<?php
// app/Http/Controllers/admin/BlogAuthorController.php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\BlogAuthor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BlogAuthorController extends Controller
{
    // ── List all authors ──────────────────────────────────────────────────
    public function index()
    {
        $authors = BlogAuthor::withCount('blogs')->latest()->get();
        return view('backend.blog_system.author.author_index', compact('authors'));
    }

    // ── Show create form ──────────────────────────────────────────────────
    public function create()
    {
        return view('backend.blog_system.author.author_create');
    }

    // ── Store new author ──────────────────────────────────────────────────
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'instagram' => 'nullable|url|max:255',
            'facebook' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $author = new BlogAuthor();
        $author->name = $request->name;
        $author->designation = $request->designation;
        $author->bio = $request->bio;
        $author->instagram = $request->instagram;
        $author->facebook = $request->facebook;
        $author->twitter = $request->twitter;
        $author->linkedin = $request->linkedin;
        $author->status = 1;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img/authors'), $filename);
            $author->image = $filename;
        }

        $author->save();

        return redirect()->route('admin.blog-author.index')
            ->with('success', 'Author added successfully.');
    }

    // ── Show edit form ────────────────────────────────────────────────────
    public function edit($id)
    {
        $author = BlogAuthor::findOrFail($id);
        return view('backend.blog_system.author.edit', compact('author'));
    }

    // ── Update author ─────────────────────────────────────────────────────
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'designation' => 'nullable|string|max:255',
            'bio' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'instagram' => 'nullable|url|max:255',
            'facebook' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $author = BlogAuthor::findOrFail($id);
        $author->name = $request->name;
        $author->designation = $request->designation;
        $author->bio = $request->bio;
        $author->instagram = $request->instagram;
        $author->facebook = $request->facebook;
        $author->twitter = $request->twitter;
        $author->linkedin = $request->linkedin;

        if ($request->input('remove_image') == '1') {
            if ($author->image && file_exists(public_path('img/authors/' . $author->image))) {
                unlink(public_path('img/authors/' . $author->image));
            }
            $author->image = null;
        }

        if ($request->hasFile('image')) {
            if ($author->image && file_exists(public_path('img/authors/' . $author->image))) {
                unlink(public_path('img/authors/' . $author->image));
            }
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img/authors'), $filename);
            $author->image = $filename;
        }

        $author->save();

        return redirect()->route('admin.blog-author.index')
            ->with('success', 'Author updated successfully.');
    }

    // ── Delete author ─────────────────────────────────────────────────────
    public function destroy($id)
    {
        $author = BlogAuthor::findOrFail($id);
        if ($author->image && file_exists(public_path('img/authors/' . $author->image))) {
            unlink(public_path('img/authors/' . $author->image));
        }
        $author->delete();
        return redirect()->route('admin.blog-author.index')
            ->with('success', 'Author deleted successfully.');
    }

    // ── Toggle active / inactive ──────────────────────────────────────────
    public function toggleStatus(Request $request)
    {
        $author = BlogAuthor::find($request->id);
        if ($author) {
            $author->status = $request->status;
            $author->save();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }
}