<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Gallerycat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::with('galleryCategory')->latest()->get();

        return view('backend.galleries.index', compact('galleries'));
    }

    public function create()
    {
        $categories = Gallerycat::all();

        return view('backend.galleries.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validate incoming data
        $request->validate([
            'gallery_category_id' => 'required|exists:gallery_categories,id',
            'title' => 'required|string|max:200',
            'images' => 'required|array|min:1', // Ensure at least one image is uploaded
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:4096', // Validate each image
        ]);

        // Loop through each uploaded image and store it
        foreach ($request->file('images') as $image) {
            $path = $image->store('gallery', 'public'); // Store each image in the public storage

            // Create a new gallery record for each image
            Gallery::create([
                'gallery_category_id' => $request->gallery_category_id,
                'title' => $request->title, // Use the same title for each image (or adjust as necessary)
                'image' => $path,
            ]);
        }

        // Return success message and redirect
        return redirect()->route('galleries.index')->with('success', 'Images uploaded successfully');
    }

    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);
        $categories = Gallerycat::all();

        return view('backend.galleries.edit', compact('gallery', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);

        $request->validate([
            'gallery_category_id' => 'required|exists:gallery_categories,id',
            'title' => 'required|string|max:200',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        $path = $gallery->image; // keep old image by default

        if ($request->hasFile('image')) {
            // Delete old image from storage
            Storage::disk('public')->delete($gallery->image);
            $path = $request->file('image')->store('gallery', 'public');
        }

        $gallery->update([
            'gallery_category_id' => $request->gallery_category_id,
            'title' => $request->title,
            'image' => $path,
        ]);

        return redirect()->route('galleries.index')->with('success', 'Image updated successfully');
    }

    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);

        // Delete image file from storage
        Storage::disk('public')->delete($gallery->image);
        $gallery->delete();

        return redirect()->route('galleries.index')->with('success', 'Image deleted successfully');
    }
}
