<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\WorkshopAgeGroup;
use App\Models\WorkshopCity;
use App\Models\WorkshopSchool;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class WorkshopSchoolController extends Controller
{
    public function index(Request $request): View
    {
        $ageGroups = WorkshopAgeGroup::ordered()->get();
        $cities = WorkshopCity::ordered()->with('ageGroup')->get();

        $query = WorkshopSchool::with(['city', 'ageGroup'])->ordered();

        if ($request->filled('age_group_id')) {
            $query->where('age_group_id', $request->age_group_id);
        }
        if ($request->filled('city_id')) {
            $query->where('city_id', $request->city_id);
        }

        $schools = $query->get();
        $activeAgeGroup = $request->input('age_group_id');
        $activeCity = $request->input('city_id');

        return view('backend.workshop.school.schools-index', compact('schools', 'ageGroups', 'cities', 'activeAgeGroup', 'activeCity'));
    }

    public function create(): View
    {
        $ageGroups = WorkshopAgeGroup::active()->ordered()->get();
        $cities = WorkshopCity::active()->ordered()->with('ageGroup')->get();
        // resources\views\backend\workshop\school\schools-create.blade.php
        return view('backend.workshop.school.schools-create', compact('ageGroups', 'cities'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'age_group_id' => ['required', 'exists:workshop_age_groups,id'],
            'city_id' => ['required', 'exists:workshop_cities,id'],
            'name' => ['required', 'string', 'max:200'],
            'description' => ['nullable', 'string'],
            'timings' => ['nullable', 'string', 'max:100'],
            'registration_url' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'fees' => ['required', 'integer'],
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('workshops', 'public');
        }

        WorkshopSchool::create([
            'age_group_id' => $request->age_group_id,
            'city_id' => $request->city_id,
            'name' => $request->name,
            'description' => $request->description,
            'timings' => $request->timings,
            'registration_url' => $request->registration_url,
            'address' => $request->address,
            'image_path' => $imagePath,
            'sort_order' => $request->input('sort_order', 0),
            'status' => $request->boolean('status'),
            'fees' => $request->fees,
        ]);

        return redirect()
            ->route('workshop-schools-index')
            ->with('success', "\"{$request->name}\" added successfully.");
    }

    public function edit(WorkshopSchool $workshopSchool): View
    {
        $ageGroups = WorkshopAgeGroup::active()->ordered()->get();
        $cities = WorkshopCity::active()->ordered()->with('ageGroup')->get();

        return view('backend.workshop.school.schools-edit', compact('workshopSchool', 'ageGroups', 'cities'));
    }

    public function update(Request $request, WorkshopSchool $workshopSchool): RedirectResponse
    {
        $request->validate([
            'age_group_id' => ['required', 'exists:workshop_age_groups,id'],
            'city_id' => ['required', 'exists:workshop_cities,id'],
            'name' => ['required', 'string', 'max:200'],
            'description' => ['nullable', 'string'],
            'timings' => ['nullable', 'string', 'max:100'],
            'registration_url' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'fees' => ['required', 'integer'],
        ]);

        if ($request->hasFile('image')) {
            if ($workshopSchool->image_path) {
                Storage::disk('public')->delete($workshopSchool->image_path);
            }
            $workshopSchool->image_path = $request->file('image')->store('workshops', 'public');
        }

        $workshopSchool->update([
            'age_group_id' => $request->age_group_id,
            'city_id' => $request->city_id,
            'name' => $request->name,
            'description' => $request->description,
            'timings' => $request->timings,
            'registration_url' => $request->registration_url,
            'address' => $request->address,
            'image_path' => $workshopSchool->image_path,
            'sort_order' => $request->input('sort_order', $workshopSchool->sort_order),
            'status' => $request->boolean('status'),
            'fees' => $request->fees,
        ]);

        return redirect()
            ->route('workshop-schools-index')
            ->with('success', "\"{$workshopSchool->name}\" updated.");
    }

    public function status(Request $request)
    {
        $school = WorkshopSchool::findOrFail($request->id);
        $school->update(['status' => !$school->status]);
        return response()->json(['success' => true, 'status' => $school->status]);
    }

    public function destroy(WorkshopSchool $workshopSchool): RedirectResponse
    {
        if ($workshopSchool->image_path) {
            Storage::disk('public')->delete($workshopSchool->image_path);
        }
        $name = $workshopSchool->name;
        $workshopSchool->delete();

        return redirect()
            ->route('workshop-schools-index')
            ->with('success', "\"{$name}\" deleted.");
    }
}
