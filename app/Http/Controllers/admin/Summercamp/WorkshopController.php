<?php

namespace App\Http\Controllers\admin\Summercamp;

use App\Http\Controllers\Controller;
use App\Models\Merchandise;
use App\Models\WorkshopAgeGroup;
use App\Models\WorkshopCity;
use App\Models\WorkshopSchool;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WorkshopController extends Controller
{
    public function index(Request $request): View|JsonResponse
    {
        $ageGroups = WorkshopAgeGroup::active()
            ->ordered()
            ->with(['cities' => fn($q) => $q->where('status', 1)->ordered()])
            ->get();

        // ── AJAX: cities for a selected age group ──────────────────────────
        if ($request->ajax() && $request->filled('age_group_id') && !$request->filled('city_id')) {
            $cities = WorkshopCity::active()
                ->ordered()
                ->where('age_group_id', $request->age_group_id)
                ->get(['id', 'name']);

            return response()->json(['cities' => $cities]);
        }

        // ── AJAX: workshops for age group + city ───────────────────────────
        if ($request->ajax() && $request->filled('age_group_id') && $request->filled('city_id')) {
            $schools          = WorkshopSchool::active()->ordered()
                ->where('age_group_id', $request->age_group_id)
                ->where('city_id', $request->city_id)
                ->get();
            $selectedAgeGroup = WorkshopAgeGroup::find($request->age_group_id);
            $selectedCity     = WorkshopCity::find($request->city_id);

            return response()->json([
                'count'          => $schools->count(),
                'city_name'      => $selectedCity?->name,
                'age_group_name' => $selectedAgeGroup?->name,
                'age_group_desc' => $selectedAgeGroup?->description,
                'schools'        => $schools->map(fn($s) => [
                    'id'          => $s->id,
                    'name'        => $s->name,
                    'description' => $s->description,
                    'timings'     => $s->timings,
                    'image_url'   => $s->image_url,
                    'address'     => $s->address,
                    'fees'        => $s->fees,
                    'url'         => route('workshops.show', $s->slug),
                ]),
            ]);
        }

        // ── Normal full-page render ────────────────────────────────────────
        $selectedAgeGroupId = $request->input('age_group_id');
        $selectedCityId     = $request->input('city_id');
        $cities             = collect();
        $schools            = collect();
        $selectedAgeGroup   = null;
        $selectedCity       = null;

        if ($selectedAgeGroupId) {
            $cities = WorkshopCity::active()->ordered()->where('age_group_id', $selectedAgeGroupId)->get();
        }
        if ($selectedAgeGroupId && $selectedCityId) {
            $schools          = WorkshopSchool::active()->ordered()->where('age_group_id', $selectedAgeGroupId)->where('city_id', $selectedCityId)->get();
            $selectedAgeGroup = WorkshopAgeGroup::find($selectedAgeGroupId);
            $selectedCity     = WorkshopCity::find($selectedCityId);
        }

        return view('frontend.Summercamp.workshops', compact('ageGroups', 'cities', 'schools', 'selectedAgeGroupId', 'selectedCityId', 'selectedAgeGroup', 'selectedCity'));
    }
    public function workshopdetails(WorkshopSchool $school): View
    {
        abort_if(!$school->status, 404);
        $school->load('city', 'ageGroup');

        $relatedSchools = WorkshopSchool::active()->ordered()
            ->where('city_id', $school->city_id)
            ->where('age_group_id', $school->age_group_id)
            ->where('id', '!=', $school->id)
            ->limit(3)->get();

        $merchandises = Merchandise::active()->ordered()->get();

        return view('frontend.Summercamp.workshopdetails', compact('school', 'relatedSchools', 'merchandises'));
    }

    public function registerPage(WorkshopSchool $school): View
    {
        abort_if(!$school->status, 404);
        $school->load('city', 'ageGroup');
        $merchandises = Merchandise::active()->ordered()->get();

        return view('frontend.Summercamp.register', compact('school', 'merchandises'));
    }
}
