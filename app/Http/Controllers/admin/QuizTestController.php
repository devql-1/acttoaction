<?php
// app/Http/Controllers/Admin/QuizTestController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PsychTest;
use Illuminate\Http\Request;

class QuizTestController extends Controller
{
    // STEP 1 — List all tests
    public function index()
    {
        $tests = PsychTest::withCount(['categories', 'questions'])
            ->latest()
            ->get();

        return view('backend.psych.tests.index', compact('tests'));
    }

    // STEP 2 — Show create form
    public function create()
    {
        return view('backend.psych.tests.create');
    }

    // STEP 3 — Save new test
    public function store(Request $request)
    {
        $request->validate([
            'test_name' => 'required|string|max:255|unique:psych_tests,test_name',
            'description' => 'required|string',
            'duration' => 'required|string|max:100',
            'age' => 'required|string|max:100',
        ]);

        $test = PsychTest::create($request->only('test_name', 'description', 'duration', 'age'));

        // After test created, redirect to categories page to start building
        return redirect()->route('quiz-categories.index', $test->id)
            ->with('success', 'Test created! Now add categories.');
    }

    // STEP 4 — Show edit form
    public function edit($id)
    {
        $test = PsychTest::findOrFail($id);
        return view('backend.psych.tests.edit', compact('test'));
    }

    // STEP 5 — Update test
    public function update(Request $request, $id)
    {
        $test = PsychTest::findOrFail($id);

        $request->validate([
            'test_name' => 'required|string|max:255|unique:psych_tests,test_name,' . $id,
            'description' => 'nullable|string',
            'duration' => 'nullable|string|max:100',
            'age' => 'required|string|max:100',
        ]);

        $test->update($request->only('test_name', 'description', 'duration', 'age'));

        return redirect()->route('quiz-tests.index')
            ->with('success', 'Test updated successfully.');
    }

    // STEP 6 — Delete test (cascade deletes categories + questions)
    public function destroy($id)
    {
        PsychTest::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }

    // STEP 7 — View test overview with categories and marks
    public function show($id)
    {
        $test = PsychTest::withCount(['categories', 'questions'])->findOrFail($id);
        $categories = $test->categories()->withCount('questions')->get();
        return view('backend.psych.tests.show', compact('test', 'categories'));
    }

}
