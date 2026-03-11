<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::withCount('subEvents')->latest()->get();
        return view('backend.events.index', compact('events'));
    }

    public function create()
    {
        return view('backend.events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'required|date',
            'event_end_date' => 'nullable|date|after_or_equal:event_date',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'instagram_link' => 'nullable|url',
            'highlights_link' => 'nullable|url',
        ]);

        // Upload banner image
        $bannerPath = null;
        if ($request->hasFile('banner_image')) {
            $bannerPath = $request->file('banner_image')->store('event_banners', 'public');
        }

        $event = Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'event_date' => $request->event_date,
            'event_end_date' => $request->event_end_date,
            'banner_image' => $bannerPath,
            'instagram_link' => $request->instagram_link,
            'highlights_link' => $request->highlights_link,
            'status' => 1,
        ]);

        return redirect()->route('events-index', $event->id)
            ->with('success', 'Event created successfully. Now add sub events below.');
    }

    public function show($id)
    {
        $event = Event::with(['subEvents.centers.state'])->findOrFail($id);
        return view('backend.events.show', compact('event'));
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('backend.events.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'required|date',
            'event_end_date' => 'nullable|date|after_or_equal:event_date',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'instagram_link' => 'nullable|url',
            'highlights_link' => 'nullable|url',
        ]);

        $event = Event::findOrFail($id);

        // Handle banner image update
        $bannerPath = $event->banner_image;
        if ($request->hasFile('banner_image')) {
            // Delete old image
            if ($bannerPath) {
                Storage::disk('public')->delete($bannerPath);
            }
            $bannerPath = $request->file('banner_image')->store('event_banners', 'public');
        }

        $event->update([
            'title' => $request->title,
            'description' => $request->description,
            'event_date' => $request->event_date,
            'event_end_date' => $request->event_end_date,
            'banner_image' => $bannerPath,
            'instagram_link' => $request->instagram_link,
            'highlights_link' => $request->highlights_link,
        ]);

        return redirect()->route('events-index')
            ->with('success', 'Event updated successfully');
    }

    public function status(Request $request)
    {
        $event = Event::findOrFail($request->id);
        $event->update(['status' => $request->status]);
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        // Delete banner image from storage
        if ($event->banner_image) {
            Storage::disk('public')->delete($event->banner_image);
        }

        $event->delete(); // cascades to sub_events and sub_event_centers

        return redirect()->back()->with('success', 'Event deleted successfully');
    }
}