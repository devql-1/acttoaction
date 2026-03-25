<?php

namespace App\Http\Controllers\admin\Summercamp;

use App\Http\Controllers\Controller;
use App\Models\GalleryCategory;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use Illuminate\View\View;

class GalleryCategoryController extends Controller
{
    public function index(): View
    {
        $categories = GalleryCategory::withCount('images')->ordered()->get();
        return view('backend.Summercamp.gallery.gallery-cat-index', compact('categories'));
    }

    public function create(): View
    {
        return view('backend.Summercamp.gallery.gallery-cat-create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'slug' => ['nullable', 'string', 'max:120', 'unique:gallery_categories,slug'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        GalleryCategory::create([
            'name' => $request->name,
            'slug' => $request->filled('slug') ? Str::slug($request->slug) : Str::slug($request->name),
            'sort_order' => $request->input('sort_order', 0),
            'status' => $request->boolean('status'),
        ]);

        return redirect()
            ->route('gallery-categories-index')
            ->with('success', "Category \"{$request->name}\" created.");
    }

    public function edit(GalleryCategory $galleryCategory): View
    {
        return view('backend.Summercamp.gallery.gallery-cat-edit', compact('galleryCategory'));
    }

    public function update(Request $request, GalleryCategory $galleryCategory): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'slug' => ['nullable', 'string', 'max:120', "unique:gallery_categories,slug,{$galleryCategory->id}"],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $galleryCategory->update([
            'name' => $request->name,
            'slug' => $request->filled('slug') ? Str::slug($request->slug) : Str::slug($request->name),
            'sort_order' => $request->input('sort_order', $galleryCategory->sort_order),
            'status' => $request->boolean('status'),
        ]);

        return redirect()
            ->route('gallery-categories-index')
            ->with('success', "Category \"{$galleryCategory->name}\" updated.");
    }

    public function status(Request $request)
    {
        $cat = GalleryCategory::findOrFail($request->id);
        $cat->update(['status' => !$cat->status]);
        return response()->json(['success' => true, 'status' => $cat->status]);
    }

    public function destroy(GalleryCategory $galleryCategory): RedirectResponse
    {
        $name = $galleryCategory->name;
        $galleryCategory->delete(); // cascades to images
        return redirect()
            ->route('gallery-categories-index')
            ->with('success', "Category \"{$name}\" and all its images deleted.");
    }
}
