<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PsychTest;
use App\Models\TestGraphConfig;
use App\Models\TestResultRange;
use Illuminate\Http\Request;

class TestResultConfigController extends Controller
{
    /** Show admin config page for a test */
    public function edit($testId)
    {
        $test = PsychTest::findOrFail($testId);
        $config = TestGraphConfig::firstOrNew(['test_id' => $testId]);


        return view('backend.test_config.edit', compact('test', 'config'));
    }

    /** Save graph type */
    public function saveGraph(Request $request, $testId)
    {
        $request->validate(['graph_type' => 'required|in:bar,radar,pie,line,none']);
        TestGraphConfig::updateOrCreate(
            ['test_id' => $testId],
            ['graph_type' => $request->graph_type]
        );
        return back()->with('success', 'Graph type saved.');
    }

    /** Store a new result range */
    public function storeRange(Request $request, $testId)
    {
        $data = $request->validate([
            'min_percent' => 'required|integer|min:0|max:100',
            'max_percent' => 'required|integer|min:0|max:100|gte:min_percent',
            'label' => 'required|string|max:150',
            'emoji' => 'nullable|string|max:10',
            'tagline' => 'required|string|max:255',
            'description' => 'required|string',
            'recommended_course' => 'nullable|string|max:255',
            'tags' => 'nullable|string',   // comma-separated
            'color' => 'required|string|max:10',
        ]);

        $data['test_id'] = $testId;
        $data['emoji'] = $data['emoji'] ?? '⭐';
        $data['tags'] = !empty($data['tags'])
            ? array_map('trim', explode(',', $data['tags']))
            : [];

        TestResultRange::create($data);
        return back()->with('success', 'Result range added.');
    }

    /** Update a range */
    public function updateRange(Request $request, $testId, $rangeId)
    {
        $range = TestResultRange::where('test_id', $testId)->findOrFail($rangeId);
        $data = $request->validate([
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
        $data['tags'] = !empty($data['tags'])
            ? array_map('trim', explode(',', $data['tags']))
            : [];
        $range->update($data);
        return back()->with('success', 'Range updated.');
    }

    /** Delete a range */
    public function destroyRange($testId, $rangeId)
    {
        TestResultRange::where('test_id', $testId)->findOrFail($rangeId)->delete();
        return back()->with('success', 'Range deleted.');
    }
}