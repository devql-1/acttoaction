<?php

namespace App\Http\Controllers\admin\Summercamp;

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

class SummerEventRegistrationController extends Controller
{
    // ── SHOW ─────────────────────────────────────────────
    public function show($sub_event_id)
    {
        $sub = SubEvent::with(['event', 'centersWithState.state'])->findOrFail($sub_event_id);

        // 🔥 Ensure only summer-event
        if ($sub->event->type !== 'summer-event') {
            abort(404);
        }

        $booked = EventRegistration::where('sub_event_id', $sub->id)
            ->whereIn('status', ['pending', 'confirmed'])
            ->sum('tickets');

        $avail = $sub->max_seats ? max(0, $sub->max_seats - $booked) : null;
        $isFull = $sub->max_seats && $avail <= 0;

        return view('frontend.event.register', [
            'sub' => $sub,
            'booked' => $booked,
            'avail' => $avail,
            'isFull' => $isFull,
            'centres' => $sub->centersWithState ?? collect(),
        ]);
    }

    // ── STORE ────────────────────────────────────────────
    public function store(Request $request, $sub_event_id)
    {
        $sub = SubEvent::with('event')->findOrFail($sub_event_id);

        // 🔥 Ensure only summer-event
        if ($sub->event->type !== 'summer-event') {
            abort(404);
        }

        $ticketCount = (int) $request->input('tickets', 1);
        $primaryIdx = (int) $request->input('primary_ticket', 0);

        $attendees = $request->input('attendees', []);
        $primaryIdx = $primaryIdx >= 0 && $primaryIdx < count($attendees) ? $primaryIdx : 0;

        $request->validate([
            'tickets' => 'required|integer|min:1|max:10',
            'primary_ticket' => 'required|integer|min:0',
            'center_id' => 'nullable|exists:centers,id',
            'attendees' => 'required|array|min:1',
            'attendees.*.name' => 'required|string|min:2|max:100',
            'attendees.*.phone' => 'nullable|digits_between:10,13',
            "attendees.$primaryIdx.phone" => 'required|digits_between:10,13',
            "attendees.$primaryIdx.email" => 'required|email|max:150',
        ]);

        // Seat check
        if ($sub->max_seats) {
            $booked = EventRegistration::where('sub_event_id', $sub->id)
                ->whereIn('status', ['pending', 'confirmed'])
                ->lockForUpdate()
                ->sum('tickets');

            if ($ticketCount > $sub->max_seats - $booked) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'tickets' => 'Only ' . max(0, $sub->max_seats - $booked) . ' seats left.',
                    ]);
            }
        }

        // Center data
        $centerId = $request->center_id;
        $city = null;
        $state = null;

        if ($centerId) {
            $center = Center::with('state')->find($centerId);
            if ($center) {
                $city = $center->name;
                $state = $center->state->name ?? null;
            }
        }

        $registration = DB::transaction(function () use ($sub, $ticketCount, $primaryIdx, $attendees, $centerId, $city, $state) {
            $reg = EventRegistration::create([
                'event_id' => $sub->event_id,
                'sub_event_id' => $sub->id,
                'center_id' => $centerId,
                'city' => $city,
                'state' => $state,
                'tickets' => $ticketCount,
                'total_amount' => round($sub->fees * $ticketCount, 2),
                'status' => 'pending',
            ]);

            foreach ($attendees as $i => $att) {
                $isPrimary = $i === $primaryIdx;

                EventRegistrationAttendee::create([
                    'registration_id' => $reg->id,
                    'ticket_number' => $i + 1,
                    'is_primary' => $isPrimary,
                    'name' => $att['name'],
                    'phone' => $att['phone'] ?? null,
                    'email' => $isPrimary ? $att['email'] ?? null : null,
                ]);
            }

            return $reg;
        });

        session(['pending_registration_id' => $registration->id]);

        return redirect()->route('frontend.events.register.success', $registration->id);
    }

    // ── SUCCESS ──────────────────────────────────────────
    public function success($id)
    {
        $registration = EventRegistration::with(['event', 'subEvent', 'attendees', 'center.state'])->findOrFail($id);

        return view('frontend.event.register-success', compact('registration'));
    }

    // ── ADMIN INDEX (ONLY SUMMER EVENTS) ──────────────────
    public function adminIndex(Request $request)
    {
        $query = EventRegistration::with(['event', 'subEvent', 'attendees', 'center'])
            ->whereHas('event', function ($q) {
                $q->where('type', 'summer-event'); // 🔥 filter
            })
            ->latest();

        if ($request->filled('event_id')) {
            $query->where('event_id', $request->event_id);
        }

        if ($request->filled('search')) {
            $search = substr(trim($request->search), 0, 100);

            $query->where(function ($q) use ($search) {
                $q->whereHas('attendees', function ($a) use ($search) {
                    $a->where('name', 'like', "%$search%")
                        ->orWhere('phone', 'like', "%$search%")
                        ->orWhere('email', 'like', "%$search%");
                })->orWhere('registration_number', 'like', "%$search%");
            });
        }

        return view('backend.registrations.index', [
            'registrations' => $query->paginate(20),
            'events' => Event::where('type', 'summer-event')->orderBy('title')->get(),
        ]);
    }

    // ── CREATE ORDER ─────────────────────────────────────
    public function createOrder(Request $request, $sub_event_id)
    {
        $request->validate(['tickets' => 'required|integer|min:1|max:10']);

        $sub = SubEvent::with('event')->findOrFail($sub_event_id);

        // 🔥 Ensure only summer-event
        if ($sub->event->type !== 'summer-event') {
            abort(404);
        }

        if ($sub->fees == 0) {
            return response()->json(['error' => 'Free event'], 400);
        }

        $tickets = (int) $request->tickets;

        if ($sub->max_seats) {
            $booked = EventRegistration::where('sub_event_id', $sub->id)
                ->whereIn('status', ['pending', 'confirmed'])
                ->sum('tickets');

            if ($tickets > $sub->max_seats - $booked) {
                return response()->json(['error' => 'Seats not available'], 422);
            }
        }

        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

        $order = $api->order->create([
            'receipt' => 'EVT_' . $sub->id . '_' . uniqid(),
            'amount' => (int) round($sub->fees * $tickets * 100),
            'currency' => 'INR',
        ]);

        session([
            'rzp_order_id' => $order->id,
            'rzp_amount' => $order->amount,
        ]);

        return response()->json([
            'order_id' => $order->id,
            'amount' => $order->amount,
        ]);
    }

    // ── VERIFY PAYMENT ───────────────────────────────────
    public function verifyPayment(Request $request, $registration_id)
    {
        $request->validate([
            'razorpay_order_id' => 'required',
            'razorpay_payment_id' => 'required',
            'razorpay_signature' => 'required',
        ]);

        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

        $api->utility->verifyPaymentSignature([
            'razorpay_order_id' => $request->razorpay_order_id,
            'razorpay_payment_id' => $request->razorpay_payment_id,
            'razorpay_signature' => $request->razorpay_signature,
        ]);

        $payment = $api->payment->fetch($request->razorpay_payment_id);

        $registration = EventRegistration::with('event')->findOrFail($registration_id);

        $paymentType = $registration->event->type === 'summer-event' ? 'summer_event_registration' : 'event_registration';

        DB::transaction(function () use ($request, $registration_id, $payment, $paymentType) {
            EventRegistration::where('id', $registration_id)->update(['status' => 'confirmed']);

            Payment::create([
                'event_registration_id' => $registration_id,
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature,
                'amount' => session('rzp_amount') / 100,
                'currency' => 'INR',
                'status' => 'success',
                'transaction_type' => $payment->method,
                'type' => $paymentType,
                'paid_at' => now(),
            ]);
        });

        return response()->json([
            'success' => true,
            'message' => 'Payment successful',
        ]);
    }
}
