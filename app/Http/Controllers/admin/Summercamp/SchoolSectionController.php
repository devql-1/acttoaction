<?php

namespace App\Http\Controllers\admin\Summercamp;

use App\Http\Controllers\Controller;
use App\Models\SchoolSection;
use App\Models\SchoolPartnerCategory;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class SchoolSectionController extends Controller
{
    public function index(): View
    {
        $sections = SchoolSection::withCount('categories as category_count')
            ->ordered()
            ->get();

        return view('backend.Summercamp.SchoolSection.index', compact('sections'));
    }

    public function create(): View
    {
        return view('backend.Summercamp.SchoolSection.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'        => ['required', 'string', 'max:100'],
            'slug'        => ['nullable', 'string', 'max:100', 'unique:school_sections,slug', 'regex:/^[a-z0-9\-]+$/'],
            'description' => ['nullable', 'string'],
            'sort_order'  => ['nullable', 'integer', 'min:0', 'max:255'],
        ]);

        $slug = $request->slug ?: Str::slug($request->name);
        $base = $slug; $i = 2;
        while (SchoolSection::where('slug', $slug)->exists()) {
            $slug = $base . '-' . $i++;
        }

        SchoolSection::create([
            'name'        => $request->name,
            'slug'        => $slug,
            'description' => $request->description,
            'sort_order'  => $request->input('sort_order', 0),
            'status'      => $request->boolean('status'),
        ]);

        return redirect()->route('school-sections.index')
            ->with('success', "Section '{$request->name}' created. Now add categories under it.");
    }

    public function edit(SchoolSection $schoolSection): View
    {
        // All categories — so admin can assign / unassign them
        $allCategories     = SchoolPartnerCategory::ordered()->get();
        $assignedIds       = $schoolSection->categories()->pluck('id')->toArray();

        return view('backend.Summercamp.SchoolSection.edit', compact('schoolSection', 'allCategories', 'assignedIds'));
    }

    public function update(Request $request, SchoolSection $schoolSection): RedirectResponse
    {
        $request->validate([
            'name'        => ['required', 'string', 'max:100'],
            'slug'        => ['nullable', 'string', 'max:100', 'regex:/^[a-z0-9\-]+$/',
                             "unique:school_sections,slug,{$schoolSection->id}"],
            'description' => ['nullable', 'string'],
            'sort_order'  => ['nullable', 'integer', 'min:0', 'max:255'],
            'category_ids'=> ['nullable', 'array'],
            'category_ids.*' => ['exists:school_partner_categories,id'],
        ]);

        $schoolSection->update([
            'name'        => $request->name,
            'slug'        => $request->slug ?: Str::slug($request->name),
            'description' => $request->description,
            'sort_order'  => $request->input('sort_order', $schoolSection->sort_order),
            'status'      => $request->boolean('status'),
        ]);

        // Detach all categories from this section first, then assign selected ones
        SchoolPartnerCategory::where('school_section_id', $schoolSection->id)
            ->update(['school_section_id' => null]);

        if ($request->filled('category_ids')) {
            SchoolPartnerCategory::whereIn('id', $request->category_ids)
                ->update(['school_section_id' => $schoolSection->id]);
        }

        return redirect()->route('school-sections.index')
            ->with('success', "Section '{$schoolSection->name}' updated.");
    }

    public function status(Request $request)
    {
        $section = SchoolSection::findOrFail($request->id);
        $section->update(['status' => !$section->status]);

        return response()->json(['success' => true, 'status' => $section->status]);
    }

    public function destroy(SchoolSection $schoolSection): RedirectResponse
    {
        $count = $schoolSection->categories()->count();
        if ($count > 0) {
            return redirect()->route('school-sections.index')
                ->with('error', "Cannot delete — {$count} category/categories are under this section. Remove them first.");
        }

        $name = $schoolSection->name;
        $schoolSection->delete();

        return redirect()->route('school-sections.index')
            ->with('success', "Section '{$name}' deleted.");
    }
}
