<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use App\Models\Course;
use Razorpay\Api\Api;
use App\Models\Payment;
use App\Services\EmailService;
use Illuminate\Support\Facades\DB;

class EnrollmentController extends Controller
{
    /**
     * Show the multi-step enrollment form
     */
    public function enroll(Course $course)
    {
        $course->load([
            'category',
            'centers' => function ($q) {
                $q->active()->with('state');
            },
        ]);

        $centresByState = [];
        foreach ($course->centers as $center) {
            $stateName = $center->state ? $center->state->name : 'Other';
            if (!isset($centresByState[$stateName])) {
                $centresByState[$stateName] = [];
            }

            // Debug: dump pivot to confirm column name
            // dd($center->pivot->toArray());

            $centresByState[$stateName][] = [
                'id' => $center->id,
                'name' => $center->name,
                'fees' => (float) ($center->pivot->fees ?? ($center->pivot->fee ?? 0)),
                'address' => $center->address ?? '',
                'phone' => $center->phone ?? '',
                'email' => $center->email ?? '',
                'map' => $center->map_link ?? '',
            ];
        }

        $courseStates = array_keys($centresByState);
        $otherCourses = Course::with('category')->where('id', '!=', $course->id)->latest()->take(5)->get();

        return view('frontend.enrollment.create', compact('course', 'otherCourses', 'centresByState', 'courseStates'));
    }

    /**
     * Handle form submission
     */
    public function store(Request $request)
    {
        $isLead = $request->boolean('is_lead');

        $rules = [
            'centre_id'    => 'required|integer|exists:centers,id',
            'first_name'   => 'required|string|max:100',
            'last_name'    => 'required|string|max:100',
            'dob'          => ['required', 'date', 'before:today', 'after:' . now()->subYears(100)->toDateString()],
            'gender'       => 'required|in:Male,Female,Other',
            'father_name'  => 'required|string|max:100',
            'mother_name'  => 'required|string|max:100',
            'parent_phone' => ['required', 'string', 'max:20', function ($attr, $val, $fail) {
                if (!preg_match('/^\+91\d{10}$/', $val)) {
                    $fail('The parent phone must be a valid Indian 10-digit number (+91XXXXXXXXXX).');
                }
            }],
            'parent_email' => 'required|email|max:150',
            'mother_phone' => ['nullable', 'string', 'max:20', function ($attr, $val, $fail) {
                if (!empty($val) && !preg_match('/^\+91\d{10}$/', $val)) {
                    $fail('The mother phone must be a valid Indian 10-digit number (+91XXXXXXXXXX).');
                }
            }],
            'phone'        => ['required', 'string', 'max:20', function ($attr, $val, $fail) {
                if (!preg_match('/^\+91\d{10}$/', $val)) {
                    $fail('The phone must be a valid Indian 10-digit number (+91XXXXXXXXXX).');
                }
            }],
            'email'        => 'required|email|max:150',
            'address'      => 'required|string|max:500',
            'school'       => 'required|string|max:200',
            'grade'        => 'nullable|string|max:200',
            'achievements' => 'nullable|string|max:1000',
            'state'        => 'required|string|max:100',
            'city'         => 'nullable|string|max:100',
            'centre'       => 'required|string|max:200',
            'mode'         => ['required', 'string', Rule::in([
                'Online — Live Classes',
                'Offline — At Centre',
                'Hybrid — Online + Centre',
            ])],
            'course'              => 'required|string|max:200',
            'newsletter_subscribed' => 'boolean',
        ];

        if (!$isLead) {
            $rules['terms_accepted'] = 'required|accepted';
        }

        $validated = $request->validate($rules);
        $age = Carbon::parse($validated['dob'])->age;

        $course = Course::where('title', $validated['course'])->first();

        // Fetch fee from pivot table using course + centre
        $centreId = $request->input('centre_id');
        $fee = 0;

        if ($course && $centreId) {
            $pivotFee = $course->centers()->where('centers.id', $centreId)->first()?->pivot?->fees;
            $fee = $pivotFee ?? 0;
        }

        // Validate fee before creating any record (non-leads must have a configured fee)
        if (!$isLead && $fee <= 0) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Course fee not configured properly for the selected centre.',
                ],
                422,
            );
        }

        // Update existing enrollment if upgrading from lead.
        // Ownership is verified by matching phone to prevent arbitrary ID injection.
        if ($request->filled('enrollment_id') && !$isLead) {
            $enrollment = Enrollment::where('id', $request->enrollment_id)
                ->where('status', 'lead')
                ->where('phone', $validated['phone'])
                ->first();

            if ($enrollment) {
                $enrollment->update([
                    'mother_phone'          => $validated['mother_phone'] ?? null,
                    'parent_phone'          => $validated['parent_phone'],
                    'parent_email'          => $validated['parent_email'],
                    'address'               => $validated['address'],
                    'city'                  => $validated['city'] ?? null,
                    'achievements'          => $validated['achievements'] ?? null,
                    'newsletter_subscribed' => $request->boolean('newsletter_subscribed'),
                    'course'                => $validated['course'],
                    'fee'                   => $fee,
                    'terms_accepted'        => true,
                    'status'                => 'pending',
                ]);
            }
        }

        // Create new enrollment if none was found/updated above
        if (!isset($enrollment) || !$enrollment) {
            $enrollment = Enrollment::create([
                'first_name'            => $validated['first_name'],
                'last_name'             => $validated['last_name'],
                'dob'                   => $validated['dob'],
                'age'                   => $age,
                'gender'                => $validated['gender'],
                'father_name'           => $validated['father_name'],
                'mother_name'           => $validated['mother_name'],
                'mother_phone'          => $validated['mother_phone'] ?? null,
                'parent_phone'          => $validated['parent_phone'],
                'parent_email'          => $validated['parent_email'],
                'phone'                 => $validated['phone'],
                'email'                 => $validated['email'],
                'address'               => $validated['address'],
                'school'                => $validated['school'],
                'grade'                 => $validated['grade'],
                'achievements'          => $validated['achievements'] ?? null,
                'state'                 => $validated['state'],
                'city'                  => $validated['city'] ?? null,
                'centre'                => $validated['centre'],
                'mode'                  => $validated['mode'],
                'course'                => $validated['course'],
                'fee'                   => $fee,
                'terms_accepted'        => !$isLead,
                'newsletter_subscribed' => $request->boolean('newsletter_subscribed'),
                'status'                => $isLead ? 'lead' : 'pending',
            ]);
        }

        // Return early if saving as lead only
        if ($isLead) {
            return response()->json([
                'success' => true,
                'enrollment_id' => $enrollment->id,
            ]);
        }

        // Create Razorpay Payment Link (key stays 100% server-side, no key sent to browser)
        try {
            $api  = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
            $link = $api->paymentLink->create([
                'amount'           => $fee * 100,
                'currency'         => 'INR',
                'accept_partial'   => false,
                'reference_id'     => $enrollment->reference_id,
                'description'      => 'Course Enrollment: ' . $enrollment->course,
                'customer'         => [
                    'name'    => $enrollment->first_name . ' ' . $enrollment->last_name,
                    'email'   => $enrollment->email,
                    'contact' => $enrollment->phone,
                ],
                'notify'           => ['sms' => false, 'email' => false],
                'reminder_enable'  => false,
                'callback_url'     => route('enrollment.payment.callback'),
                'callback_method'  => 'get',
                'expire_by'        => now()->addHours(2)->timestamp,
            ]);

            // Store enrollment ID in session to verify callback ownership
            session(['rzp_enrollment_id' => $enrollment->id]);
            session(['rzp_link_id'       => $link->id]);
            session(['rzp_amount'        => $fee * 100]);

            return response()->json([
                'success'      => true,
                'payment_url'  => $link->short_url, // e.g. https://rzp.io/l/xxxxx
                'enrollment_id'=> $enrollment->id,
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Failed to create payment link. Please try again.',
                ],
                500,
            );
        }
    }
    public function validateField(Request $request)
    {
        $field = $request->input('field');
        $value = $request->input('value');

        // Whitelist — only these two fields are valid to check
        if (!in_array($field, ['phone', 'email'], true)) {
            return response()->json(['valid' => true]);
        }

        if ($field === 'phone') {
            if (!preg_match('/^\+91\d{10}$/', $value)) {
                return response()->json(['valid' => false, 'message' => 'Enter a valid 10-digit Indian phone number']);
            }
            return response()->json(['valid' => true]);
        }

        if ($field === 'email') {
            if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                return response()->json(['valid' => false, 'message' => 'Enter a valid email address']);
            }
            return response()->json(['valid' => true]);
        }

        return response()->json(['valid' => true]);
    }
    /**
     * Admin: List all enrollments with search & filters
     */
    public function index(Request $request)
    {
        $query = Enrollment::with('latestPayment')->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('first_name', 'like', "%$search%")
                    ->orWhere('last_name', 'like', "%$search%")
                    ->orWhere('phone', 'like', "%$search%")
                    ->orWhere('email', 'like', "%$search%")
                    ->orWhere('reference_id', 'like', "%$search%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('course')) {
            $query->where('course', 'like', '%' . $request->course . '%');
        }

        $enrollments = $query->paginate(20)->withQueryString();

        $stats = [
            'total' => Enrollment::count(),
            'confirmed' => Enrollment::where('status', 'confirmed')->count(),
            'lead' => Enrollment::where('status', 'lead')->count(),
            'pending' => Enrollment::where('status', 'pending')->count(),
        ];

        return view('backend.enrollments.index', compact('enrollments', 'stats'));
    }

    /**
     * Admin: View single enrollment
     */
    public function show($id)
    {
        $enrollment = Enrollment::findOrFail($id);
        return view('backend.enrollments.show', compact('enrollment'));
    }

    /**
     * Admin: Update enrollment status
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required|in:pending,confirmed,cancelled']);

        Enrollment::findOrFail($id)->update(['status' => $request->status]);

        return back()->with('success', 'Enrollment status updated.');
    }

    /**
     * Admin: Delete enrollment
     */
    public function destroy($id)
    {
        Enrollment::findOrFail($id)->delete();
        return back()->with('success', 'Enrollment deleted.');
    }

    /**
     * Verify Razorpay payment and confirm enrollment
     */
    public function verifyPayment(Request $request)
    {
        $request->validate([
            'razorpay_order_id' => 'required|string',
            'razorpay_payment_id' => 'required|string',
            'razorpay_signature' => 'required|string',
            'enrollment_id' => 'required|integer|exists:enrollments,id',
        ]);

        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

        try {
            // Step 1: Verify Razorpay signature FIRST before any other logic.
            $api->utility->verifyPaymentSignature([
                'razorpay_order_id'   => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature'  => $request->razorpay_signature,
            ]);

            // Step 2: Prevent cross-enrollment replay by matching the checkout session.
            // Note: rzp_order_id is not tracked here because store() uses Razorpay
            // Payment Links (no pre-created order); matching the enrollment is
            // sufficient — the authoritative order/amount check happens in Step 4/5b
            // against the Razorpay-fetched payment object.
            if ((int) session('rzp_enrollment_id') !== (int) $request->enrollment_id) {
                return response()->json(['success' => false, 'message' => 'Payment verification failed'], 422);
            }

            // Step 3: Fetch authoritative payment details from Razorpay.
            $rzpPayment = $api->payment->fetch($request->razorpay_payment_id);

            // Step 4: Confirm the order ID on the Razorpay payment matches what we expect.
            if ((string) ($rzpPayment->order_id ?? '') !== (string) $request->razorpay_order_id) {
                return response()->json(['success' => false, 'message' => 'Payment verification failed'], 422);
            }

            // Step 5: Process payment atomically inside a transaction with row-level locking
            // to prevent race conditions from concurrent requests.
            $alreadyProcessed = false;

            DB::transaction(function () use ($request, $rzpPayment, &$alreadyProcessed) {
                // Lock the enrollment row for the duration of this transaction.
                $enrollment = Enrollment::lockForUpdate()->findOrFail($request->enrollment_id);

                // Step 5a: Idempotency check inside the transaction (with lock held).
                if (Payment::where('razorpay_payment_id', $request->razorpay_payment_id)->exists()) {
                    $alreadyProcessed = true;
                    return;
                }

                // Step 5b: Verify the amount Razorpay actually charged matches the fee on record.
                // This prevents a user paying ₹1 to confirm a ₹5000 enrollment.
                $expectedPaise = (int) ($enrollment->fee * 100);
                $receivedPaise = (int) $rzpPayment->amount;
                if ($receivedPaise !== $expectedPaise) {
                    throw new \Exception("Amount mismatch: expected {$expectedPaise} paise, received {$receivedPaise} paise.");
                }

                // Update enrollment status
                if ($enrollment->status !== 'confirmed') {
                    $enrollment->update(['status' => 'confirmed']);
                }

                // Create payment record using the verified Razorpay amount as the source of truth.
                $payment = new Payment();
                $payment->enrollment_id       = $enrollment->id;
                $payment->razorpay_order_id   = $request->razorpay_order_id;
                $payment->razorpay_payment_id = $request->razorpay_payment_id;
                $payment->razorpay_signature  = $request->razorpay_signature;
                $payment->amount              = $rzpPayment->amount / 100; // authoritative from Razorpay
                $payment->currency            = 'INR';
                $payment->status              = 'success';
                $payment->transaction_type    = $rzpPayment->method;
                $payment->type                = 'course_enrollment';
                $payment->paid_at             = now();
                $payment->contact             = $rzpPayment->contact ?? $enrollment->phone;
                $payment->email               = $rzpPayment->email ?? $enrollment->email;
                $payment->save();

                // Send confirmation email (failure does not roll back the payment)
                try {
                    app(EmailService::class)->send(
                        'enrollment-confirmation',
                        $enrollment->email,
                        [
                            'student_name' => $enrollment->first_name . ' ' . $enrollment->last_name,
                            'course_name'  => $enrollment->course,
                            'centre'       => $enrollment->centre,
                            'reference_id' => $enrollment->reference_id,
                            'amount'       => '₹' . number_format($enrollment->fee),
                            'payment_id'   => $request->razorpay_payment_id,
                        ],
                        $enrollment->first_name,
                    );
                } catch (\Exception $e) {
                    // Log but do not fail — payment is already confirmed
                    \Illuminate\Support\Facades\Log::warning('Enrollment confirmation email failed', [
                        'enrollment_id' => $enrollment->id,
                        'error'         => $e->getMessage(),
                    ]);
                }
            });

            $enrollment = Enrollment::find($request->enrollment_id);
            return response()->json([
                'success'      => true,
                'message'      => $alreadyProcessed ? 'Payment already processed' : 'Payment successful',
                'reference_id' => $enrollment?->reference_id,
            ]);

        } catch (\Razorpay\Api\Errors\SignatureVerificationError $e) {
            // Record failed attempt for audit trail with real fee and order ID
            $failedEnrollment = Enrollment::find($request->enrollment_id);
            Payment::insert([
                'enrollment_id'       => $request->enrollment_id,
                'razorpay_order_id'   => $request->razorpay_order_id ?? null,
                'razorpay_payment_id' => $request->razorpay_payment_id ?: null, // null not '' — unique index allows multiple NULLs
                'amount'              => $failedEnrollment?->fee ?? 0,
                'currency'            => 'INR',
                'status'              => 'failed',
                'error_code'          => 'SIGNATURE_MISMATCH',
                'error_reason'        => $e->getMessage(),
                'type'                => 'course_enrollment',
                'created_at'          => now(),
                'updated_at'          => now(),
            ]);

            return response()->json(['success' => false, 'message' => 'Payment verification failed'], 422);

        } catch (\Exception $e) {
            // Record failed attempt for audit trail with real fee and order ID
            $failedEnrollment = Enrollment::find($request->enrollment_id ?? null);
            Payment::insert([
                'enrollment_id'       => $request->enrollment_id ?? null,
                'razorpay_order_id'   => $request->razorpay_order_id ?? null,
                'razorpay_payment_id' => $request->razorpay_payment_id ?: null, // null not '' — unique index allows multiple NULLs
                'amount'              => $failedEnrollment?->fee ?? 0,
                'currency'            => 'INR',
                'status'              => 'failed',
                'error_code'          => class_basename($e),
                'error_reason'        => $e->getMessage(),
                'type'                => 'course_enrollment',
                'created_at'          => now(),
                'updated_at'          => now(),
            ]);

            return response()->json(['success' => false, 'message' => 'Payment verification failed'], 500);
        }
    }

    /**
     * Razorpay Payment Link callback (GET redirect after payment)
     * Key never touches the browser — verification is fully server-side.
     */
    public function paymentCallback(Request $request)
    {
        // Razorpay sends these as GET params on redirect
        $paymentId     = $request->query('razorpay_payment_id');
        $linkId        = $request->query('razorpay_payment_link_id');
        $referenceId   = $request->query('razorpay_payment_link_reference_id'); // = enrollment reference_id
        $linkStatus    = $request->query('razorpay_payment_link_status');
        $signature     = $request->query('razorpay_signature');

        // Step 1: Verify the payment link signature server-side
        // Payload = link_id|reference_id|status|payment_id
        $payload          = $linkId . '|' . $referenceId . '|' . $linkStatus . '|' . $paymentId;
        $expectedSig      = hash_hmac('sha256', $payload, config('services.razorpay.secret'));

        if (!hash_equals($expectedSig, (string) $signature)) {
            return redirect()->route('home')->with('error', 'Payment verification failed. Please contact support.');
        }

        // Step 2: Confirm payment was actually paid
        if ($linkStatus !== 'paid') {
            return redirect()->route('home')->with('error', 'Payment was not completed.');
        }

        // Step 3: Find enrollment by reference_id (server-side — no user input trusted)
        $enrollment = Enrollment::where('reference_id', $referenceId)->first();

        if (!$enrollment) {
            return redirect()->route('home')->with('error', 'Enrollment not found.');
        }

        // Step 4: Fetch and verify amount from Razorpay API
        try {
            $api        = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
            $rzpPayment = $api->payment->fetch($paymentId);

            $expectedPaise = (int) ($enrollment->fee * 100);
            $receivedPaise = (int) $rzpPayment->amount;

            if ($receivedPaise !== $expectedPaise) {
                \Illuminate\Support\Facades\Log::error('Payment amount mismatch on callback', [
                    'enrollment_id' => $enrollment->id,
                    'expected'      => $expectedPaise,
                    'received'      => $receivedPaise,
                ]);
                return redirect()->route('home')->with('error', 'Payment amount mismatch. Contact support.');
            }

            // Step 5: Process atomically with lock
            DB::transaction(function () use ($paymentId, $signature, $rzpPayment, $enrollment) {
                $enrollment = Enrollment::lockForUpdate()->find($enrollment->id);

                // Idempotency — skip if already processed
                if (Payment::where('razorpay_payment_id', $paymentId)->exists()) {
                    return;
                }

                if ($enrollment->status !== 'confirmed') {
                    $enrollment->update(['status' => 'confirmed']);
                }

                $payment                      = new Payment();
                $payment->enrollment_id       = $enrollment->id;
                $payment->razorpay_order_id   = $rzpPayment->order_id ?? null;
                $payment->razorpay_payment_id = $paymentId;
                $payment->razorpay_signature  = $signature;
                $payment->amount              = $rzpPayment->amount / 100;
                $payment->currency            = 'INR';
                $payment->status              = 'success';
                $payment->transaction_type    = $rzpPayment->method;
                $payment->type                = 'course_enrollment';
                $payment->paid_at             = now();
                $payment->contact             = $rzpPayment->contact ?? $enrollment->phone;
                $payment->email               = $rzpPayment->email ?? $enrollment->email;
                $payment->save();

                try {
                    app(EmailService::class)->send(
                        'enrollment-confirmation',
                        $enrollment->email,
                        [
                            'student_name' => $enrollment->first_name . ' ' . $enrollment->last_name,
                            'course_name'  => $enrollment->course,
                            'centre'       => $enrollment->centre,
                            'reference_id' => $enrollment->reference_id,
                            'amount'       => '₹' . number_format($enrollment->fee),
                            'payment_id'   => $paymentId,
                        ],
                        $enrollment->first_name,
                    );
                } catch (\Exception $e) {
                    \Illuminate\Support\Facades\Log::warning('Enrollment confirmation email failed', [
                        'enrollment_id' => $enrollment->id,
                        'error'         => $e->getMessage(),
                    ]);
                }
            });

            return redirect()->route('enrollment.payment.confirmed', [
                'ref' => $enrollment->reference_id,
            ]);

        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Payment callback error', ['error' => $e->getMessage()]);
            return redirect()->route('home')->with('error', 'Payment processing error. Contact support with ref: ' . $referenceId);
        }
    }

    /**
     * Payment confirmed success page
     */
    public function paymentConfirmed(Request $request)
    {
        $enrollment = Enrollment::where('reference_id', $request->query('ref'))
            ->where('status', 'confirmed')
            ->firstOrFail();

        return view('frontend.enrollment.confirmed', compact('enrollment'));
    }
}
