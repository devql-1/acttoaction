<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ActionItem;

class ActionItemController extends Controller
{
    public function index()
    {
        $actions = ActionItem::orderBy('order')->latest()->get();
        return view('backend.action_items.index', compact('actions'));
    }

    public function create()
    {
        return view('backend.action_items.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
            'route' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
        ]);

        ActionItem::create([
            'title' => $request->title,
            'icon' => $request->icon,
            'route' => $request->route,
            'order' => $request->order ?? 0,
            'status' => 1,
        ]);

        return redirect()->route('action-items.index')->with('success', 'Action created successfully');
    }

    public function edit($id)
    {
        $action = ActionItem::findOrFail($id);
        return view('backend.action_items.edit', compact('action'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'icon' => 'required|string|max:255',
            'route' => 'nullable|string|max:255',
            'order' => 'nullable|integer',
        ]);

        $action = ActionItem::findOrFail($id);

        $action->update([
            'title' => $request->title,
            'icon' => $request->icon,
            'route' => $request->route,
            'order' => $request->order ?? 0,
        ]);

        return redirect()->route('action-items.index')->with('success', 'Action updated successfully');
    }

    public function destroy($id)
    {
        $action = ActionItem::findOrFail($id);
        $action->delete();

        return redirect()->route('action-items.index')->with('success', 'Action deleted successfully');
    }

    public function status(Request $request)
    {
        $action = ActionItem::findOrFail($request->id);
        $action->update(['status' => $request->status]);

        return response()->json(['success' => true]);
    }
}
