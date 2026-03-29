@extends('backend.layout.app')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <div class="d-flex align-items-center justify-content-between">
                    <h3 class="fw-bold mb-3">Payment Details</h3>
                    <div class="gap-2">
                        <a href="{{ route('payments.index') }}" class="btn btn-sm btn-secondary">
                            <i class="fas fa-arrow-left me-1"></i> Back
                        </a>
                    </div>
                </div>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="{{ route('payments.index') }}">Payments</a></li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="#">{{ $payment->razorpay_payment_id }}</a></li>
                </ul>
            </div>

            <div class="row">
                {{-- Main Payment Details --}}
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between">
                                <h5 class="card-title mb-0">Transaction Details</h5>
                                <span
                                    class="badge badge-{{ $payment->status === 'success' ? 'success' : ($payment->status === 'failed' ? 'danger' : 'warning') }}">
                                    {{ ucfirst($payment->status) }}
                                </span>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label text-muted">Payment ID</label>
                                    <div class="fw-bold d-flex align-items-center gap-2">
                                        <code style="font-size:12px;">{{ $payment->razorpay_payment_id }}</code>
                                        <button type="button" class="btn btn-sm btn-outline-secondary"
                                            onclick="copyToClipboard('{{ $payment->razorpay_payment_id }}')">
                                            <i class="fas fa-copy"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-muted">Order ID</label>
                                    <div class="fw-bold d-flex align-items-center gap-2">
                                        <code style="font-size:12px;">{{ $payment->razorpay_order_id }}</code>
                                        <button type="button" class="btn btn-sm btn-outline-secondary"
                                            onclick="copyToClipboard('{{ $payment->razorpay_order_id }}')">
                                            <i class="fas fa-copy"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label text-muted">Amount</label>
                                    <div class="fw-bold" style="font-size:18px; color:#059669;">
                                        {{ $payment->currency }} {{ number_format($payment->amount, 2) }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-muted">Currency</label>
                                    <div class="fw-bold">{{ $payment->currency }}</div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label text-muted">Payment Type</label>
                                    <div class="fw-bold">
                                        <span
                                            class="badge bg-info">{{ ucfirst(str_replace('_', ' ', $payment->type)) }}</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-muted">Transaction Type (Method)</label>
                                    <div class="fw-bold">
                                        <span
                                            class="badge bg-primary">{{ ucfirst($payment->transaction_type ?? 'Unknown') }}</span>
                                    </div>
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label class="form-label text-muted">Paid At</label>
                                    @if ($payment->paid_at)
                                        <div>
                                            <div class="fw-bold">{{ $payment->paid_at->format('d M Y, H:i:s') }}</div>
                                            <small class="text-muted">{{ $payment->paid_at->diffForHumans() }}</small>
                                        </div>
                                    @else
                                        <div class="text-muted">Not yet paid</div>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label text-muted">Created At</label>
                                    <div>
                                        <div class="fw-bold">{{ $payment->created_at->format('d M Y, H:i:s') }}</div>
                                        <small class="text-muted">{{ $payment->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                            </div>

                            @if ($payment->status === 'failed')
                                <div class="alert alert-danger" role="alert">
                                    <h6 class="alert-heading fw-bold mb-2">
                                        <i class="fas fa-exclamation-triangle me-2"></i> Error Details
                                    </h6>
                                    <p class="mb-1"><strong>Error Code:</strong> {{ $payment->error_code }}</p>
                                    <p class="mb-0"><strong>Reason:</strong> {{ $payment->error_reason }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Contact Information --}}
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Contact Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-muted">Email</label>
                                    <div class="fw-bold">
                                        <a href="mailto:{{ $payment->email }}">{{ $payment->email }}</a>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-muted">Phone</label>
                                    <div class="fw-bold">
                                        <a href="tel:{{ $payment->contact }}">{{ $payment->contact }}</a>
                                    </div>
                                </div>
                            </div>
                            @if ($payment->bank || $payment->wallet || $payment->vpa)
                                <hr class="my-3">
                                <div class="row">
                                    @if ($payment->bank)
                                        <div class="col-md-4 mb-2">
                                            <label class="form-label text-muted">Bank</label>
                                            <div class="fw-bold">{{ $payment->bank }}</div>
                                        </div>
                                    @endif
                                    @if ($payment->wallet)
                                        <div class="col-md-4 mb-2">
                                            <label class="form-label text-muted">Wallet</label>
                                            <div class="fw-bold">{{ $payment->wallet }}</div>
                                        </div>
                                    @endif
                                    @if ($payment->vpa)
                                        <div class="col-md-4 mb-2">
                                            <label class="form-label text-muted">VPA (UPI)</label>
                                            <div class="fw-bold">{{ $payment->vpa }}</div>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Additional Info --}}
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">Additional Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-muted">Description</label>
                                    <div class="fw-bold">{{ $payment->description ?? '—' }}</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-muted">Signature</label>
                                    <small
                                        class="text-muted d-block text-break">{{ substr($payment->razorpay_signature, 0, 40) }}...</small>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label text-muted">Updated At</label>
                                    <div class="fw-bold">{{ $payment->updated_at->format('d M Y, H:i:s') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="col-md-4">
                    {{-- Enrollment Info --}}
                    @if ($payment->enrollment)
                        <div class="card mb-3">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Enrollment Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="text-center mb-3">
                                    <div class="avatar avatar-xl mx-auto mb-2">
                                        <span class="avatar-title rounded-circle bg-primary text-white"
                                            style="font-size:24px;width:60px;height:60px;display:inline-flex;align-items:center;justify-content:center;">
                                            {{ strtoupper(substr($payment->enrollment->first_name, 0, 1)) }}
                                        </span>
                                    </div>
                                    <h6 class="fw-bold">
                                        {{ $payment->enrollment->first_name }} {{ $payment->enrollment->last_name }}
                                    </h6>
                                    <small class="text-muted">{{ $payment->enrollment->email }}</small>
                                </div>

                                <hr class="my-3">

                                <div class="mb-3">
                                    <label class="form-label text-muted" style="font-size:12px;">Phone</label>
                                    <div class="fw-bold">{{ $payment->enrollment->phone }}</div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label text-muted" style="font-size:12px;">Course</label>
                                    <div class="fw-bold">{{ $payment->enrollment->course }}</div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label text-muted" style="font-size:12px;">Centre</label>
                                    <div class="fw-bold">{{ $payment->enrollment->centre }}</div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label text-muted" style="font-size:12px;">Reference ID</label>
                                    <div class="fw-bold">{{ $payment->enrollment->reference_id }}</div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label text-muted" style="font-size:12px;">Enrollment Status</label>
                                    @php
                                        $statusBadge =
                                            [
                                                'confirmed' => 'success',
                                                'pending' => 'warning',
                                                'lead' => 'info',
                                                'cancelled' => 'danger',
                                            ][$payment->enrollment->status] ?? 'secondary';
                                    @endphp
                                    <div>
                                        <span class="badge badge-{{ $statusBadge }}">
                                            {{ ucfirst($payment->enrollment->status) }}
                                        </span>
                                    </div>
                                </div>

                                <a href="{{ route('enrollments.show', $payment->enrollment->id) }}"
                                    class="btn btn-sm btn-primary w-100 mt-3">
                                    <i class="fas fa-arrow-right me-1"></i> View Enrollment
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-info" role="alert">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>No enrollment linked</strong> to this payment
                        </div>
                    @endif

                    {{-- Related Payments --}}
                    @if ($relatedPayments->count() > 0)
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Related Payments</h5>
                            </div>
                            <div class="card-body p-0">
                                <div class="list-group list-group-flush">
                                    @foreach ($relatedPayments as $related)
                                        <a href="{{ route('payments.show', $related->id) }}"
                                            class="list-group-item list-group-item-action p-3 {{ $related->id === $payment->id ? 'active' : '' }}">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div>
                                                    <h6 class="mb-1">
                                                        {{ $related->currency }} {{ number_format($related->amount, 2) }}
                                                    </h6>
                                                    <small class="text-muted">
                                                        {{ ucfirst(str_replace('_', ' ', $related->type)) }}
                                                    </small>
                                                </div>
                                                <span
                                                    class="badge badge-{{ $related->status === 'success' ? 'success' : 'danger' }}">
                                                    {{ ucfirst($related->status) }}
                                                </span>
                                            </div>
                                            <small class="text-muted d-block mt-2">
                                                {{ $related->created_at->format('d M Y H:i') }}
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

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(() => {
                Swal.fire({
                    icon: 'success',
                    title: 'Copied!',
                    text: 'Text copied to clipboard',
                    timer: 1500,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end',
                });
            });
        }

        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Done!',
                text: '{{ session('success') }}',
                timer: 2500,
                showConfirmButton: false,
                toast: true,
                position: 'top-end',
            });
        @endif
    </script>
@endsection
