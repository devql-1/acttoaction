<?php

namespace App\Http\Controllers\admin\Summercamp;

use App\Http\Controllers\Controller;
use App\Models\WorkshopAgeGroup;
use App\Models\WorkshopCity;
use App\Models\WorkshopSchool;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WorkshopController extends Controller
{
    public function index(Request $request): View
    {
        // All active age groups with their active cities — for both dropdowns
        $ageGroups = WorkshopAgeGroup::active()
            ->ordered()
            ->with(['cities' => fn($q) => $q->where('status', 1)->ordered()])
            ->get();

        $selectedAgeGroupId = $request->input('age_group_id');
        $selectedCityId = $request->input('city_id');

        // Cities for the selected age group — populates city dropdown
        $cities = collect();
        if ($selectedAgeGroupId) {
            $cities = WorkshopCity::active()->ordered()->where('age_group_id', $selectedAgeGroupId)->get();
        }

        // Schools — only when both are selected
        $schools = collect();
        $selectedAgeGroup = null;
        $selectedCity = null;

        if ($selectedAgeGroupId && $selectedCityId) {
            $schools = WorkshopSchool::active()->ordered()->where('age_group_id', $selectedAgeGroupId)->where('city_id', $selectedCityId)->get();

            $selectedAgeGroup = WorkshopAgeGroup::find($selectedAgeGroupId);
            $selectedCity = WorkshopCity::find($selectedCityId);
        }
        // resources\views\frontend\Summercamp\workshops.blade.php

        return view('frontend.Summercamp.workshops', compact('ageGroups', 'cities', 'schools', 'selectedAgeGroupId', 'selectedCityId', 'selectedAgeGroup', 'selectedCity'));
    }
    public function workshopdetails(WorkshopSchool $school): View
    {
        // Abort if the school is inactive
        abort_if(!$school->status, 404);

        // Eager-load relations used in the view
        $school->load('city', 'ageGroup');

        // Suggest other schools in the same city + age group (max 3, excluding self)
        $relatedSchools = WorkshopSchool::active()->ordered()->where('city_id', $school->city_id)->where('age_group_id', $school->age_group_id)->where('id', '!=', $school->id)->limit(3)->get();

        return view('frontend.Summercamp.workshopdetails', compact('school', 'relatedSchools'));
    }
}
