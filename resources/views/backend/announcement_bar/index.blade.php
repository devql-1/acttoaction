@extends('backend.layout.app')
@section('content')

<div class="container">
    <div class="page-inner">

        <div class="page-header">
            <h3 class="fw-bold mb-3">Announcement Bar</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="{{ route('admin') }}"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Content</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Announcement Bar</a></li>
            </ul>
        </div>

        <div class="alert alert-info d-flex align-items-start gap-2 mb-3" style="font-size:13px;">
            <i class="fa fa-info-circle mt-1"></i>
            <span>Only <strong>one</strong> active announcement is shown on the site at a time (the most recently created active one). Use the toggle to activate/deactivate. The message field supports basic HTML like <code>&lt;strong&gt;</code>.</span>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">
                                Announcements
                                <span class="badge bg-primary ms-2">{{ $bars->count() }}</span>
                            </div>
                            <button class="btn btn-dark ms-auto" data-bs-toggle="modal" data-bs-target="#addBarModal">
                                <i class="fa fa-plus me-1"></i> Add Announcement
                            </button>
                        </div>
                    </div>

                    <div class="card-body p-2">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0" id="basic-datatables">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Message</th>
                                        <th>CTA Button</th>
                                        <th>CTA URL</th>
                                        <th class="text-center">Active</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($bars as $key => $bar)
                                    <tr id="bar-row-{{ $bar->id }}">
                                        <td>{{ $key + 1 }}</td>

                                        <td style="max-width:320px;">
                                            <span style="font-size:13px;">{!! \Illuminate\Support\Str::limit(strip_tags($bar->message), 80) !!}</span>
                                        </td>

                                        <td>
                                            @if($bar->cta_text)
                                                <span class="badge bg-secondary">{{ $bar->cta_text }}</span>
                                            @else
                                                <span class="text-muted">&mdash;</span>
                                            @endif
                                        </td>

                                        <td style="max-width:180px;">
                                            @if($bar->cta_url)
                                                <span style="font-size:11px;word-break:break-all;color:#555;">
                                                    {{ \Illuminate\Support\Str::limit($bar->cta_url, 40) }}
                                                </span>
                                            @else
                                                <span class="text-muted">&mdash;</span>
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            <label class="switch">
                                                <input type="checkbox" class="toggle-bar-status"
                                                       data-id="{{ $bar->id }}"
                                                       {{ $bar->is_active ? 'checked' : '' }}>
                                                <span class="record-toggle"></span>
                                            </label>
                                        </td>

                                        <td class="text-center">
                                            <div class="d-flex gap-1 justify-content-center">
                                                <button class="btn btn-sm btn-warning btn-edit-bar"
                                                        data-bs-toggle="modal" data-bs-target="#editBarModal"
                                                        data-id="{{ $bar->id }}"
                                                        data-message="{{ $bar->message }}"
                                                        data-cta-text="{{ $bar->cta_text }}"
                                                        data-cta-url="{{ $bar->cta_url }}"
                                                        data-active="{{ $bar->is_active ? 1 : 0 }}"
                                                        title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger btn-delete-bar"
                                                        data-id="{{ $bar->id }}" title="Delete">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-5">
                                            <i class="fa fa-bullhorn fa-2x mb-2 d-block"></i>
                                            No announcements yet. Click "Add Announcement" to create one.
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

{{-- ===== ADD MODAL ===== --}}
<div class="modal fade" id="addBarModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.announcement-bar.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fa fa-bullhorn me-2"></i>Add Announcement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Message <span class="text-danger">*</span></label>
                        <textarea name="message" class="form-control" rows="3"
                            placeholder="e.g. 🎭 &nbsp;<strong>Cyber AI Threat Conclave 2026</strong> — Jaipur's Biggest Performing Arts Program is Coming!"
                            required maxlength="500"></textarea>
                        <small class="text-muted">Supports basic HTML like &lt;strong&gt;. Max 500 chars.</small>
                    </div>

                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="form-label fw-semibold">CTA Button Text</label>
                            <input type="text" name="cta_text" class="form-control"
                                placeholder="e.g. Register Now" maxlength="100">
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label fw-semibold">CTA URL</label>
                            <input type="text" name="cta_url" class="form-control"
                                placeholder="/event or https://...">
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-2">
                        <label class="form-label fw-semibold mb-0">Active</label>
                        <div class="form-check form-switch ms-2">
                            <input class="form-check-input" type="checkbox" name="is_active" checked style="width:40px;height:20px;">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-dark btn-sm"><i class="fa fa-save me-1"></i> Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ===== EDIT MODAL ===== --}}
<div class="modal fade" id="editBarModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editBarForm" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fa fa-edit me-2"></i>Edit Announcement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Message <span class="text-danger">*</span></label>
                        <textarea name="message" id="edit-message" class="form-control" rows="3"
                            required maxlength="500"></textarea>
                        <small class="text-muted">Supports basic HTML like &lt;strong&gt;. Max 500 chars.</small>
                    </div>

                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="form-label fw-semibold">CTA Button Text</label>
                            <input type="text" name="cta_text" id="edit-cta-text" class="form-control" maxlength="100">
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label fw-semibold">CTA URL</label>
                            <input type="text" name="cta_url" id="edit-cta-url" class="form-control">
                        </div>
                    </div>

                    <div class="d-flex align-items-center gap-2">
                        <label class="form-label fw-semibold mb-0">Active</label>
                        <div class="form-check form-switch ms-2">
                            <input class="form-check-input" type="checkbox" name="is_active" id="edit-is-active" style="width:40px;height:20px;">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-dark btn-sm"><i class="fa fa-save me-1"></i> Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('after_scripts')
<script>
$(document).ready(function () {
    var csrfToken = '{{ csrf_token() }}';

    // ── Populate Edit Modal ──
    $(document).on('click', '.btn-edit-bar', function () {
        var btn = $(this);
        var id  = btn.data('id');
        $('#editBarForm').attr('action', '{{ url("admin/announcement-bar") }}/' + id);
        $('#edit-message').val(btn.data('message'));
        $('#edit-cta-text').val(btn.data('cta-text') || '');
        $('#edit-cta-url').val(btn.data('cta-url') || '');
        $('#edit-is-active').prop('checked', btn.data('active') == 1);
    });

    // ── Toggle Status ──
    $(document).on('change', '.toggle-bar-status', function () {
        var $el    = $(this);
        var id     = $el.data('id');
        var status = $el.is(':checked') ? 1 : 0;

        $.post('{{ route("admin.announcement-bar.toggle") }}', {
            _token: csrfToken, id: id, status: status
        })
        .done(function (res) {
            if (res && res.success) {
                toastr.success(status ? 'Announcement activated' : 'Announcement deactivated');
            } else {
                $el.prop('checked', !status);
                toastr.error('Failed to update status');
            }
        })
        .fail(function () {
            $el.prop('checked', !status);
            toastr.error('Failed to update status');
        });
    });

    // ── Delete ──
    $(document).on('click', '.btn-delete-bar', function () {
        var id  = $(this).data('id');
        var row = $('#bar-row-' + id);

        Swal.fire({
            title: 'Are you sure?',
            text: 'This announcement will be permanently deleted!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then(function (result) {
            if (!result.isConfirmed) return;

            $.ajax({
                url: '{{ url("admin/announcement-bar") }}/' + id,
                method: 'DELETE',
                data: { _token: csrfToken },
                success: function (res) {
                    if (res.success) {
                        row.fadeOut(300, function () { $(this).remove(); });
                        toastr.success('Announcement deleted');
                    } else {
                        toastr.error('Failed to delete announcement');
                    }
                },
                error: function () {
                    toastr.error('Failed to delete announcement');
                }
            });
        });
    });
});
</script>
@endpush
