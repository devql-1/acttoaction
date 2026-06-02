<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\HeroBanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class HeroBannerController extends Controller
{
    // ── Index ───────────────────────────────────────────────

    public function index(): View
    {
        $banners = HeroBanner::latest()->get();

        return view('backend.Summercamp.hero-banner.index', compact('banners'));
    }

    public function create(): View
    {
        return view('backend.Summercamp.hero-banner.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'alt_text' => ['nullable', 'string', 'max:255'],
        ]);

        $path = $request->file('image')->store('hero', 'public');

        // If this is set as active, deactivate all others first
        if ($request->boolean('is_active')) {
            HeroBanner::query()->update(['is_active' => false]);
        }

        HeroBanner::create([
            'image_path' => $path,
            'alt_text' => $request->input('alt_text', 'Cyber AI Threat Conclave Banner'),
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('hero-banner.index')->with('success', 'Hero banner uploaded successfully.');
    }

    public function edit(HeroBanner $heroBanner): View
    {
        return view('backend.Summercamp.hero-banner.edit', compact('heroBanner'));
    }

    // ── Update ──────────────────────────────────────────────

    public function update(Request $request, HeroBanner $heroBanner): RedirectResponse
    {
        $request->validate([
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'alt_text' => ['nullable', 'string', 'max:255'],
        ]);

        // If a new image is uploaded, delete the old one
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($heroBanner->image_path);
            $heroBanner->image_path = $request->file('image')->store('hero', 'public');
        }

        // If this is set as active, deactivate all others first
        if ($request->boolean('is_active')) {
            HeroBanner::where('id', '!=', $heroBanner->id)->update(['is_active' => false]);
        }

        $heroBanner->update([
            'image_path' => $heroBanner->image_path,
            'alt_text' => $request->input('alt_text', $heroBanner->alt_text),
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('hero-banner.index')->with('success', 'Hero banner updated successfully.');
    }

    // ── Destroy ─────────────────────────────────────────────

    public function destroy(HeroBanner $heroBanner): RedirectResponse
    {
        Storage::disk('public')->delete($heroBanner->image_path);
        $heroBanner->delete();

        return redirect()->route('hero-banner.index')->with('success', 'Hero banner deleted.');
    }

    // ── Quick toggle active ──────────────────────────────────

    public function activate(HeroBanner $heroBanner): RedirectResponse
    {
        // Deactivate all, then activate this one
        HeroBanner::query()->update(['is_active' => false]);
        $heroBanner->update(['is_active' => true]);

        return redirect()
            ->route('hero-banner.index')
            ->with('success', "Banner #{$heroBanner->id} is now active.");
    }
}
