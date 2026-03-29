<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Enrollment;
use App\Models\Course;
use App\Models\Event;
use App\Models\Center;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Display the admin dashboard with all statistics
     */
    public function index()
    {
        // ============ PAYMENT STATISTICS ============
        $recentPayments = Payment::with('enrollment')->where('status', 'success')->latest('paid_at')->take(10)->get();

        $totalRevenue = Payment::where('status', 'success')->sum('amount');
        $monthlyRevenue = Payment::where('status', 'success')->whereMonth('paid_at', now()->month)->whereYear('paid_at', now()->year)->sum('amount');
        $todayRevenue = Payment::where('status', 'success')->whereDate('paid_at', today())->sum('amount');

        $failedPayments = Payment::where('status', 'failed')->count();
        $successfulPayments = Payment::where('status', 'success')->count();
        $pendingPayments = Payment::where('status', 'pending')->count();

        // Payment by type
        $paymentsByType = Payment::where('status', 'success')->selectRaw('type, COUNT(*) as count, SUM(amount) as total')->groupBy('type')->get()->keyBy('type');

        // Payment by method
        $paymentsByMethod = Payment::where('status', 'success')->selectRaw('transaction_type, COUNT(*) as count, SUM(amount) as total')->groupBy('transaction_type')->get()->keyBy('transaction_type');

        // ============ ENROLLMENT STATISTICS ============
        $totalEnrollments = Enrollment::count();
        $confirmedEnrollments = Enrollment::where('status', 'confirmed')->count();
        $pendingEnrollments = Enrollment::where('status', 'pending')->count();
        $leadEnrollments = Enrollment::where('status', 'lead')->count();
        $cancelledEnrollments = Enrollment::where('status', 'cancelled')->count();

        // Enrollments by mode
        $enrollmentsByMode = Enrollment::selectRaw('mode, COUNT(*) as count')->groupBy('mode')->get()->keyBy('mode');

        // Recent enrollments
        $recentEnrollments = Enrollment::latest('created_at')->take(5)->get();

        // ============ COURSE STATISTICS ============
        $totalCourses = Course::count();
        $activeCourses = Course::whereHas('centers')->count();

        $courseEnrollments = Enrollment::selectRaw('course, COUNT(*) as count')->groupBy('course')->orderByDesc('count')->limit(5)->get();

        // Most enrolled courses
        $topCourses = Enrollment::selectRaw('course, COUNT(*) as enrollments, COUNT(CASE WHEN status = "confirmed" THEN 1 END) as confirmed')->groupBy('course')->orderByDesc('enrollments')->limit(5)->get();

        // ============ CENTER STATISTICS ============
        $totalCenters = Center::count();
        $activeCenters = Center::count();

        $centerEnrollments = Enrollment::selectRaw('centre, COUNT(*) as count, COUNT(CASE WHEN status = "confirmed" THEN 1 END) as confirmed')->groupBy('centre')->orderByDesc('count')->limit(5)->get();

        // ============ EVENT STATISTICS ============
        $totalEvents = Event::count();
        $activeEvents = Event::where('status', 1)->count();
        $upcomingEvents = Event::where('event_date', '>=', now())->where('status', 1)->count();
        $pastEvents = Event::where('event_date', '<', now())->count();

        // ============ STUDENT STATISTICS ============
        $uniqueStudents = Enrollment::distinct('email')->count('email');
        $maleStudents = Enrollment::where('gender', 'Male')->count();
        $femaleStudents = Enrollment::where('gender', 'Female')->count();
        $otherGender = Enrollment::where('gender', 'Other')->count();

        // State-wise enrollments
        $enrollmentsByState = Enrollment::selectRaw('state, COUNT(*) as count')->groupBy('state')->orderByDesc('count')->limit(5)->get();

        // ============ REVENUE STATISTICS ============
        $revenueByType = Payment::where('status', 'success')->selectRaw('type, COUNT(*) as count, SUM(amount) as amount')->groupBy('type')->orderByDesc('amount')->get();

        $revenueByMethod = Payment::where('status', 'success')->selectRaw('transaction_type, COUNT(*) as count, SUM(amount) as amount')->groupBy('transaction_type')->orderByDesc('amount')->get();

        // ============ CONVERSION STATISTICS ============
        $conversionRate = $totalEnrollments > 0 ? round(($confirmedEnrollments / $totalEnrollments) * 100, 2) : 0;

        $leadConversion = $leadEnrollments > 0 ? round(($confirmedEnrollments / ($confirmedEnrollments + $leadEnrollments)) * 100, 2) : 0;

        // ============ TIME SERIES DATA ============
        // Last 7 days revenue
        $last7DaysRevenue = $this->getLast7DaysRevenue();

        // Last 30 days enrollments
        $last30DaysEnrollments = $this->getLast30DaysEnrollments();

        return view(
            'backend.index',
            compact(
                // Payments
                'recentPayments',
                'totalRevenue',
                'monthlyRevenue',
                'todayRevenue',
                'failedPayments',
                'successfulPayments',
                'pendingPayments',
                'paymentsByType',
                'paymentsByMethod',

                // Enrollments
                'totalEnrollments',
                'confirmedEnrollments',
                'pendingEnrollments',
                'leadEnrollments',
                'cancelledEnrollments',
                'enrollmentsByMode',
                'recentEnrollments',

                // Courses
                'totalCourses',
                'activeCourses',
                'courseEnrollments',
                'topCourses',

                // Centers
                'totalCenters',
                'activeCenters',
                'centerEnrollments',

                // Events
                'totalEvents',
                'activeEvents',
                'upcomingEvents',
                'pastEvents',

                // Students
                'uniqueStudents',
                'maleStudents',
                'femaleStudents',
                'otherGender',
                'enrollmentsByState',

                // Revenue
                'revenueByType',
                'revenueByMethod',

                // Conversion
                'conversionRate',
                'leadConversion',

                // Time series
                'last7DaysRevenue',
                'last30DaysEnrollments',
            ),
        );
    }

    /**
     * Get last 7 days revenue data for chart
     */
    private function getLast7DaysRevenue()
    {
        $data = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $amount = Payment::where('status', 'success')->whereDate('paid_at', $date)->sum('amount');

            $data[] = [
                'date' => $date->format('M d'),
                'amount' => (float) $amount,
            ];
        }
        return $data;
    }

    /**
     * Get last 30 days enrollments data for chart
     */
    private function getLast30DaysEnrollments()
    {
        $data = [];
        for ($i = 29; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $count = Enrollment::whereDate('created_at', $date)->count();

            $data[] = [
                'date' => $date->format('M d'),
                'count' => $count,
            ];
        }
        return $data;
    }

    /**
     * Get analytics data via AJAX
     */
    public function analytics(Request $request)
    {
        $period = $request->get('period', 'month');

        $query = Payment::where('status', 'success');

        if ($period === 'week') {
            $query->whereBetween('paid_at', [now()->startOfWeek(), now()->endOfWeek()]);
        } elseif ($period === 'month') {
            $query->whereMonth('paid_at', now()->month)->whereYear('paid_at', now()->year);
        } elseif ($period === 'year') {
            $query->whereYear('paid_at', now()->year);
        }

        $data = [
            'total_revenue' => $query->sum('amount'),
            'total_transactions' => $query->count(),
            'by_type' => $query->selectRaw('type, COUNT(*) as count, SUM(amount) as amount')->groupBy('type')->get(),
            'by_method' => $query->selectRaw('transaction_type, COUNT(*) as count, SUM(amount) as amount')->groupBy('transaction_type')->get(),
        ];

        return response()->json($data);
    }
}
