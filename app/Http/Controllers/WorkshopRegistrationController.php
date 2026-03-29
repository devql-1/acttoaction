<?php

namespace App\Http\Controllers;

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
            'parent_name' => 'required|string|max:120',
            'email' => 'required|email|max:150',
            'phone' => 'required|string|max:20',
            'whatsapp' => 'nullable|string|max:20',
            'children' => 'required|array|min:1|max:5',
            'children.*.student_name' => 'required|string|max:120',
            'children.*.dob' => 'nullable|date|before:today',
            'children.*.school_name' => 'nullable|string|max:150',
            'children.*.experience' => 'nullable|in:none,beginner,intermediate,advanced',
            'message' => 'nullable|string|max:1000',
        ]);

        $amount = (float) $school->fees;
        $childCount = count($data['children']);
        $totalAmount = $amount * $childCount;

        $registrations = [];

        DB::transaction(function () use ($data, $school, $amount, &$registrations) {
            foreach ($data['children'] as $child) {
                $registrations[] = WorkshopRegistration::create([
                    'workshop_school_id' => $school->id,
                    'age_group_id' => $school->age_group_id,
                    'city_id' => $school->city_id,

                    'participant_name' => $data['parent_name'],
                    'participant_email' => $data['email'],
                    'participant_phone' => $data['phone'],
                    'parent_name' => $data['parent_name'],
                    'parent_phone' => $data['phone'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'whatsapp' => $data['whatsapp'] ?? null,

                    'student_name' => $child['student_name'],
                    'dob' => $child['dob'] ?? null,
                    'school_name' => $child['school_name'] ?? null,
                    'experience' => $child['experience'] ?? null,

                    'workshop_name' => $school->name,
                    'city_name' => $school->city?->name,
                    'age_group_name' => $school->ageGroup?->name,

                    'amount' => $amount,
                    'status' => 'pending',
                    'message' => $data['message'] ?? null,
                    'ip_address' => request()->ip(),
                ]);
            }
        });

        // ── FREE WORKSHOP ─────────────────────────────────────────────────────
        if ($amount == 0) {
            foreach ($registrations as $reg) {
                $reg->update(['status' => 'confirmed']);
            }

            // Send free confirmation email
            $this->sendConfirmationEmail(registrations: $registrations, totalAmount: 0, paymentId: 'FREE', isFree: true);

            return response()->json([
                'is_free' => true,
                'registration_ids' => collect($registrations)->pluck('id'),
                'child_count' => $childCount,
                'message' => $childCount > 1 ? "All {$childCount} children registered successfully!" : 'Registration confirmed!',
            ]);
        }

        return $this->createRazorpayOrder($registrations, $school, $totalAmount, $childCount);
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
            'razorpay_order_id' => 'required|string',
            'razorpay_payment_id' => 'required|string',
            'razorpay_signature' => 'required|string',
        ]);

        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

        // 1. Verify signature — throws on mismatch
        $api->utility->verifyPaymentSignature([
            'razorpay_order_id' => $request->razorpay_order_id,
            'razorpay_payment_id' => $request->razorpay_payment_id,
            'razorpay_signature' => $request->razorpay_signature,
        ]);

        // 2. Prevent duplicate processing
        if (Payment::where('razorpay_payment_id', $request->razorpay_payment_id)->exists()) {
            return response()->json(['success' => true, 'message' => 'Payment already processed']);
        }

        // 3. Fetch payment method details from Razorpay
        $rzpPayment = $api->payment->fetch($request->razorpay_payment_id);

        // 4. Load all registrations tied to this order (one per child)
        $registrations = WorkshopRegistration::where('razorpay_order_id', $request->razorpay_order_id)->where('status', 'pending')->get();

        $confirmedCount = $registrations->count();
        $totalAmount = $registrations->sum('amount'); // sum of all children's fees

        // 5. DB transaction: confirm all registrations + save payment record
        DB::transaction(function () use ($request, $rzpPayment, $registrations, $totalAmount) {
            // Confirm every child registration under this order
            WorkshopRegistration::where('razorpay_order_id', $request->razorpay_order_id)
                ->where('status', 'pending')
                ->update([
                    'status' => 'confirmed',
                    'razorpay_payment_id' => $request->razorpay_payment_id,
                    'razorpay_signature' => $request->razorpay_signature,
                ]);

            // Save payment record — linked to the primary (first) registration
            Payment::create([
                'event_registration_id' => null, // not an event registration
                'enrollment_id' => null,
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature,
                'amount' => $totalAmount,
                'currency' => 'INR',
                'status' => 'success',
                'transaction_type' => $rzpPayment->method,
                'type' => 'workshop_registration',
                'paid_at' => now(),
                'contact' => $rzpPayment->contact ?? null,
                'email' => $rzpPayment->email ?? null,
            ]);
        });

        // 6. Reload confirmed registrations for email (fresh after update)
        $confirmedRegistrations = WorkshopRegistration::where('razorpay_order_id', $request->razorpay_order_id)->get();

        // 7. Send confirmation email
        $this->sendConfirmationEmail(registrations: $confirmedRegistrations->all(), totalAmount: $totalAmount, paymentId: $request->razorpay_payment_id, isFree: false);

        return response()->json([
            'success' => true,
            'child_count' => $confirmedCount,
            'message' => $confirmedCount > 1 ? "Payment confirmed! All {$confirmedCount} children registered." : 'Payment verified. Registration confirmed!',
        ]);
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

        // ── Build [key] => value placeholders ────────────────────────────────
        $placeholders = [
            'parent_name' => $first->parent_name ?? 'Parent',
            'registration_id' => $first->id,
            'workshop_name' => $first->workshop_name ?? 'Workshop',
            'age_group_name' => $first->age_group_name ?? '',
            'city_name' => $first->city_name ?? '',
            'phone' => $first->phone ?? '',
            'child_count' => $childCount,
            'amount_paid' => $isFree ? 'Free' : '₹' . number_format($totalAmount, 2),
            'payment_id' => $isFree ? 'N/A (Free Workshop)' : $paymentId,
            'payment_status_label' => $isFree ? 'Registration Free' : 'Payment Successful',
            'child_cards' => $childCardsHtml,
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
