<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\WorkshopAgeGroup;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class WorkshopAgeGroupController extends Controller
{
    // resources\views\backend\workshop\age
    public function index(): View
    {
        $ageGroups = WorkshopAgeGroup::withCount(['cities', 'schools'])
            ->ordered()
            ->get();

        return view('backend.workshop.age.age-groups-index', compact('ageGroups'));
    }

    public function create(): View
    {
        return view('backend.workshop.age.age-groups-create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        WorkshopAgeGroup::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'sort_order' => $request->input('sort_order', 0),
            'status' => $request->boolean('status'),
        ]);

        return redirect()
            ->route('workshop-age-groups-index')
            ->with('success', "Age group \"{$request->name}\" created.");
    }

    public function edit(WorkshopAgeGroup $workshopAgeGroup): View
    {
        return view('backend.workshop.age.age-groups-edit', compact('workshopAgeGroup'));
    }

    public function update(Request $request, WorkshopAgeGroup $workshopAgeGroup): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'description' => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $workshopAgeGroup->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'sort_order' => $request->input('sort_order', $workshopAgeGroup->sort_order),
            'status' => $request->boolean('status'),
        ]);

        return redirect()
            ->route('workshop-age-groups-index')
            ->with('success', "Age group \"{$workshopAgeGroup->name}\" updated.");
    }

    public function status(Request $request)
    {
        $group = WorkshopAgeGroup::findOrFail($request->id);
        $group->update(['status' => !$group->status]);
        return response()->json(['success' => true, 'status' => $group->status]);
    }

    public function destroy(WorkshopAgeGroup $workshopAgeGroup): RedirectResponse
    {
        $name = $workshopAgeGroup->name;
        $workshopAgeGroup->delete(); // cascades to cities → schools
        return redirect()
            ->route('workshop-age-groups-index')
            ->with('success', "Age group \"{$name}\" deleted.");
    }
}
