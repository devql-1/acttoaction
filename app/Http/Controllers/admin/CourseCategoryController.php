<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CourseCategory;
use Illuminate\Support\Facades\Storage;

class CourseCategoryController extends Controller
{
    public function index()
    {
        $categories = CourseCategory::withCount('courses')->latest()->get();
        return view('backend.course_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('backend.course_categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:course_categories,name',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('category_images', 'public');
        }

        CourseCategory::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imagePath,
            'status' => 1,
        ]);

        return redirect()->route('course-categories-index')->with('success', 'Category created successfully');
    }

    public function edit($id)
    {
        $category = CourseCategory::findOrFail($id);
        return view('backend.course_categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = CourseCategory::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255|unique:course_categories,name,' . $id,
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = $category->image;
        if ($request->hasFile('image')) {
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image')->store('category_images', 'public');
        }

        $category->update([
            'name' => $request->name,
            'image' => $imagePath,
            'description' => $request->description,
        ]);

        return redirect()->route('course-categories-index')->with('success', 'Category updated successfully');
    }

    public function status(Request $request)
    {
        $category = CourseCategory::findOrFail($request->id);
        $category->update(['status' => $request->status]);
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $category = CourseCategory::findOrFail($id);

        if ($category->courses()->count() > 0) {
            return redirect()
                ->back()
                ->with('error', 'Cannot delete. ' . $category->courses()->count() . ' courses are assigned to this category.');
        }

        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return redirect()->back()->with('success', 'Category deleted successfully');
    }
}
