@extends('backend.layout.app')
@section('content')

@php
    $total     = $volunteers->count();
    $pending   = $volunteers->where('status', 'pending')->count();
    $hired     = $volunteers->where('status', 'hired')->count();
    $rejected  = $volunteers->where('status', 'rejected')->count();
    $cancelled = $volunteers->where('status', 'cancelled')->count();
@endphp

<style>
    .status-badge { font-size: 12px; font-weight: 600; padding: 4px 10px; border-radius: 20px; text-transform: capitalize; }
    .badge-pending   { background: #fff3cd; color: #856404; border: 1px solid #ffc107; }
    .badge-hired     { background: #d1e7dd; color: #0a3622; border: 1px solid #198754; }
    .badge-rejected  { background: #f8d7da; color: #58151c; border: 1px solid #dc3545; }
    .badge-cancelled { background: #e2e3e5; color: #41464b; border: 1px solid #6c757d; }
    .stat-card { border-radius: 12px; padding: 18px 20px; color: #fff; }
    .stat-card .stat-num  { font-size: 28px; font-weight: 700; }
    .stat-card .stat-label{ font-size: 12px; opacity: .85; text-transform: uppercase; letter-spacing: 1px; }
    .vol-modal-label { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: #6c757d; margin-bottom: 2px; }
    .vol-modal-value { font-size: 14px; color: #212529; margin-bottom: 12px; }
    .section-divider { border: none; border-top: 2px solid #f0f0f0; margin: 16px 0; }
</style>

<div class="container">
    <div class="page-inner">

        {{-- Header --}}
        <div class="page-header">
            <h3 class="fw-bold mb-3">Volunteer Applications</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="{{ route('admin') }}"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Enquiries</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Volunteers</a></li>
            </ul>
        </div>

        

        {{-- Summary Cards --}}
        <div class="row g-3 mb-4">
            <div class="col-6 col-md-3">
                <div class="stat-card" style="background:#5b73e8;">
                    <div class="stat-num">{{ $total }}</div>
                    <div class="stat-label">Total</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card" style="background:#f59e0b;">
                    <div class="stat-num">{{ $pending }}</div>
                    <div class="stat-label">Pending</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card" style="background:#10b981;">
                    <div class="stat-num">{{ $hired }}</div>
                    <div class="stat-label">Hired</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="stat-card" style="background:#ef4444;">
                    <div class="stat-num">{{ $rejected + $cancelled }}</div>
                    <div class="stat-label">Rejected / Cancelled</div>
                </div>
            </div>
        </div>

        {{-- Table --}}
        <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">All Applications</div>
                        </div>
                    </div>
                    <div class="card-body p-2">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0" id="basic-datatables">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email / Phone</th>
                                        <th>Location</th>
                                        <th>Roles</th>
                                        <th>Availability</th>
                                        <th>Applied On</th>
                                        <th>Status</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($volunteers as $key => $v)
                                    <tr id="record-row-{{ $v->id }}">
                                        <td>{{ $key + 1 }}</td>

                                        {{-- Name --}}
                                        <td>
                                            <strong>{{ $v->first_name }} {{ $v->last_name }}</strong>
                                            @if($v->occupation)
                                                <br><small class="text-muted">{{ $v->occupation }}</small>
                                            @endif
                                            @if($v->age)
                                                <br><small class="text-muted">Age: {{ $v->age }}</small>
                                            @endif
                                        </td>

                                        {{-- Contact --}}
                                        <td>
                                            <div>{{ $v->email }}</div>
                                            <small class="text-muted">{{ $v->phone }}</small>
                                        </td>

                                        {{-- Location --}}
                                        <td>{{ implode(', ', array_filter([$v->city, $v->state])) ?: '—' }}</td>

                                        {{-- Roles --}}
                                        <td>
                                            @if($v->roles)
                                                @foreach(explode(',', $v->roles) as $role)
                                                    <span class="badge bg-info text-dark me-1 mb-1">{{ trim($role) }}</span>
                                                @endforeach
                                            @else
                                                <span class="text-muted">—</span>
                                            @endif
                                        </td>

                                        {{-- Availability --}}
                                        <td><small>{{ $v->availability ?? '—' }}</small></td>

                                        {{-- Date --}}
                                        <td><small>{{ $v->created_at->format('d M Y') }}</small></td>

                                        {{-- Status badge --}}
                                        <td>
                                            <span class="status-badge badge-{{ $v->status }}" id="status-badge-{{ $v->id }}">
                                                {{ ucfirst($v->status) }}
                                            </span>
                                        </td>

                                        {{-- Actions --}}
                                        <td class="text-center">
                                            <div class="d-flex gap-1 justify-content-center flex-wrap">

                                                {{-- View Full Application --}}
                                                <button type="button"
                                                        class="btn btn-sm btn-primary btn-view-app"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#modalVolunteer"
                                                        data-volunteer='@json($v)'
                                                        data-date="{{ $v->created_at->format('d M Y, h:i A') }}"
                                                        title="View Full Application">
                                                    <i class="fa fa-eye"></i>
                                                </button>

                                                {{-- Change Status --}}
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-warning dropdown-toggle" type="button"
                                                            data-bs-toggle="dropdown" title="Change Status">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li><h6 class="dropdown-header">Change Status</h6></li>
                                                        <li>
                                                            <a class="dropdown-item status-action" href="#"
                                                               data-id="{{ $v->id }}" data-status="pending">
                                                               <span class="status-badge badge-pending me-2">Pending</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item status-action" href="#"
                                                               data-id="{{ $v->id }}" data-status="hired">
                                                               <span class="status-badge badge-hired me-2">Hired</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item status-action" href="#"
                                                               data-id="{{ $v->id }}" data-status="rejected">
                                                               <span class="status-badge badge-rejected me-2">Rejected</span>
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a class="dropdown-item status-action" href="#"
                                                               data-id="{{ $v->id }}" data-status="cancelled">
                                                               <span class="status-badge badge-cancelled me-2">Cancelled</span>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>

                                                {{-- Delete --}}
                                                <a href="{{ route('admin.volunteers.destroy', $v->id) }}"
                                                   class="btn btn-sm btn-danger"
                                                   data-confirm="This volunteer application will be permanently removed."
                                                   data-confirm-title="Delete Application?"
                                                   data-confirm-button="Yes, delete"
                                                   title="Delete">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-muted py-5">
                                            <i class="fas fa-hands-helping fa-2x mb-2 d-block"></i>
                                            No volunteer applications yet.
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

{{-- ===== FULL APPLICATION MODAL ===== --}}
<div class="modal fade" id="modalVolunteer" tabindex="-1" aria-labelledby="modalVolunteerLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modalVolunteerLabel">
                    <i class="fas fa-hands-helping me-2"></i> Volunteer Application
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                {{-- Status banner --}}
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <div>
                        <span class="vol-modal-label d-block">Current Status</span>
                        <span class="status-badge" id="modal-status-badge"></span>
                    </div>
                    <small class="text-muted" id="modal-date"></small>
                </div>

                <hr class="section-divider">

                {{-- Personal Info --}}
                <div class="mb-1 fw-bold text-uppercase" style="font-size:11px;letter-spacing:1px;color:var(--accent-color,#5b73e8);">
                    <i class="bi bi-person me-1"></i> Personal Information
                </div>
                <div class="row mt-2">
                    <div class="col-sm-6">
                        <div class="vol-modal-label">Full Name</div>
                        <div class="vol-modal-value" id="modal-name"></div>
                    </div>
                    <div class="col-sm-3">
                        <div class="vol-modal-label">Age</div>
                        <div class="vol-modal-value" id="modal-age"></div>
                    </div>
                    <div class="col-sm-3">
                        <div class="vol-modal-label">Occupation</div>
                        <div class="vol-modal-value" id="modal-occupation"></div>
                    </div>
                    <div class="col-sm-6">
                        <div class="vol-modal-label">Email</div>
                        <div class="vol-modal-value" id="modal-email"></div>
                    </div>
                    <div class="col-sm-6">
                        <div class="vol-modal-label">Phone</div>
                        <div class="vol-modal-value" id="modal-phone"></div>
                    </div>
                    <div class="col-sm-6">
                        <div class="vol-modal-label">City</div>
                        <div class="vol-modal-value" id="modal-city"></div>
                    </div>
                    <div class="col-sm-6">
                        <div class="vol-modal-label">State</div>
                        <div class="vol-modal-value" id="modal-state"></div>
                    </div>
                </div>

                <hr class="section-divider">

                {{-- Volunteer Preferences --}}
                <div class="mb-1 fw-bold text-uppercase" style="font-size:11px;letter-spacing:1px;color:var(--accent-color,#5b73e8);">
                    <i class="bi bi-briefcase me-1"></i> Volunteer Preferences
                </div>
                <div class="row mt-2">
                    <div class="col-sm-6">
                        <div class="vol-modal-label">Preferred Roles</div>
                        <div class="vol-modal-value" id="modal-roles"></div>
                    </div>
                    <div class="col-sm-6">
                        <div class="vol-modal-label">Availability</div>
                        <div class="vol-modal-value" id="modal-availability"></div>
                    </div>
                    <div class="col-sm-12">
                        <div class="vol-modal-label">How did they hear about us?</div>
                        <div class="vol-modal-value" id="modal-hear"></div>
                    </div>
                </div>

                <hr class="section-divider">

                {{-- Written Answers --}}
                <div class="mb-1 fw-bold text-uppercase" style="font-size:11px;letter-spacing:1px;color:var(--accent-color,#5b73e8);">
                    <i class="bi bi-chat-text me-1"></i> Written Answers
                </div>
                <div class="mt-2">
                    <div class="vol-modal-label">Why do they want to join?</div>
                    <div class="vol-modal-value" id="modal-motivation"
                         style="white-space:pre-wrap;background:#f8f9fa;padding:10px 14px;border-radius:8px;"></div>

                    <div class="vol-modal-label mt-2">Relevant Experience / Skills</div>
                    <div class="vol-modal-value" id="modal-experience"
                         style="white-space:pre-wrap;background:#f8f9fa;padding:10px 14px;border-radius:8px;"></div>
                </div>

                <hr class="section-divider">

                {{-- Status Change inside modal --}}
                <div class="mb-1 fw-bold text-uppercase" style="font-size:11px;letter-spacing:1px;color:var(--accent-color,#5b73e8);">
                    Update Status
                </div>
                <div class="d-flex gap-2 flex-wrap mt-2">
                    <button class="btn btn-sm modal-status-btn" data-status="pending"
                            style="background:#fff3cd;color:#856404;border:1px solid #ffc107;">
                        Pending
                    </button>
                    <button class="btn btn-sm modal-status-btn" data-status="hired"
                            style="background:#d1e7dd;color:#0a3622;border:1px solid #198754;">
                        Hired
                    </button>
                    <button class="btn btn-sm modal-status-btn" data-status="rejected"
                            style="background:#f8d7da;color:#58151c;border:1px solid #dc3545;">
                        Rejected
                    </button>
                    <button class="btn btn-sm modal-status-btn" data-status="cancelled"
                            style="background:#e2e3e5;color:#41464b;border:1px solid #6c757d;">
                        Cancelled
                    </button>
                </div>

            </div><!-- /.modal-body -->

            <div class="modal-footer">
                <a id="modal-delete-btn" href="#"
                   class="btn btn-danger btn-sm"
                   data-confirm="This volunteer application will be permanently removed."
                   data-confirm-title="Delete Application?"
                   data-confirm-button="Yes, delete">
                    <i class="fa fa-trash me-1"></i> Delete
                </a>
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>


@endsection

@push('after_scripts')
<script>
$(function () {

    var csrfToken = '{{ csrf_token() }}';
    var currentVolunteerId = null;

    // ── Open modal: populate all fields ──
    $(document).on('click', '.btn-view-app', function () {
        var btn = $(this);
        var v   = btn.data('volunteer');   // full JSON object — safe from newlines/quotes
        currentVolunteerId = v.id;

        var fullName = $.trim((v.first_name || '') + ' ' + (v.last_name || ''));
        $('#modal-name').text(fullName || '—');
        $('#modal-email').text(v.email || '—');
        $('#modal-phone').text(v.phone || '—');
        $('#modal-age').text(v.age || '—');
        $('#modal-city').text(v.city || '—');
        $('#modal-state').text(v.state || '—');
        $('#modal-occupation').text(v.occupation || '—');
        $('#modal-availability').text(v.availability || '—');
        $('#modal-hear').text(v.hear_about || '—');
        $('#modal-motivation').text(v.motivation || '—');
        $('#modal-experience').text(v.experience || '—');
        $('#modal-date').text(btn.data('date'));

        // Roles: comma-separated → badges
        if (v.roles) {
            var html = '';
            $.each(String(v.roles).split(','), function (i, r) {
                html += '<span class="badge bg-info text-dark me-1">' + $.trim(r) + '</span>';
            });
            $('#modal-roles').html(html);
        } else {
            $('#modal-roles').text('—');
        }

        // Status badge
        setStatusBadge('#modal-status-badge', v.status);

        // Delete link
        $('#modal-delete-btn').attr('href', '{{ url("admin/volunteers/destroy") }}/' + currentVolunteerId);
    });

    // ── Status change from table dropdown ──
    $(document).on('click', '.status-action', function (e) {
        e.preventDefault();
        var id     = $(this).data('id');
        var status = $(this).data('status');
        changeStatus(id, status);
    });

    // ── Status change from inside modal ──
    $(document).on('click', '.modal-status-btn', function () {
        if (!currentVolunteerId) return;
        var status = $(this).data('status');
        changeStatus(currentVolunteerId, status, true);
    });

    function changeStatus(id, status, insideModal) {
        $.ajax({
            url: '{{ url("admin/volunteers") }}/' + id + '/status',
            method: 'POST',
            data: { status: status, _token: csrfToken },
            success: function (res) {
                if (res.status === 200) {
                    setStatusBadge('#status-badge-' + id, status);
                    if (insideModal) setStatusBadge('#modal-status-badge', status);
                    toastr.success(res.message);
                }
            },
            error: function () {
                toastr.error('Failed to update status.');
            }
        });
    }

    function setStatusBadge(selector, status) {
        var labels = { pending: 'Pending', hired: 'Hired', rejected: 'Rejected', cancelled: 'Cancelled' };
        $(selector)
            .removeClass('badge-pending badge-hired badge-rejected badge-cancelled')
            .addClass('badge-' + status)
            .text(labels[status] || status);
    }

});
</script>
@endpush
