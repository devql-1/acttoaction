<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\EventRegistration;
use App\Models\Payment;
use App\Models\WorkshopRegistration;
use App\Services\EmailService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Razorpay server-to-server webhooks.
 *
 * Purpose: recover payments where the browser callback never fires
 * (user closed the tab, network glitch, etc.). Razorpay retries this
 * endpoint until it receives 2xx, so every response we give must be
 * either "accepted" (2xx) or "reject and retry" (non-2xx). We return
 * 200 for every case we have deliberately handled — including "already
 * processed" and "ignored" — so Razorpay stops retrying.
 *
 * Signature verification uses the raw request body and the webhook
 * secret from config('services.razorpay.webhook_secret').
 *
 * This endpoint MUST be excluded from CSRF (see bootstrap/app.php).
 */
class RazorpayWebhookController extends Controller
{
    /**
     * Events we act on. Every other event returns 200 "ignored" so
     * Razorpay stops retrying.
     */
    private const HANDLED_EVENTS = [
        'payment.captured',
        'payment.failed',
        'payment_link.paid',
    ];

    public function handle(Request $request): JsonResponse
    {
        $rawBody   = $request->getContent();
        $signature = (string) $request->header('X-Razorpay-Signature', '');
        $secret    = (string) config('services.razorpay.webhook_secret');

        if ($secret === '') {
            Log::error('Razorpay webhook received but webhook_secret is not configured');
            return response()->json(['message' => 'Webhook not configured'], 500);
        }

        // Verify HMAC — timing-safe compare.
        $expected = hash_hmac('sha256', $rawBody, $secret);
        if ($signature === '' || !hash_equals($expected, $signature)) {
            Log::warning('Razorpay webhook signature mismatch', [
                'ip' => $request->ip(),
            ]);
            // 401 — Razorpay will retry. That's fine: real misconfigurations
            // will stop retrying after a few hours, and real attacks will
            // continue failing forever without doing any damage.
            return response()->json(['message' => 'Invalid signature'], 401);
        }

        $payload = json_decode($rawBody, true);
        if (!is_array($payload) || !isset($payload['event'])) {
            Log::warning('Razorpay webhook malformed payload');
            return response()->json(['message' => 'Malformed payload'], 400);
        }

        $event = $payload['event'];

        if (!in_array($event, self::HANDLED_EVENTS, true)) {
            return response()->json(['message' => 'Ignored', 'event' => $event]);
        }

        try {
            return match ($event) {
                'payment.captured'   => $this->handlePaymentCaptured($payload),
                'payment.failed'     => $this->handlePaymentFailed($payload),
                'payment_link.paid'  => $this->handlePaymentLinkPaid($payload),
            };
        } catch (\Throwable $e) {
            // Log and return 500 so Razorpay retries. Never leak exception
            // details in the response body.
            Log::error('Razorpay webhook handler error', [
                'event' => $event,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return response()->json(['message' => 'Internal error'], 500);
        }
    }

    /**
     * Used for event_registration and workshop_registration flows
     * (both pre-create a Razorpay order with razorpay_order_id).
     */
    private function handlePaymentCaptured(array $payload): JsonResponse
    {
        $payment = $payload['payload']['payment']['entity'] ?? null;
        if (!is_array($payment) || empty($payment['id']) || empty($payment['order_id'])) {
            return response()->json(['message' => 'Missing payment or order id'], 400);
        }

        $paymentId = (string) $payment['id'];
        $orderId   = (string) $payment['order_id'];
        $amount    = (int) ($payment['amount'] ?? 0);

        // Fast path: already recorded by the sync verify handler.
        if (Payment::where('razorpay_payment_id', $paymentId)->exists()) {
            return response()->json(['message' => 'Already processed']);
        }

        // Try to resolve this to an event registration first.
        $eventReg = EventRegistration::where('razorpay_order_id', $orderId)->first();
        if ($eventReg) {
            return $this->confirmEventRegistration($eventReg, $payment, $amount, $paymentId);
        }

        // Then workshop. Workshops tie multiple registrations to one order.
        $workshopReg = WorkshopRegistration::where('razorpay_order_id', $orderId)->first();
        if ($workshopReg) {
            return $this->confirmWorkshopRegistrations($orderId, $payment, $amount, $paymentId);
        }

        // Enrollment (course) flow uses Payment Links, not pre-created orders,
        // so a raw payment.captured with no matching registration is expected —
        // the payment_link.paid event will pick it up instead.
        Log::info('Razorpay payment.captured with no matching registration', [
            'payment_id' => $paymentId,
            'order_id'   => $orderId,
        ]);
        return response()->json(['message' => 'No matching registration — deferring to payment_link.paid']);
    }

    /**
     * Records a failed payment for the audit trail. Does NOT change
     * enrollment/registration status — those remain pending so the
     * user can retry.
     */
    private function handlePaymentFailed(array $payload): JsonResponse
    {
        $payment = $payload['payload']['payment']['entity'] ?? null;
        if (!is_array($payment) || empty($payment['id'])) {
            return response()->json(['message' => 'Missing payment id'], 400);
        }

        $paymentId = (string) $payment['id'];

        if (Payment::where('razorpay_payment_id', $paymentId)->exists()) {
            return response()->json(['message' => 'Already recorded']);
        }

        // Resolve type from order id if possible.
        $orderId = $payment['order_id'] ?? null;
        $type = 'other';
        $enrollmentId = null;

        if ($orderId) {
            if (EventRegistration::where('razorpay_order_id', $orderId)->exists()) {
                $type = 'event_registration';
            } elseif (WorkshopRegistration::where('razorpay_order_id', $orderId)->exists()) {
                $type = 'workshop_registration';
            }
        }

        Payment::insert([
            'enrollment_id'       => $enrollmentId,
            'razorpay_order_id'   => $orderId,
            'razorpay_payment_id' => $paymentId,
            'amount'              => ((int) ($payment['amount'] ?? 0)) / 100,
            'currency'            => $payment['currency'] ?? 'INR',
            'status'              => 'failed',
            'transaction_type'    => $payment['method'] ?? null,
            'type'                => $type,
            'email'               => $payment['email'] ?? null,
            'contact'             => $payment['contact'] ?? null,
            'error_code'          => $payment['error_code'] ?? 'WEBHOOK_FAILED',
            'error_reason'        => $payment['error_description'] ?? null,
            'created_at'          => now(),
            'updated_at'          => now(),
        ]);

        return response()->json(['message' => 'Failure recorded']);
    }

    /**
     * Course enrollment flow — Payment Links. The link carries the
     * enrollment reference_id so we can resolve which enrollment to
     * confirm without relying on any session state.
     */
    private function handlePaymentLinkPaid(array $payload): JsonResponse
    {
        $link    = $payload['payload']['payment_link']['entity'] ?? null;
        $payment = $payload['payload']['payment']['entity']      ?? null;

        if (!is_array($link) || !is_array($payment)) {
            return response()->json(['message' => 'Missing link or payment entity'], 400);
        }
        if (empty($payment['id']) || empty($link['reference_id'])) {
            return response()->json(['message' => 'Missing payment id or reference_id'], 400);
        }

        $paymentId   = (string) $payment['id'];
        $referenceId = (string) $link['reference_id'];
        $receivedPaise = (int) ($payment['amount'] ?? 0);

        if (Payment::where('razorpay_payment_id', $paymentId)->exists()) {
            return response()->json(['message' => 'Already processed']);
        }

        $enrollment = Enrollment::where('reference_id', $referenceId)->first();
        if (!$enrollment) {
            Log::warning('payment_link.paid with unknown reference_id', [
                'reference_id' => $referenceId,
                'payment_id'   => $paymentId,
            ]);
            // 200 so Razorpay stops retrying — nothing we can do.
            return response()->json(['message' => 'Enrollment not found']);
        }

        $expectedPaise = (int) round(((float) $enrollment->fee) * 100);
        if ($receivedPaise !== $expectedPaise) {
            Log::error('payment_link.paid amount mismatch', [
                'enrollment_id' => $enrollment->id,
                'expected'      => $expectedPaise,
                'received'      => $receivedPaise,
            ]);
            return response()->json(['message' => 'Amount mismatch'], 422);
        }

        DB::transaction(function () use ($enrollment, $payment, $paymentId) {
            $locked = Enrollment::lockForUpdate()->find($enrollment->id);
            if (!$locked) {
                return;
            }

            if (Payment::where('razorpay_payment_id', $paymentId)->exists()) {
                return;
            }

            if ($locked->status !== 'confirmed') {
                $locked->update(['status' => 'confirmed']);
            }

            $row                      = new Payment();
            $row->enrollment_id       = $locked->id;
            $row->razorpay_order_id   = $payment['order_id'] ?? null;
            $row->razorpay_payment_id = $paymentId;
            $row->amount              = ((int) ($payment['amount'] ?? 0)) / 100;
            $row->currency            = $payment['currency'] ?? 'INR';
            $row->status              = 'success';
            $row->transaction_type    = $payment['method'] ?? null;
            $row->type                = 'course_enrollment';
            $row->paid_at             = now();
            $row->contact             = $payment['contact'] ?? $locked->phone;
            $row->email               = $payment['email'] ?? $locked->email;
            $row->save();

            $this->sendEnrollmentEmail($locked, $paymentId);
        });

        return response()->json(['message' => 'Confirmed']);
    }

    private function confirmEventRegistration(
        EventRegistration $registration,
        array $payment,
        int $amountPaise,
        string $paymentId,
    ): JsonResponse {
        $expectedPaise = (int) round(((float) $registration->total_amount) * 100);
        if ($amountPaise !== $expectedPaise) {
            Log::error('Webhook event amount mismatch', [
                'registration_id' => $registration->id,
                'expected'        => $expectedPaise,
                'received'        => $amountPaise,
            ]);
            return response()->json(['message' => 'Amount mismatch'], 422);
        }

        DB::transaction(function () use ($registration, $payment, $paymentId) {
            if (Payment::where('razorpay_payment_id', $paymentId)->lockForUpdate()->exists()) {
                return;
            }

            $locked = EventRegistration::lockForUpdate()->find($registration->id);
            if (!$locked) {
                return;
            }

            if ($locked->status !== 'confirmed') {
                $locked->update(['status' => 'confirmed']);
            }

            $row                      = new Payment();
            $row->enrollment_id       = null;
            $row->razorpay_order_id   = $payment['order_id'] ?? null;
            $row->razorpay_payment_id = $paymentId;
            $row->amount              = ((int) ($payment['amount'] ?? 0)) / 100;
            $row->currency            = $payment['currency'] ?? 'INR';
            $row->status              = 'success';
            $row->transaction_type    = $payment['method'] ?? null;
            $row->type                = 'event_registration';
            $row->paid_at             = now();
            $row->contact             = $payment['contact'] ?? null;
            $row->email               = $payment['email'] ?? null;
            $row->save();
        });

        return response()->json(['message' => 'Confirmed']);
    }

    private function confirmWorkshopRegistrations(
        string $orderId,
        array $payment,
        int $amountPaise,
        string $paymentId,
    ): JsonResponse {
        $registrations = WorkshopRegistration::where('razorpay_order_id', $orderId)->get();
        if ($registrations->isEmpty()) {
            return response()->json(['message' => 'No workshop registrations for order']);
        }

        $expectedPaise = (int) round(((float) $registrations->sum('amount')) * 100);
        if ($amountPaise !== $expectedPaise) {
            Log::error('Webhook workshop amount mismatch', [
                'order_id' => $orderId,
                'expected' => $expectedPaise,
                'received' => $amountPaise,
            ]);
            return response()->json(['message' => 'Amount mismatch'], 422);
        }

        DB::transaction(function () use ($orderId, $payment, $paymentId) {
            if (Payment::where('razorpay_payment_id', $paymentId)->lockForUpdate()->exists()) {
                return;
            }

            $pending = WorkshopRegistration::where('razorpay_order_id', $orderId)
                ->where('status', 'pending')
                ->lockForUpdate()
                ->get();

            if ($pending->isEmpty()) {
                return;
            }

            WorkshopRegistration::where('razorpay_order_id', $orderId)
                ->where('status', 'pending')
                ->update([
                    'status'              => 'confirmed',
                    'razorpay_payment_id' => $paymentId,
                ]);

            $row                      = new Payment();
            $row->enrollment_id       = null;
            $row->razorpay_order_id   = $orderId;
            $row->razorpay_payment_id = $paymentId;
            $row->amount              = ((int) ($payment['amount'] ?? 0)) / 100;
            $row->currency            = $payment['currency'] ?? 'INR';
            $row->status              = 'success';
            $row->transaction_type    = $payment['method'] ?? null;
            $row->type                = 'workshop_registration';
            $row->paid_at             = now();
            $row->contact             = $payment['contact'] ?? null;
            $row->email               = $payment['email'] ?? null;
            $row->save();
        });

        return response()->json(['message' => 'Confirmed']);
    }

    private function sendEnrollmentEmail(Enrollment $enrollment, string $paymentId): void
    {
        try {
            app(EmailService::class)->send(
                'enrollment-confirmation',
                $enrollment->email,
                [
                    'student_name' => $enrollment->first_name . ' ' . $enrollment->last_name,
                    'course_name'  => $enrollment->course,
                    'centre'       => $enrollment->centre,
                    'reference_id' => $enrollment->reference_id,
                    'amount'       => '₹' . number_format($enrollment->fee),
                    'payment_id'   => $paymentId,
                ],
                $enrollment->first_name,
            );
        } catch (\Throwable $e) {
            Log::warning('Webhook enrollment confirmation email failed', [
                'enrollment_id' => $enrollment->id,
                'error'         => $e->getMessage(),
            ]);
        }
    }
}
