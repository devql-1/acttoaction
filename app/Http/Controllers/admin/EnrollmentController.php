<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Course;

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
        $otherCourses = Course::with('category')
            ->where('id', '!=', $id)
            ->latest()
            ->take(5)
            ->get();

        return view('frontend.enrollment.create', compact(
            'course',
            'otherCourses',
            'centresByState',
            'courseStates'
        ));
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
            'parent_phone' => 'nullable|string|max:15',
            'parent_email' => 'nullable|email|max:150',
            'phone' => 'required|string|min:10|max:15',
            'email' => 'required|email|max:150',
            'address' => 'nullable|string|max:500',
            'school' => 'required|string|max:200',
            'grade' => 'required|string|max:50',
            'achievements' => 'nullable|string|max:1000',
            'state' => 'required|string|max:100',
            'city' => 'nullable|string|max:100',
            'centre' => 'required|string|max:200',
            'mode' => 'required|string|max:50',
            'course' => 'required|string|max:200',
            'newsletter' => 'nullable|boolean',
        ]);

        $age = Carbon::parse($validated['dob'])->age;

        // get course price from database
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
            'parent_phone' => $validated['parent_phone'] ?? null,
            'parent_email' => $validated['parent_email'] ?? null,
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'address' => $validated['address'] ?? null,
            'school' => $validated['school'],
            'grade' => $validated['grade'],
            'achievements' => $validated['achievements'] ?? null,
            'state' => $validated['state'],
            'city' => $validated['city'] ?? null,
            'centre' => $validated['centre'],
            'mode' => $validated['mode'],
            'course' => $validated['course'],
            'fee' => $fee,
            'terms_accepted' => true,
            'newsletter_subscribed' => $validated['newsletter'] ?? false,
            'status' => 'pending',
        ]);

        return response()->json([
            'success' => true,
            'reference_id' => $enrollment->reference_id,
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
}