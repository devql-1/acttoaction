<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $recentPayments = Payment::with('enrollment')->where('status', 'paid')->latest('paid_at')->take(10)->get();

        $totalRevenue = Payment::where('status', 'paid')->sum('amount');
        $totalEnrollments = Enrollment::count();
        $paidEnrollments = Enrollment::where('status', 'paid')->count();
        $leadEnrollments = Enrollment::where('status', 'lead')->count();

        return view('backend.index', compact('recentPayments', 'totalRevenue', 'totalEnrollments', 'paidEnrollments', 'leadEnrollments'));
    }
}
