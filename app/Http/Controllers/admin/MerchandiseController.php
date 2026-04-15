<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Merchandise;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class MerchandiseController extends Controller
{
    public function index(): View
    {
        $merchandises = Merchandise::ordered()->get();
        return view('backend.merchandise.index', compact('merchandises'));
    }

    public function create(): View
    {
        return view('backend.merchandise.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name'        => ['required', 'string', 'max:200'],
            'description' => ['nullable', 'string'],
            'price'       => ['required', 'numeric', 'min:0'],
            'image'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
            'sort_order'  => ['nullable', 'integer', 'min:0'],
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('merchandise', 'public');
        }

        Merchandise::create([
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price,
            'image_path'  => $imagePath,
            'sort_order'  => $request->input('sort_order', 0),
            'status'      => $request->boolean('status'),
        ]);

        return redirect()
            ->route('merchandise.index')
            ->with('success', "\"{$request->name}\" added successfully.");
    }

    public function edit(Merchandise $merchandise): View
    {
        return view('backend.merchandise.edit', compact('merchandise'));
    }

    public function update(Request $request, Merchandise $merchandise): RedirectResponse
    {
        $request->validate([
            'name'        => ['required', 'string', 'max:200'],
            'description' => ['nullable', 'string'],
            'price'       => ['required', 'numeric', 'min:0'],
            'image'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
            'sort_order'  => ['nullable', 'integer', 'min:0'],
        ]);

        if ($request->hasFile('image')) {
            if ($merchandise->image_path) {
                Storage::disk('public')->delete($merchandise->image_path);
            }
            $merchandise->image_path = $request->file('image')->store('merchandise', 'public');
        }

        $merchandise->update([
            'name'        => $request->name,
            'description' => $request->description,
            'price'       => $request->price,
            'image_path'  => $merchandise->image_path,
            'sort_order'  => $request->input('sort_order', $merchandise->sort_order),
            'status'      => $request->boolean('status'),
        ]);

        return redirect()
            ->route('merchandise.index')
            ->with('success', "\"{$merchandise->name}\" updated.");
    }

    public function status(Request $request)
    {
        $merchandise = Merchandise::findOrFail($request->id);
        $merchandise->update(['status' => !$merchandise->status]);
        return response()->json(['success' => true, 'status' => $merchandise->status]);
    }

    public function destroy(Merchandise $merchandise): RedirectResponse
    {
        if ($merchandise->image_path) {
            Storage::disk('public')->delete($merchandise->image_path);
        }
        $name = $merchandise->name;
        $merchandise->delete();

        return redirect()
            ->route('merchandise.index')
            ->with('success', "\"{$name}\" deleted.");
    }
}
