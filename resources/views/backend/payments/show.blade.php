@extends('backend.layout.app')
@section('content')
@php
    $statusMap = [
        'success' => ['success', 'check-circle',  '#059669'],
        'failed'  => ['danger',  'times-circle',  '#dc2626'],
        'pending' => ['warning', 'clock',         '#d97706'],
    ];
    [$sBg, $sIcon, $sColor] = $statusMap[$payment->status] ?? ['secondary', 'question-circle', '#6b7280'];

    $enrollmentStatusMap = [
        'confirmed' => 'success',
        'pending'   => 'warning',
        'lead'      => 'info',
        'cancelled' => 'danger',
    ];
@endphp

<style>
    .kv-label        { font-size: 11px; text-transform: uppercase; letter-spacing:.4px; color:#8e95a9; font-weight:600; margin-bottom:2px; }
    .kv-value        { font-size: 14px; font-weight: 600; color:#1f2937; word-break: break-word; }
    .kv-value code   { font-size: 12px; }
    .payment-hero    { border-left: 4px solid {{ $sColor }}; }
    .copy-btn        { padding:2px 8px; font-size:11px; line-height:1.4; }
    .avatar-lg {
        width:70px; height:70px; border-radius:50%;
        display:inline-flex; align-items:center; justify-content:center;
        font-size:28px; font-weight:700; color:#fff; background:#4e73df;
    }
</style>

<div class="container">
    <div class="page-inner">

        {{-- PAGE HEADER --}}
        <div class="page-header">
            <div class="d-flex align-items-start justify-content-between flex-wrap gap-2">
                <div>
                    <h3 class="fw-bold mb-1">Payment Details</h3>
                    <ul class="breadcrumbs mb-0">
                        <li class="nav-home"><a href="{{ url('/admin') }}"><i class="icon-home"></i></a></li>
                        <li class="separator"><i class="icon-arrow-right"></i></li>
                        <li class="nav-item"><a href="{{ route('payments.index') }}">Payments</a></li>
                        <li class="separator"><i class="icon-arrow-right"></i></li>
                        <li class="nav-item">
                            <a href="#">#{{ $payment->id }}</a>
                        </li>
                    </ul>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('payments.index') }}" class="btn btn-sm btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i> Back
                    </a>
                    <form method="POST" action="{{ route('payments.destroy', $payment->id) }}"
                          onsubmit="return confirmDelete(event);" class="d-inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger">
                            <i class="fas fa-trash me-1"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- HERO: amount + status + IDs --}}
        <div class="card card-round mb-4 payment-hero">
            <div class="card-body">
                <div class="row align-items-center g-3">
                    <div class="col-md-4">
                        <div class="kv-label">Amount</div>
                        <div style="font-size:30px;font-weight:800;color:{{ $sColor }};line-height:1.1;">
                            {{ $payment->currency }} {{ number_format($payment->amount, 2) }}
                        </div>
                        <div class="mt-2">
                            <span class="badge badge-{{ $sBg }}" style="font-size:12px;padding:6px 12px;">
                                <i class="fa fa-{{ $sIcon }} me-1"></i>
                                {{ ucfirst($payment->status) }}
                            </span>
                            <span class="badge bg-info ms-1" style="font-size:12px;padding:6px 12px;">
                                {{ ucfirst(str_replace('_', ' ', $payment->type)) }}
                            </span>
                            @if ($payment->transaction_type)
                                <span class="badge bg-secondary ms-1" style="font-size:12px;padding:6px 12px;">
                                    {{ ucfirst($payment->transaction_type) }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="kv-label">Payment ID</div>
                        <div class="kv-value d-flex align-items-center gap-2">
                            @if ($payment->razorpay_payment_id)
                                <code>{{ $payment->razorpay_payment_id }}</code>
                                <button type="button" class="btn btn-outline-secondary copy-btn"
                                        onclick="copyToClipboard('{{ $payment->razorpay_payment_id }}')">
                                    <i class="fas fa-copy"></i>
                                </button>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </div>

                        <div class="kv-label mt-3">Order ID</div>
                        <div class="kv-value d-flex align-items-center gap-2">
                            @if ($payment->razorpay_order_id)
                                <code>{{ $payment->razorpay_order_id }}</code>
                                <button type="button" class="btn btn-outline-secondary copy-btn"
                                        onclick="copyToClipboard('{{ $payment->razorpay_order_id }}')">
                                    <i class="fas fa-copy"></i>
                                </button>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="kv-label">Paid At</div>
                        <div class="kv-value">
                            @if ($payment->paid_at)
                                {{ $payment->paid_at->format('d M Y, h:i A') }}
                                <div class="text-muted small fw-normal">{{ $payment->paid_at->diffForHumans() }}</div>
                            @else
                                <span class="text-muted">Not yet paid</span>
                            @endif
                        </div>

                        <div class="kv-label mt-3">Created</div>
                        <div class="kv-value">
                            {{ $payment->created_at->format('d M Y, h:i A') }}
                            <div class="text-muted small fw-normal">{{ $payment->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- FAILURE ALERT --}}
        @if ($payment->status === 'failed' && ($payment->error_code || $payment->error_reason))
            <div class="alert alert-danger d-flex align-items-start gap-2 mb-4">
                <i class="fas fa-exclamation-triangle mt-1"></i>
                <div>
                    <div class="fw-bold">Payment failed</div>
                    @if ($payment->error_code)
                        <div><strong>Code:</strong> <code>{{ $payment->error_code }}</code></div>
                    @endif
                    @if ($payment->error_reason)
                        <div><strong>Reason:</strong> {{ $payment->error_reason }}</div>
                    @endif
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-lg-8">

                {{-- CONTACT --}}
                <div class="card card-round mb-4">
                    <div class="card-header">
                        <div class="card-title">Contact</div>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="kv-label">Email</div>
                                <div class="kv-value">
                                    @if ($payment->email)
                                        <a href="mailto:{{ $payment->email }}">{{ $payment->email }}</a>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="kv-label">Phone</div>
                                <div class="kv-value">
                                    @if ($payment->contact)
                                        <a href="tel:{{ $payment->contact }}">{{ $payment->contact }}</a>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </div>
                            </div>

                            @if ($payment->bank || $payment->wallet || $payment->vpa)
                                <div class="col-12"><hr class="my-1"></div>
                                @if ($payment->vpa)
                                    <div class="col-md-4">
                                        <div class="kv-label">UPI (VPA)</div>
                                        <div class="kv-value">{{ $payment->vpa }}</div>
                                    </div>
                                @endif
                                @if ($payment->bank)
                                    <div class="col-md-4">
                                        <div class="kv-label">Bank</div>
                                        <div class="kv-value">{{ $payment->bank }}</div>
                                    </div>
                                @endif
                                @if ($payment->wallet)
                                    <div class="col-md-4">
                                        <div class="kv-label">Wallet</div>
                                        <div class="kv-value">{{ $payment->wallet }}</div>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>

                {{-- ADDITIONAL --}}
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-title">Additional Information</div>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="kv-label">Description</div>
                                <div class="kv-value">{{ $payment->description ?: '—' }}</div>
                            </div>
                            <div class="col-md-6">
                                <div class="kv-label">Updated At</div>
                                <div class="kv-value">
                                    {{ $payment->updated_at->format('d M Y, h:i A') }}
                                    <div class="text-muted small fw-normal">{{ $payment->updated_at->diffForHumans() }}</div>
                                </div>
                            </div>
                            @if ($payment->razorpay_signature)
                                <div class="col-12">
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <div class="kv-label mb-0">Signature</div>
                                        <button type="button" class="btn btn-outline-secondary copy-btn"
                                                onclick="copyToClipboard('{{ $payment->razorpay_signature }}')">
                                            <i class="fas fa-copy me-1"></i> Copy
                                        </button>
                                    </div>
                                    <code class="d-block p-2 bg-light rounded"
                                          style="font-size:11px;word-break:break-all;overflow-wrap:anywhere;line-height:1.5;">{{ $payment->razorpay_signature }}</code>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">

                {{-- ENROLLMENT / CUSTOMER --}}
                @if ($payment->enrollment)
                    @php
                        $e = $payment->enrollment;
                        $eStatus = $enrollmentStatusMap[$e->status] ?? 'secondary';
                        $fullName = trim(($e->first_name ?? '') . ' ' . ($e->last_name ?? ''));
                    @endphp
                    <div class="card card-round mb-4">
                        <div class="card-header">
                            <div class="card-title">Customer</div>
                        </div>
                        <div class="card-body text-center">
                            <div class="avatar-lg mx-auto mb-2">
                                {{ strtoupper(mb_substr($fullName ?: 'U', 0, 1)) }}
                            </div>
                            <h6 class="fw-bold mb-0">{{ $fullName ?: '—' }}</h6>
                            <small class="text-muted">{{ $e->email }}</small>

                            <div class="mt-3">
                                <span class="badge badge-{{ $eStatus }}">
                                    {{ ucfirst($e->status ?? 'unknown') }}
                                </span>
                            </div>
                        </div>
                        <ul class="list-group list-group-flush">
                            @if ($e->phone)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span class="text-muted small"><i class="fa fa-phone me-2"></i>Phone</span>
                                    <a href="tel:{{ $e->phone }}" class="fw-semibold">{{ $e->phone }}</a>
                                </li>
                            @endif
                            @if ($e->course)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span class="text-muted small"><i class="fa fa-book me-2"></i>Course</span>
                                    <span class="fw-semibold text-end">{{ $e->course }}</span>
                                </li>
                            @endif
                            @if ($e->centre)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span class="text-muted small"><i class="fa fa-map-marker me-2"></i>Centre</span>
                                    <span class="fw-semibold text-end">{{ $e->centre }}</span>
                                </li>
                            @endif
                            @if ($e->reference_id)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <span class="text-muted small"><i class="fa fa-hashtag me-2"></i>Ref</span>
                                    <code style="font-size:11px;">{{ $e->reference_id }}</code>
                                </li>
                            @endif
                        </ul>
                        <div class="card-body pt-3">
                            <a href="{{ route('enrollments.show', $e->id) }}" class="btn btn-primary w-100 btn-sm">
                                <i class="fas fa-arrow-right me-1"></i> View Enrollment
                            </a>
                        </div>
                    </div>
                @else
                    <div class="alert alert-info d-flex align-items-start gap-2 mb-4">
                        <i class="fas fa-info-circle mt-1"></i>
                        <div>
                            <strong>No enrollment linked</strong><br>
                            <small>This payment is not associated with an enrollment record.</small>
                        </div>
                    </div>
                @endif

                {{-- RELATED --}}
                @if ($relatedPayments->count() > 0)
                    <div class="card card-round">
                        <div class="card-header">
                            <div class="card-title">
                                Related Payments
                                <span class="badge bg-primary ms-1">{{ $relatedPayments->count() }}</span>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="list-group list-group-flush">
                                @foreach ($relatedPayments as $related)
                                    @php
                                        [$rBg] = $statusMap[$related->status] ?? ['secondary'];
                                    @endphp
                                    <a href="{{ route('payments.show', $related->id) }}"
                                       class="list-group-item list-group-item-action">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <div class="fw-bold">
                                                    {{ $related->currency }} {{ number_format($related->amount, 2) }}
                                                </div>
                                                <small class="text-muted">
                                                    {{ ucfirst(str_replace('_', ' ', $related->type)) }}
                                                </small>
                                            </div>
                                            <span class="badge badge-{{ $rBg }}">
                                                {{ ucfirst($related->status) }}
                                            </span>
                                        </div>
                                        <small class="text-muted d-block mt-1">
                                            {{ $related->created_at->format('d M Y, h:i A') }}
                                        </small>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>

    </div>
</div>
@endsection

@push('after_scripts')
<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function () {
            toastr.success('Copied to clipboard');
        }).catch(function () {
            toastr.error('Failed to copy');
        });
    }

    function confirmDelete(e) {
        e.preventDefault();
        var form = e.target;
        Swal.fire({
            title: 'Delete payment record?',
            text: 'This cannot be undone.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e74a3b',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, Delete',
            cancelButtonText: 'Cancel'
        }).then(function (result) {
            if (result.isConfirmed) form.submit();
        });
        return false;
    }
</script>
@endpush
