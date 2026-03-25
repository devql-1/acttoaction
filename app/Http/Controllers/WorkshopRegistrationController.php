<?php

namespace App\Http\Controllers;

use App\Models\WorkshopRegistration;
use App\Models\WorkshopSchool;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Razorpay\Api\Api;

class WorkshopRegistrationController extends Controller
{
    public function register(Request $request, WorkshopSchool $school): JsonResponse
    {
        abort_if(!$school->status, 404);

        // Validate parent fields + array of children
        $data = $request->validate([
            'parent_name' => 'required|string|max:120',
            'email' => 'required|email|max:150',
            'phone' => 'required|string|max:20',
            'whatsapp' => 'nullable|string|max:20',

            // Children array — at least 1 required
            'children' => 'required|array|min:1|max:5',
            'children.*.student_name' => 'required|string|max:120',
            'children.*.dob' => 'nullable|date|before:today',
            'children.*.school_name' => 'nullable|string|max:150',
            'children.*.experience' => 'nullable|in:none,beginner,intermediate,advanced',

            'message' => 'nullable|string|max:1000',
        ]);

        $amount = (float) $school->fees;
        $childCount = count($data['children']);
        $totalAmount = $amount * $childCount;

        try {
            // Create one registration row per child inside a transaction
            $registrations = [];

            DB::transaction(function () use ($data, $school, $amount, &$registrations) {
                foreach ($data['children'] as $child) {
                    $registrations[] = WorkshopRegistration::create([
                        'workshop_school_id' => $school->id,
                        'age_group_id' => $school->age_group_id,
                        'city_id' => $school->city_id,

                        // Parent info (stored on every row for easy querying)
                        'participant_name' => $data['parent_name'],
                        'participant_email' => $data['email'],
                        'participant_phone' => $data['phone'],
                        'parent_name' => $data['parent_name'],
                        'parent_phone' => $data['phone'],
                        'email' => $data['email'],
                        'phone' => $data['phone'],
                        'whatsapp' => $data['whatsapp'] ?? null,

                        // Child-specific
                        'student_name' => $child['student_name'],
                        'dob' => $child['dob'] ?? null,
                        'school_name' => $child['school_name'] ?? null,
                        'experience' => $child['experience'] ?? null,

                        // Workshop context
                        'workshop_name' => $school->name,
                        'city_name' => $school->city?->name,
                        'age_group_name' => $school->ageGroup?->name,

                        // Fees
                        'amount' => $amount,
                        'status' => 'pending',

                        'message' => $data['message'] ?? null,
                        'ip_address' => request()->ip(),
                    ]);
                }
            });

            // Free workshop — confirm all immediately
            if ($amount == 0) {
                foreach ($registrations as $reg) {
                    $reg->update(['status' => 'confirmed']);
                }

                return response()->json([
                    'is_free' => true,
                    'registration_ids' => collect($registrations)->pluck('id'),
                    'child_count' => $childCount,
                    'message' => $childCount > 1 ? "All {$childCount} children registered successfully! We will be in touch soon." : 'Registration confirmed! We will be in touch soon.',
                ]);
            }

            // Paid — create ONE Razorpay order for the combined total
            return $this->createRazorpayOrder($registrations, $school, $totalAmount, $childCount);
        } catch (\Exception $e) {
            // Log the real error, never expose it to the user
            Log::error('WorkshopRegistration failed', [
                'school_id' => $school->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return response()->json(
                [
                    'error' => 'Something went wrong while saving your registration. Please try again or call us on +91 90241 64323.',
                ],
                500,
            );
        }
    }

    private function createRazorpayOrder(array $registrations, WorkshopSchool $school, float $totalAmount, int $childCount): JsonResponse
    {
        try {
            $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

            // Use the first registration ID as the primary reference
            $primaryId = $registrations[0]->id;
            $allIds = collect($registrations)->pluck('id')->implode('_');

            $order = $api->order->create([
                'receipt' => 'WS_' . $school->id . '_' . $allIds . '_' . uniqid(),
                'amount' => (int) round($totalAmount * 100), // paise
                'currency' => 'INR',
                'notes' => [
                    'workshop_school_id' => $school->id,
                    'registration_ids' => $allIds,
                    'children' => $childCount,
                ],
            ]);

            // Save order ID on all registration rows
            foreach ($registrations as $reg) {
                $reg->update(['razorpay_order_id' => $order->id]);
            }

            session([
                'rzp_ws_order_id' => $order->id,
                'rzp_ws_registration_ids' => collect($registrations)->pluck('id')->toArray(),
                'rzp_ws_amount' => $order->amount,
            ]);

            return response()->json([
                'is_free' => false,
                'registration_id' => $primaryId, // used by verify route
                'registration_ids' => collect($registrations)->pluck('id'),
                'order_id' => $order->id,
                'amount' => $order->amount,
                'currency' => $order->currency,
                'workshop_name' => $school->name,
                'child_count' => $childCount,
            ]);
        } catch (\Exception $e) {
            Log::error('Razorpay order creation failed', [
                'school_id' => $school->id,
                'error' => $e->getMessage(),
            ]);

            return response()->json(
                [
                    'error' => 'Unable to initiate payment at this time. Please try again or call us on +91 90241 64323.',
                ],
                500,
            );
        }
    }

    public function verifyPayment(Request $request, WorkshopRegistration $registration): JsonResponse
    {
        $request->validate([
            'razorpay_order_id' => 'required|string',
            'razorpay_payment_id' => 'required|string',
            'razorpay_signature' => 'required|string',
        ]);

        try {
            $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

            $api->utility->verifyPaymentSignature([
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature,
            ]);

            // Confirm ALL registrations sharing this order ID
            DB::transaction(function () use ($request, $registration) {
                WorkshopRegistration::where('razorpay_order_id', $request->razorpay_order_id)->update([
                    'status' => 'confirmed',
                    'razorpay_payment_id' => $request->razorpay_payment_id,
                    'razorpay_signature' => $request->razorpay_signature,
                ]);
            });

            $confirmedCount = WorkshopRegistration::where('razorpay_order_id', $request->razorpay_order_id)->count();

            session()->forget(['rzp_ws_order_id', 'rzp_ws_registration_ids', 'rzp_ws_amount']);

            return response()->json([
                'success' => true,
                'child_count' => $confirmedCount,
                'message' => $confirmedCount > 1 ? "Payment confirmed! All {$confirmedCount} children are now registered." : 'Payment verified. Registration confirmed!',
            ]);
        } catch (\Exception $e) {
            Log::error('Razorpay verification failed', [
                'registration_id' => $registration->id,
                'order_id' => $request->razorpay_order_id ?? null,
                'error' => $e->getMessage(),
            ]);

            // Mark as failed
            WorkshopRegistration::where('razorpay_order_id', $request->razorpay_order_id ?? $registration->razorpay_order_id)->update(['status' => 'failed']);

            return response()->json(
                [
                    'success' => false,
                    'message' => 'Payment verification failed. If money was deducted, please call us on +91 90241 64323 with your payment ID.',
                ],
                422,
            );
        }
    }
}
