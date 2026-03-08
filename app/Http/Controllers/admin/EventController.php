<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseDocument;
use App\Models\State;
use App\Models\CourseCategory;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::latest()->get();
        return view('backend.courses.index', compact('courses'));
    }

    public function create()
    {
        $states = State::where('status', 1)->get();
        $categories = CourseCategory::where('status', 1)->get();
        return view('backend.courses.create', compact('states', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:course_categories,id',
            'title' => 'required',
            'duration' => 'required',
            'fees' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'documents.*' => 'nullable|mimes:pdf|max:10240',
            'center_ids' => 'nullable|array',
            'center_ids.*' => 'exists:centers,id',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $filename = time() . '.' . $request->image->extension();
            $request->image->move(public_path('img/course_images'), $filename);
            $imagePath = 'img/course_images/' . $filename;
        }

        $course = Course::create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'image' => $imagePath,
            'description' => $request->description,
            'duration' => $request->duration,
            'sessions' => $request->total_sessions,
            'mode' => $request->mode,
            'age_group' => $request->age_group,
            'fees' => $request->fees,
            'instagram_link' => $request->instagram_link,
            'highlights_link' => $request->highlights_link,
        ]);

        // Sync centers only if selected
        $course->centers()->sync($request->center_ids ?? []);

        // Documents upload
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $path = $file->store('course_documents', 'public');
                CourseDocument::create([
                    'course_id' => $course->id,
                    'document_name' => $file->getClientOriginalName(),
                    'document_file' => $path,
                ]);
            }
        }

        return redirect()->route('courses')
            ->with('success', 'Course created successfully');
    }

    public function edit($id)
    {
        $course = Course::with('centers')->findOrFail($id);
        $states = State::where('status', 1)->get();
        $categories = CourseCategory::where('status', 1)->get();
        $selectedCenters = $course->centers->pluck('id')->toArray();

        return view('backend.courses.edit', compact('course', 'states', 'categories', 'selectedCenters'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_id' => 'required|exists:course_categories,id',
            'title' => 'required',
            'duration' => 'required',
            'fees' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'center_ids' => 'nullable|array',
            'center_ids.*' => 'exists:centers,id',
        ]);

        $course = Course::findOrFail($id);

        // Handle image update
        $imagePath = $course->image;
        if ($request->hasFile('image')) {
            if ($imagePath && file_exists(public_path($imagePath))) {
                unlink(public_path($imagePath));
            }
            $filename = time() . '.' . $request->image->extension();
            $request->image->move(public_path('img/course_images'), $filename);
            $imagePath = 'img/course_images/' . $filename;
        }

        $course->update([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'image' => $imagePath,
            'description' => $request->description,
            'duration' => $request->duration,
            'sessions' => $request->total_sessions,
            'mode' => $request->mode,
            'age_group' => $request->age_group,
            'fees' => $request->fees,
            'instagram_link' => $request->instagram_link,
            'highlights_link' => $request->highlights_link,
        ]);

        // Sync centers
        $course->centers()->sync($request->center_ids ?? []);

        return redirect()->route('courses')
            ->with('success', 'Course updated successfully');
    }

    public function status(Request $request)
    {
        $course = Course::findOrFail($request->id);
        $course->update(['status' => $request->status]);
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);

        // Delete image
        if ($course->image && file_exists(public_path($course->image))) {
            unlink(public_path($course->image));
        }

        $course->delete();

        return redirect()->back()->with('success', 'Course deleted successfully');
    }
}