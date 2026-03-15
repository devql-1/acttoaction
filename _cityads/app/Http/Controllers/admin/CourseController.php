<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseSession;
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
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'instagram_link' => 'nullable|url',
            'highlights_link' => 'nullable|url',
            'documents.*' => 'nullable|mimes:pdf|max:10240',
            'center_ids' => 'nullable|array',
            'center_ids.*' => 'exists:centers,id',
        ]);

        $bannerPath = null;

        // Upload Banner Image
        if ($request->hasFile('banner_image')) {
            $filename = time() . '.' . $request->banner_image->extension();
            $request->banner_image->move(public_path('img/course_images'), $filename);
            $bannerPath = 'img/course_images/' . $filename;
        }

        // Create Course
        $course = Course::create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'banner_image' => $bannerPath,
            'description' => $request->description,
            'duration' => $request->duration,
            'sessions' => $request->total_sessions,
            'mode' => $request->mode,
            'age_group' => $request->age_group,
            'fees' => $request->fees,
            'instagram_link' => $request->instagram_link ?? null,
            'highlights_link' => $request->highlights_link ?? null,
        ]);

        // Sync Centers (Pivot Table)
        if ($request->filled('center_ids')) {
            $course->centers()->sync($request->center_ids);
        }

        // Upload PDF Documents
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

        return redirect()->route('courses')->with('success', 'Course created successfully');
    }

    public function show($id)
    {
        $course = Course::with('sessions', 'documents', 'centers.state')->findOrFail($id);
        return view('backend.courses.show', compact('course'));
    }

    public function edit($id)
    {
        $course = Course::with('sessions', 'documents', 'centers')->findOrFail($id);
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
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'instagram_link' => 'nullable|url',
            'highlights_link' => 'nullable|url',
            'center_ids' => 'nullable|array',
            'center_ids.*' => 'exists:centers,id',
        ]);

        $course = Course::findOrFail($id);
        $bannerPath = $course->banner_image;

        // Upload New Banner Image
        if ($request->hasFile('banner_image')) {
            // Delete old image
            if ($bannerPath && file_exists(public_path($bannerPath))) {
                unlink(public_path($bannerPath));
            }

            $filename = time() . '.' . $request->banner_image->extension();
            $request->banner_image->move(public_path('img/course_images'), $filename);
            $bannerPath = 'img/course_images/' . $filename;
        }

        // Update Course
        $course->update([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'banner_image' => $bannerPath,
            'description' => $request->description,
            'duration' => $request->duration,
            'sessions' => $request->total_sessions,
            'mode' => $request->mode,
            'age_group' => $request->age_group,
            'fees' => $request->fees,
            'instagram_link' => $request->instagram_link ?? null,
            'highlights_link' => $request->highlights_link ?? null,
        ]);

        // Sync Centers (Pivot Table)
        $course->centers()->sync($request->center_ids ?? []);

        return redirect()->route('courses')->with('success', 'Course updated successfully');
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

        // Delete Banner Image
        if ($course->banner_image && file_exists(public_path($course->banner_image))) {
            unlink(public_path($course->banner_image));
        }

        // Delete Related Documents
        foreach ($course->documents as $doc) {
            if (file_exists(public_path('storage/' . $doc->document_file))) {
                unlink(public_path('storage/' . $doc->document_file));
            }
            $doc->delete();
        }

        // Detach centers (pivot)
        $course->centers()->detach();

        $course->delete();

        return redirect()->back()->with('success', 'Course deleted successfully');
    }
}