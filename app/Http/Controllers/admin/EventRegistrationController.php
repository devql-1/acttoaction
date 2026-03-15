<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\SubEvent;
use App\Models\EventRegistration;
use Illuminate\Http\Request;

class EventRegistrationController extends Controller
{
    /**
     * Show the registration form for an event.
     * Route: GET /events/{event_id}/register
     */
    public function show($event_id)
    {
        $event = Event::with([
            'subEvents' => function ($q) {
                $q->where('status', 1)->with('centersWithState');
            },
        ])->findOrFail($event_id);

        $states = \App\Models\State::where('status', 1)->orderBy('name')->get();

        return view('frontend.events.register', compact('event', 'states'));
    }

    /**
     * AJAX: Get sub-event details (seats taken, fee, etc.)
     * Route: GET /events/sub-event/{sub_event_id}/details
     */
    public function subEventDetails($sub_event_id)
    {
        $sub = SubEvent::with('centersWithState')->findOrFail($sub_event_id);

        $booked = EventRegistration::where('sub_event_id', $sub->id)
            ->whereIn('status', ['pending', 'confirmed'])
            ->sum('max_seats');

        $available = $sub->max_seats ? max(0, $sub->max_seats - $booked) : null;

        return response()->json([
            'id' => $sub->id,
            'title' => $sub->title,
            'event_date' => \Carbon\Carbon::parse($sub->event_date)->format('M j, Y'),
            'time_range' => $sub->time_range ?? '--',
            'fees' => (float) $sub->fees,
            'is_free' => $sub->fees == 0,
            'mode' => $sub->mode,
            'age_group' => $sub->age_group,
            'max_seats' => $sub->max_seats,
            'booked' => (int) $booked,
            'available' => $available,
            'description' => strip_tags($sub->description ?? ''),
        ]);
    }

    /**
     * Store the registration.
     * Route: POST /events/{event_id}/register
     */
    public function store(Request $request, $event_id)
    {
        $event = Event::findOrFail($event_id);

        $request->validate([
            'name' => 'required|string|min:2|max:100',
            'phone' => 'required|digits_between:10,13',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'sub_event_id' => 'required|exists:sub_events,id',
            'tickets' => 'required|integer|min:1|max:10',
        ]);

        $sub = SubEvent::findOrFail($request->sub_event_id);

        // Seat availability check
        if ($sub->max_seats) {
            $booked = EventRegistration::where('sub_event_id', $sub->id)
                ->whereIn('status', ['pending', 'confirmed'])
                ->sum('tickets');
            if ($booked + $request->tickets > $sub->max_seats) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'tickets' => 'Not enough seats available. Only ' . max(0, $sub->max_seats - $booked) . ' seat(s) left.',
                    ]);
            }
        }

        $total = (float) $sub->fees * (int) $request->tickets;

        $registration = EventRegistration::create([
            'event_id' => $event->id,
            'sub_event_id' => $sub->id,
            'name' => $request->name,
            'phone' => $request->phone,
            'city' => $request->city,
            'state' => $request->state,
            'tickets' => $request->tickets,
            'total_amount' => $total,
            'status' => 'pending',
        ]);

        return redirect()->route('frontend.events.register.success', $registration->id);
    }

    /**
     * Registration success page.
     * Route: GET /events/register/success/{id}
     */
    public function success($id)
    {
        $registration = EventRegistration::with(['event', 'subEvent'])->findOrFail($id);
        return view('frontend.events.register-success', compact('registration'));
    }

    // ─── Admin: List all registrations ───────────────────────────────────────

    public function adminIndex(Request $request)
    {
        $query = EventRegistration::with(['event', 'subEvent'])->latest();

        if ($request->filled('event_id')) {
            $query->where('event_id', $request->event_id);
        }
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('phone', 'like', '%' . $request->search . '%')
                    ->orWhere('registration_number', 'like', '%' . $request->search . '%');
            });
        }

        $registrations = $query->paginate(20);
        $events = Event::orderBy('title')->get();

        return view('backend.registrations.index', compact('registrations', 'events'));
    }

    public function adminShow($id)
    {
        $registration = EventRegistration::with(['event', 'subEvent'])->findOrFail($id);
        return view('backend.registrations.show', compact('registration'));
    }

    public function adminUpdateStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required|in:pending,confirmed,cancelled']);
        $registration = EventRegistration::findOrFail($id);
        $registration->update(['status' => $request->status]);
        return response()->json(['success' => true, 'status' => $request->status]);
    }
}
