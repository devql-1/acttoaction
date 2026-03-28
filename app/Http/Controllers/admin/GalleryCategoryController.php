<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Gallerycat;
use Illuminate\Http\Request;

class GalleryCategoryController extends Controller
{
    public function index()
    {
        $categories = Gallerycat::withCount('galleries')->paginate(10); // Adjust the number 10 to whatever fits your case

        return view('backend.gallery_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('backend.gallery_categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100|unique:gallery_categories,name',
        ]);

        Gallerycat::create([
            'name' => $request->name,
        ]);

        return redirect()->route('galleryCategories.index')->with('success', 'Category created successfully');
    }

    public function edit($id)
    {
        $category = Gallerycat::findOrFail($id);

        return view('backend.gallery_categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $category = Gallerycat::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:100|unique:gallery_categories,name,' . $id,
        ]);

        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->route('galleryCategories.index')->with('success', 'Category updated successfully');
    }

    public function destroy($id)
    {
        Gallerycat::findOrFail($id)->delete();

        return redirect()->route('galleryCategories.index')->with('success', 'Category deleted successfully');
    }
}
