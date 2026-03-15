{{-- resources/views/backend/enrollments/show.blade.php --}}
@extends('backend.layout.app')
@section('content')

    <div class="container-fluid">
        <div class="page-inner">

            <div class="d-flex align-items-center justify-content-between pt-2 pb-4">
                <div>
                    <h3 class="fw-bold mb-1">Enrollment Detail</h3>
                    <h6 class="text-muted mb-0">{{ $enrollment->reference_id ?? 'No Reference' }}</h6>
                </div>
                <a href="#" class="btn btn-light btn-round">
                    <i class="fas fa-arrow-left me-1"></i> Back
                </a>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row">

                {{-- ── Left: Student info ── --}}
                <div class="col-md-8">
                    <div class="card card-round mb-4">
                        <div class="card-header">
                            <div class="card-title">Student Information</div>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                @php
                                    $fields = [
                                        'Full Name' => $enrollment->first_name . ' ' . $enrollment->last_name,
                                        'Date of Birth' => $enrollment->dob,
                                        'Age' => $enrollment->age . ' years',
                                        'Gender' => $enrollment->gender,
                                        "Father's Name" => $enrollment->father_name,
                                        "Mother's Name" => $enrollment->mother_name,
                                        'Phone' => $enrollment->phone,
                                        'Email' => $enrollment->email,
                                        'School' => $enrollment->school,
                                        'Class/Grade' => $enrollment->grade,
                                        'State' => $enrollment->state,
                                        'City' => $enrollment->city ?? '—',
                                        'Centre' => $enrollment->centre,
                                        'Mode' => $enrollment->mode,
                                        'Course' => $enrollment->course,
                                        'Address' => $enrollment->address ?? '—',
                                    ];
                                @endphp
                                @foreach ($fields as $label => $value)
                                    <div class="col-sm-6">
                                        <div
                                            style="font-size:11px;font-weight:600;color:#6b7a99;text-transform:uppercase;letter-spacing:.4px;margin-bottom:2px;">
                                            {{ $label }}
                                        </div>
                                        <div style="font-size:14px;font-weight:500;color:#0e1c35;">
                                            {{ $value ?: '—' }}
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- ── Payment history ── --}}
                    @if ($enrollment->payments->count() > 0)
                        <div class="card card-round">
                            <div class="card-header">
                                <div class="card-title">Payment History</div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table align-middle mb-0">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Payment ID</th>
                                                <th>Order ID</th>
                                                <th class="text-end">Amount</th>
                                                <th class="text-center">Status</th>
                                                <th class="text-end">Paid At</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($enrollment->payments as $p)
                                                <tr>
                                                    <td><code style="font-size:11px;">{{ $p->razorpay_payment_id }}</code>
                                                    </td>
                                                    <td><code style="font-size:11px;">{{ $p->razorpay_order_id }}</code>
                                                    </td>
                                                    <td class="text-end fw-bold" style="color:#059669;">
                                                        ₹{{ number_format($p->amount) }}
                                                    </td>
                                                    <td class="text-center">
                                                        <span
                                                            class="badge badge-{{ $p->status === 'paid' ? 'success' : 'danger' }}">
                                                            {{ ucfirst($p->status) }}
                                                        </span>
                                                    </td>
                                                    <td class="text-end" style="font-size:12px;">
                                                        {{ $p->paid_at ? $p->paid_at->format('d M Y, g:ia') : '—' }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- ── Right: Status + Actions ── --}}
                <div class="col-md-4">
                    <div class="card card-round mb-4">
                        <div class="card-header">
                            <div class="card-title">Enrollment Status</div>
                        </div>
                        <div class="card-body">
                            @php
                                $badge =
                                    [
                                        'paid' => 'success',
                                        'pending' => 'warning',
                                        'lead' => 'info',
                                        'cancelled' => 'danger',
                                    ][$enrollment->status] ?? 'secondary';
                            @endphp
                            <div class="text-center mb-4">
                                <span class="badge badge-{{ $badge }}" style="font-size:16px;padding:10px 24px;">
                                    {{ ucfirst($enrollment->status) }}
                                </span>
                            </div>
                            <form method="POST" action="#">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label fw-bold" style="font-size:13px;">Update Status</label>
                                    <select name="status" class="form-select form-select-sm">
                                        <option value="lead" {{ $enrollment->status === 'lead' ? 'selected' : '' }}>
                                            Lead</option>
                                        <option value="pending" {{ $enrollment->status === 'pending' ? 'selected' : '' }}>
                                            Pending</option>
                                        <option value="paid" {{ $enrollment->status === 'paid' ? 'selected' : '' }}>
                                            Paid</option>
                                        <option value="cancelled"
                                            {{ $enrollment->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary btn-sm w-100">
                                    <i class="fas fa-save me-1"></i> Update Status
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="card card-round">
                        <div class="card-header">
                            <div class="card-title">Summary</div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted" style="font-size:13px;">Reference ID</span>
                                <code style="font-size:12px;">{{ $enrollment->reference_id ?? '—' }}</code>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted" style="font-size:13px;">Course Fee</span>
                                <strong style="color:#059669;">₹{{ number_format($enrollment->fee ?? 0) }}</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted" style="font-size:13px;">Enrolled On</span>
                                <span style="font-size:13px;">{{ $enrollment->created_at->format('d M Y') }}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted" style="font-size:13px;">Newsletter</span>
                                <span style="font-size:13px;">{{ $enrollment->newsletter ? 'Yes' : 'No' }}</span>
                            </div>
                            <hr>
                            <form method="POST" action="{{ route('enrollments.destroy', $enrollment->id) }}"
                                onsubmit="return confirm('Permanently delete this enrollment?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm w-100">
                                    <i class="fas fa-trash me-1"></i> Delete Enrollment
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
