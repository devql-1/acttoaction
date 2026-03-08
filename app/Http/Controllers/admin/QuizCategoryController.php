<?php
// app/Http/Controllers/Admin/QuizCategoryController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PsychCategory;
use App\Models\PsychTest;
use Illuminate\Http\Request;

class QuizCategoryController extends Controller
{
    // List categories for a test
    public function index($testId)
    {
        $test       = PsychTest::findOrFail($testId);
        $categories = PsychCategory::where('test_id', $testId)
                        ->withCount('questions')
                        ->get();

        return view('backend.psych.categories.index', compact('test', 'categories'));
    }

    // Show create category form
    public function create($testId)
    {
        $test = PsychTest::findOrFail($testId);
        return view('backend.psych.categories.create', compact('test'));
    }

    // Save new category
    public function store(Request $request, $testId)
    {
        $test = PsychTest::findOrFail($testId);

        $request->validate([
            'category_name' => 'required|string|max:255',
            'description'   => 'nullable|string',
        ]);

        $category = PsychCategory::create([
            'test_id'       => $test->id,
            'category_name' => $request->category_name,
            'description'   => $request->description,
            'total_marks'   => 0, // starts at 0, auto-increments as questions are added
        ]);

        // If called via AJAX (from question page inline form)
        if ($request->expectsJson()) {
            return response()->json([
                'success'  => true,
                'category' => ['id' => $category->id, 'category_name' => $category->category_name]
            ]);
        }

        return redirect()->route('quiz-categories.index', $testId)
            ->with('success', 'Category added. Now add questions to it.');
    }

    // Show edit category form
    public function edit($testId, $id)
    {
        $test     = PsychTest::findOrFail($testId);
        $category = PsychCategory::where('test_id', $testId)->findOrFail($id);
        return view('backend.psych.categories.edit', compact('test', 'category'));
    }

    // Update category
    public function update(Request $request, $testId, $id)
    {
        $category = PsychCategory::where('test_id', $testId)->findOrFail($id);

        $request->validate([
            'category_name' => 'required|string|max:255',
            'description'   => 'nullable|string',
        ]);

        $category->update($request->only('category_name', 'description'));

        return redirect()->route('quiz-categories.index', $testId)
            ->with('success', 'Category updated.');
    }

    // Delete category (cascade deletes questions, auto-resets total_marks)
    public function destroy($testId, $id)
    {
        PsychCategory::where('test_id', $testId)->findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }
}
