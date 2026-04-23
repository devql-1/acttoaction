@extends('backend.layout.app')
@section('content')

<style>
    .banner-thumb {
        width: 90px; height: 56px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid #e0e0e0;
    }
    .no-thumb {
        width: 90px; height: 56px;
        display: flex; align-items: center; justify-content: center;
        background: #f3f4f6; border-radius: 8px; border: 1px dashed #ccc;
        color: #aaa; font-size: 20px;
    }
    .preview-img {
        width: 100%; max-height: 200px;
        object-fit: cover; border-radius: 10px;
        border: 1px solid #ddd; margin-top: 8px;
        display: none;
    }
    .sort-badge {
        display: inline-block;
        background: #e8eaf6; color: #3949ab;
        font-size: 11px; font-weight: 700;
        padding: 2px 8px; border-radius: 12px;
    }
</style>

<div class="container">
    <div class="page-inner">

        <div class="page-header">
            <h3 class="fw-bold mb-3">Notification Banners</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="{{ route('admin') }}"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Content</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Notification Banners</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">
                                Bell Popup Banners
                                <span class="badge bg-primary ms-2">{{ $banners->count() }}</span>
                            </div>
                            <button class="btn btn-dark ms-auto" data-bs-toggle="modal" data-bs-target="#addBannerModal">
                                <i class="fa fa-plus me-1"></i> Add Banner
                            </button>
                        </div>
                    </div>

                    <div class="card-body p-2">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0" id="basic-datatables">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Link URL</th>
                                        <th>Order</th>
                                        <th class="text-center">Active</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($banners as $key => $b)
                                    <tr id="banner-row-{{ $b->id }}">
                                        <td>{{ $key + 1 }}</td>

                                        <td>
                                            @if($b->image)
                                                <img src="{{ asset($b->image) }}" class="banner-thumb" alt="{{ $b->title }}">
                                            @else
                                                <div class="no-thumb"><i class="fa fa-image"></i></div>
                                            @endif
                                        </td>

                                        <td><strong>{{ $b->title }}</strong></td>

                                        <td>
                                            @if($b->url)
                                                <a href="{{ $b->url }}" target="_blank" class="text-primary" style="font-size:12px;word-break:break-all;">
                                                    {{ \Illuminate\Support\Str::limit($b->url, 50) }}
                                                </a>
                                            @else
                                                <span class="text-muted">&mdash;</span>
                                            @endif
                                        </td>

                                        <td><span class="sort-badge">{{ $b->sort_order }}</span></td>

                                        <td class="text-center">
                                            <label class="switch">
                                                <input type="checkbox" class="toggle-banner-status"
                                                       data-id="{{ $b->id }}"
                                                       {{ $b->is_active ? 'checked' : '' }}>
                                                <span class="record-toggle"></span>
                                            </label>
                                        </td>

                                        <td class="text-center">
                                            <div class="d-flex gap-1 justify-content-center">
                                                <button class="btn btn-sm btn-warning btn-edit-banner"
                                                        data-bs-toggle="modal" data-bs-target="#editBannerModal"
                                                        data-id="{{ $b->id }}"
                                                        data-title="{{ $b->title }}"
                                                        data-url="{{ $b->url }}"
                                                        data-sort="{{ $b->sort_order }}"
                                                        data-active="{{ $b->is_active ? 1 : 0 }}"
                                                        data-image="{{ $b->image ? asset($b->image) : '' }}"
                                                        title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </button>

                                                <button class="btn btn-sm btn-danger btn-delete-banner"
                                                        data-id="{{ $b->id }}" title="Delete">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-5">
                                            <i class="fa fa-bell fa-2x mb-2 d-block"></i>
                                            No banners yet. Click "Add Banner" to create one.
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
<div class="modal fade" id="addBannerModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.notification-banners.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fa fa-bell me-2"></i>Add Notification Banner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" placeholder="e.g. Summer Camp 2026" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Banner Image</label>
                        <input type="file" name="image" class="form-control img-input" accept="image/*" data-preview="add-preview">
                        <img id="add-preview" class="preview-img" src="" alt="Preview">
                        <small class="text-muted">Recommended: 900Ã—500px · Max 2MB</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Link URL</label>
                        <input type="text" name="url" class="form-control" placeholder="https://... or leave blank">
                    </div>

                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="form-label fw-semibold">Sort Order</label>
                            <input type="number" name="sort_order" class="form-control" value="0" min="0">
                            <small class="text-muted">Lower = shown first</small>
                        </div>
                        <div class="col-6 mb-3 d-flex align-items-center gap-2 pt-3">
                            <label class="form-label fw-semibold mb-0">Active</label>
                            <div class="form-check form-switch ms-2">
                                <input class="form-check-input" type="checkbox" name="is_active" checked style="width:40px;height:20px;">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-dark btn-sm"><i class="fa fa-save me-1"></i> Save Banner</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- ===== EDIT MODAL ===== --}}
<div class="modal fade" id="editBannerModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="editBannerForm" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fa fa-edit me-2"></i>Edit Notification Banner</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Title <span class="text-danger">*</span></label>
                        <input type="text" name="title" id="edit-title" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Banner Image</label>
                        <div id="edit-current-img-wrap" class="mb-2" style="display:none;">
                            <img id="edit-current-img" src="" alt="Current" class="banner-thumb">
                            <div class="form-check mt-1">
                                <input class="form-check-input" type="checkbox" name="remove_image" id="edit-remove-image" value="1">
                                <label class="form-check-label text-danger" for="edit-remove-image">Remove current image</label>
                            </div>
                        </div>
                        <input type="file" name="image" class="form-control img-input" accept="image/*" data-preview="edit-preview">
                        <img id="edit-preview" class="preview-img" src="" alt="Preview">
                        <small class="text-muted">Upload a new image to replace. Recommended: 900Ã—500px · Max 2MB</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Link URL</label>
                        <input type="text" name="url" id="edit-url" class="form-control" placeholder="https://...">
                    </div>

                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="form-label fw-semibold">Sort Order</label>
                            <input type="number" name="sort_order" id="edit-sort" class="form-control" min="0">
                        </div>
                        <div class="col-6 mb-3 d-flex align-items-center gap-2 pt-3">
                            <label class="form-label fw-semibold mb-0">Active</label>
                            <div class="form-check form-switch ms-2">
                                <input class="form-check-input" type="checkbox" name="is_active" id="edit-is-active" style="width:40px;height:20px;">
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-dark btn-sm"><i class="fa fa-save me-1"></i> Update Banner</button>
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

    // ── Image preview ──
    $(document).on('change', '.img-input', function () {
        var file   = this.files[0];
        var target = '#' + $(this).data('preview');
        if (file) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(target).attr('src', e.target.result).show();
            };
            reader.readAsDataURL(file);
        } else {
            $(target).hide();
        }
    });

    // ── Populate Edit Modal ──
    $(document).on('click', '.btn-edit-banner', function () {
        var btn = $(this);
        var id  = btn.data('id');

        $('#editBannerForm').attr('action', '{{ url("admin/notification-banners") }}/' + id);
        $('#edit-title').val(btn.data('title'));
        $('#edit-url').val(btn.data('url') || '');
        $('#edit-sort').val(btn.data('sort'));
        $('#edit-is-active').prop('checked', btn.data('active') == 1);
        $('#edit-remove-image').prop('checked', false);
        $('#edit-preview').hide();

        var img = btn.data('image');
        if (img) {
            $('#edit-current-img').attr('src', img);
            $('#edit-current-img-wrap').show();
        } else {
            $('#edit-current-img-wrap').hide();
        }
    });

    // ── Toggle Status ──
    $(document).on('change', '.toggle-banner-status', function () {
        var $el    = $(this);
        var id     = $el.data('id');
        var status = $el.is(':checked') ? 1 : 0;

        $.post('{{ route("admin.notification-banners.toggle") }}', {
            _token: csrfToken, id: id, status: status
        })
        .done(function (res) {
            if (res && res.success) {
                toastr.success(status ? 'Banner activated' : 'Banner deactivated');
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
    $(document).on('click', '.btn-delete-banner', function () {
        var id  = $(this).data('id');
        var row = $('#banner-row-' + id);

        Swal.fire({
            title: 'Are you sure?',
            text: 'This banner will be permanently deleted!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then(function (result) {
            if (!result.isConfirmed) return;

            $.ajax({
                url: '{{ url("admin/notification-banners") }}/' + id,
                method: 'DELETE',
                data: { _token: csrfToken },
                success: function (res) {
                    if (res.success) {
                        row.fadeOut(300, function () { $(this).remove(); });
                        toastr.success('Banner deleted');
                    } else {
                        toastr.error('Failed to delete banner');
                    }
                },
                error: function () {
                    toastr.error('Failed to delete banner');
                }
            });
        });
    });

});
</script>
@endpush
