@extends('backend.layout.app')
@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Edit Stat</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="{{ route('stats-index') }}">Stats</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Edit</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-7">
                <div class="card card-round">
                    <div class="card-header"><div class="card-title">Edit — {{ $stat->label }}</div></div>
                    <div class="card-body">
                        <form action="{{ route('stats-update', $stat->id) }}" method="POST">
                            @csrf @method('PUT')

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Bootstrap Icon <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i class="bi {{ old('icon', $stat->icon) }}" id="iconPreview"></i>
                                    </span>
                                    <input type="text" name="icon" id="iconInput"
                                           value="{{ old('icon', $stat->icon) }}"
                                           class="form-control @error('icon') is-invalid @enderror"
                                           oninput="document.getElementById('iconPreview').className='bi '+this.value">
                                </div>
                                @error('icon') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Value <span class="text-danger">*</span></label>
                                    <input type="text" name="value"
                                           value="{{ old('value', $stat->value) }}"
                                           class="form-control @error('value') is-invalid @enderror">
                                    @error('value') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Suffix</label>
                                    <input type="text" name="suffix"
                                           value="{{ old('suffix', $stat->suffix) }}"
                                           class="form-control">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Label <span class="text-danger">*</span></label>
                                <input type="text" name="label"
                                       value="{{ old('label', $stat->label) }}"
                                       class="form-control @error('label') is-invalid @enderror">
                                @error('label') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Sort Order</label>
                                    <input type="number" name="sort_order"
                                           value="{{ old('sort_order', $stat->sort_order) }}"
                                           min="0" class="form-control">
                                </div>
                                <div class="col-md-8 d-flex align-items-end pb-1">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox"
                                               name="status" id="status" value="1"
                                               {{ $stat->status ? 'checked' : '' }}>
                                        <label class="form-check-label fw-semibold" for="status">Active</label>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save me-1"></i> Update Stat
                                </button>
                                <a href="{{ route('stats-index') }}" class="btn btn-secondary">
                                    <i class="fa fa-arrow-left me-1"></i> Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card card-round">
                    <div class="card-header"><div class="card-title">Live Preview</div></div>
                    <div class="card-body text-center">
                        <div style="background:linear-gradient(135deg,#112344,#1c3d75);
                                    border-radius:14px; padding:24px 32px; display:inline-block;">
                            <div style="width:54px;height:54px;background:rgba(255,106,0,.15);
                                        border:2px solid rgba(255,106,0,.3);border-radius:50%;
                                        display:flex;align-items:center;justify-content:center;margin:0 auto 12px;">
                                <i class="bi {{ $stat->icon }}" style="font-size:22px;color:#ff6a00;"></i>
                            </div>
                            <div style="font-family:'Montserrat',sans-serif;font-size:2rem;
                                        font-weight:800;color:#fff;line-height:1;">
                                {{ $stat->value }}<span style="font-size:1.4rem;color:#ff6a00;">{{ $stat->suffix }}</span>
                            </div>
                            <div style="font-size:12px;color:rgba(255,255,255,.6);margin-top:6px;">
                                {{ $stat->label }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card card-round mt-3">
                    <div class="card-header"><div class="card-title text-danger"><i class="fa fa-exclamation-triangle me-1"></i> Danger Zone</div></div>
                    <div class="card-body">
                        <form id="delete-form-{{ $stat->id }}"
                              action="{{ route('stats-destroy', $stat->id) }}"
                              method="POST" class="d-none">
                            @csrf @method('DELETE')
                        </form>
                        <button type="button" class="btn btn-danger btn-sm"
                                onclick="confirmDelete({{ $stat->id }}, '{{ addslashes($stat->label) }}')">
                            <i class="fa fa-trash me-1"></i> Delete Stat
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmDelete(id, label) {
    Swal.fire({
        title: 'Are you sure?', text: `Deleting stat "${label}"?`, icon: 'warning',
        showCancelButton: true, confirmButtonColor: '#d33', cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it!',
    }).then(r => { if (r.isConfirmed) document.getElementById(`delete-form-${id}`).submit(); });
}
@if(session('success'))
    Swal.fire({ icon: 'success', title: 'Success!', text: '{{ session('success') }}', timer: 2500, showConfirmButton: false });
@endif
</script>
@endsection
