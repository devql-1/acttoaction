<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of all payments with filtering by type
     */
    public function index(Request $request)
    {
        $query = Payment::with('enrollment')->latest();

        // Filter by payment type
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by payment method
        // if ($request->filled('method')) {
        //     $query->where('transaction_type', $request->method);
        // }

        // Search by email, phone, order ID, payment ID, or reference ID
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('email', 'like', "%$search%")
                    ->orWhere('contact', 'like', "%$search%")
                    ->orWhere('razorpay_order_id', 'like', "%$search%")
                    ->orWhere('razorpay_payment_id', 'like', "%$search%")
                    ->orWhereHas('enrollment', function ($sub) use ($search) {
                        $sub->where('reference_id', 'like', "%$search%")
                            ->orWhere('first_name', 'like', "%$search%")
                            ->orWhere('last_name', 'like', "%$search%");
                    });
            });
        }

        $payments = $query->paginate(20)->withQueryString();

        // Get statistics
        $stats = [
            'total' => Payment::count(),
            'success' => Payment::where('status', 'success')->count(),
            'failed' => Payment::where('status', 'failed')->count(),
            'pending' => Payment::where('status', 'pending')->count(),
            'total_amount' => Payment::where('status', 'success')->sum('amount'),
        ];

        // Get payment types for filter dropdown
        $paymentTypes = [
            'course_enrollment' => 'Course Enrollment',
            'workshop_registration' => 'Workshop Registration',
            'event_registration' => 'Event Registration',
            'subscription' => 'Subscription',
            'other' => 'Other',
        ];

        // Get payment methods for filter dropdown
        $paymentMethods = ['upi', 'card', 'netbanking', 'wallet'];

        return view('backend.payments.index', compact('payments', 'stats', 'paymentTypes', 'paymentMethods'));
    }

    /**
     * Display the specified payment
     */
    public function show($id)
    {
        $payment = Payment::with('enrollment')->findOrFail($id);

        // Get related payments from same enrollment
        $relatedPayments = Payment::where('enrollment_id', $payment->enrollment_id)->where('id', '!=', $id)->latest()->take(5)->get();

        return view('backend.payments.show', compact('payment', 'relatedPayments'));
    }

    /**
     * Filter payments by type (AJAX endpoint)
     */
    public function byType($type)
    {
        $payments = Payment::where('type', $type)->with('enrollment')->latest()->paginate(20);

        $stats = [
            'total' => Payment::where('type', $type)->count(),
            'success' => Payment::where('type', $type)->where('status', 'success')->count(),
            'failed' => Payment::where('type', $type)->where('status', 'failed')->count(),
            'total_amount' => Payment::where('type', $type)->where('status', 'success')->sum('amount'),
        ];

        $paymentTypeLabel =
            [
                'course_enrollment' => 'Course Enrollment',
                'workshop_registration' => 'Workshop Registration',
                'event_registration' => 'Event Registration',
                'subscription' => 'Subscription',
                'other' => 'Other',
            ][$type] ?? 'Unknown';

        return view('backend.payments.by-type', compact('payments', 'stats', 'type', 'paymentTypeLabel'));
    }

    /**
     * Get payment statistics
     */
    public function statistics(Request $request)
    {
        $period = $request->get('period', 'month'); // day, week, month, year

        $query = Payment::where('status', 'success');

        if ($period === 'day') {
            $query->whereDate('paid_at', today());
        } elseif ($period === 'week') {
            $query->whereBetween('paid_at', [now()->startOfWeek(), now()->endOfWeek()]);
        } elseif ($period === 'month') {
            $query->whereMonth('paid_at', now()->month)->whereYear('paid_at', now()->year);
        } elseif ($period === 'year') {
            $query->whereYear('paid_at', now()->year);
        }

        $byType = $query
            ->get()
            ->groupBy('type')
            ->map(function ($items) {
                return [
                    'count' => $items->count(),
                    'amount' => $items->sum('amount'),
                ];
            });

        $byMethod = $query
            ->get()
            ->groupBy('transaction_type')
            ->map(function ($items) {
                return [
                    'count' => $items->count(),
                    'amount' => $items->sum('amount'),
                ];
            });

        return response()->json([
            'by_type' => $byType,
            'by_method' => $byMethod,
            'total_amount' => $query->sum('amount'),
            'total_count' => $query->count(),
        ]);
    }

    /**
     * Export payments to CSV
     */
    public function export(Request $request)
    {
        $query = Payment::with('enrollment')->latest();

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $payments = $query->get();

        $filename = 'payments_' . now()->format('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($payments) {
            $file = fopen('php://output', 'w');

            // Write header
            fputcsv($file, ['ID', 'Enrollment ID', 'Student Name', 'Email', 'Phone', 'Amount', 'Currency', 'Payment Type', 'Transaction Type', 'Status', 'Order ID', 'Payment ID', 'Paid At', 'Created At']);

            // Write data
            foreach ($payments as $payment) {
                fputcsv($file, [$payment->id, $payment->enrollment_id, $payment->enrollment ? $payment->enrollment->first_name . ' ' . $payment->enrollment->last_name : '-', $payment->email, $payment->contact, $payment->amount, $payment->currency, $payment->type, $payment->transaction_type, $payment->status, $payment->razorpay_order_id, $payment->razorpay_payment_id, $payment->paid_at?->format('Y-m-d H:i:s'), $payment->created_at->format('Y-m-d H:i:s')]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Delete a payment record
     */
    public function destroy($id)
    {
        Payment::findOrFail($id)->delete();
        return back()->with('success', 'Payment record deleted successfully.');
    }
}
