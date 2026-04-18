@extends('backend.layout.app')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <div class="d-flex align-items-center justify-content-between">
                    <h3 class="fw-bold mb-3">{{ $paymentTypeLabel }} Payments</h3>
                    <a href="{{ route('payments.index') }}" class="btn btn-sm btn-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Back to All Payments
                    </a>
                </div>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="{{ route('payments.index') }}">Payments</a></li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="#">{{ $paymentTypeLabel }}</a></li>
                </ul>
            </div>

            {{-- Statistics for this type --}}
            <div class="row mb-3">
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-primary bubble-shadow-small">
                                        <i class="fas fa-money-bill-wave"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Total Amount</p>
                                        <h4 class="card-title">₹{{ number_format($stats['total_amount'], 2) }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
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
                                        <p class="card-category">Successful</p>
                                        <h4 class="card-title">{{ $stats['success'] }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
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
                                        <p class="card-category">Failed</p>
                                        <h4 class="card-title">{{ $stats['failed'] }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-info bubble-shadow-small">
                                        <i class="fas fa-exchange-alt"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Total</p>
                                        <h4 class="card-title">{{ $stats['total'] }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 class="card-title mb-0">
                                    {{ $paymentTypeLabel }}
                                    <span class="badge bg-primary">{{ $stats['total'] }} Transactions</span>
                                </h5>
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Student</th>
                                            <th>Method</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Payment ID</th>
                                            <th class="text-center">Date</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($payments as $payment)
                                            <tr>
                                                <td class="text-muted" style="font-size:12px;">{{ $payment->id }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div class="avatar avatar-sm">
                                                            <span class="avatar-title rounded-circle bg-primary text-white"
                                                                style="font-size:12px;width:34px;height:34px;display:inline-flex;align-items:center;justify-content:center;">
                                                                @if ($payment->enrollment)
                                                                    {{ strtoupper(substr($payment->enrollment->first_name, 0, 1)) }}
                                                                @else
                                                                    {{ strtoupper(substr($payment->email, 0, 1)) }}
                                                                @endif
                                                            </span>
                                                        </div>
                                                        <div>
                                                            <div class="fw-bold" style="font-size:13px;">
                                                                @if ($payment->enrollment)
                                                                    {{ $payment->enrollment->first_name }}
                                                                    {{ $payment->enrollment->last_name }}
                                                                @else
                                                                    {{ $payment->email }}
                                                                @endif
                                                            </div>
                                                            <div class="text-muted" style="font-size:11px;">
                                                                {{ $payment->contact ?? $payment->email }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td style="font-size:12px;">
                                                    <span class="badge bg-secondary">
                                                        {{ ucfirst($payment->transaction_type ?? 'Unknown') }}
                                                    </span>
                                                </td>
                                                <td class="fw-bold" style="color:#059669;">
                                                    {{ $payment->currency }} {{ number_format($payment->amount, 2) }}
                                                </td>
                                                <td class="text-center">
                                                    @php
                                                        $statusBadge =
                                                            [
                                                                'success' => 'success',
                                                                'failed' => 'danger',
                                                                'pending' => 'warning',
                                                            ][$payment->status] ?? 'secondary';
                                                    @endphp
                                                    <span class="badge badge-{{ $statusBadge }}">
                                                        {{ ucfirst($payment->status) }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <code style="font-size:10px;">
                                                        {{ substr($payment->razorpay_payment_id, 0, 15) }}...
                                                    </code>
                                                </td>
                                                <td class="text-center" style="font-size:12px;white-space:nowrap;">
                                                    @if ($payment->paid_at)
                                                        {{ $payment->paid_at->format('d M Y') }}<br>
                                                        <span
                                                            class="text-muted">{{ $payment->paid_at->format('H:i') }}</span>
                                                    @else
                                                        <span class="text-muted">—</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('payments.show', $payment->id) }}"
                                                        class="btn btn-sm btn-icon btn-primary btn-round"
                                                        title="View Details">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center py-5 text-muted">
                                                    <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                                    No {{ strtolower($paymentTypeLabel) }} payments found.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- Pagination --}}
                        @if ($payments->hasPages())
                            <nav aria-label="Page navigation" class="card-footer">
                                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                                    <div class="text-muted" style="font-size:13px;">
                                        Showing
                                        <strong>{{ $payments->firstItem() }}</strong>–<strong>{{ $payments->lastItem() }}</strong>
                                        of <strong>{{ $payments->total() }}</strong> payments
                                    </div>
                                    <ul class="pagination pagination-sm mb-0">
                                        @if ($payments->onFirstPage())
                                            <li class="page-item disabled">
                                                <span class="page-link">
                                                    <i class="fas fa-chevron-left"></i> Previous
                                                </span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $payments->previousPageUrl() }}"
                                                    rel="prev">
                                                    <i class="fas fa-chevron-left"></i> Previous
                                                </a>
                                            </li>
                                        @endif

                                        @if ($payments->lastPage() > 1)
                                            @php
                                                $currentPage = $payments->currentPage();
                                                $lastPage = $payments->lastPage();
                                                $start = max(1, $currentPage - 2);
                                                $end = min($lastPage, $currentPage + 2);
                                            @endphp

                                            @if ($start > 1)
                                                <li class="page-item">
                                                    <a class="page-link" href="{{ $payments->url(1) }}">1</a>
                                                </li>
                                                @if ($start > 2)
                                                    <li class="page-item disabled">
                                                        <span class="page-link">...</span>
                                                    </li>
                                                @endif
                                            @endif

                                            @foreach ($payments->getUrlRange($start, $end) as $page => $url)
                                                @if ($page == $currentPage)
                                                    <li class="page-item active">
                                                        <span class="page-link">{{ $page }}</span>
                                                    </li>
                                                @else
                                                    <li class="page-item">
                                                        <a class="page-link"
                                                            href="{{ $url }}">{{ $page }}</a>
                                                    </li>
                                                @endif
                                            @endforeach

                                            @if ($end < $lastPage)
                                                @if ($end < $lastPage - 1)
                                                    <li class="page-item disabled">
                                                        <span class="page-link">...</span>
                                                    </li>
                                                @endif
                                                <li class="page-item">
                                                    <a class="page-link"
                                                        href="{{ $payments->url($lastPage) }}">{{ $lastPage }}</a>
                                                </li>
                                            @endif
                                        @endif

                                        @if ($payments->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $payments->nextPageUrl() }}"
                                                    rel="next">
                                                    Next <i class="fas fa-chevron-right"></i>
                                                </a>
                                            </li>
                                        @else
                                            <li class="page-item disabled">
                                                <span class="page-link">
                                                    Next <i class="fas fa-chevron-right"></i>
                                                </span>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </nav>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
