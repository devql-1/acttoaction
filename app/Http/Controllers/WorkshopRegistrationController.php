<?php

namespace App\Http\Controllers;

use App\Models\Merchandise;
use App\Models\Payment;
use App\Models\WorkshopRegistration;
use App\Models\WorkshopSchool;
use App\Services\EmailService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Razorpay\Api\Api;

class WorkshopRegistrationController extends Controller
{
    public function register(Request $request, WorkshopSchool $school): JsonResponse
    {
        if (!$school->status) {
            return response()->json(['error' => 'Workshop not available'], 404);
        }

        $data = $request->validate([
            'parent_name'               => 'required|string|max:120',
            'email'                     => 'required|email|max:150',
            'phone'    => ['required', 'string', 'max:15', function ($attr, $val, $fail) {
                if (!preg_match('/^\+91\d{10}$/', $val)) {
                    $fail('Phone must be a valid Indian 10-digit number.');
                }
            }],
            'whatsapp' => ['nullable', 'string', 'max:15', function ($attr, $val, $fail) {
                if (!empty($val) && !preg_match('/^\+91\d{10}$/', $val)) {
                    $fail('WhatsApp must be a valid Indian 10-digit number.');
                }
            }],
            'children'                  => 'required|array|min:1|max:5',
            'children.*.student_name'   => 'required|string|max:120',
            'children.*.dob'            => 'nullable|date|before:today',
            'children.*.school_name'    => 'nullable|string|max:150',
            'children.*.experience'     => 'nullable|in:none,beginner,intermediate,advanced',
            'message'                   => 'nullable|string|max:1000',
            'merchandise'               => 'nullable|array|max:20',
            'merchandise.*.id'          => 'required_with:merchandise|integer|exists:merchandises,id',
            'merchandise.*.qty'         => 'required_with:merchandise|integer|min:1|max:10',
        ]);

        // ── Resolve merchandise items and compute subtotal ────────────────────
        $merchandiseItems = [];
        $merchandiseTotal = 0.0;

        if (!empty($data['merchandise'])) {
            $ids         = collect($data['merchandise'])->pluck('id')->unique();
            $merchModels = Merchandise::whereIn('id', $ids)->where('status', true)->get()->keyBy('id');

            foreach ($data['merchandise'] as $entry) {
                $model = $merchModels->get($entry['id']);
                if (!$model) continue;

                $qty   = (int) $entry['qty'];
                $price = (float) $model->price;

                $merchandiseItems[] = [
                    'id'    => $model->id,
                    'name'  => $model->name,
                    'price' => $price,
                    'qty'   => $qty,
                ];
                $merchandiseTotal += $price * $qty;
            }
        }

        $amount      = (float) $school->fees;
        $childCount  = count($data['children']);
        $totalAmount = ($amount * $childCount) + $merchandiseTotal;

        $registrations = [];

        DB::transaction(function () use ($data, $school, $amount, $merchandiseItems, $merchandiseTotal, &$registrations) {
            foreach ($data['children'] as $child) {
                $registrations[] = WorkshopRegistration::create([
                    'workshop_school_id' => $school->id,
                    'age_group_id'       => $school->age_group_id,
                    'city_id'            => $school->city_id,

                    'participant_name'  => $data['parent_name'],
                    'participant_email' => $data['email'],
                    'participant_phone' => $data['phone'],
                    'parent_name'       => $data['parent_name'],
                    'parent_phone'      => $data['phone'],
                    'email'             => $data['email'],
                    'phone'             => $data['phone'],
                    'whatsapp'          => $data['whatsapp'] ?? null,

                    'student_name' => $child['student_name'],
                    'dob'          => $child['dob'] ?? null,
                    'school_name'  => $child['school_name'] ?? null,
                    'experience'   => $child['experience'] ?? null,

                    'workshop_name'  => $school->name,
                    'city_name'      => $school->city?->name,
                    'age_group_name' => $school->ageGroup?->name,

                    'amount'             => $amount,
                    'merchandise_items'  => !empty($merchandiseItems) ? $merchandiseItems : null,
                    'merchandise_total'  => $merchandiseTotal,
                    'status'             => 'pending',
                    'message'            => $data['message'] ?? null,
                    'ip_address'         => request()->ip(),
                ]);
            }
        });

        // ── FREE WORKSHOP ─────────────────────────────────────────────────────
        if ($amount <= 0) {
            foreach ($registrations as $reg) {
                $reg->update(['status' => 'confirmed']);
            }

            $this->sendConfirmationEmail(registrations: $registrations, totalAmount: 0, paymentId: 'FREE', isFree: true);

            return response()->json([
                'is_free'          => true,
                'registration_ids' => collect($registrations)->pluck('id'),
                'child_count'      => $childCount,
                'message'          => $childCount > 1 ? "All {$childCount} children registered successfully!" : 'Registration confirmed!',
            ]);
        }

        // ── PAID WORKSHOP — create Razorpay order ────────────────────────────
        // If Razorpay order creation fails, delete the pending registrations so
        // the user doesn't end up with orphaned records they can never pay for.
        try {
            return $this->createRazorpayOrder($registrations, $school, $totalAmount, $childCount);
        } catch (\Exception $e) {
            $ids = collect($registrations)->pluck('id');
            WorkshopRegistration::whereIn('id', $ids)->delete();

            Log::error('Workshop Razorpay order creation failed', [
                'school_id' => $school->id,
                'error'     => $e->getMessage(),
            ]);

            return response()->json(['error' => 'Payment setup failed. Please try again.'], 500);
        }
    }

    // ── CREATE RAZORPAY ORDER ─────────────────────────────────────────────────
    private function createRazorpayOrder(array $registrations, WorkshopSchool $school, float $totalAmount, int $childCount): JsonResponse
    {
        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

        $primaryId = $registrations[0]->id;
        $allIds = collect($registrations)->pluck('id')->implode('_');

        $order = $api->order->create([
            'receipt' => 'WS_' . $school->id . '_' . $allIds . '_' . uniqid(),
            'amount' => (int) round($totalAmount * 100),
            'currency' => 'INR',
            'notes' => [
                'workshop_school_id' => $school->id,
                'registration_ids' => $allIds,
                'children' => $childCount,
            ],
        ]);

        foreach ($registrations as $reg) {
            $reg->update(['razorpay_order_id' => $order->id]);
        }

        return response()->json([
            'is_free' => false,
            'registration_id' => $primaryId,
            'registration_ids' => collect($registrations)->pluck('id'),
            'order_id' => $order->id,
            'amount' => $order->amount,
            'currency' => $order->currency,
            'workshop_name' => $school->name,
            'child_count' => $childCount,
        ]);
    }

    // ── VERIFY PAYMENT ────────────────────────────────────────────────────────
    public function verifyPayment(Request $request, WorkshopRegistration $registration): JsonResponse
    {
        $request->validate([
            'razorpay_order_id'  => 'required|string',
            'razorpay_payment_id' => 'required|string',
            'razorpay_signature' => 'required|string',
        ]);

        // Fix 5: Validate that the registration in the URL actually owns this order.
        // Prevents someone from using a random registration ID in the URL with a
        // different user's payment.
        if ($registration->razorpay_order_id !== $request->razorpay_order_id) {
            return response()->json(['success' => false, 'message' => 'Payment verification failed'], 422);
        }

        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

        // Fix 1: Wrap signature verification in a try-catch so a bad signature
        // returns 422 + audit log instead of an unhandled 500.
        try {
            $api->utility->verifyPaymentSignature([
                'razorpay_order_id'  => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature,
            ]);
        } catch (\Razorpay\Api\Errors\SignatureVerificationError $e) {
            Log::warning('Workshop payment signature mismatch', [
                'order_id'   => $request->razorpay_order_id,
                'payment_id' => $request->razorpay_payment_id,
                'ip'         => $request->ip(),
            ]);
            return response()->json(['success' => false, 'message' => 'Payment verification failed'], 422);
        }

        try {
            // Fix 2: Fetch authoritative payment details from Razorpay BEFORE the
            // transaction so we can verify the amount without holding DB locks during
            // a network call.
            $rzpPayment = $api->payment->fetch($request->razorpay_payment_id);

            $alreadyProcessed = false;
            $confirmedCount   = 0;
            $totalAmount      = 0.0;

            // Fix 3: Move idempotency check + all DB writes into one transaction
            // with row-level locks to eliminate the TOCTOU race condition.
            DB::transaction(function () use ($request, $rzpPayment, &$alreadyProcessed, &$confirmedCount, &$totalAmount) {

                // Idempotency check INSIDE the lock — prevents two concurrent
                // requests both slipping past the check and double-confirming.
                if (Payment::where('razorpay_payment_id', $request->razorpay_payment_id)
                    ->lockForUpdate()->exists()) {
                    $alreadyProcessed = true;
                    return;
                }

                // Lock all pending registrations for this order atomically.
                $registrations = WorkshopRegistration::where('razorpay_order_id', $request->razorpay_order_id)
                    ->where('status', 'pending')
                    ->lockForUpdate()
                    ->get();

                // If none are pending the order was already confirmed.
                if ($registrations->isEmpty()) {
                    $alreadyProcessed = true;
                    return;
                }

                $totalAmount = (float) $registrations->sum('amount');

                // Fix 2: Verify the amount Razorpay actually charged matches the
                // sum of the registration fees stored in the DB.
                // Prevents a user paying ₹1 to confirm a ₹5000 registration.
                $expectedPaise = (int) round($totalAmount * 100);
                $receivedPaise = (int) $rzpPayment->amount;

                if ($receivedPaise !== $expectedPaise) {
                    throw new \Exception(
                        "Amount mismatch: expected {$expectedPaise} paise, received {$receivedPaise} paise."
                    );
                }

                // Confirm every child registration under this order.
                WorkshopRegistration::where('razorpay_order_id', $request->razorpay_order_id)
                    ->where('status', 'pending')
                    ->update([
                        'status'               => 'confirmed',
                        'razorpay_payment_id'  => $request->razorpay_payment_id,
                        'razorpay_signature'   => $request->razorpay_signature,
                    ]);

                // Save payment record — use direct property assignment because
                // 'status' is intentionally excluded from $fillable on the Payment
                // model to prevent mass-assignment from bypassing verification.
                $payment = new Payment();
                $payment->enrollment_id       = null;
                $payment->razorpay_order_id   = $request->razorpay_order_id;
                $payment->razorpay_payment_id = $request->razorpay_payment_id;
                $payment->razorpay_signature  = $request->razorpay_signature;
                $payment->amount              = $rzpPayment->amount / 100; // authoritative from Razorpay
                $payment->currency            = 'INR';
                $payment->status              = 'success';
                $payment->transaction_type    = $rzpPayment->method;
                $payment->type                = 'workshop_registration';
                $payment->paid_at             = now();
                $payment->contact             = $rzpPayment->contact ?? null;
                $payment->email               = $rzpPayment->email ?? null;
                $payment->save();

                $confirmedCount = $registrations->count();
            });

            if ($alreadyProcessed) {
                return response()->json(['success' => true, 'message' => 'Payment already processed']);
            }

            // Reload confirmed registrations for the email (fresh state after update).
            $confirmedRegistrations = WorkshopRegistration::where('razorpay_order_id', $request->razorpay_order_id)->get();

            $this->sendConfirmationEmail(
                registrations: $confirmedRegistrations->all(),
                totalAmount:   $totalAmount,
                paymentId:     $request->razorpay_payment_id,
                isFree:        false,
            );

            return response()->json([
                'success'     => true,
                'child_count' => $confirmedCount,
                'message'     => $confirmedCount > 1
                    ? "Payment confirmed! All {$confirmedCount} children registered."
                    : 'Payment verified. Registration confirmed!',
            ]);

        } catch (\Exception $e) {
            Log::error('Workshop payment verification error', [
                'order_id'   => $request->razorpay_order_id,
                'payment_id' => $request->razorpay_payment_id,
                'error'      => $e->getMessage(),
            ]);
            return response()->json(['success' => false, 'message' => 'Payment verification failed'], 500);
        }
    }

    // ── SEND CONFIRMATION EMAIL ───────────────────────────────────────────────
    /**
     * Builds dynamic [child_cards] HTML and sends the workshop confirmation email.
     * Called for both free workshops (from register()) and paid (from verifyPayment()).
     *
     * @param WorkshopRegistration[] $registrations
     */
    private function sendConfirmationEmail(array $registrations, float $totalAmount, string $paymentId, bool $isFree): void
    {
        if (empty($registrations)) {
            return;
        }

        $first = $registrations[0];
        $toEmail = $first->email;
        $childCount = count($registrations);

        if (!$toEmail) {
            return;
        }

        // ── Build dynamic child cards HTML ────────────────────────────────────
        // One card per child — teal/sky styling to match the workshop email theme.
        $childCardsHtml = '';

        foreach ($registrations as $index => $reg) {
            $num = $index + 1;
            $isFirst = $index === 0;

            // First child card gets highlighted styling
            $cardStyle = $isFirst ? 'border:1px solid #bae6fd;border-radius:8px;background:#f0f9ff;margin-bottom:12px;' : 'border:1px solid #e5e7eb;border-radius:8px;background:#ffffff;margin-bottom:12px;';

            $badgeBg = $isFirst ? '#0ea5e9' : '#6366f1';

            $firstTag = $isFirst ? ' <span style="display:inline-block;background:#0ea5e9;color:#fff;font-size:10px;font-weight:600;padding:2px 8px;border-radius:20px;letter-spacing:0.4px;text-transform:uppercase;margin-left:8px;vertical-align:middle;">Primary</span>' : '';

            // Build meta line — only show fields that have data
            $metaParts = [];

            if (!empty($reg->dob)) {
                $age = \Carbon\Carbon::parse($reg->dob)->age;
                $dobFormatted = \Carbon\Carbon::parse($reg->dob)->format('d M Y');
                $metaParts[] = '🎂 ' . $dobFormatted . ' (Age: ' . $age . ')';
            }
            if (!empty($reg->school_name)) {
                $metaParts[] = '🏫 ' . htmlspecialchars($reg->school_name);
            }
            if (!empty($reg->experience) && $reg->experience !== 'none') {
                $metaParts[] = '🎨 ' . ucfirst($reg->experience) . ' level';
            }
            if (!empty($reg->age_group_name)) {
                $metaParts[] = '👥 ' . htmlspecialchars($reg->age_group_name);
            }

            $metaHtml = !empty($metaParts) ? '<p style="margin:0;font-size:13px;color:#6b7280;line-height:2;">' . implode('&nbsp;&nbsp; ', $metaParts) . '</p>' : '';

            $childCardsHtml .=
                '
            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="' .
                $cardStyle .
                '">
              <tr>
                <td style="padding:0;">
                  <span style="display:inline-block;background:' .
                $badgeBg .
                ';color:#fff;font-size:11px;font-weight:700;padding:3px 10px;border-radius:7px 0 6px 0;letter-spacing:0.3px;">Child #' .
                $num .
                '</span>
                </td>
              </tr>
              <tr>
                <td style="padding:4px 16px 14px;">
                  <p style="margin:8px 0 8px;font-size:15px;font-weight:700;color:#111827;">' .
                htmlspecialchars($reg->student_name) .
                $firstTag .
                '</p>
                  ' .
                $metaHtml .
                '
                </td>
              </tr>
            </table>';
        }

        // ── Build merchandise section HTML ────────────────────────────────────
        $merchandiseHtml = '';
        $merchandiseItems = $first->merchandise_items ?? [];
        $merchandiseTotal = (float) $first->merchandise_total;

        if (!empty($merchandiseItems) && $merchandiseTotal > 0) {
            $rows = '';
            foreach ($merchandiseItems as $item) {
                $itemTotal = number_format((float)$item['price'] * (int)$item['qty'], 2);
                $rows .= '<tr>
                    <td style="padding:8px 12px;font-size:13px;color:#374151;border-bottom:1px solid #f3f4f6;">' . htmlspecialchars($item['name']) . '</td>
                    <td style="padding:8px 12px;font-size:13px;color:#374151;border-bottom:1px solid #f3f4f6;text-align:center;">' . (int)$item['qty'] . '</td>
                    <td style="padding:8px 12px;font-size:13px;color:#374151;border-bottom:1px solid #f3f4f6;text-align:right;">₹' . number_format((float)$item['price'], 2) . '</td>
                    <td style="padding:8px 12px;font-size:13px;font-weight:600;color:#111827;border-bottom:1px solid #f3f4f6;text-align:right;">₹' . $itemTotal . '</td>
                </tr>';
            }

            $merchandiseHtml = '
            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border:1px solid #e0f2fe;border-radius:8px;background:#f0f9ff;margin-top:16px;">
              <tr>
                <td colspan="4" style="padding:10px 12px;background:#0ea5e9;border-radius:7px 7px 0 0;">
                  <span style="font-size:13px;font-weight:700;color:#fff;letter-spacing:0.3px;">🛍️ Merchandise Ordered</span>
                </td>
              </tr>
              <tr style="background:#e0f2fe;">
                <th style="padding:8px 12px;font-size:12px;color:#0369a1;text-align:left;font-weight:600;">Item</th>
                <th style="padding:8px 12px;font-size:12px;color:#0369a1;text-align:center;font-weight:600;">Qty</th>
                <th style="padding:8px 12px;font-size:12px;color:#0369a1;text-align:right;font-weight:600;">Price</th>
                <th style="padding:8px 12px;font-size:12px;color:#0369a1;text-align:right;font-weight:600;">Total</th>
              </tr>
              ' . $rows . '
              <tr>
                <td colspan="3" style="padding:10px 12px;font-size:13px;font-weight:700;color:#111827;text-align:right;">Merchandise Total:</td>
                <td style="padding:10px 12px;font-size:14px;font-weight:700;color:#0ea5e9;text-align:right;">₹' . number_format($merchandiseTotal, 2) . '</td>
              </tr>
            </table>';
        }

        // ── Build [key] => value placeholders ────────────────────────────────
        $workshopFees  = $totalAmount - $merchandiseTotal;
        $placeholders = [
            'parent_name'          => $first->parent_name ?? 'Parent',
            'registration_id'      => $first->id,
            'workshop_name'        => $first->workshop_name ?? 'Workshop',
            'age_group_name'       => $first->age_group_name ?? '',
            'city_name'            => $first->city_name ?? '',
            'phone'                => $first->phone ?? '',
            'child_count'          => $childCount,
            'workshop_fees'        => $isFree ? 'Free' : '₹' . number_format($workshopFees, 2),
            'merchandise_total'    => $merchandiseTotal > 0 ? '₹' . number_format($merchandiseTotal, 2) : '—',
            'amount_paid'          => $isFree ? 'Free' : '₹' . number_format($totalAmount, 2),
            'payment_id'           => $isFree ? 'N/A (Free Workshop)' : $paymentId,
            'payment_status_label' => $isFree ? 'Registration Free' : 'Payment Successful',
            'child_cards'          => $childCardsHtml,
            'merchandise_section'  => $merchandiseHtml,
        ];

        try {
            app(EmailService::class)->send(
                'workshop-registration-confirmation', // your CKEditor template key/slug
                $toEmail,
                $placeholders,
                $first->parent_name ?? 'Parent', // $name param for EmailService
            );
        } catch (\Exception $e) {
            Log::error('Workshop registration confirmation email failed', [
                'registration_id' => $first->id,
                'to_email' => $toEmail,
                'error' => $e->getMessage(),
            ]);
        }
    }
}
