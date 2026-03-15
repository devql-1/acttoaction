<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PsychTest;
use App\Models\TestResultRange;
use Illuminate\Http\Request;

class TestResultRangeController extends Controller
{
    public function tests()
    {
        $tests = PsychTest::latest()->get();

        return view('backend.test_result_ranges.tests', compact('tests'));
    }
    public function index($testId)
    {
        $test = PsychTest::findOrFail($testId);
        $ranges = TestResultRange::where('test_id', $testId)
            ->orderBy('min_percent')
            ->get();

        return view('backend.test_result_ranges.index', compact('test', 'ranges'));
    }

    /** Show create form */
    public function create($testId)
    {

        $test = PsychTest::findOrFail($testId);
        return view('backend.test_result_ranges.create', compact('test'));
    }

    /** Store new range */
    public function store(Request $request, $testId)
    {
        $request->validate([
            'min_percent' => 'required|integer|min:0|max:100',
            'max_percent' => 'required|integer|min:0|max:100|gte:min_percent',
            'label' => 'required|string|max:150',
            'emoji' => 'nullable|string|max:10',
            'tagline' => 'required|string|max:255',
            'description' => 'required|string',
            'recommended_course' => 'nullable|string|max:255',
            'tags' => 'nullable|string',
            'color' => 'required|string|max:10',
        ]);

        TestResultRange::create([
            'test_id' => $testId,
            'min_percent' => $request->min_percent,
            'max_percent' => $request->max_percent,
            'label' => $request->label,
            'emoji' => $request->emoji ?? '⭐',
            'tagline' => $request->tagline,
            'description' => $request->description,
            'recommended_course' => $request->recommended_course,
            'tags' => !empty($request->tags)
                ? array_map('trim', explode(',', $request->tags))
                : null,
            'color' => $request->color,
        ]);

        return redirect()->route('test-result-ranges.index', $testId)
            ->with('success', 'Result range created successfully.');
    }

    /** Show edit form */
    public function edit($testId, $id)
    {
        $test = PsychTest::findOrFail($testId);
        $range = TestResultRange::where('test_id', $testId)->findOrFail($id);
        return view('backend.test_result_ranges.edit', compact('test', 'range'));
    }

    /** Update range */
    public function update(Request $request, $testId, $id)
    {
        $range = TestResultRange::where('test_id', $testId)->findOrFail($id);

        $request->validate([
            'min_percent' => 'required|integer|min:0|max:100',
            'max_percent' => 'required|integer|min:0|max:100|gte:min_percent',
            'label' => 'required|string|max:150',
            'emoji' => 'nullable|string|max:10',
            'tagline' => 'required|string|max:255',
            'description' => 'required|string',
            'recommended_course' => 'nullable|string|max:255',
            'tags' => 'nullable|string',
            'color' => 'required|string|max:10',
        ]);

        $range->update([
            'min_percent' => $request->min_percent,
            'max_percent' => $request->max_percent,
            'label' => $request->label,
            'emoji' => $request->emoji ?? '⭐',
            'tagline' => $request->tagline,
            'description' => $request->description,
            'recommended_course' => $request->recommended_course,
            'tags' => !empty($request->tags)
                ? array_map('trim', explode(',', $request->tags))
                : null,
            'color' => $request->color,
        ]);

        return redirect()->route('test-result-ranges.index', $testId)
            ->with('success', 'Result range updated successfully.');
    }

    /** Delete range */
    public function destroy($testId, $id)
    {
        TestResultRange::where('test_id', $testId)->findOrFail($id)->delete();

        return redirect()->route('test-result-ranges.index', $testId)
            ->with('success', 'Result range deleted.');
    }
}