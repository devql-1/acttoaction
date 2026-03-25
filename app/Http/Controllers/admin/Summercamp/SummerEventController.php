<?php

namespace App\Http\Controllers\admin\Summercamp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Storage;

class SummerEventController extends Controller
{
    private $type = 'summer-event';

    public function index()
    {
        $events = Event::where('type', $this->type)->withCount('subEvents')->latest()->get();

        return view('backend.Summercamp.events.index', compact('events'));
    }

    public function create()
    {
        return view('backend.Summercamp.events.create');
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

        $bannerPath = null;

        if ($request->hasFile('banner_image')) {
            $filename = time() . '.' . $request->banner_image->extension();
            $request->banner_image->move(public_path('img/event_banners'), $filename);
            $bannerPath = 'img/event_banners/' . $filename;
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
            'type' => $this->type,
        ]);

        return redirect()->route('summer-events.index', $event->id)->with('success', 'Event created successfully. Now add sub events below.');
    }

    public function show($id)
    {
        $event = Event::where('type', $this->type)
            ->with(['subEvents.centers.state'])
            ->findOrFail($id);

        return view('backend.Summercamp.events.index', compact('event'));
    }

    public function edit($id)
    {
        $event = Event::where('type', $this->type)->findOrFail($id);

        return view('backend.Summercamp.events.edit', compact('event'));
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

        $event = Event::where('type', $this->type)->findOrFail($id);

        $bannerPath = $event->banner_image;

        if ($request->hasFile('banner_image')) {
            if ($bannerPath && file_exists(public_path($bannerPath))) {
                unlink(public_path($bannerPath));
            }

            $filename = time() . '.' . $request->banner_image->extension();
            $request->banner_image->move(public_path('img/event_banners'), $filename);

            $bannerPath = 'img/event_banners/' . $filename;
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

        return redirect()->route('summer-events.index')->with('success', 'Event updated successfully');
    }

    public function status(Request $request)
    {
        $event = Event::where('type', $this->type)->findOrFail($request->id);

        $event->update(['status' => $request->status]);

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $event = Event::where('type', $this->type)->findOrFail($id);

        if ($event->banner_image && file_exists(public_path($event->banner_image))) {
            unlink(public_path($event->banner_image));
        }

        $event->delete();

        return redirect()->back()->with('success', 'Event deleted successfully');
    }
}
