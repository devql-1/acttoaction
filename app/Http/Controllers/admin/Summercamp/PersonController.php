<?php

namespace App\Http\Controllers\admin\Summercamp;

use App\Http\Controllers\Controller;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PersonController extends Controller
{
    // ── Index ────────────────────────────────────────────────

    public function index(): View
    {
        // Group by section for cleaner display
        $people = Person::orderBy('section')->orderBy('sort_order')->orderBy('id')->get()->groupBy('section');

        $sections = Person::SECTIONS;

        return view('backend.Summercamp.Person.index', compact('people', 'sections'));
    }

    // ── Create ───────────────────────────────────────────────

    public function create(): View
    {
        $sections = Person::SECTIONS;

        return view('backend.Summercamp.Person.create', compact('sections'));
    }

    // ── Store ────────────────────────────────────────────────

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'section' => ['required', 'in:mentor,speaker,guest,faculty'],
            'name' => ['required', 'string', 'max:150'],
            'role_badge' => ['required', 'string', 'max:80'],
            'designation' => ['required', 'string', 'max:150'],
            'bio' => ['nullable', 'string', 'max:500'],
            'photo' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
            'instagram_url' => ['nullable', 'url', 'max:255'],
            'youtube_url' => ['nullable', 'url', 'max:255'],
            'press_url' => ['nullable', 'max:255'],
            'press_label' => ['nullable', 'string', 'max:80'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:255'],
        ]);

        $photoPath = $request->file('photo')->store('people', 'public');

        Person::create([
            'section' => $request->section,
            'name' => $request->name,
            'role_badge' => $request->role_badge,
            'designation' => $request->designation,
            'bio' => $request->bio,
            'photo_path' => $photoPath,
            'instagram_url' => $request->instagram_url,
            'youtube_url' => $request->youtube_url,
            'press_url' => $request->press_url,
            'press_label' => $request->press_label,
            'sort_order' => $request->input('sort_order', 0),
            'status' => $request->boolean('status'),
        ]);

        return redirect()
            ->route('people-index')
            ->with('success', "{$request->name} added successfully.");
    }

    // ── Edit ─────────────────────────────────────────────────

    public function edit(Person $person): View
    {
        $sections = Person::SECTIONS;

        return view('backend.people.edit', compact('person', 'sections'));
    }

    // ── Update ───────────────────────────────────────────────

    public function update(Request $request, Person $person): RedirectResponse
    {
        $request->validate([
            'section' => ['required', 'in:mentor,speaker,guest,faculty'],
            'name' => ['required', 'string', 'max:150'],
            'role_badge' => ['required', 'string', 'max:80'],
            'designation' => ['required', 'string', 'max:150'],
            'bio' => ['nullable', 'string', 'max:500'],
            'photo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:3072'],
            'instagram_url' => ['nullable', 'url', 'max:255'],
            'youtube_url' => ['nullable', 'url', 'max:255'],
            'press_url' => ['nullable', 'max:255'],
            'press_label' => ['nullable', 'string', 'max:80'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:255'],
        ]);

        // Replace photo if new one uploaded
        if ($request->hasFile('photo')) {
            Storage::disk('public')->delete($person->photo_path);
            $person->photo_path = $request->file('photo')->store('people', 'public');
        }

        $person->update([
            'section' => $request->section,
            'name' => $request->name,
            'role_badge' => $request->role_badge,
            'designation' => $request->designation,
            'bio' => $request->bio,
            'photo_path' => $person->photo_path,
            'instagram_url' => $request->instagram_url,
            'youtube_url' => $request->youtube_url,
            'press_url' => $request->press_url,
            'press_label' => $request->press_label,
            'sort_order' => $request->input('sort_order', $person->sort_order),
            'status' => $request->boolean('status'),
        ]);

        return redirect()
            ->route('people-index')
            ->with('success', "{$person->name} updated successfully.");
    }

    // ── Toggle Status (AJAX) ─────────────────────────────────

    public function status(Request $request)
    {
        $person = Person::findOrFail($request->id);
        $person->update(['status' => !$person->status]);

        return response()->json([
            'success' => true,
            'status' => $person->status,
        ]);
    }

    // ── Destroy ──────────────────────────────────────────────

    public function destroy(Person $person): RedirectResponse
    {
        Storage::disk('public')->delete($person->photo_path);
        $name = $person->name;
        $person->delete();

        return redirect()
            ->route('people-index')
            ->with('success', "{$name} deleted successfully.");
    }
}
