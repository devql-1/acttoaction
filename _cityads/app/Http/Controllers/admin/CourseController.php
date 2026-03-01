<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CourseSession;
use App\Models\CourseDocument;
use Illuminate\Support\Facades\DB;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::latest()->get();
        return view('backend.courses.index', compact('courses'));
    }

    public function create()
    {
        return view('backend.courses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'duration' => 'required',
            'fees' => 'required|numeric',
            'documents.*' => 'mimes:pdf'
        ]);

        DB::beginTransaction();

        try {

            // create course
            $course = Course::create([
                'title' => $request->title,
                'description' => $request->description,
                'duration' => $request->duration,
                'sessions' => $request->total_sessions,
                'mode' => $request->mode,
                'age_group' => $request->age_group,
                'fees' => $request->fees,
                'instagram_link' => $request->instagram_link,
                'highlights_link' => $request->highlights_link,
            ]);

            // save sessions
            if ($request->session_title) {
                foreach ($request->session_title as $key => $title) {
                    CourseSession::create([
                        'course_id' => $course->id,
                        'session_number' => $key + 1,
                        'title' => $title,
                        'description' => $request->session_description[$key] ?? null,
                    ]);
                }
            }

            // upload documents (PDF)
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

            DB::commit();

            return redirect()->route()
                ->with('success', 'Course Created Successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        $course = Course::with('sessions', 'documents')->findOrFail($id);
        return view('backend.courses.show', compact('course'));
    }

    public function destroy($id)
    {
        Course::destroy($id);
        return redirect()->back()->with('success', 'Deleted Successfully');
    }
}