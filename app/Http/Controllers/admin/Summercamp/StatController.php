<?php

namespace App\Http\Controllers\admin\Summercamp;

use App\Http\Controllers\Controller;
use App\Models\Stat;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class StatController extends Controller
{
    public function index(): View
    {
        $stats = Stat::ordered()->get();
        return view('backend.Summercamp.stat.stats-index', compact('stats'));
    }

    public function create(): View
    {
        return view('backend.Summercamp.stat.stats-create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'icon' => ['required', 'string', 'max:80'],
            'value' => ['required', 'string', 'max:20'],
            'suffix' => ['nullable', 'string', 'max:10'],
            'label' => ['required', 'string', 'max:100'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        Stat::create([
            'icon' => $request->icon,
            'value' => $request->value,
            'suffix' => $request->input('suffix', '+'),
            'label' => $request->label,
            'sort_order' => $request->input('sort_order', 0),
            'status' => $request->boolean('status'),
        ]);

        return redirect()
            ->route('stats-index')
            ->with('success', "Stat \"{$request->label}\" created.");
    }

    public function edit(Stat $stat): View
    {
        return view('backend.Summercamp.stat.stats-edit', compact('stat'));
    }

    public function update(Request $request, Stat $stat): RedirectResponse
    {
        $request->validate([
            'icon' => ['required', 'string', 'max:80'],
            'value' => ['required', 'string', 'max:20'],
            'suffix' => ['nullable', 'string', 'max:10'],
            'label' => ['required', 'string', 'max:100'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $stat->update([
            'icon' => $request->icon,
            'value' => $request->value,
            'suffix' => $request->input('suffix', '+'),
            'label' => $request->label,
            'sort_order' => $request->input('sort_order', $stat->sort_order),
            'status' => $request->boolean('status'),
        ]);

        return redirect()
            ->route('stats-index')
            ->with('success', "Stat \"{$stat->label}\" updated.");
    }

    public function status(Request $request)
    {
        $stat = Stat::findOrFail($request->id);
        $stat->update(['status' => !$stat->status]);
        return response()->json(['success' => true, 'status' => $stat->status]);
    }

    public function destroy(Stat $stat): RedirectResponse
    {
        $label = $stat->label;
        $stat->delete();
        return redirect()
            ->route('stats-index')
            ->with('success', "Stat \"{$label}\" deleted.");
    }
}
