<?php

namespace App\Http\Controllers\admin\Summercamp;

use App\Http\Controllers\Controller;
use App\Models\SummerPartnerCategory;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PartnerCategoryController extends Controller
{
    // ── Index ────────────────────────────────────────────────

    public function index(): View
    {
        $categories = SummerPartnerCategory::withCount(['partners as partner_count'])
            ->ordered()
            ->get();

        return view('backend.Summercamp.PartnerCategory.index', compact('categories'));
    }

    // ── Create ───────────────────────────────────────────────

    public function create(): View
    {
        return view('backend.Summercamp.PartnerCategory.create');
    }

    // ── Store ────────────────────────────────────────────────

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'       => ['required', 'string', 'max:100'],
            'slug'       => ['nullable', 'string', 'max:100', 'unique:summer_partner_categories,slug', 'regex:/^[a-z0-9\-]+$/'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:255'],
        ]);

        $slug = $request->slug ?: Str::slug($request->name);

        // Ensure uniqueness even if auto-generated
        $base = $slug;
        $i    = 2;
        while (SummerPartnerCategory::where('slug', $slug)->exists()) {
            $slug = $base . '-' . $i++;
        }

        SummerPartnerCategory::create([
            'name'       => $request->name,
            'slug'       => $slug,
            'sort_order' => $request->input('sort_order', 0),
            'status'     => $request->boolean('status'),
        ]);

        return redirect()
            ->route('summer-partner-categories.index')
            ->with('success', "Category '{$request->name}' added.");
    }

    // ── Edit ─────────────────────────────────────────────────

    public function edit(SummerPartnerCategory $summerPartnerCategory): View
    {
        return view('backend.Summercamp.PartnerCategory.edit', ['category' => $summerPartnerCategory]);
    }

    // ── Update ───────────────────────────────────────────────

    public function update(Request $request, SummerPartnerCategory $summerPartnerCategory): RedirectResponse
    {
        $request->validate([
            'name'       => ['required', 'string', 'max:100'],
            'slug'       => ['nullable', 'string', 'max:100', 'regex:/^[a-z0-9\-]+$/',
                             "unique:summer_partner_categories,slug,{$summerPartnerCategory->id}"],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:255'],
        ]);

        $newSlug = $request->slug ?: Str::slug($request->name);

        // If slug changed, update all partners that used the old slug
        if ($newSlug !== $summerPartnerCategory->slug) {
            \App\Models\SummerPartner::where('category', $summerPartnerCategory->slug)
                ->update(['category' => $newSlug]);
        }

        $summerPartnerCategory->update([
            'name'       => $request->name,
            'slug'       => $newSlug,
            'sort_order' => $request->input('sort_order', $summerPartnerCategory->sort_order),
            'status'     => $request->boolean('status'),
        ]);

        return redirect()
            ->route('summer-partner-categories.index')
            ->with('success', "Category '{$summerPartnerCategory->name}' updated.");
    }

    // ── Toggle Status (AJAX) ─────────────────────────────────

    public function status(Request $request)
    {
        $cat = SummerPartnerCategory::findOrFail($request->id);
        $cat->update(['status' => !$cat->status]);

        return response()->json(['success' => true, 'status' => $cat->status]);
    }

    // ── Destroy ──────────────────────────────────────────────

    public function destroy(SummerPartnerCategory $summerPartnerCategory): RedirectResponse
    {
        $count = \App\Models\SummerPartner::where('category', $summerPartnerCategory->slug)->count();

        if ($count > 0) {
            return redirect()
                ->route('summer-partner-categories.index')
                ->with('error', "Cannot delete — {$count} partner(s) are assigned to this category. Reassign them first.");
        }

        $name = $summerPartnerCategory->name;
        $summerPartnerCategory->delete();

        return redirect()
            ->route('summer-partner-categories.index')
            ->with('success', "Category '{$name}' deleted.");
    }
}
