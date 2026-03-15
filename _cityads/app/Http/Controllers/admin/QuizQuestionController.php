<?php
// app/Http/Controllers/Admin/QuizQuestionController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PsychCategory;
use App\Models\PsychQuestion;
use App\Models\PsychTest;
use Illuminate\Http\Request;

class QuizQuestionController extends Controller
{
    // List questions for a category
    public function index($testId, $categoryId)
    {
        $test = PsychTest::findOrFail($testId);
        $category = PsychCategory::where('test_id', $testId)->findOrFail($categoryId);
        $questions = PsychQuestion::where('category_id', $categoryId)->latest()->get();
        $categories = PsychCategory::where('test_id', $testId)->get();

        return view('backend.psych.questions.index', compact('test', 'category', 'questions', 'categories'));
    }

    // Show bulk create form (multiple questions + multiple categories)
    public function create($testId)
    {
        $test = PsychTest::findOrFail($testId);
        $categories = PsychCategory::where('test_id', $testId)->get();

        return view('backend.psych.questions.create', compact('test', 'categories'));
    }

    // Save multiple questions at once
    public function store(Request $request, $testId)
    {
        $test = PsychTest::findOrFail($testId);

        $request->validate([
            'questions' => 'required|array|min:1',
            'questions.*.question_text' => 'required|string',
            'questions.*.category_id' => 'required|exists:psych_categories,id',
        ]);

        $saved = 0;
        foreach ($request->questions as $q) {
            if (!empty(trim($q['question_text']))) {
                PsychQuestion::create([
                    'category_id' => $q['category_id'],
                    'question_text' => trim($q['question_text']),
                    'scale_min' => 1,
                    'scale_max' => 5,
                ]);
                $saved++;
            }
        }

        return redirect()->route('quiz-tests.show', $testId)
            ->with('success', $saved . ' question(s) added successfully. Category marks updated automatically.');
    }

    // Show edit form for single question
    public function edit($testId, $categoryId, $id)
    {
        $test = PsychTest::findOrFail($testId);
        $category = PsychCategory::where('test_id', $testId)->findOrFail($categoryId);
        $question = PsychQuestion::where('category_id', $categoryId)->findOrFail($id);
        $categories = PsychCategory::where('test_id', $testId)->get();

        return view('backend.psych.questions.edit', compact('test', 'category', 'question', 'categories'));
    }

    // Update single question
    public function update(Request $request, $testId, $categoryId, $id)
    {
        $question = PsychQuestion::where('category_id', $categoryId)->findOrFail($id);

        $request->validate([
            'question_text' => 'required|string',
            'category_id' => 'required|exists:psych_categories,id',
        ]);

        $question->update([
            'category_id' => $request->category_id,
            'question_text' => $request->question_text,
        ]);

        // Model booted() handles total_marks update automatically

        return redirect()->route('quiz-questions.index', [$testId, $request->category_id])
            ->with('success', 'Question updated.');
    }

    // Delete question (model booted() auto-decrements total_marks)
    public function destroy($testId, $categoryId)
    {
        $category = PsychCategory::where('id', $categoryId)
            ->where('test_id', $testId)
            ->firstOrFail();

        $category->delete();

        return redirect()
            ->route('quiz-categories.index', $testId)
            ->with('success', 'Category deleted successfully.');
    }
}
