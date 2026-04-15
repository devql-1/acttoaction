@extends('backend.layout.app')

@section('content')
<div class="container">
    <div class="page-inner">

        <div class="page-header">
            <h3 class="fw-bold mb-3">Workshop Registration #{{ $registration->id }}</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="{{ route('workshop-registrations.index') }}">Workshop Registrations</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">#{{ $registration->id }}</a></li>
            </ul>
        </div>

        <div class="row g-4">

            {{-- ── LEFT COLUMN ────────────────────────────────────────── --}}
            <div class="col-lg-8">

                {{-- REGISTRATION SUMMARY --}}
                <div class="card card-round mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <div class="card-title mb-0">Registration Summary</div>
                        @php
                            $badgeClass = match($registration->status) {
                                'confirmed' => 'badge-success',
                                'cancelled' => 'badge-danger',
                                default     => 'badge-warning',
                            };
                        @endphp
                        <span class="badge {{ $badgeClass }} px-3 py-2" style="font-size:13px;text-transform:capitalize;">
                            {{ $registration->status }}
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <p class="text-muted mb-1" style="font-size:12px;">Workshop</p>
                                <p class="fw-bold mb-0">{{ $registration->workshop_name ?? optional($registration->workshopSchool)->name ?? '—' }}</p>
                            </div>
                            <div class="col-sm-6">
                                <p class="text-muted mb-1" style="font-size:12px;">City · Age Group</p>
                                <p class="fw-bold mb-0">{{ $registration->city_name }} · {{ $registration->age_group_name }}</p>
                            </div>
                            <div class="col-sm-6">
                                <p class="text-muted mb-1" style="font-size:12px;">Workshop Fee</p>
                                <p class="fw-bold mb-0 {{ $registration->amount == 0 ? 'text-muted' : 'text-success' }}" style="font-size:18px;">
                                    {{ $registration->amount == 0 ? 'Free' : '₹' . number_format($registration->amount, 2) }}
                                </p>
                            </div>
                            <div class="col-sm-6">
                                <p class="text-muted mb-1" style="font-size:12px;">Registered On</p>
                                <p class="fw-bold mb-0">{{ $registration->created_at->format('d M Y, h:i A') }}</p>
                            </div>
                            @if($registration->razorpay_payment_id)
                                <div class="col-sm-6">
                                    <p class="text-muted mb-1" style="font-size:12px;">Payment ID</p>
                                    <p class="fw-bold mb-0" style="font-size:12px;word-break:break-all;">{{ $registration->razorpay_payment_id }}</p>
                                </div>
                                <div class="col-sm-6">
                                    <p class="text-muted mb-1" style="font-size:12px;">Order ID</p>
                                    <p class="fw-bold mb-0" style="font-size:12px;word-break:break-all;">{{ $registration->razorpay_order_id }}</p>
                                </div>
                            @endif
                            @if($registration->message)
                                <div class="col-12">
                                    <p class="text-muted mb-1" style="font-size:12px;">Message from Parent</p>
                                    <p class="mb-0 fst-italic">{{ $registration->message }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- STUDENT DETAILS --}}
                <div class="card card-round mb-4">
                    <div class="card-header">
                        <div class="card-title">Student Details</div>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <p class="text-muted mb-1" style="font-size:12px;">Student Name</p>
                                <p class="fw-bold mb-0">{{ $registration->student_name }}</p>
                            </div>
                            <div class="col-sm-6">
                                <p class="text-muted mb-1" style="font-size:12px;">Date of Birth</p>
                                <p class="fw-bold mb-0">
                                    @if($registration->dob)
                                        {{ $registration->dob->format('d M Y') }}
                                        <span class="text-muted fw-normal">(Age {{ $registration->dob->age }})</span>
                                    @else
                                        —
                                    @endif
                                </p>
                            </div>
                            <div class="col-sm-6">
                                <p class="text-muted mb-1" style="font-size:12px;">School</p>
                                <p class="fw-bold mb-0">{{ $registration->school_name ?: '—' }}</p>
                            </div>
                            <div class="col-sm-6">
                                <p class="text-muted mb-1" style="font-size:12px;">Experience Level</p>
                                <p class="fw-bold mb-0">
                                    @if($registration->experience && $registration->experience !== 'none')
                                        <span class="badge badge-info">{{ ucfirst($registration->experience) }}</span>
                                    @else
                                        <span class="text-muted">None / Not specified</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- MERCHANDISE SECTION — only if items selected --}}
                @if(!empty($registration->merchandise_items) && count($registration->merchandise_items) > 0)
                <div class="card card-round mb-4" style="border-left:4px solid #6366f1;">
                    <div class="card-header" style="background:linear-gradient(135deg,#f5f3ff,#ede9fe);">
                        <div class="card-title" style="color:#4f46e5;">
                            <i class="fa fa-shopping-bag me-2"></i>Merchandise Selected
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Item</th>
                                        <th class="text-center">Unit Price</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-end">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($registration->merchandise_items as $i => $item)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td class="fw-semibold">{{ $item['name'] ?? '—' }}</td>
                                            <td class="text-center">₹{{ number_format($item['price'] ?? 0, 2) }}</td>
                                            <td class="text-center">
                                                <span class="badge badge-secondary">× {{ $item['qty'] ?? 1 }}</span>
                                            </td>
                                            <td class="text-end fw-bold text-success">
                                                ₹{{ number_format(($item['price'] ?? 0) * ($item['qty'] ?? 1), 2) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr style="background:#f5f3ff;">
                                        <td colspan="4" class="text-end fw-bold" style="color:#4f46e5;">Merchandise Total</td>
                                        <td class="text-end fw-bold" style="color:#4f46e5;font-size:16px;">
                                            ₹{{ number_format($registration->merchandise_total, 2) }}
                                        </td>
                                    </tr>
                                    <tr style="background:#f0fdf4;">
                                        <td colspan="4" class="text-end fw-bold text-success">Grand Total (Fee + Merch)</td>
                                        <td class="text-end fw-bold text-success" style="font-size:18px;">
                                            ₹{{ number_format((float)$registration->amount + (float)$registration->merchandise_total, 2) }}
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                @endif

                {{-- SIBLINGS — other children in same booking --}}
                @if($siblings->count() > 0)
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-title">
                            Other Children in Same Booking
                            <span class="badge badge-secondary ms-1">{{ $siblings->count() }}</span>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Student Name</th>
                                        <th>DOB</th>
                                        <th>Experience</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($siblings as $sib)
                                        <tr>
                                            <td><span class="badge badge-secondary">#{{ $sib->id }}</span></td>
                                            <td class="fw-semibold">{{ $sib->student_name }}</td>
                                            <td>{{ $sib->dob ? $sib->dob->format('d M Y') : '—' }}</td>
                                            <td>{{ $sib->experience ? ucfirst($sib->experience) : '—' }}</td>
                                            <td class="text-center">
                                                @php
                                                    $sc = match($sib->status) { 'confirmed'=>'badge-success','cancelled'=>'badge-danger',default=>'badge-warning' };
                                                @endphp
                                                <span class="badge {{ $sc }}">{{ ucfirst($sib->status) }}</span>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('workshop-registrations.show', $sib->id) }}"
                                                   class="btn btn-sm btn-outline-primary">
                                                    <i class="fa fa-eye"></i> View
                                                </a>
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

            {{-- ── RIGHT COLUMN ───────────────────────────────────────── --}}
            <div class="col-lg-4">

                {{-- STATUS CONTROL --}}
                <div class="card card-round mb-4">
                    <div class="card-header">
                        <div class="card-title">Update Status</div>
                    </div>
                    <div class="card-body">
                        <select id="statusSelect" class="form-select mb-3" data-id="{{ $registration->id }}">
                            <option value="pending"   {{ $registration->status == 'pending'   ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ $registration->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="cancelled" {{ $registration->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        <button id="saveStatusBtn" class="btn btn-success w-100">
                            <i class="fa fa-save me-1"></i> Save Status
                        </button>
                    </div>
                </div>

                {{-- QUICK ACTIONS --}}
                <div class="card card-round mb-4">
                    <div class="card-header">
                        <div class="card-title">Quick Actions</div>
                    </div>
                    <div class="card-body d-grid gap-2">
                        <a href="{{ route('workshop-registrations.index') }}" class="btn btn-outline-secondary">
                            <i class="fa fa-arrow-left me-1"></i> Back to List
                        </a>
                        <a href="{{ route('workshop-registrations.export') }}?reg_id={{ $registration->id }}"
                           class="btn btn-outline-success">
                            <i class="fa fa-download me-1"></i> Export This Record
                        </a>
                    </div>
                </div>

                {{-- PARENT CONTACT --}}
                <div class="card card-round mb-4">
                    <div class="card-header">
                        <div class="card-title">Parent / Contact</div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div style="width:48px;height:48px;border-radius:50%;background:linear-gradient(135deg,#0ea5e9,#6366f1);display:flex;align-items:center;justify-content:center;color:#fff;font-size:20px;font-weight:700;flex-shrink:0;">
                                {{ strtoupper(substr($registration->parent_name ?? 'P', 0, 1)) }}
                            </div>
                            <div>
                                <div class="fw-bold">{{ $registration->parent_name }}</div>
                            </div>
                        </div>
                        @if($registration->email)
                            <p class="mb-2"><i class="fa fa-envelope me-2 text-muted"></i>{{ $registration->email }}</p>
                        @endif
                        @if($registration->phone)
                            <p class="mb-2"><i class="fa fa-phone me-2 text-muted"></i>{{ $registration->phone }}</p>
                        @endif
                        @if($registration->whatsapp)
                            <p class="mb-2">
                                <i class="fab fa-whatsapp me-2 text-success"></i>
                                <a href="https://wa.me/{{ preg_replace('/\D/', '', $registration->whatsapp) }}" target="_blank">
                                    {{ $registration->whatsapp }}
                                </a>
                            </p>
                        @endif
                        @if($registration->ip_address)
                            <p class="mb-0"><i class="fa fa-globe me-2 text-muted"></i><small class="text-muted">{{ $registration->ip_address }}</small></p>
                        @endif
                    </div>
                </div>

                {{-- AMOUNT SUMMARY --}}
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-title">Amount Summary</div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Workshop Fee</span>
                            <span class="fw-bold">{{ $registration->amount == 0 ? 'Free' : '₹' . number_format($registration->amount, 2) }}</span>
                        </div>
                        @if((float)$registration->merchandise_total > 0)
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Merchandise</span>
                                <span class="fw-bold" style="color:#6366f1;">₹{{ number_format($registration->merchandise_total, 2) }}</span>
                            </div>
                            <hr class="my-2">
                            <div class="d-flex justify-content-between">
                                <span class="fw-bold">Grand Total</span>
                                <span class="fw-bold text-success" style="font-size:18px;">
                                    ₹{{ number_format((float)$registration->amount + (float)$registration->merchandise_total, 2) }}
                                </span>
                            </div>
                        @else
                            <div class="d-flex justify-content-between">
                                <span class="fw-bold">Total Paid</span>
                                <span class="fw-bold text-success" style="font-size:18px;">
                                    {{ $registration->amount == 0 ? 'Free' : '₹' . number_format($registration->amount, 2) }}
                                </span>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.getElementById('saveStatusBtn').addEventListener('click', function () {
    const select = document.getElementById('statusSelect');
    fetch(`/admin/workshop-registrations/${select.dataset.id}/status`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ status: select.value })
    })
    .then(r => r.json())
    .then(r => {
        if (r.success) {
            Swal.fire({ icon: 'success', title: 'Status Updated', toast: true, position: 'top-end', timer: 1800, showConfirmButton: false });
        }
    })
    .catch(() => {
        Swal.fire({ icon: 'error', title: 'Update failed', toast: true, position: 'top-end', timer: 2000, showConfirmButton: false });
    });
});
</script>
@endsection
