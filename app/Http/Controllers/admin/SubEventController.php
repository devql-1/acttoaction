<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubEvent;
use App\Models\Event;
use App\Models\State;

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
            'center_ids' => 'nullable|array',
            'center_ids.*' => 'exists:centers,id',
        ]);

        // Create sub event linked to parent event
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
            'status' => 1,
        ]);

        // Attach selected centers
        if ($request->filled('center_ids')) {
            $subEvent->centers()->sync($request->center_ids);
        }

        return redirect()->route('events-show', $event->id)
            ->with('success', 'Sub event added successfully');
    }

    public function edit($id)
    {
        $subEvent = SubEvent::with(['event', 'centers.state'])->findOrFail($id);
        $states = State::where('status', 1)->get();

        // Selected center IDs
        $selectedCenters = $subEvent->centers->pluck('id')->toArray();

        // Group existing centers by state_id so edit blade can pre-render rows
        // Format: { state_id: [center, center, ...] }
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
            'center_ids' => 'nullable|array',
            'center_ids.*' => 'exists:centers,id',
        ]);

        $subEvent = SubEvent::findOrFail($id);

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
        ]);

        // Sync centers (adds new, removes unchecked)
        $subEvent->centers()->sync($request->center_ids ?? []);

        return redirect()->route('events-index', $subEvent->event_id)
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

        $subEvent->centers()->detach(); // remove pivot records
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
}