@extends('backend.layout.app')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <div class="d-flex align-items-center justify-content-between">
                    <h3 class="fw-bold mb-3">Payments</h3>
                    <a href="{{ route('payments.export') }}" class="btn btn-sm btn-success">
                        <i class="fas fa-download me-1"></i> Export CSV
                    </a>
                </div>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="#">Payments</a></li>
                </ul>
            </div>

            {{-- Statistics Cards --}}
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
                                        <p class="card-category">Total Transactions</p>
                                        <h4 class="card-title">{{ $stats['total'] }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Payment Type Quick Links --}}
            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="fw-bold mb-3">Filter by Payment Type</h6>
                            <div class="d-flex gap-2 flex-wrap">
                                <a href="{{ route('payments.index') }}"
                                    class="btn btn-sm {{ !request('type') ? 'btn-primary' : 'btn-outline-primary' }}">
                                    <i class="fas fa-th me-1"></i> All Payments
                                </a>
                                @foreach ($paymentTypes as $key => $label)
                                    <a href="{{ route('payments.index', ['type' => $key]) }}"
                                        class="btn btn-sm {{ request('type') === $key ? 'btn-primary' : 'btn-outline-primary' }}">
                                        <i class="fas fa-tag me-1"></i> {{ $label }}
                                    </a>
                                @endforeach
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
                                <div class="card-title">
                                    All Payments
                                    @if (request('type'))
                                        <span
                                            class="badge bg-primary ms-2">{{ $paymentTypes[request('type')] ?? 'Unknown' }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        {{-- Filters --}}
                        <div class="card-body border-bottom pb-3">
                            <form method="GET" action="{{ route('payments.index') }}" class="row g-2 align-items-end">
                                <div class="col-md-4">
                                    <label class="form-label form-label-sm">Search</label>
                                    <input type="text" name="search" class="form-control form-control-sm"
                                        placeholder="Email, phone, order ID, payment ID..."
                                        value="{{ request('search') }}">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label form-label-sm">Status</label>
                                    <select name="status" class="form-control form-control-sm">
                                        <option value="">All Statuses</option>
                                        <option value="success" {{ request('status') === 'success' ? 'selected' : '' }}>
                                            Success</option>
                                        <option value="failed" {{ request('status') === 'failed' ? 'selected' : '' }}>
                                            Failed</option>
                                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>
                                            Pending</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label form-label-sm">Payment Method</label>
                                    <select name="method" class="form-control form-control-sm">
                                        <option value="">All Methods</option>
                                        <option value="upi" {{ request('method') === 'upi' ? 'selected' : '' }}>UPI
                                        </option>
                                        <option value="card" {{ request('method') === 'card' ? 'selected' : '' }}>Card
                                        </option>
                                        <option value="netbanking"
                                            {{ request('method') === 'netbanking' ? 'selected' : '' }}>Net Banking</option>
                                        <option value="wallet" {{ request('method') === 'wallet' ? 'selected' : '' }}>
                                            Wallet</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary btn-sm w-100">
                                        <i class="fa fa-search me-1"></i> Search
                                    </button>
                                </div>
                                <div class="col-md-2">
                                    <a href="{{ route('payments.index') }}" class="btn btn-secondary btn-sm w-100">
                                        <i class="fa fa-times me-1"></i> Clear
                                    </a>
                                </div>
                            </form>
                        </div>

                        

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Student</th>
                                            <th>Type / Method</th>
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
                                                    <span class="badge bg-info">
                                                        {{ ucfirst(str_replace('_', ' ', $payment->type)) }}
                                                    </span>
                                                    <br>
                                                    <small class="text-muted">
                                                        {{ ucfirst($payment->transaction_type ?? 'Unknown') }}
                                                    </small>
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
                                                    <div class="d-flex gap-1 justify-content-center">
                                                        <a href="{{ route('payments.show', $payment->id) }}"
                                                            class="btn btn-sm btn-icon btn-primary btn-round"
                                                            title="View Details">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        {{-- Delete form --}}
                                                        <form id="del-form-{{ $payment->id }}" method="POST"
                                                            action="{{ route('payments.destroy', $payment->id) }}"
                                                            style="display:none;">
                                                            @csrf @method('DELETE')
                                                        </form>
                                                        <button type="button"
                                                            class="btn btn-sm btn-icon btn-danger btn-round"
                                                            title="Delete" onclick="confirmDelete({{ $payment->id }})">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center py-5 text-muted">
                                                    <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                                    No payments found.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- Custom Pagination --}}
                        @if ($payments->hasPages())
                            <nav aria-label="Page navigation" class="card-footer">
                                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                                    <div class="text-muted" style="font-size:13px;">
                                        Showing
                                        <strong>{{ $payments->firstItem() }}</strong>–<strong>{{ $payments->lastItem() }}</strong>
                                        of <strong>{{ $payments->total() }}</strong> payments
                                    </div>
                                    <ul class="pagination pagination-sm mb-0">
                                        {{-- Previous Page Link --}}
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

                                        {{-- Page Number Links --}}
                                        @if ($payments->lastPage() > 1)
                                            @php
                                                $currentPage = $payments->currentPage();
                                                $lastPage = $payments->lastPage();
                                                $start = max(1, $currentPage - 2);
                                                $end = min($lastPage, $currentPage + 2);
                                            @endphp

                                            {{-- First page link --}}
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

                                            {{-- Page range --}}
                                            @foreach ($payments->getUrlRange($start, $end) as $page => $url)
                                                @if ($page == $currentPage)
                                                    <li class="page-item active">
                                                        <span class="page-link">
                                                            {{ $page }}
                                                            <span class="visually-hidden">(current)</span>
                                                        </span>
                                                    </li>
                                                @else
                                                    <li class="page-item">
                                                        <a class="page-link"
                                                            href="{{ $url }}">{{ $page }}</a>
                                                    </li>
                                                @endif
                                            @endforeach

                                            {{-- Last page link --}}
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

                                        {{-- Next Page Link --}}
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

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(id) {
            Swal.fire({
                title: 'Delete Payment Record?',
                text: 'This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e74a3b',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="fas fa-trash me-1"></i> Yes, Delete',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('del-form-' + id).submit();
                }
            });
        }

        
    </script>
@endsection
