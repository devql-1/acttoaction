<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use Illuminate\Http\Request;
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
    public function enroll($id)
    {
        $course = Course::with([
            'category',
            'centers' => function ($q) {
                $q->active()->with('state');
            },
        ])->findOrFail($id);

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
        $otherCourses = Course::with('category')->where('id', '!=', $id)->latest()->take(5)->get();

        return view('frontend.enrollment.create', compact('course', 'otherCourses', 'centresByState', 'courseStates'));
    }

    /**
     * Handle form submission
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'centre_id' => 'required|integer|exists:centers,id',
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'dob' => 'required|date',
            'gender' => 'required|in:Male,Female,Other',
            'father_name' => 'required|string|max:100',
            'mother_name' => 'required|string|max:100',
            'phone' => 'required|string|min:10|max:15',
            'email' => 'required|email|max:150',
            'school' => 'required|string|max:200',
            'grade' => 'required|string|max:50',
            'state' => 'required|string|max:100',
            'centre' => 'required|string|max:200',
            'mode' => 'required|string|max:50',
            'course' => 'required|string|max:200',
        ]);

        $isLead = $request->boolean('is_lead');
        $age = Carbon::parse($validated['dob'])->age;

        $course = Course::where('title', $validated['course'])->first();

        // Fetch fee from pivot table using course + centre
        $centreId = $request->input('centre_id'); // add this hidden field to your form
        $fee = 0;

        if ($course && $centreId) {
            $pivotFee = $course->centers()->where('centers.id', $centreId)->first()?->pivot?->fees;

            $fee = $pivotFee ?? 0;
        }

        // Update existing enrollment if upgrading from lead
        if ($request->filled('enrollment_id') && !$isLead) {
            $enrollment = Enrollment::find($request->enrollment_id);
            if ($enrollment) {
                $enrollment->update([
                    'course' => $validated['course'],
                    'fee' => $fee,
                    'status' => 'pending',
                ]);
            }
        }

        // Create new enrollment if not exists
        if (!isset($enrollment) || !$enrollment) {
            $enrollment = Enrollment::create([
                'first_name' => $validated['first_name'],
                'last_name' => $validated['last_name'],
                'dob' => $validated['dob'],
                'age' => $age,
                'gender' => $validated['gender'],
                'father_name' => $validated['father_name'],
                'mother_name' => $validated['mother_name'],
                'phone' => $validated['phone'],
                'email' => $validated['email'],
                'school' => $validated['school'],
                'grade' => $validated['grade'],
                'state' => $validated['state'],
                'centre' => $validated['centre'],
                'mode' => $validated['mode'],
                'course' => $validated['course'],
                'fee' => $fee,
                'status' => $isLead ? 'lead' : 'pending',
            ]);
        }

        // Return early if saving as lead only
        if ($isLead) {
            return response()->json([
                'success' => true,
                'enrollment_id' => $enrollment->id,
            ]);
        }

        // Validate fee is configured
        if ($fee <= 0) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Course fee not configured properly',
                ],
                422,
            );
        }

        // Create Razorpay order
        try {
            $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

            $order = $api->order->create([
                'receipt' => $enrollment->reference_id,
                'amount' => $fee * 100,
                'currency' => 'INR',
            ]);

            session(['rzp_amount' => $fee * 100]);
            session(['rzp_order_id' => $order['id'] ?? null]);
            session(['rzp_enrollment_id' => $enrollment->id]);

            return response()->json([
                'success' => true,
                'order_id' => $order['id'],
                'amount' => $fee * 100,
                'enrollment_id' => $enrollment->id,
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Failed to create payment order. Please try again.',
                ],
                500,
            );
        }
    }
    public function validateField(Request $request)
    {
        $field = $request->input('field');
        $value = $request->input('value');

        if ($field === 'phone') {
            $digits = preg_replace('/\D/', '', $value);
            $exists = Enrollment::where('phone', $value)->where('status', '!=', 'lead')->exists();
            if (strlen($digits) < 10) {
                return response()->json(['valid' => false, 'message' => 'Enter a valid 10-digit phone number']);
            }
            if ($exists) {
                return response()->json(['valid' => false, 'message' => 'This phone is already enrolled']);
            }
            return response()->json(['valid' => true]);
        }

        if ($field === 'email') {
            $exists = Enrollment::where('email', $value)->where('status', '!=', 'lead')->exists();
            if ($exists) {
                return response()->json(['valid' => false, 'message' => 'This email is already enrolled']);
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
            // Verify payment signature
            $attributes = [
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature,
            ];

            $api->utility->verifyPaymentSignature($attributes);

            // Prevent cross-enrollment/order replay by strictly matching the checkout session.
            if ((int) session('rzp_enrollment_id') !== (int) $request->enrollment_id || (string) session('rzp_order_id') !== (string) $request->razorpay_order_id) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Payment verification failed',
                    ],
                    422,
                );
            }

            // Check if payment already processed
            $existingPayment = Payment::where('razorpay_payment_id', $request->razorpay_payment_id)->first();
            if ($existingPayment) {
                return response()->json([
                    'success' => true,
                    'message' => 'Payment already processed',
                ]);
            }

            // Fetch payment details from Razorpay
            $rzpPayment = $api->payment->fetch($request->razorpay_payment_id);

            if ((string) ($rzpPayment->order_id ?? '') !== (string) $request->razorpay_order_id) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Payment verification failed',
                    ],
                    422,
                );
            }

            // Process payment atomically
            DB::transaction(function () use ($request, $rzpPayment) {
                $enrollment = Enrollment::findOrFail($request->enrollment_id);

                // Update enrollment status
                if ($enrollment->status !== 'confirmed') {
                    $enrollment->update(['status' => 'confirmed']);
                }

                // Create payment record
                Payment::create([
                    'enrollment_id' => $enrollment->id,
                    'razorpay_order_id' => $request->razorpay_order_id,
                    'razorpay_payment_id' => $request->razorpay_payment_id,
                    'razorpay_signature' => $request->razorpay_signature,
                    'amount' => session('rzp_amount') ? session('rzp_amount') / 100 : $enrollment->fee,
                    'currency' => 'INR',
                    'status' => 'success',
                    'transaction_type' => $rzpPayment->method,
                    'type' => 'course_enrollment',
                    'paid_at' => now(),
                    'contact' => $rzpPayment->contact ?? $enrollment->phone,
                    'email' => $rzpPayment->email ?? $enrollment->email,
                ]);

                // Send confirmation email
                try {
                    app(EmailService::class)->send(
                        'enrollment-confirmation',
                        $enrollment->email,
                        [
                            'student_name' => $enrollment->first_name . ' ' . $enrollment->last_name,
                            'course_name' => $enrollment->course,
                            'centre' => $enrollment->centre,
                            'reference_id' => $enrollment->reference_id,
                            'amount' => '₹' . number_format($enrollment->fee),
                            'payment_id' => $request->razorpay_payment_id,
                        ],
                        $enrollment->first_name,
                    );
                } catch (\Exception $e) {
                    // Email failure doesn't fail the payment
                }
            });

            return response()->json([
                'success' => true,
                'message' => 'Payment successful',
            ]);
        } catch (\Razorpay\Api\Errors\SignatureVerificationError $e) {
            Payment::create([
                'enrollment_id' => $request->enrollment_id,
                'razorpay_payment_id' => $request->razorpay_payment_id ?? '',
                'amount' => 0,
                'status' => 'failed',
                'error_code' => 'SIGNATURE_MISMATCH',
                'error_reason' => $e->getMessage(),
            ]);

            return response()->json(
                [
                    'success' => false,
                    'message' => 'Payment verification failed',
                ],
                422,
            );
        } catch (\Exception $e) {
            Payment::create([
                'enrollment_id' => $request->enrollment_id ?? null,
                'razorpay_payment_id' => $request->razorpay_payment_id ?? '',
                'amount' => 0,
                'status' => 'failed',
                'error_code' => class_basename($e),
                'error_reason' => $e->getMessage(),
            ]);

            return response()->json(
                [
                    'success' => false,
                    'message' => 'Payment verification failed',
                ],
                500,
            );
        }
    }
}
