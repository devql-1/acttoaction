<?php

namespace App\Http\Controllers\admin\Summercamp;

use App\Http\Controllers\Controller;
use App\Models\SummerPartner;
use App\Models\SummerPartnerCategory;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PartnerController extends Controller
{
    // ── Index ────────────────────────────────────────────────

    public function index(): View
    {
        $categories = SummerPartnerCategory::active()->ordered()->get()->keyBy('slug');
        $partners   = SummerPartner::orderBy('sort_order')->orderBy('id')->get()->groupBy('category');

        return view('backend.Summercamp.Partner.index', compact('partners', 'categories'));
    }

    // ── Create ───────────────────────────────────────────────

    public function create(): View
    {
        $categories = SummerPartnerCategory::active()->ordered()->get();

        return view('backend.Summercamp.Partner.create', compact('categories'));
    }

    // ── Store ────────────────────────────────────────────────

    public function store(Request $request): RedirectResponse
    {
        $slugs = SummerPartnerCategory::active()->pluck('slug')->implode(',');

        $request->validate([
            'category'    => ['required', 'exists:summer_partner_categories,slug'],
            'name'        => ['required', 'string', 'max:150'],
            'logo'        => ['required', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
            'website_url' => ['nullable', 'url', 'max:255'],
            'sort_order'  => ['nullable', 'integer', 'min:0', 'max:255'],
        ]);

        $logoPath = $request->file('logo')->store('summer-partners', 'public');

        SummerPartner::create([
            'category'    => $request->category,
            'name'        => $request->name,
            'logo_path'   => $logoPath,
            'website_url' => $request->website_url,
            'sort_order'  => $request->input('sort_order', 0),
            'status'      => $request->boolean('status'),
        ]);

        return redirect()->route('summer-partners.index')
            ->with('success', "{$request->name} added successfully.");
    }

    // ── Edit ─────────────────────────────────────────────────

    public function edit(SummerPartner $partner): View
    {
        $categories    = SummerPartnerCategory::active()->ordered()->get();
        $summerPartner = $partner;

        return view('backend.Summercamp.Partner.edit', compact('summerPartner', 'categories'));
    }

    // ── Update ───────────────────────────────────────────────

    public function update(Request $request, SummerPartner $partner): RedirectResponse
    {
        $request->validate([
            'category'    => ['required', 'exists:summer_partner_categories,slug'],
            'name'        => ['required', 'string', 'max:150'],
            'logo'        => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
            'website_url' => ['nullable', 'url', 'max:255'],
            'sort_order'  => ['nullable', 'integer', 'min:0', 'max:255'],
        ]);

        if ($request->hasFile('logo')) {
            Storage::disk('public')->delete($partner->logo_path);
            $partner->logo_path = $request->file('logo')->store('summer-partners', 'public');
        }

        $partner->update([
            'category'    => $request->category,
            'name'        => $request->name,
            'logo_path'   => $partner->logo_path,
            'website_url' => $request->website_url,
            'sort_order'  => $request->input('sort_order', $partner->sort_order),
            'status'      => $request->boolean('status'),
        ]);

        return redirect()->route('summer-partners.index')
            ->with('success', "{$partner->name} updated successfully.");
    }

    // ── Toggle Status (AJAX) ─────────────────────────────────

    public function status(Request $request)
    {
        $partner = SummerPartner::findOrFail($request->id);
        $partner->update(['status' => !$partner->status]);

        return response()->json(['success' => true, 'status' => $partner->status]);
    }

    // ── Destroy ──────────────────────────────────────────────

    public function destroy(SummerPartner $partner): RedirectResponse
    {
        Storage::disk('public')->delete($partner->logo_path);
        $name = $partner->name;
        $partner->delete();

        return redirect()->route('summer-partners.index')
            ->with('success', "{$name} deleted successfully.");
    }
}
