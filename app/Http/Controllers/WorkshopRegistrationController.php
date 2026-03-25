<?php

namespace App\Http\Controllers;

use App\Models\WorkshopRegistration;
use App\Models\WorkshopSchool;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Razorpay\Api\Api;

class WorkshopRegistrationController extends Controller
{
    public function register(Request $request, WorkshopSchool $school): JsonResponse
    {
        if (!$school->status) {
            return response()->json(['error' => 'Workshop not available'], 404);
        }

        $data = $request->validate([
            'parent_name' => 'required|string|max:120',
            'email' => 'required|email|max:150',
            'phone' => 'required|string|max:20',
            'whatsapp' => 'nullable|string|max:20',

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

        $registrations = [];

        DB::transaction(function () use ($data, $school, $amount, &$registrations) {
            foreach ($data['children'] as $child) {
                $registrations[] = WorkshopRegistration::create([
                    'workshop_school_id' => $school->id,
                    'age_group_id' => $school->age_group_id,
                    'city_id' => $school->city_id,

                    'participant_name' => $data['parent_name'],
                    'participant_email' => $data['email'],
                    'participant_phone' => $data['phone'],
                    'parent_name' => $data['parent_name'],
                    'parent_phone' => $data['phone'],
                    'email' => $data['email'],
                    'phone' => $data['phone'],
                    'whatsapp' => $data['whatsapp'] ?? null,

                    'student_name' => $child['student_name'],
                    'dob' => $child['dob'] ?? null,
                    'school_name' => $child['school_name'] ?? null,
                    'experience' => $child['experience'] ?? null,

                    'workshop_name' => $school->name,
                    'city_name' => $school->city?->name,
                    'age_group_name' => $school->ageGroup?->name,

                    'amount' => $amount,
                    'status' => 'pending',

                    'message' => $data['message'] ?? null,
                    'ip_address' => request()->ip(),
                ]);
            }
        });

        // FREE WORKSHOP
        if ($amount == 0) {
            foreach ($registrations as $reg) {
                $reg->update(['status' => 'confirmed']);
            }

            return response()->json([
                'is_free' => true,
                'registration_ids' => collect($registrations)->pluck('id'),
                'child_count' => $childCount,
                'message' => $childCount > 1 ? "All {$childCount} children registered successfully!" : 'Registration confirmed!',
            ]);
        }

        return $this->createRazorpayOrder($registrations, $school, $totalAmount, $childCount);
    }

    private function createRazorpayOrder(array $registrations, WorkshopSchool $school, float $totalAmount, int $childCount): JsonResponse
    {
        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

        $primaryId = $registrations[0]->id;
        $allIds = collect($registrations)->pluck('id')->implode('_');

        $order = $api->order->create([
            'receipt' => 'WS_' . $school->id . '_' . $allIds . '_' . uniqid(),
            'amount' => (int) round($totalAmount * 100),
            'currency' => 'INR',
            'notes' => [
                'workshop_school_id' => $school->id,
                'registration_ids' => $allIds,
                'children' => $childCount,
            ],
        ]);

        foreach ($registrations as $reg) {
            $reg->update(['razorpay_order_id' => $order->id]);
        }

        return response()->json([
            'is_free' => false,
            'registration_id' => $primaryId,
            'registration_ids' => collect($registrations)->pluck('id'),
            'order_id' => $order->id,
            'amount' => $order->amount,
            'currency' => $order->currency,
            'workshop_name' => $school->name,
            'child_count' => $childCount,
        ]);
    }

    public function verifyPayment(Request $request, WorkshopRegistration $registration): JsonResponse
    {
        $request->validate([
            'razorpay_order_id' => 'required|string',
            'razorpay_payment_id' => 'required|string',
            'razorpay_signature' => 'required|string',
        ]);

        $api = new Api(config('services.razorpay.key'), config('services.razorpay.secret'));

        // Verify signature
        $api->utility->verifyPaymentSignature([
            'razorpay_order_id' => $request->razorpay_order_id,
            'razorpay_payment_id' => $request->razorpay_payment_id,
            'razorpay_signature' => $request->razorpay_signature,
        ]);

        // Fetch order from Razorpay (IMPORTANT SECURITY FIX)
        $razorpayOrder = $api->order->fetch($request->razorpay_order_id);

        DB::transaction(function () use ($request) {
            WorkshopRegistration::where('razorpay_order_id', $request->razorpay_order_id)
                ->where('status', 'pending')
                ->update([
                    'status' => 'confirmed',
                    'razorpay_payment_id' => $request->razorpay_payment_id,
                    'razorpay_signature' => $request->razorpay_signature,
                ]);
        });

        $confirmedCount = WorkshopRegistration::where('razorpay_order_id', $request->razorpay_order_id)->count();

        return response()->json([
            'success' => true,
            'child_count' => $confirmedCount,
            'message' => $confirmedCount > 1 ? "Payment confirmed! All {$confirmedCount} children registered." : 'Payment verified. Registration confirmed!',
        ]);
    }
}
