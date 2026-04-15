<?php

namespace App\Http\Controllers\admin\Summercamp;

use App\Http\Controllers\Controller;
use App\Models\SchoolPartner;
use App\Models\SchoolPartnerCategory;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SchoolPartnerController extends Controller
{
    public function index(): View
    {
        $categories = SchoolPartnerCategory::ordered()->get()->keyBy('id');
        $schools    = SchoolPartner::with('category')->ordered()->get()->groupBy('category_id');

        return view('backend.Summercamp.SchoolPartner.index', compact('schools', 'categories'));
    }

    public function create(): View
    {
        $categories = SchoolPartnerCategory::active()->ordered()->get();

        return view('backend.Summercamp.SchoolPartner.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'category_id' => ['required', 'exists:school_partner_categories,id'],
            'name'        => ['required', 'string', 'max:150'],
            'logo'        => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
            'website_url' => ['nullable', 'url', 'max:255'],
            'sort_order'  => ['nullable', 'integer', 'min:0', 'max:255'],
        ]);

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('school-partners', 'public');
        }

        SchoolPartner::create([
            'category_id' => $request->category_id,
            'name'        => $request->name,
            'logo_path'   => $logoPath,
            'website_url' => $request->website_url,
            'sort_order'  => $request->input('sort_order', 0),
            'status'      => $request->boolean('status'),
        ]);

        return redirect()->route('school-partners.index')
            ->with('success', "{$request->name} added successfully.");
    }

    public function edit(SchoolPartner $schoolPartner): View
    {
        $categories = SchoolPartnerCategory::active()->ordered()->get();

        return view('backend.Summercamp.SchoolPartner.edit', compact('schoolPartner', 'categories'));
    }

    public function update(Request $request, SchoolPartner $schoolPartner): RedirectResponse
    {
        $request->validate([
            'category_id' => ['required', 'exists:school_partner_categories,id'],
            'name'        => ['required', 'string', 'max:150'],
            'logo'        => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
            'website_url' => ['nullable', 'url', 'max:255'],
            'sort_order'  => ['nullable', 'integer', 'min:0', 'max:255'],
        ]);

        if ($request->hasFile('logo')) {
            if ($schoolPartner->logo_path && !str_starts_with($schoolPartner->logo_path, 'http')) {
                Storage::disk('public')->delete($schoolPartner->logo_path);
            }
            $schoolPartner->logo_path = $request->file('logo')->store('school-partners', 'public');
        }

        $schoolPartner->update([
            'category_id' => $request->category_id,
            'name'        => $request->name,
            'logo_path'   => $schoolPartner->logo_path,
            'website_url' => $request->website_url,
            'sort_order'  => $request->input('sort_order', $schoolPartner->sort_order),
            'status'      => $request->boolean('status'),
        ]);

        return redirect()->route('school-partners.index')
            ->with('success', "{$schoolPartner->name} updated successfully.");
    }

    public function status(Request $request)
    {
        $school = SchoolPartner::findOrFail($request->id);
        $school->update(['status' => !$school->status]);

        return response()->json(['success' => true, 'status' => $school->status]);
    }

    public function destroy(SchoolPartner $schoolPartner): RedirectResponse
    {
        if ($schoolPartner->logo_path && !str_starts_with($schoolPartner->logo_path, 'http')) {
            Storage::disk('public')->delete($schoolPartner->logo_path);
        }
        $name = $schoolPartner->name;
        $schoolPartner->delete();

        return redirect()->route('school-partners.index')
            ->with('success', "{$name} deleted successfully.");
    }
}
