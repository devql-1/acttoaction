<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PsychTest;
use App\Models\TestGraphConfig;
use Illuminate\Http\Request;

class TestGraphConfigController extends Controller
{
    /** List all tests with their current graph config */
    public function index()
    {
        $tests = PsychTest::with('graphConfig')->latest()->paginate(15);
        return view('backend.test_graph_configs.index', compact('tests'));
    }

    /** Show create form for a specific test */
    public function create()
    {

        $tests = PsychTest::whereDoesntHave('graphConfig')->latest()->get();
        return view('backend.test_graph_configs.create', compact('tests'));
    }

    /** Store new graph config */
    public function store(Request $request)
    {
        $request->validate([
            'test_id' => 'required|exists:psych_tests,id|unique:test_graph_configs,test_id',
            'graph_type' => 'required|in:bar,radar,pie,line,none',
        ]);

        TestGraphConfig::create([
            'test_id' => $request->test_id,
            'graph_type' => $request->graph_type,
        ]);

        return redirect()->route('test-graph-configs.index')
            ->with('success', 'Graph config created successfully.');
    }

    /** Show edit form */
    public function edit($id)
    {
        $config = TestGraphConfig::with('test')->findOrFail($id);
        return view('backend.test_graph_configs.edit', compact('config'));
    }

    /** Update graph config */
    public function update(Request $request, $id)
    {
        $config = TestGraphConfig::findOrFail($id);

        $request->validate([
            'graph_type' => 'required|in:bar,radar,pie,line,none',
            'is_active' => 'boolean',
        ]);

        $config->update([
            'graph_type' => $request->graph_type,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('test-graph-configs.index')
            ->with('success', 'Graph config updated successfully.');
    }

    /** Delete config */
    public function destroy($id)
    {
        TestGraphConfig::findOrFail($id)->delete();

        return redirect()->route('test-graph-configs.index')
            ->with('success', 'Graph config deleted.');
    }
}