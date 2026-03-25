<?php

namespace App\Http\Controllers\admin\Summercamp;

use App\Http\Controllers\Controller;
use App\Models\GalleryCategory;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class GalleryImageController extends Controller
{
    public function index(Request $request): View
    {
        $categories = GalleryCategory::ordered()->get();
        $query = GalleryImage::with('category')->ordered();

        if ($request->filled('category_id')) {
            $query->where('gallery_category_id', $request->category_id);
        }

        $images = $query->get();
        $activeCategory = $request->input('category_id');

        return view('backend.Summercamp.gallery.gallery-img-index', compact('images', 'categories', 'activeCategory'));
    }

    public function create(): View
    {
        $categories = GalleryCategory::active()->ordered()->get();
        return view('backend.Summercamp.gallery.gallery-img-create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'gallery_category_id' => ['required', 'exists:gallery_categories,id'],
            'images' => ['required', 'array', 'min:1'],
            'images.*' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'size' => ['nullable', 'in:sm,md,lg'],
            'strip_row' => ['nullable', 'integer', 'between:1,3'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $count = 0;
        foreach ($request->file('images') as $file) {
            $path = $file->store('gallery', 'public');

            GalleryImage::create([
                'gallery_category_id' => $request->gallery_category_id,
                'image_path' => $path,
                'alt_text' => $request->input('alt_text'),
                'label' => $request->input('label'),
                'size' => $request->input('size', 'md'),
                'strip_row' => $request->input('strip_row', 1),
                'is_featured' => $request->boolean('is_featured'),
                'sort_order' => $request->input('sort_order', 0),
                'status' => $request->boolean('status', true),
            ]);

            $count++;
        }

        return redirect()
            ->route('gallery-images-index')
            ->with('success', "{$count} image(s) uploaded successfully.");
    }

    public function edit(GalleryImage $galleryImage): View
    {
        $categories = GalleryCategory::active()->ordered()->get();
        return view('backend.Summercamp.gallery.gallery-img-edit', compact('galleryImage', 'categories'));
    }

    public function update(Request $request, GalleryImage $galleryImage): RedirectResponse
    {
        $request->validate([
            'gallery_category_id' => ['required', 'exists:gallery_categories,id'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'size' => ['nullable', 'in:sm,md,lg'],
            'strip_row' => ['nullable', 'integer', 'between:1,3'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($galleryImage->image_path);
            $galleryImage->image_path = $request->file('image')->store('gallery', 'public');
        }

        $galleryImage->update([
            'gallery_category_id' => $request->gallery_category_id,
            'image_path' => $galleryImage->image_path,
            'alt_text' => $request->input('alt_text'),
            'label' => $request->input('label'),
            'size' => $request->input('size', 'md'),
            'strip_row' => $request->input('strip_row', 1),
            'is_featured' => $request->boolean('is_featured'),
            'sort_order' => $request->input('sort_order', $galleryImage->sort_order),
            'status' => $request->boolean('status'),
        ]);

        return redirect()->route('gallery-images-index')->with('success', 'Image updated.');
    }

    public function status(Request $request)
    {
        $img = GalleryImage::findOrFail($request->id);
        $img->update(['status' => !$img->status]);
        return response()->json(['success' => true, 'status' => $img->status]);
    }

    public function destroy(GalleryImage $galleryImage): RedirectResponse
    {
        Storage::disk('public')->delete($galleryImage->image_path);
        $galleryImage->delete();
        return redirect()->route('gallery-images-index')->with('success', 'Image deleted.');
    }
}
