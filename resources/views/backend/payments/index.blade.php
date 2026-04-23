@extends('backend.layout.app')
@section('content')
<div class="container">
    <div class="page-inner">

        {{-- PAGE HEADER --}}
        <div class="page-header">
            <h3 class="fw-bold mb-3">Payments</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="{{ url('/admin') }}"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="{{ route('payments.index') }}">Payments</a></li>
            </ul>
        </div>

        {{-- STATS --}}
        <div class="row mb-4">
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
                                    <p class="card-category">Collected</p>
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
                                <div class="icon-big text-center icon-warning bubble-shadow-small">
                                    <i class="fas fa-clock"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Pending</p>
                                    <h4 class="card-title">{{ $stats['pending'] ?? 0 }}</h4>
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
        </div>

        {{-- FILTERS --}}
        <div class="card card-round mb-4">
            <div class="card-header">
                <div class="card-head-row">
                    <div class="card-title">Filters</div>
                    @if(request()->hasAny(['search','status','type']))
                        <div class="card-tools">
                            <a href="{{ route('payments.index') }}" class="btn btn-outline-secondary btn-sm">
                                <i class="fa fa-times me-1"></i> Clear
                            </a>
                        </div>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('payments.index') }}">
                    <div class="row g-3 align-items-end">

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Search</label>
                            <input type="text" name="search" class="form-control"
                                placeholder="Email, phone, order ID, payment ID…"
                                value="{{ request('search') }}">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Type</label>
                            <select name="type" class="form-select">
                                <option value="">All Types</option>
                                @foreach ($paymentTypes as $k => $label)
                                    <option value="{{ $k }}" {{ request('type') === $k ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Status</label>
                            <select name="status" class="form-select">
                                <option value="">All Statuses</option>
                                <option value="success" {{ request('status') === 'success' ? 'selected' : '' }}>Success</option>
                                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="failed"  {{ request('status') === 'failed'  ? 'selected' : '' }}>Failed</option>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-search me-1"></i> Search
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>

        {{-- TABLE --}}
        <div class="card card-round">
            <div class="card-header">
                <div class="card-head-row card-tools-still-right">
                    <div class="card-title">
                        Transactions
                        <span class="badge bg-primary ms-1">{{ $payments->total() }}</span>
                        @if (request('type'))
                            <span class="badge bg-info ms-1">
                                {{ $paymentTypes[request('type')] ?? 'Unknown' }}
                            </span>
                        @endif
                    </div>
                    <div class="card-tools">
                        <a href="{{ route('payments.export', request()->query()) }}"
                           class="btn btn-success btn-sm">
                            <i class="fas fa-file-csv me-1"></i> Export CSV
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th style="width:70px;">#</th>
                                <th>Customer</th>
                                <th>Type</th>
                                <th class="text-end">Amount</th>
                                <th class="text-center">Status</th>
                                <th>Payment ID</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($payments as $payment)
                                @php
                                    $statusMap = [
                                        'success' => ['success', 'check-circle'],
                                        'failed'  => ['danger',  'times-circle'],
                                        'pending' => ['warning', 'clock'],
                                    ];
                                    [$sBg, $sIcon] = $statusMap[$payment->status] ?? ['secondary', 'question-circle'];

                                    $displayName = $payment->enrollment
                                        ? trim(($payment->enrollment->first_name ?? '') . ' ' . ($payment->enrollment->last_name ?? ''))
                                        : ($payment->email ?? '—');
                                    $initial = strtoupper(mb_substr($displayName ?: 'U', 0, 1));
                                @endphp
                                <tr>
                                    <td class="text-muted small">#{{ $payment->id }}</td>

                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <span class="avatar-title rounded-circle bg-primary text-white fw-bold"
                                                  style="width:34px;height:34px;display:inline-flex;align-items:center;justify-content:center;">
                                                {{ $initial }}
                                            </span>
                                            <div>
                                                <div class="fw-bold" style="font-size:13px;">
                                                    {{ $displayName ?: '—' }}
                                                </div>
                                                <small class="text-muted">
                                                    {{ $payment->contact ?? $payment->email ?? '—' }}
                                                </small>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <span class="badge bg-info">
                                            {{ ucfirst(str_replace('_', ' ', $payment->type)) }}
                                        </span>
                                        @if ($payment->transaction_type)
                                            <br>
                                            <small class="text-muted">{{ ucfirst($payment->transaction_type) }}</small>
                                        @endif
                                    </td>

                                    <td class="text-end fw-bold text-success">
                                        {{ $payment->currency }} {{ number_format($payment->amount, 2) }}
                                    </td>

                                    <td class="text-center">
                                        <span class="badge badge-{{ $sBg }}">
                                            <i class="fa fa-{{ $sIcon }} me-1"></i>
                                            {{ ucfirst($payment->status) }}
                                        </span>
                                    </td>

                                    <td>
                                        @if ($payment->razorpay_payment_id)
                                            <code class="small" title="{{ $payment->razorpay_payment_id }}">
                                                {{ \Illuminate\Support\Str::limit($payment->razorpay_payment_id, 18) }}
                                            </code>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>

                                    <td class="text-center text-muted small text-nowrap">
                                        @if ($payment->paid_at)
                                            {{ $payment->paid_at->format('d M Y') }}<br>
                                            <small>{{ $payment->paid_at->format('h:i A') }}</small>
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        <div class="d-flex gap-1 justify-content-center">
                                            <a href="{{ route('payments.show', $payment->id) }}"
                                               class="btn btn-sm btn-outline-primary" title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <form id="del-form-{{ $payment->id }}" method="POST"
                                                  action="{{ route('payments.destroy', $payment->id) }}"
                                                  style="display:none;">
                                                @csrf @method('DELETE')
                                            </form>
                                            <button type="button"
                                                    class="btn btn-sm btn-outline-danger"
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
                                        No payments found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if ($payments->hasPages())
                <div class="card-footer">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <div class="text-muted" style="font-size:13px;">
                            Showing
                            <strong>{{ $payments->firstItem() }}</strong>–<strong>{{ $payments->lastItem() }}</strong>
                            of <strong>{{ $payments->total() }}</strong>
                        </div>
                        <div>
                            {{ $payments->withQueryString()->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            @endif
        </div>

    </div>
</div>
@endsection

@push('after_scripts')
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
@endpush
