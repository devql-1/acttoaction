@extends('backend.layout.app')

@section('content')
<div class="container">
    <div class="page-inner">

        {{-- HEADER --}}
        <div class="page-header">
            <h3 class="fw-bold mb-3">Registration Detail</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="{{ route('event-registrations.index') }}">Registrations</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">{{ $registration->registration_number }}</a></li>
            </ul>
        </div>

        <div class="row g-4">

            {{-- ── LEFT COLUMN ─────────────────────────────────────────── --}}
            <div class="col-lg-8">

                {{-- REGISTRATION SUMMARY CARD --}}
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
                                <p class="text-muted mb-1" style="font-size:12px;">Registration #</p>
                                <p class="fw-bold mb-0">{{ $registration->registration_number }}</p>
                            </div>
                            <div class="col-sm-6">
                                <p class="text-muted mb-1" style="font-size:12px;">Registered On</p>
                                <p class="fw-bold mb-0">{{ $registration->created_at->format('d M Y, h:i A') }}</p>
                            </div>
                            <div class="col-sm-6">
                                <p class="text-muted mb-1" style="font-size:12px;">Event</p>
                                <p class="fw-bold mb-0">{{ optional($registration->event)->title ?? '—' }}</p>
                            </div>
                            <div class="col-sm-6">
                                <p class="text-muted mb-1" style="font-size:12px;">Session / Sub-Event</p>
                                <p class="fw-bold mb-0">{{ optional($registration->subEvent)->title ?? '—' }}</p>
                            </div>
                            <div class="col-sm-6">
                                <p class="text-muted mb-1" style="font-size:12px;">Tickets</p>
                                <p class="fw-bold mb-0">
                                    <span class="badge badge-info px-3">{{ $registration->tickets }} ticket{{ $registration->tickets != 1 ? 's' : '' }}</span>
                                </p>
                            </div>
                            <div class="col-sm-6">
                                <p class="text-muted mb-1" style="font-size:12px;">Total Amount</p>
                                <p class="fw-bold mb-0 {{ $registration->total_amount == 0 ? 'text-muted' : 'text-success' }}" style="font-size:18px;">
                                    {{ $registration->total_amount == 0 ? 'Free' : '₹' . number_format($registration->total_amount, 2) }}
                                </p>
                            </div>
                            @if($registration->center)
                                <div class="col-sm-6">
                                    <p class="text-muted mb-1" style="font-size:12px;">Center</p>
                                    <p class="fw-bold mb-0">{{ $registration->center->name }}</p>
                                </div>
                            @endif
                            @if($registration->city || $registration->state)
                                <div class="col-sm-6">
                                    <p class="text-muted mb-1" style="font-size:12px;">Location</p>
                                    <p class="fw-bold mb-0">{{ implode(', ', array_filter([$registration->city, $registration->state])) }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- ATTENDEES TABLE --}}
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-title">
                            Attendees
                            <span class="badge badge-secondary ms-1">{{ $registration->attendees->count() }}</span>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="width:60px">#</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Email</th>
                                        <th>DOB</th>
                                        <th>Gender</th>
                                        <th>Institution</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($registration->attendees as $att)
                                        <tr {{ $att->is_primary ? 'style=background:#f5f3ff' : '' }}>
                                            <td>
                                                <span class="badge {{ $att->is_primary ? 'badge-primary' : 'badge-secondary' }}">
                                                    #{{ $att->ticket_number }}
                                                </span>
                                                @if($att->is_primary)
                                                    <br><small class="text-primary fw-semibold" style="font-size:10px;">PRIMARY</small>
                                                @endif
                                            </td>
                                            <td class="fw-semibold">{{ $att->name }}</td>
                                            <td>{{ $att->phone ?? '—' }}</td>
                                            <td>{{ $att->email ?? '—' }}</td>
                                            <td>{{ $att->dob ? $att->dob->format('d M Y') : '—' }}</td>
                                            <td>{{ $att->gender ? ucfirst(str_replace('_', ' ', $att->gender)) : '—' }}</td>
                                            <td>{{ $att->institution ?? '—' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

            {{-- ── RIGHT COLUMN ─────────────────────────────────────────── --}}
            <div class="col-lg-4">

                {{-- STATUS CONTROL --}}
                <div class="card card-round mb-4">
                    <div class="card-header">
                        <div class="card-title">Update Status</div>
                    </div>
                    <div class="card-body">
                        <select id="statusSelect" class="form-select mb-3"
                            data-id="{{ $registration->id }}">
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
                        <a href="{{ route('event-registrations.index') }}" class="btn btn-outline-secondary">
                            <i class="fa fa-arrow-left me-1"></i> Back to List
                        </a>
                        <a href="{{ route('event-registrations.export') }}?reg_id={{ $registration->id }}"
                           class="btn btn-outline-success">
                            <i class="fa fa-download me-1"></i> Export This Record
                        </a>
                    </div>
                </div>

                {{-- PRIMARY CONTACT BOX --}}
                @php $primary = $registration->attendees->firstWhere('is_primary', true) ?? $registration->attendees->first(); @endphp
                @if($primary)
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-title">Primary Contact</div>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center gap-3 mb-3">
                            <div style="width:48px;height:48px;border-radius:50%;background:linear-gradient(135deg,#667eea,#764ba2);display:flex;align-items:center;justify-content:center;color:#fff;font-size:20px;font-weight:700;flex-shrink:0;">
                                {{ strtoupper(substr($primary->name, 0, 1)) }}
                            </div>
                            <div>
                                <div class="fw-bold">{{ $primary->name }}</div>
                                @if($primary->gender)
                                    <small class="text-muted">{{ ucfirst(str_replace('_',' ',$primary->gender)) }}</small>
                                @endif
                            </div>
                        </div>
                        @if($primary->phone)
                            <p class="mb-2"><i class="fa fa-phone me-2 text-muted"></i>{{ $primary->phone }}</p>
                        @endif
                        @if($primary->email)
                            <p class="mb-2"><i class="fa fa-envelope me-2 text-muted"></i>{{ $primary->email }}</p>
                        @endif
                        @if($primary->dob)
                            <p class="mb-2"><i class="fa fa-birthday-cake me-2 text-muted"></i>{{ $primary->dob->format('d M Y') }}</p>
                        @endif
                        @if($primary->institution)
                            <p class="mb-0"><i class="fa fa-university me-2 text-muted"></i>{{ $primary->institution }}</p>
                        @endif
                    </div>
                </div>
                @endif

            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.getElementById('saveStatusBtn').addEventListener('click', function () {
    const select = document.getElementById('statusSelect');
    const id = select.dataset.id;

    fetch(`/admin/event-registrations/${id}/status`, {
        method: 'PATCH',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ status: select.value })
    })
    .then(res => res.json())
    .then(res => {
        if (res.success) {
            Swal.fire({ icon: 'success', title: 'Status Updated', toast: true, position: 'top-end', timer: 1800, showConfirmButton: false });
        }
    })
    .catch(() => {
        Swal.fire({ icon: 'error', title: 'Update failed', toast: true, position: 'top-end', timer: 2000, showConfirmButton: false });
    });
});
</script>
@endsection
