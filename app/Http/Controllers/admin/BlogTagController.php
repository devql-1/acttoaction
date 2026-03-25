<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogTag;
use Illuminate\Support\Str;

class BlogTagController extends Controller
{
    public function index()
    {
        $tags = BlogTag::withCount('blogs')->latest()->paginate(15);
        return view('backend.blog_system.blog_tags.index', compact('tags'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:100|unique:blog_tags,name']);

        BlogTag::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return back()->with('success', 'Tag created.');
    }

    public function update(Request $request, BlogTag $blogTag)
    {
        $request->validate(['name' => 'required|string|max:100|unique:blog_tags,name,' . $blogTag->id]);

        $blogTag->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return back()->with('success', 'Tag updated.');
    }

    public function destroy(BlogTag $blogTag)
    {
        $blogTag->delete(); // pivot rows auto-delete via cascade
        return back()->with('success', 'Tag deleted.');
    }
}
