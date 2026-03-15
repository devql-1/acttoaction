<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\State;

class StateController extends Controller
{
    public function index()
    {
        $states = State::withCount('centers')->latest()->get();
        return view('backend.states.index', compact('states'));
    }

    public function create()
    {
        return view('backend.states.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:states,name'
        ]);

        State::create([
            'name' => $request->name,
            'status' => 1
        ]);

        return redirect()->route('states-index')
            ->with('success', 'State added successfully');
    }

    public function edit($id)
    {
        $state = State::withCount('centers')->findOrFail($id);
        return view('backend.states.edit', compact('state'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:states,name,' . $id
        ]);

        State::findOrFail($id)->update([
            'name' => $request->name
        ]);

        return redirect()->route('states-index')
            ->with('success', 'State updated successfully');
    }

    public function status(Request $request)
    {
        $state = State::findOrFail($request->id);
        $state->update(['status' => $request->status]);
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $state = State::withCount('centers')->findOrFail($id);

        if ($state->centers_count > 0) {
            return redirect()->back()
                ->with('error', 'Cannot delete "' . $state->name . '", it has ' . $state->centers_count . ' center(s) assigned. Remove the centers first.');
        }

        $state->delete();
        return redirect()->back()->with('success', 'State deleted successfully');
    }
}
