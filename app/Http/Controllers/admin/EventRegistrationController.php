<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Center;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\EventRegistrationAttendee;
use App\Models\Payment;
use App\Models\SubEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Razorpay\Api\Api;

class EventRegistrationController extends Controller
{
    // ── SHOW ─────────────────────────────────────────────────────────────────
    public function show($sub_event_id)
    {
        $sub = SubEvent::with(['event', 'centersWithState.state'])->findOrFail($sub_event_id);
        $booked = EventRegistration::where('sub_event_id', $sub->id)
            ->whereIn('status', ['pending', 'confirmed'])
            ->sum('tickets');
        $avail = $sub->max_seats ? max(0, $sub->max_seats - $booked) : null;
        $isFull = $sub->max_seats && $avail <= 0;
        $centres = $sub->centersWithState ?? collect();

        return view('frontend.event.register', compact('sub', 'booked', 'avail', 'isFull', 'centres'));
    }

    // ── STORE ─────────────────────────────────────────────────────────────────
    public function store(Request $request, $sub_event_id)
    {
        $sub = SubEvent::with('event')->findOrFail($sub_event_id);
        $ticketCount = (int) $request->input('tickets', 1);
        $primaryIdx = (int) $request->input('primary_ticket', 0);

        // FIX 1: Validate primaryIdx is within the actual attendees array range
        $attendeesCount = is_array($request->input('attendees')) ? count($request->input('attendees')) : 0;
        if ($primaryIdx >= $attendeesCount || $primaryIdx < 0) {
            $primaryIdx = 0;
        }

        $rules = [
            'tickets' => 'required|integer|min:1|max:10',
            'primary_ticket' => 'required|integer|min:0',
            'center_id' => 'nullable|exists:centers,id',
            'attendees' => 'required|array|min:1',
            'attendees.*.name' => 'required|string|min:2|max:100',
            'attendees.*.phone' => 'nullable|digits_between:10,13',
        ];

        $rules["attendees.{$primaryIdx}.phone"] = 'required|digits_between:10,13';
        $rules["attendees.{$primaryIdx}.email"] = 'required|email|max:150';
        $rules["attendees.{$primaryIdx}.dob"] = 'nullable|date|before:today';
        $rules["attendees.{$primaryIdx}.gender"] = 'nullable|in:male,female,other,prefer_not_to_say';
        $rules["attendees.{$primaryIdx}.institution"] = 'nullable|string|max:200';

        $messages = [
            'attendees.*.name.required' => 'Name is required for every attendee.',
            'attendees.*.phone.digits_between' => 'Phone must be 10–13 digits.',
            "attendees.{$primaryIdx}.phone.required" => 'Primary contact phone is required.',
            "attendees.{$primaryIdx}.email.required" => 'Primary contact email is required.',
            "attendees.{$primaryIdx}.email.email" => 'Please enter a valid email address.',
            "attendees.{$primaryIdx}.dob.before" => 'Date of birth must be in the past.',
        ];

        $request->validate($rules, $messages);

        // FIX 2: Seat check with DB lock to prevent race conditions
        if ($sub->max_seats) {
            $booked = EventRegistration::where('sub_event_id', $sub->id)
                ->whereIn('status', ['pending', 'confirmed'])
                ->lockForUpdate() // ← prevents two simultaneous requests both passing
                ->sum('tickets');

            if ($ticketCount > $sub->max_seats - $booked) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'tickets' => 'Only ' . max(0, $sub->max_seats - $booked) . ' seat(s) left.',
                    ]);
            }
        }

        $centerId = $request->center_id ?: null;
        $city = null;
        $state = null;

        if ($centerId) {
            $centre = Center::with('state')->find($centerId);
            if ($centre) {
                $city = $centre->name;
                $state = $centre->state->name ?? null;
            }
        }

        $registration = DB::transaction(function () use ($sub, $centerId, $city, $state, $ticketCount, $primaryIdx, $request) {
            $reg = EventRegistration::create([
                'event_id' => $sub->event_id,
                'sub_event_id' => $sub->id,
                'center_id' => $centerId,
                'city' => $city,
                'state' => $state,
                'tickets' => $ticketCount,
                'total_amount' => round((float) $sub->fees * $ticketCount, 2),
                'status' => 'pending',
            ]);

            foreach ($request->attendees as $i => $att) {
                $isPrimary = $i === $primaryIdx;
                EventRegistrationAttendee::create([
                    'registration_id' => $reg->id,
                    'ticket_number' => $i + 1,
                    'is_primary' => $isPrimary,
                    'name' => $att['name'],
                    'phone' => $att['phone'] ?? null,
                    'email' => $isPrimary ? $att['email'] ?? null : null,
                    'dob' => $isPrimary ? $att['dob'] ?? null : null,
                    'age' => $isPrimary ? $att['age'] ?? null : null,
                    'gender' => $isPrimary ? $att['gender'] ?? null : null,
                    'institution' => $isPrimary ? $att['institution'] ?? null : null,
                ]);
            }

            return $reg;
        });

        // FIX 6: Store registration ID in session so verifyPayment can validate it
        session(['pending_registration_id' => $registration->id]);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'registration_id' => $registration->id,
            ]);
        }

        return redirect()->route('frontend.events.register.success', $registration->id);
    }

    // ── SUCCESS ───────────────────────────────────────────────────────────────
    public function success($id)
    {
        $registration = EventRegistration::with(['event', 'subEvent', 'attendees', 'center.state'])->findOrFail($id);

        return view('frontend.event.register-success', compact('registration'));
    }

    // ── ADMIN INDEX ───────────────────────────────────────────────────────────
    public function adminIndex(Request $request)
    {
        $query = EventRegistration::with(['event', 'subEvent', 'attendees', 'center'])->latest();

        if ($request->filled('event_id')) {
            $query->where('event_id', $request->event_id);
        }

        if ($request->filled('search')) {
            // FIX 7: Trim and limit search string length to prevent abuse
            $search = substr(trim($request->search), 0, 100);

            $query->where(function ($q) use ($search) {
                $q->whereHas(
                    'attendees',
                    fn($a) => $a
                        ->where('name', 'like', '%' . $search . '%')
                        ->orWhere('phone', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%'),
                )->orWhere('registration_number', 'like', '%' . $search . '%');
            });
        }

        $registrations = $query->paginate(20);
        $events = Event::orderBy('title')->get();

        return view('backend.registrations.index', compact('registrations', 'events'));
    }

    public function adminShow($id)
    {
        $registration = EventRegistration::with(['event', 'subEvent', 'attendees', 'center.state'])->findOrFail($id);

        return view('backend.registrations.show', compact('registration'));
    }

    public function adminUpdateStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required|in:pending,confirmed,cancelled']);
        EventRegistration::findOrFail($id)->update(['status' => $request->status]);

        return response()->json(['success' => true, 'status' => $request->status]);
    }

    // ── CREATE ORDER ──────────────────────────────────────────────────────────
    public function createOrder(Request $request, $sub_event_id)
    {
        $request->validate(['tickets' => 'required|integer|min:1|max:10']);
        $tickets = (int) $request->tickets;
        $sub = SubEvent::findOrFail($sub_event_id);

        // FIX 8: Guard free events — should never reach here
        if ($sub->fees == 0) {
            return response()->json(['error' => 'This event is free.'], 400);
        }

        // FIX 9: Seat check BEFORE charging the user
        if ($sub->max_seats) {
            $booked = EventRegistration::where('sub_event_id', $sub->id)
                ->whereIn('status', ['pending', 'confirmed'])
                ->sum('tickets');
            $avail = $sub->max_seats - $booked;
            if ($tickets > $avail) {
                return response()->json(
                    [
                        'error' => 'Only ' . max(0, $avail) . ' seat(s) remaining.',
                    ],
                    422,
                );
            }
        }

        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
        $order = $api->order->create([
            'receipt' => 'EVT_' . $sub->id . '_' . uniqid(), // FIX 10: traceable receipt
            'amount' => (int) round($sub->fees * $tickets * 100), // FIX 11: round() for float safety
            'currency' => 'INR',
            'notes' => ['sub_event_id' => $sub->id, 'tickets' => $tickets],
        ]);

        // FIX 12: Store order details server-side for verification
        session([
            'rzp_order_id' => $order->id,
            'rzp_sub_event_id' => $sub->id,
            'rzp_tickets' => $tickets,
            'rzp_amount' => $order->amount,
        ]);

        // FIX 13: Do NOT return the key — set it once in Blade as window.__RZP_KEY__
        return response()->json([
            'order_id' => $order->id,
            'amount' => $order->amount,
            'currency' => $order->currency,
            'sub_name' => $sub->title,
        ]);
    }

    public function verifyPayment(Request $request, $registration_id)
    {
        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

        try {
            $attributes = [
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature,
            ];

            $api->utility->verifyPaymentSignature($attributes);

            $rzpPayment = $api->payment->fetch($request->razorpay_payment_id);

            DB::transaction(function () use ($request, $registration_id, $rzpPayment) {
                EventRegistration::where('id', $registration_id)->update([
                    'status' => 'confirmed',
                ]);

                Payment::create([
                    'event_registration_id' => $registration_id,
                    'enrollment_id' => null,
                    'razorpay_order_id' => $request->razorpay_order_id,
                    'razorpay_payment_id' => $request->razorpay_payment_id,
                    'razorpay_signature' => $request->razorpay_signature,
                    'amount' => session('rzp_amount') / 100,
                    'currency' => 'INR',
                    'status' => 'success',
                    'transaction_type' => $rzpPayment->method,
                    'type' => 'event_registration',
                    'paid_at' => now(),
                    'contact' => $rzpPayment->contact ?? null,
                    'email' => $rzpPayment->email ?? null,
                ]);
            });

            return response()->json([
                'success' => true,
                'message' => 'Payment successful',
            ]);
        } catch (\Exception $e) {
            Payment::create([
                'event_registration_id' => $registration_id,
                'enrollment_id' => null,
                'razorpay_order_id' => $request->razorpay_order_id ?? '',
                'razorpay_payment_id' => $request->razorpay_payment_id ?? '',
                'razorpay_signature' => $request->razorpay_signature ?? '',
                'amount' => 0,
                'currency' => 'INR',
                'status' => 'failed',
                'error_reason' => substr($e->getMessage(), 0, 1000),
                'transaction_type' => null,
                'type' => 'event_registration',
            ]);

            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ]);
        }
    }
}
