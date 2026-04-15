<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\WorkshopRegistration;
use App\Models\WorkshopSchool;
use Illuminate\Http\Request;
use Illuminate\View\View;

class WorkshopRegistrationAdminController extends Controller
{
    public function index(Request $request): View
    {
        $query = WorkshopRegistration::with(['workshopSchool', 'city', 'ageGroup'])->latest();

        if ($request->filled('school_id')) {
            $query->where('workshop_school_id', $request->school_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = substr(trim($request->search), 0, 100);
            $query->where(function ($q) use ($search) {
                $q->where('parent_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('student_name', 'like', "%{$search}%")
                  ->orWhere('workshop_name', 'like', "%{$search}%");
            });
        }

        $registrations = $query->paginate(25);
        $schools       = WorkshopSchool::ordered()->get(['id', 'name']);

        $stats = [
            'total'     => WorkshopRegistration::count(),
            'confirmed' => WorkshopRegistration::where('status', 'confirmed')->count(),
            'pending'   => WorkshopRegistration::where('status', 'pending')->count(),
            'cancelled' => WorkshopRegistration::where('status', 'cancelled')->count(),
        ];

        return view('backend.workshop.registrations.index', compact('registrations', 'schools', 'stats'));
    }

    public function show($id): View
    {
        $registration = WorkshopRegistration::with(['workshopSchool', 'city', 'ageGroup'])->findOrFail($id);

        // Siblings — other children registered in the same booking (same order_id or same parent+email on same day)
        $siblings = collect();
        if ($registration->razorpay_order_id) {
            $siblings = WorkshopRegistration::where('razorpay_order_id', $registration->razorpay_order_id)
                ->where('id', '!=', $registration->id)
                ->get();
        }

        return view('backend.workshop.registrations.show', compact('registration', 'siblings'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate(['status' => 'required|in:pending,confirmed,cancelled']);
        WorkshopRegistration::findOrFail($id)->update(['status' => $request->status]);

        return response()->json(['success' => true, 'status' => $request->status]);
    }

    public function export(Request $request)
    {
        if ($request->filled('reg_id')) {
            $registrations = WorkshopRegistration::where('id', $request->reg_id)->get();
        } else {
            $query = WorkshopRegistration::latest();

            if ($request->filled('school_id')) {
                $query->where('workshop_school_id', $request->school_id);
            }
            if ($request->filled('status')) {
                $query->where('status', $request->status);
            }
            if ($request->filled('search')) {
                $search = substr(trim($request->search), 0, 100);
                $query->where(function ($q) use ($search) {
                    $q->where('parent_name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('phone', 'like', "%{$search}%")
                      ->orWhere('student_name', 'like', "%{$search}%");
                });
            }

            $registrations = $query->get();
        }

        $filename = 'workshop_registrations_' . now()->format('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv; charset=utf-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($registrations) {
            $file = fopen('php://output', 'w');

            // UTF-8 BOM for Excel
            fputs($file, "\xEF\xBB\xBF");

            fputcsv($file, [
                'ID', 'Status',
                'Parent Name', 'Email', 'Phone', 'WhatsApp',
                'Student Name', 'DOB', 'School', 'Experience',
                'Workshop', 'City', 'Age Group',
                'Fee (₹)', 'Merchandise Items', 'Merchandise Total (₹)', 'Grand Total (₹)',
                'Payment ID', 'Order ID',
                'Message', 'IP Address', 'Registered At',
            ]);

            foreach ($registrations as $reg) {
                $merchText = '';
                if (!empty($reg->merchandise_items)) {
                    $lines = [];
                    foreach ($reg->merchandise_items as $item) {
                        $lines[] = ($item['name'] ?? '') . ' x' . ($item['qty'] ?? 1) . ' @₹' . ($item['price'] ?? 0);
                    }
                    $merchText = implode(' | ', $lines);
                }

                $grandTotal = (float) $reg->amount + (float) $reg->merchandise_total;

                fputcsv($file, [
                    $reg->id,
                    ucfirst($reg->status),
                    $reg->parent_name,
                    $reg->email,
                    $reg->phone,
                    $reg->whatsapp ?? '',
                    $reg->student_name,
                    $reg->dob ? $reg->dob->format('d M Y') : '',
                    $reg->school_name ?? '',
                    $reg->experience ? ucfirst($reg->experience) : '',
                    $reg->workshop_name ?? '',
                    $reg->city_name ?? '',
                    $reg->age_group_name ?? '',
                    $reg->amount,
                    $merchText,
                    $reg->merchandise_total ?? 0,
                    number_format($grandTotal, 2),
                    $reg->razorpay_payment_id ?? '',
                    $reg->razorpay_order_id ?? '',
                    $reg->message ?? '',
                    $reg->ip_address ?? '',
                    $reg->created_at->format('d M Y h:i A'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
