<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubEvent;
use App\Models\Event;
use App\Models\State;
use Illuminate\Support\Facades\Storage;

class SubEventController extends Controller
{
    public function create($event_id)
    {
        $event = Event::findOrFail($event_id);
        $states = State::where('status', 1)->get();
        return view('backend.sub_events.create', compact('event', 'states'));
    }

    public function store(Request $request, $event_id)
    {
        $event = Event::findOrFail($event_id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'nullable|date',
            'start_time' => 'nullable',
            'end_time' => 'nullable',
            'fees' => 'nullable|numeric|min:0',
            'age_group' => 'nullable|string|max:100',
            'mode' => 'required|in:online,offline,both',
            'max_seats' => 'nullable|integer|min:1',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'redirect_link' => 'nullable|url|max:2048',
            'center_ids' => 'nullable|array',
            'center_ids.*' => 'exists:centers,id',
        ]);

        // Handle banner image upload
        $bannerPath = $this->storeBannerImage($request);

        $subEvent = SubEvent::create([
            'event_id' => $event->id,
            'title' => $request->title,
            'description' => $request->description,
            'event_date' => $request->event_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'fees' => $request->fees ?? 0,
            'age_group' => $request->age_group,
            'mode' => $request->mode,
            'max_seats' => $request->max_seats,
            'banner_image' => $bannerPath,
            'redirect_link' => $request->redirect_link,
            'status' => 1,
        ]);

        if ($request->filled('center_ids')) {
            $subEvent->centers()->sync($request->center_ids);
        }

        return redirect()->route('events-index', $event->id)
            ->with('success', 'Sub event added successfully');
    }

    public function edit($id)
    {
        $subEvent = SubEvent::with(['event', 'centers.state'])->findOrFail($id);
        $states = State::where('status', 1)->get();
        $selectedCenters = $subEvent->centers->pluck('id')->toArray();
        $centersByState = $subEvent->centers
            ->groupBy('state_id')
            ->map(fn($centers) => $centers->values())
            ->toArray();

        return view('backend.sub_events.edit', compact(
            'subEvent',
            'states',
            'selectedCenters',
            'centersByState'
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_date' => 'nullable|date',
            'start_time' => 'nullable',
            'end_time' => 'nullable',
            'fees' => 'nullable|numeric|min:0',
            'age_group' => 'nullable|string|max:100',
            'mode' => 'required|in:online,offline,both',
            'max_seats' => 'nullable|integer|min:1',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'redirect_link' => 'nullable|url|max:2048',
            'center_ids' => 'nullable|array',
            'center_ids.*' => 'exists:centers,id',
        ]);

        $subEvent = SubEvent::findOrFail($id);
        $bannerPath = $subEvent->banner_image; // keep existing by default

        // Handle banner image upload
        if ($request->hasFile('banner_image')) {
            $this->deleteBannerImage($bannerPath);
            $bannerPath = $this->storeBannerImage($request);
        }

        $subEvent->update([
            'title' => $request->title,
            'description' => $request->description,
            'event_date' => $request->event_date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'fees' => $request->fees ?? 0,
            'age_group' => $request->age_group,
            'mode' => $request->mode,
            'max_seats' => $request->max_seats,
            'banner_image' => $bannerPath,
            'redirect_link' => $request->redirect_link,
        ]);

        $subEvent->centers()->sync($request->center_ids ?? []);

        return redirect()->route('sub-events-index', $subEvent->event_id)
            ->with('success', 'Sub event updated successfully');
    }

    public function status(Request $request)
    {
        $subEvent = SubEvent::findOrFail($request->id);
        $subEvent->update(['status' => $request->status]);
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $subEvent = SubEvent::findOrFail($id);
        $eventId = $subEvent->event_id;

        // Delete banner image if exists
        $this->deleteBannerImage($subEvent->banner_image);

        $subEvent->centers()->detach();
        $subEvent->delete();

        return redirect()->route('sub-events-index', $eventId)
            ->with('success', 'Sub event deleted successfully');
    }

    public function index($event_id)
    {
        $event = Event::findOrFail($event_id);
        $subEvents = SubEvent::where('event_id', $event_id)->get();
        return view('backend.sub_events.show', compact('event', 'subEvents'));
    }

    private function storeBannerImage(Request $request): ?string
    {
        if (!$request->hasFile('banner_image')) {
            return null;
        }

        $filename = time() . '.' . $request->banner_image->extension();
        return $request->file('banner_image')->storeAs('event_banners', $filename, 'public');
    }

    private function deleteBannerImage(?string $path): void
    {
        if (!$path) {
            return;
        }

        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
            return;
        }

        $legacyPath = public_path($path);
        if (file_exists($legacyPath)) {
            unlink($legacyPath);
            return;
        }

        if (str_starts_with($path, 'public/')) {
            $legacyPublicPath = public_path(substr($path, 7));
            if (file_exists($legacyPublicPath)) {
                unlink($legacyPublicPath);
            }
        }
    }
}
