<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\WorkshopAgeGroup;
use App\Models\WorkshopCity;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class WorkshopCityController extends Controller
{
    public function index(Request $request): View
    {
        $ageGroups = WorkshopAgeGroup::ordered()->get();

        $query = WorkshopCity::with('ageGroup')->withCount('allSchools')->ordered();

        if ($request->filled('age_group_id')) {
            $query->where('age_group_id', $request->age_group_id);
        }

        $cities = $query->get();
        $activeAgeGroup = $request->input('age_group_id');
        // resources\views\backend\workshop\cities
        return view('backend.workshop.cities.cities-index', compact('cities', 'ageGroups', 'activeAgeGroup'));
    }

    public function create(): View
    {
        $ageGroups = WorkshopAgeGroup::active()->ordered()->get();
        return view('backend.workshop.cities.cities-create', compact('ageGroups'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'age_group_id' => ['required', 'exists:workshop_age_groups,id'],
            'name' => ['required', 'string', 'max:100'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        WorkshopCity::create([
            'age_group_id' => $request->age_group_id,
            'name' => $request->name,
            'sort_order' => $request->input('sort_order', 0),
            'status' => $request->boolean('status'),
        ]);

        return redirect()
            ->route('workshop-cities-index')
            ->with('success', "City \"{$request->name}\" added.");
    }

    public function edit(WorkshopCity $workshopCity): View
    {
        $ageGroups = WorkshopAgeGroup::active()->ordered()->get();
        return view('backend.workshops.cities.edit', compact('workshopCity', 'ageGroups'));
    }

    public function update(Request $request, WorkshopCity $workshopCity): RedirectResponse
    {
        $request->validate([
            'age_group_id' => ['required', 'exists:workshop_age_groups,id'],
            'name' => ['required', 'string', 'max:100'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $workshopCity->update([
            'age_group_id' => $request->age_group_id,
            'name' => $request->name,
            'sort_order' => $request->input('sort_order', $workshopCity->sort_order),
            'status' => $request->boolean('status'),
        ]);

        return redirect()
            ->route('workshop-cities-index')
            ->with('success', "City \"{$workshopCity->name}\" updated.");
    }

    public function status(Request $request)
    {
        $city = WorkshopCity::findOrFail($request->id);
        $city->update(['status' => !$city->status]);
        return response()->json(['success' => true, 'status' => $city->status]);
    }

    public function destroy(WorkshopCity $workshopCity): RedirectResponse
    {
        $name = $workshopCity->name;
        $workshopCity->delete(); // cascades to schools
        return redirect()
            ->route('workshop-cities-index')
            ->with('success', "City \"{$name}\" deleted.");
    }
}
