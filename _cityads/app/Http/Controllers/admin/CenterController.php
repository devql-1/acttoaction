<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Center;
use App\Models\State;

class CenterController extends Controller
{
    public function index(Request $request)
    {
        $centers = Center::with('state')
            ->when($request->state_id, function ($q) use ($request) {
                $q->where('state_id', $request->state_id);
            })
            ->latest()
            ->get();

        $states = State::where('status', 1)->get();

        return view('backend.centers.index', compact('centers', 'states'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'state_id' => 'required|exists:states,id',
            'name' => 'required',
            'address' => 'nullable|string',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'map_link' => 'nullable|url',
        ]);

        Center::create([
            'state_id' => $request->state_id,
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'map_link' => $request->map_link,
            'status' => 1
        ]);

        return redirect()->back()->with('success', 'Center added successfully');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'state_id' => 'required|exists:states,id',
            'name' => 'required',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email',
            'map_link' => 'nullable|url',
        ]);

        Center::findOrFail($id)->update([
            'state_id' => $request->state_id,
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'map_link' => $request->map_link,
        ]);

        return redirect()->back()->with('success', 'Center updated successfully');
    }

    public function status(Request $request)
    {
        $center = Center::findOrFail($request->id);
        $center->update(['status' => $request->status]);
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        Center::destroy($id);
        return redirect()->back()->with('success', 'Center deleted successfully');
    }

    // AJAX: get centers by state for course form / user dropdown
    public function getByState(Request $request)
    {
        $centers = Center::where('state_id', $request->state_id)
            ->where('status', 1)
            ->get(['id', 'name', 'address', 'phone', 'email', 'map_link']);

        return response()->json($centers);
    }
    public function create()
    {
        $states = State::where('status', 1)->get();
        return view('backend.centers.create', compact('states'));
    }
}