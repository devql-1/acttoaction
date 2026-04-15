<?php

namespace App\Http\Controllers\admin\Summercamp;

use App\Http\Controllers\Controller;
use App\Models\SchoolPartnerCategory;
use App\Models\SchoolSection;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class SchoolPartnerCategoryController extends Controller
{
    public function index(Request $request): View
    {
        $sections = SchoolSection::ordered()->get();

        $query = SchoolPartnerCategory::withCount('schools as school_count')
            ->with('section')
            ->ordered();

        if ($request->filled('section')) {
            $query->where('school_section_id', $request->section);
        }

        $categories    = $query->get();
        $activeSection = $request->input('section');

        return view('backend.Summercamp.SchoolPartnerCategory.index',
            compact('categories', 'sections', 'activeSection'));
    }

    public function create(Request $request): View
    {
        $sections          = SchoolSection::active()->ordered()->get();
        $preselectedSection = $request->input('section_id');

        return view('backend.Summercamp.SchoolPartnerCategory.create',
            compact('sections', 'preselectedSection'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'school_section_id' => ['nullable', 'exists:school_sections,id'],
            'name'              => ['required', 'string', 'max:100'],
            'slug'              => ['nullable', 'string', 'max:100', 'unique:school_partner_categories,slug', 'regex:/^[a-z0-9\-]+$/'],
            'sort_order'        => ['nullable', 'integer', 'min:0', 'max:255'],
        ]);

        $slug = $request->slug ?: Str::slug($request->name);
        $base = $slug; $i = 2;
        while (SchoolPartnerCategory::where('slug', $slug)->exists()) {
            $slug = $base . '-' . $i++;
        }

        SchoolPartnerCategory::create([
            'school_section_id' => $request->school_section_id ?: null,
            'name'              => $request->name,
            'slug'              => $slug,
            'sort_order'        => $request->input('sort_order', 0),
            'status'            => $request->boolean('status'),
        ]);

        return redirect()->route('school-partner-categories.index')
            ->with('success', "Category '{$request->name}' added.");
    }

    public function edit(SchoolPartnerCategory $schoolPartnerCategory): View
    {
        $sections = SchoolSection::active()->ordered()->get();

        return view('backend.Summercamp.SchoolPartnerCategory.edit',
            ['category' => $schoolPartnerCategory, 'sections' => $sections]);
    }

    public function update(Request $request, SchoolPartnerCategory $schoolPartnerCategory): RedirectResponse
    {
        $request->validate([
            'school_section_id' => ['nullable', 'exists:school_sections,id'],
            'name'              => ['required', 'string', 'max:100'],
            'slug'              => ['nullable', 'string', 'max:100', 'regex:/^[a-z0-9\-]+$/',
                                   "unique:school_partner_categories,slug,{$schoolPartnerCategory->id}"],
            'sort_order'        => ['nullable', 'integer', 'min:0', 'max:255'],
        ]);

        $schoolPartnerCategory->update([
            'school_section_id' => $request->school_section_id ?: null,
            'name'              => $request->name,
            'slug'              => $request->slug ?: Str::slug($request->name),
            'sort_order'        => $request->input('sort_order', $schoolPartnerCategory->sort_order),
            'status'            => $request->boolean('status'),
        ]);

        return redirect()->route('school-partner-categories.index')
            ->with('success', "Category '{$schoolPartnerCategory->name}' updated.");
    }

    public function status(Request $request)
    {
        $cat = SchoolPartnerCategory::findOrFail($request->id);
        $cat->update(['status' => !$cat->status]);

        return response()->json(['success' => true, 'status' => $cat->status]);
    }

    public function destroy(SchoolPartnerCategory $schoolPartnerCategory): RedirectResponse
    {
        $count = $schoolPartnerCategory->schools()->count();

        if ($count > 0) {
            return redirect()->route('school-partner-categories.index')
                ->with('error', "Cannot delete — {$count} school(s) assigned. Remove them first.");
        }

        $name = $schoolPartnerCategory->name;
        $schoolPartnerCategory->delete();

        return redirect()->route('school-partner-categories.index')
            ->with('success', "Category '{$name}' deleted.");
    }
}
