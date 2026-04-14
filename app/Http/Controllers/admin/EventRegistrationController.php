<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Center;
use App\Models\Event;
use App\Models\EventRegistration;
use App\Models\EventRegistrationAttendee;
use App\Models\Payment;
use App\Models\SubEvent;
use App\Services\EmailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Razorpay\Api\Api;

class EventRegistrationController extends Controller
{
    // ── SHOW ──────────────────────────────────────────────────────────────────
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

        // Clamp primaryIdx to valid range
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

        // Seat check with DB lock to prevent race conditions
        if ($sub->max_seats) {
            $booked = EventRegistration::where('sub_event_id', $sub->id)
                ->whereIn('status', ['pending', 'confirmed'])
                ->lockForUpdate()
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

        session(['pending_registration_id' => $registration->id]);

        if ($request->wantsJson()) {
            return response()->json(['success' => true, 'registration_id' => $registration->id]);
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
        return view('backend.registrations.registrations-index', compact('registrations', 'events'));
    }

    // ── ADMIN SHOW ────────────────────────────────────────────────────────────
    public function adminShow($id)
    {
        $registration = EventRegistration::with(['event', 'subEvent', 'attendees', 'center.state'])->findOrFail($id);

        return view('backend.registrations.show', compact('registration'));
    }

    // ── ADMIN UPDATE STATUS ───────────────────────────────────────────────────
    public function adminUpdateStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required|in:pending,confirmed,cancelled']);
        EventRegistration::findOrFail($id)->update(['status' => $request->status]);

        return response()->json(['success' => true, 'status' => $request->status]);
    }

    // ── CREATE RAZORPAY ORDER ─────────────────────────────────────────────────
    public function createOrder(Request $request, $sub_event_id)
    {
        $request->validate(['tickets' => 'required|integer|min:1|max:10']);

        $tickets = (int) $request->tickets;
        $sub = SubEvent::findOrFail($sub_event_id);

        if ($sub->fees == 0) {
            return response()->json(['error' => 'This event is free.'], 400);
        }

        if ($sub->max_seats) {
            $booked = EventRegistration::where('sub_event_id', $sub->id)
                ->whereIn('status', ['pending', 'confirmed'])
                ->sum('tickets');

            $avail = $sub->max_seats - $booked;
            if ($tickets > $avail) {
                return response()->json(['error' => 'Only ' . max(0, $avail) . ' seat(s) remaining.'], 422);
            }
        }

        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));
        $order = $api->order->create([
            'receipt' => 'EVT_' . $sub->id . '_' . uniqid(),
            'amount' => (int) round($sub->fees * $tickets * 100),
            'currency' => 'INR',
            'notes' => ['sub_event_id' => $sub->id, 'tickets' => $tickets],
        ]);

        session([
            'rzp_order_id' => $order->id,
            'rzp_sub_event_id' => $sub->id,
            'rzp_tickets' => $tickets,
            'rzp_amount' => $order->amount,
        ]);

        return response()->json([
            'order_id' => $order->id,
            'amount' => $order->amount,
            'currency' => $order->currency,
            'sub_name' => $sub->title,
        ]);
    }

    // ── VERIFY PAYMENT ────────────────────────────────────────────────────────
    public function verifyPayment(Request $request, $registration_id)
    {
        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

        // 1. Verify Razorpay signature — throws SignatureVerificationError on mismatch
        $api->utility->verifyPaymentSignature([
            'razorpay_order_id' => $request->razorpay_order_id,
            'razorpay_payment_id' => $request->razorpay_payment_id,
            'razorpay_signature' => $request->razorpay_signature,
        ]);

        // 2. Prevent duplicate payment processing
        if (Payment::where('razorpay_payment_id', $request->razorpay_payment_id)->exists()) {
            return response()->json(['success' => true, 'message' => 'Payment already processed']);
        }

        // 3. Fetch payment method details from Razorpay
        $rzpPayment = $api->payment->fetch($request->razorpay_payment_id);

        // 4. Load registration with all relationships needed for email
        $registration = EventRegistration::with(['event', 'subEvent', 'attendees', 'center.state'])->findOrFail($registration_id);

        // 5. DB transaction: confirm registration & record payment
        DB::transaction(function () use ($request, $registration_id, $rzpPayment, $registration) {
            if ($registration->status !== 'confirmed') {
                $registration->update(['status' => 'confirmed']);
            }

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

        // 6. Refresh so updated status is reflected
        $registration->refresh();

        // 7. Resolve primary attendee
        $primaryAttendee = $registration->attendees->firstWhere('is_primary', true) ?? $registration->attendees->first();

        $toEmail = $primaryAttendee?->email ?? ($rzpPayment->email ?? null);

        // 8. Resolve sub-event fields
        $subEvent = $registration->subEvent;
        $eventDate = $subEvent->event_date
            ? $subEvent->event_date->format('d M Y, D') // Carbon cast — no parse() needed
            : '';

        // 9. Build dynamic attendee cards HTML
        //    One card per actual ticket — primary card gets purple styling + extra fields,
        //    all other cards get indigo styling + name & phone only.
        $sortedAttendees = $registration->attendees->sortBy('ticket_number')->values();
        $attendeeCardsHtml = '';

        foreach ($sortedAttendees as $att) {
            $isPrimary = (bool) $att->is_primary;
            $ticketNum = $att->ticket_number;

            // Card border/background differ for primary vs regular
            $cardStyle = $isPrimary ? 'border:1px solid #c7d2fe;border-radius:8px;background:#f5f3ff;margin-bottom:12px;' : 'border:1px solid #e5e7eb;border-radius:8px;background:#ffffff;margin-bottom:12px;';

            $badgeBg = $isPrimary ? '#7c3aed' : '#4f46e5';

            $primaryTag = $isPrimary ? ' <span style="display:inline-block;background:#7c3aed;color:#fff;font-size:10px;font-weight:600;padding:2px 8px;border-radius:20px;letter-spacing:0.4px;text-transform:uppercase;margin-left:8px;vertical-align:middle;">Primary Contact</span>' : '';

            // Meta line — always show phone; show extra fields only for primary
            $metaParts = [];

            if (!empty($att->phone)) {
                $metaParts[] = '📞 ' . htmlspecialchars($att->phone);
            }

            if ($isPrimary) {
                if (!empty($att->email)) {
                    $metaParts[] = '✉️ ' . htmlspecialchars($att->email);
                }
                if (!empty($att->gender)) {
                    $metaParts[] = '👤 ' . ucfirst(str_replace('_', ' ', $att->gender));
                }
                if (!empty($att->dob)) {
                    $metaParts[] = '🎂 ' . \Carbon\Carbon::parse($att->dob)->format('d M Y');
                }
                if (!empty($att->institution)) {
                    $metaParts[] = '🏫 ' . htmlspecialchars($att->institution);
                }
            }

            $metaHtml = !empty($metaParts) ? '<p style="margin:0;font-size:13px;color:#6b7280;line-height:2;">' . implode('&nbsp;&nbsp; ', $metaParts) . '</p>' : '';

            $attendeeCardsHtml .=
                '
            <table width="100%" cellpadding="0" cellspacing="0" border="0" style="' .
                $cardStyle .
                '">
              <tr>
                <td style="padding:0;">
                  <span style="display:inline-block;background:' .
                $badgeBg .
                ';color:#fff;font-size:11px;font-weight:700;padding:3px 10px;border-radius:7px 0 6px 0;letter-spacing:0.3px;">Ticket #' .
                $ticketNum .
                '</span>
                </td>
              </tr>
              <tr>
                <td style="padding:4px 16px 14px;">
                  <p style="margin:8px 0 8px;font-size:15px;font-weight:700;color:#111827;">' .
                htmlspecialchars($att->name) .
                $primaryTag .
                '</p>
                  ' .
                $metaHtml .
                '
                </td>
              </tr>
            </table>';
        }

        // 10. Build all [key] => value replacements
        //     The EmailService must do:  str_replace('[key]', $value, $templateHtml)
        $placeholders = [
            'primary_name' => $primaryAttendee?->name ?? 'Guest',
            'registration_id' => $registration->id,
            'event_name' => $registration->event->title ?? 'Event',
            'sub_event_name' => $subEvent->title ?? 'Session',
            'event_date' => $eventDate,
            'event_time' => $subEvent->time_range ?? '', // getTimeRangeAttribute accessor
            'event_mode' => ucfirst($subEvent->mode ?? ''),
            'venue' => $subEvent->venue ?? '',
            'city' => $registration->city ?? '',
            'state' => $registration->state ?? '',
            'ticket_count' => $registration->tickets,
            'amount_paid' => '₹' . number_format($registration->total_amount, 2),
            'payment_id' => $request->razorpay_payment_id,
            'attendee_cards' => $attendeeCardsHtml, // raw HTML block — replaces [attendee_cards]
        ];

        // 11. Send confirmation email
        if ($toEmail) {
            try {
                app(EmailService::class)->send(
                    'event-registration-confirmation', // your CKEditor template key/slug
                    $toEmail,
                    $placeholders,
                    $primaryAttendee?->name ?? 'Guest', // $name param for EmailService
                );
            } catch (\Exception $e) {
                // Email failure must NOT affect the confirmed payment
                Log::error('Event registration confirmation email failed', [
                    'registration_id' => $registration_id,
                    'to_email' => $toEmail,
                    'error' => $e->getMessage(),
                ]);
            }
        }

        return response()->json(['success' => true, 'message' => 'Payment successful']);
    }
}
