<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Course;
use Razorpay\Api\Api;
use App\Models\Payment;
use App\Services\EmailService; // ← this must be here

class EnrollmentController extends Controller
{
    /** Show the multi-step enrollment form */
    public function enroll($id)
    {
        $course = Course::with([
            'category',
            'centers' => function ($q) {
                $q->active()->with('state');
            },
        ])->findOrFail($id);

        // Build state => centers map for JS dropdown
        $centresByState = [];
        foreach ($course->centers as $center) {
            $stateName = $center->state ? $center->state->name : 'Other';
            if (!isset($centresByState[$stateName])) {
                $centresByState[$stateName] = [];
            }
            $centresByState[$stateName][] = [
                'id' => $center->id,
                'name' => $center->name,
                'address' => $center->address ?? '',
                'phone' => $center->phone ?? '',
                'email' => $center->email ?? '',
                'map' => $center->map_link ?? '',
            ];
        }

        // Unique states that have centres for this course
        $courseStates = array_keys($centresByState);

        // Other courses for step 5
        $otherCourses = Course::with('category')->where('id', '!=', $id)->latest()->take(5)->get();

        return view('frontend.enrollment.create', compact('course', 'otherCourses', 'centresByState', 'courseStates'));
    }
    /** Handle form submission */

    public function store(Request $request)
    {
        $validated = $request->validate([
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
        $fee = $course ? $course->fees : 0;

        // ── If enrollment_id is passed, UPDATE existing lead record ──
        if ($request->filled('enrollment_id') && !$isLead) {
            $enrollment = Enrollment::find($request->enrollment_id);
            if ($enrollment) {
                $enrollment->update([
                    'course' => $validated['course'],
                    'fee' => $fee,
                    'status' => 'pending', // upgrade from lead → pending (awaiting payment)
                ]);
            }
        }

        // ── Otherwise create fresh ──
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

        // ── If this is just a lead save, return early (no Razorpay order) ──
        if ($isLead) {
            return response()->json([
                'success' => true,
                'enrollment_id' => $enrollment->id,
            ]);
        }

        // ── Create Razorpay order ──
        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
        $order = $api->order->create([
            'receipt' => $enrollment->reference_id,
            'amount' => $fee * 100,
            'currency' => 'INR',
        ]);

        return response()->json([
            'success' => true,
            'order_id' => $order['id'],
            'amount' => $fee * 100,
            'enrollment_id' => $enrollment->id,
            'razorpay_key' => config('services.razorpay.key'),
        ]);
    }

    /** Admin: list all enrollments */
    public function index(Request $request)
    {
        $query = Enrollment::with('latestPayment')->latest();

        // Search
        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('first_name', 'like', "%$s%")
                    ->orWhere('last_name', 'like', "%$s%")
                    ->orWhere('phone', 'like', "%$s%")
                    ->orWhere('email', 'like', "%$s%")
                    ->orWhere('reference_id', 'like', "%$s%");
            });
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by course
        if ($request->filled('course')) {
            $query->where('course', 'like', '%' . $request->course . '%');
        }

        $enrollments = $query->paginate(20)->withQueryString();

        $stats = [
            'total' => Enrollment::count(),
            'paid' => Enrollment::where('status', 'paid')->count(),
            'lead' => Enrollment::where('status', 'lead')->count(),
            'pending' => Enrollment::where('status', 'pending')->count(),
        ];

        return view('backend.enrollments.index', compact('enrollments', 'stats'));
    }

    /** Admin: view single enrollment */
    public function show($id)
    {
        $enrollment = Enrollment::findOrFail($id);
        return view('backend.enrollments.show', compact('enrollment'));
    }

    /** Admin: update status */
    public function updateStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required|in:pending,confirmed,cancelled']);

        Enrollment::findOrFail($id)->update(['status' => $request->status]);

        return back()->with('success', 'Status updated successfully.');
    }

    /** Admin: delete */
    public function destroy($id)
    {
        Enrollment::findOrFail($id)->delete();
        return back()->with('success', 'Enrollment deleted.');
    }
    public function verifyPayment(Request $request)
    {
        \Log::info('Razorpay verify — incoming payload', $request->all());

        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

        try {
            $attributes = [
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature,
            ];

            $api->utility->verifyPaymentSignature($attributes);

            $enrollment = Enrollment::find($request->enrollment_id);

            if (!$enrollment) {
                return response()->json(['success' => false, 'message' => 'Enrollment not found']);
            }

            // ── Save to payments table ──
            // Check if payment already exists
            $payment = Payment::firstOrCreate(
                ['razorpay_payment_id' => $request->razorpay_payment_id],
                [
                    'enrollment_id' => $enrollment->id,
                    'razorpay_order_id' => $request->razorpay_order_id,
                    'razorpay_signature' => $request->razorpay_signature,
                    'amount' => $enrollment->fee,
                    'currency' => 'INR',
                    'status' => 'paid',
                    'email' => $enrollment->email,
                    'contact' => $enrollment->phone,
                    'paid_at' => now(),
                ],
            );

            // Update enrollment status safely
            $enrollment->status = 'confirmed';
            $enrollment->save();

            return response()->json([
                'success' => true,
                'message' => 'Payment successful',
                'reference_id' => $enrollment->reference_id,
                'payment_id' => $payment->id,
            ]);
        } catch (\Exception $e) {
            \Log::error('Razorpay verify exception', [
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'enrollment_id' => $request->enrollment_id,
            ]);

            // ── Save failed payment record too ──
            if ($request->enrollment_id) {
                Payment::create([
                    'enrollment_id' => $request->enrollment_id,
                    'razorpay_order_id' => $request->razorpay_order_id ?? '',
                    'razorpay_payment_id' => $request->razorpay_payment_id ?? '',
                    'razorpay_signature' => $request->razorpay_signature ?? '',
                    'amount' => 0,
                    'status' => 'failed',
                    'error_code' => 'VERIFY_EXCEPTION',
                    'error_reason' => $e->getMessage(),
                ]);
            }
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

            // ── Send to parent if available ──
            if (!empty($enrollment->parent_email)) {
                app(EmailService::class)->send('enrollment-confirmation', $enrollment->parent_email, [
                    'student_name' => $enrollment->first_name . ' ' . $enrollment->last_name,
                    'course_name' => $enrollment->course,
                    'centre' => $enrollment->centre,
                    'reference_id' => $enrollment->reference_id,
                    'amount' => '₹' . number_format($enrollment->fee),
                    'payment_id' => $request->razorpay_payment_id,
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
