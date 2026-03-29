@extends('backend.layout.app')
@section('content')
    <div class="container">
        <div class="page-inner">
            {{-- Page Header --}}
            <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-3">{{ get_setting('website_name') }} Dashboard</h3>
                    <h6 class="op-7 mb-2">Welcome back! Here's your business overview.</h6>
                </div>
                <div class="ms-md-auto py-2 py-md-0">
                    <a href="{{ route('enrollments.index') }}" class="btn btn-label-info btn-round me-2">
                        <i class="fas fa-list me-1"></i> Enrollments
                    </a>
                    <a href="{{ route('payments.index') }}" class="btn btn-primary btn-round">
                        <i class="fas fa-money-bill me-1"></i> Payments
                    </a>
                </div>
            </div>

            {{-- Key Statistics Cards --}}
            <div class="row mb-3">
                {{-- Revenue Card --}}
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-primary bubble-shadow-small">
                                        <i class="fas fa-rupee-sign"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Total Revenue</p>
                                        <h4 class="card-title">₹{{ number_format($totalRevenue, 0) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Monthly Revenue --}}
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-success bubble-shadow-small">
                                        <i class="fas fa-calendar-check"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">{{ now()->format('M') }} Revenue</p>
                                        <h4 class="card-title">₹{{ number_format($monthlyRevenue, 0) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Today Revenue --}}
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-info bubble-shadow-small">
                                        <i class="fas fa-chart-line"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Today's Revenue</p>
                                        <h4 class="card-title">₹{{ number_format($todayRevenue, 0) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Total Enrollments --}}
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Total Enrollments</p>
                                        <h4 class="card-title">{{ number_format($totalEnrollments) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Enrollment Status Cards --}}
            <div class="row mb-3">
                <div class="col-sm-6 col-md-2">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-success bubble-shadow-small">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Confirmed</p>
                                        <h4 class="card-title">{{ number_format($confirmedEnrollments) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-2">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-warning bubble-shadow-small">
                                        <i class="fas fa-hourglass-half"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Pending</p>
                                        <h4 class="card-title">{{ number_format($pendingEnrollments) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-2">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-info bubble-shadow-small">
                                        <i class="fas fa-user-clock"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Leads</p>
                                        <h4 class="card-title">{{ number_format($leadEnrollments) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-2">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-danger bubble-shadow-small">
                                        <i class="fas fa-times-circle"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Cancelled</p>
                                        <h4 class="card-title">{{ number_format($cancelledEnrollments) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-2">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-secondary bubble-shadow-small">
                                        <i class="fas fa-graduation-cap"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Courses</p>
                                        <h4 class="card-title">{{ number_format($totalCourses) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-2">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-primary bubble-shadow-small">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Centers</p>
                                        <h4 class="card-title">{{ number_format($totalCenters) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Charts Row --}}
            <div class="row">
                {{-- Revenue Chart --}}
                <div class="col-md-8">
                    <div class="card card-round">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">Revenue Trend (Last 7 Days)</div>
                                <div class="card-tools">
                                    <button class="btn btn-label-success btn-round btn-sm me-2">
                                        <span class="btn-label">
                                            <i class="fa fa-download"></i>
                                        </span>
                                        Export
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container" style="min-height: 300px">
                                <canvas id="revenueChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Payment Stats --}}
                <div class="col-md-4">
                    <div class="card card-round">
                        <div class="card-header">
                            <div class="card-title">Payment Status</div>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Successful</span>
                                    <span class="fw-bold text-success">{{ number_format($successfulPayments) }}</span>
                                </div>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-success" role="progressbar"
                                        style="width: {{ $successfulPayments > 0 ? round(($successfulPayments / ($successfulPayments + $failedPayments + $pendingPayments)) * 100) : 0 }}%"
                                        aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Failed</span>
                                    <span class="fw-bold text-danger">{{ number_format($failedPayments) }}</span>
                                </div>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-danger" role="progressbar"
                                        style="width: {{ $failedPayments > 0 ? round(($failedPayments / ($successfulPayments + $failedPayments + $pendingPayments)) * 100) : 0 }}%"
                                        aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Pending</span>
                                    <span class="fw-bold text-warning">{{ number_format($pendingPayments) }}</span>
                                </div>
                                <div class="progress progress-sm">
                                    <div class="progress-bar bg-warning" role="progressbar"
                                        style="width: {{ $pendingPayments > 0 ? round(($pendingPayments / ($successfulPayments + $failedPayments + $pendingPayments)) * 100) : 0 }}%"
                                        aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>

                            <div class="mt-4 pt-3 border-top text-center">
                                <p class="text-muted mb-1">Conversion Rate</p>
                                <h3 class="fw-bold">{{ $conversionRate }}%</h3>
                                <small class="text-muted">Confirmed / Total Enrollments</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Content Row --}}
            <div class="row">
                {{-- Top Courses --}}
                <div class="col-md-6">
                    <div class="card card-round">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">Top Courses</div>
                                <div class="card-tools">
                                    <a href="#" class="btn btn-sm btn-primary">View All</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Course Name</th>
                                            <th class="text-center">Enrollments</th>
                                            <th class="text-center">Confirmed</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($topCourses as $course)
                                            <tr>
                                                <td class="fw-bold">{{ $course->course }}</td>
                                                <td class="text-center">
                                                    <span class="badge bg-info">{{ $course->enrollments }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge bg-success">{{ $course->confirmed }}</span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center text-muted py-3">No courses yet</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Top Centers --}}
                <div class="col-md-6">
                    <div class="card card-round">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">Top Centers</div>
                                <div class="card-tools">
                                    <a href="#" class="btn btn-sm btn-primary">View All</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>Center Name</th>
                                            <th class="text-center">Enrollments</th>
                                            <th class="text-center">Confirmed</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($centerEnrollments as $center)
                                            <tr>
                                                <td class="fw-bold">{{ $center->centre }}</td>
                                                <td class="text-center">
                                                    <span class="badge bg-info">{{ $center->count }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge bg-success">{{ $center->confirmed }}</span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center text-muted py-3">No centers yet</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Student Demographics --}}
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-round">
                        <div class="card-header">
                            <div class="card-title">Student Demographics</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-muted">Male</span>
                                            <span class="fw-bold">{{ $maleStudents }}</span>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar bg-info" role="progressbar"
                                                style="width: {{ $uniqueStudents > 0 ? round(($maleStudents / $uniqueStudents) * 100) : 0 }}%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-muted">Female</span>
                                            <span class="fw-bold">{{ $femaleStudents }}</span>
                                        </div>
                                        <div class="progress">
                                            <div class="progress-bar bg-success" role="progressbar"
                                                style="width: {{ $uniqueStudents > 0 ? round(($femaleStudents / $uniqueStudents) * 100) : 0 }}%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4 pt-3 border-top">
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted">Total Unique Students</span>
                                        <span class="fw-bold">{{ number_format($uniqueStudents) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Enrollment Mode --}}
                <div class="col-md-6">
                    <div class="card card-round">
                        <div class="card-header">
                            <div class="card-title">Enrollment by Mode</div>
                        </div>
                        <div class="card-body">
                            @forelse ($enrollmentsByMode as $mode => $data)
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-muted">{{ ucfirst($mode) }}</span>
                                        <span class="fw-bold">{{ $data->count }}</span>
                                    </div>
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar"
                                            style="width: {{ $totalEnrollments > 0 ? round(($data->count / $totalEnrollments) * 100) : 0 }}%">
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="text-muted text-center py-3">No enrollment data</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            {{-- Recent Transactions --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-round">
                        <div class="card-header">
                            <div class="card-head-row card-tools-still-right">
                                <div class="card-title">Recent Transactions</div>
                                <div class="card-tools">
                                    <a href="{{ route('payments.index') }}" class="btn btn-sm btn-primary">View All</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Student</th>
                                            <th scope="col">Course</th>
                                            <th scope="col">Payment ID</th>
                                            <th scope="col">Type</th>
                                            <th scope="col" class="text-end">Amount</th>
                                            <th scope="col" class="text-end">Date</th>
                                            <th scope="col" class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($recentPayments as $payment)
                                            <tr>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div class="avatar avatar-sm">
                                                            <span class="avatar-title rounded-circle bg-primary text-white"
                                                                style="font-size:12px;">
                                                                {{ strtoupper(substr($payment->enrollment?->first_name ?? 'U', 0, 1)) }}
                                                            </span>
                                                        </div>
                                                        <div>
                                                            <div class="fw-bold" style="font-size:13px;">
                                                                {{ $payment->enrollment?->first_name ?? '—' }}
                                                                {{ $payment->enrollment?->last_name ?? '' }}
                                                            </div>
                                                            <div class="text-muted" style="font-size:11px;">
                                                                {{ $payment->enrollment?->phone ?? '—' }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td style="font-size:13px;">
                                                    {{ $payment->enrollment?->course ?? '—' }}
                                                </td>
                                                <td>
                                                    <code style="font-size:10px;">
                                                        {{ substr($payment->razorpay_payment_id ?? '', 0, 12) }}...
                                                    </code>
                                                </td>
                                                <td>
                                                    <span class="badge bg-secondary">
                                                        {{ ucfirst(str_replace('_', ' ', $payment->type ?? 'unknown')) }}
                                                    </span>
                                                </td>
                                                <td class="text-end fw-bold" style="color:#059669;">
                                                    ₹{{ number_format($payment->amount, 2) }}
                                                </td>
                                                <td class="text-end" style="font-size:12px;white-space:nowrap;">
                                                    {{ $payment->paid_at?->format('d M Y, H:i') ?? '—' }}
                                                </td>
                                                <td class="text-center">
                                                    @if ($payment->status === 'success')
                                                        <span class="badge badge-success">Success</span>
                                                    @elseif ($payment->status === 'failed')
                                                        <span class="badge badge-danger">Failed</span>
                                                    @else
                                                        <span
                                                            class="badge badge-warning">{{ ucfirst($payment->status) }}</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center py-4 text-muted">
                                                    <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                                    No payments recorded yet.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Events Summary --}}
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-round">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">Event Summary</div>
                                <div class="card-tools">
                                    <a href="#" class="btn btn-sm btn-primary">View All</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Total Events</span>
                                    <span class="fw-bold">{{ $totalEvents }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Active Events</span>
                                    <span class="fw-bold text-success">{{ $activeEvents }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Upcoming Events</span>
                                    <span class="fw-bold text-info">{{ $upcomingEvents }}</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Past Events</span>
                                    <span class="fw-bold text-secondary">{{ $pastEvents }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Enrollments by State --}}
                <div class="col-md-6">
                    <div class="card card-round">
                        <div class="card-header">
                            <div class="card-title">Top States by Enrollment</div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-sm table-hover">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>State</th>
                                            <th class="text-center">Enrollments</th>
                                            <th class="text-end">Percentage</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($enrollmentsByState as $state)
                                            <tr>
                                                <td class="fw-bold">{{ $state->state }}</td>
                                                <td class="text-center">
                                                    <span class="badge bg-info">{{ $state->count }}</span>
                                                </td>
                                                <td class="text-end">
                                                    {{ $totalEnrollments > 0 ? round(($state->count / $totalEnrollments) * 100, 1) : 0 }}%
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center text-muted py-3">No data available
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- Chart.js Script --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.9.1/dist/chart.min.js"></script>
    <script>
        // Revenue Trend Chart
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        const revenueData = @json($last7DaysRevenue);

        new Chart(revenueCtx, {
            type: 'line',
            data: {
                labels: revenueData.map(d => d.date),
                datasets: [{
                    label: 'Revenue (₹)',
                    data: revenueData.map(d => d.amount),
                    borderColor: '#1f77f2',
                    backgroundColor: 'rgba(31, 119, 242, 0.1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4,
                    pointRadius: 4,
                    pointBackgroundColor: '#1f77f2',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return '₹' + value.toLocaleString();
                            }
                        }
                    }
                }
            }
        });
    </script>
@endsection
