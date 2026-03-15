<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Course;
use Razorpay\Api\Api;
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

        $age = Carbon::parse($validated['dob'])->age;

        $course = Course::where('title', $validated['course'])->first();
        $fee = $course ? $course->fees : 0;

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
            'status' => 'pending',
        ]);

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
    public function index()
    {
        $enrollments = Enrollment::latest()->paginate(20);
        return view('backend.enrollments.index', compact('enrollments'));
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
        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

        try {
            $attributes = [
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature,
            ];

            $api->utility->verifyPaymentSignature($attributes);

            $enrollment = Enrollment::find($request->enrollment_id);
            $enrollment->status = 'paid';
            $enrollment->payment_id = $request->razorpay_payment_id;
            $enrollment->save();

            return response()->json([
                'success' => true,
                'message' => 'Payment successful',
                'reference_id' => $enrollment->reference_id,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Payment verification failed',
            ]);
        }
    }
}
