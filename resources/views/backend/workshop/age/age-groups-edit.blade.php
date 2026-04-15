@extends('backend.layout.app')
@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Edit Age Group</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="{{ route('workshop-age-groups-index') }}">Age Groups</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Edit</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-7">
                <div class="card card-round">
                    <div class="card-header"><div class="card-title">Edit — {{ $workshopAgeGroup->name }}</div></div>
                    <div class="card-body">
                        <form action="{{ route('workshop-age-groups-update', $workshopAgeGroup->id) }}" method="POST">
                            @csrf @method('PUT')

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Name <span class="text-danger">*</span></label>
                                <input type="text" name="name"
                                       value="{{ old('name', $workshopAgeGroup->name) }}"
                                       class="form-control @error('name') is-invalid @enderror">
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Description</label>
                                <input type="text" name="description"
                                       value="{{ old('description', $workshopAgeGroup->description) }}"
                                       class="form-control">
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Sort Order</label>
                                    <input type="number" name="sort_order"
                                           value="{{ old('sort_order', $workshopAgeGroup->sort_order) }}"
                                           min="0" class="form-control">
                                </div>
                                <div class="col-md-8 d-flex align-items-end pb-1">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox"
                                               name="status" id="status" value="1"
                                               {{ $workshopAgeGroup->status ? 'checked' : '' }}>
                                        <label class="form-check-label fw-semibold" for="status">Active</label>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save me-1"></i> Update
                                </button>
                                <a href="{{ route('workshop-age-groups-index') }}" class="btn btn-secondary">
                                    <i class="fa fa-arrow-left me-1"></i> Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card card-round">
                    <div class="card-header"><div class="card-title"><i class="fa fa-info-circle text-info me-1"></i> Details</div></div>
                    <div class="card-body">
                        <table class="table table-sm table-borderless mb-0">
                            <tr><td class="text-muted small">Slug</td><td><code>{{ $workshopAgeGroup->slug }}</code></td></tr>
                            <tr><td class="text-muted small">Cities</td><td>{{ $workshopAgeGroup->cities()->count() }}</td></tr>
                            <tr><td class="text-muted small">Schools</td><td>{{ $workshopAgeGroup->schools()->count() }}</td></tr>
                            <tr><td class="text-muted small">Created</td><td class="small">{{ $workshopAgeGroup->created_at->format('d M Y') }}</td></tr>
                        </table>
                    </div>
                </div>

                <div class="card card-round mt-3">
                    <div class="card-header"><div class="card-title text-danger"><i class="fa fa-exclamation-triangle me-1"></i> Danger Zone</div></div>
                    <div class="card-body">
                        <p class="small text-muted mb-3">Deleting this will also delete all its cities and schools.</p>
                        <form id="delete-form-{{ $workshopAgeGroup->id }}"
                              action="{{ route('workshop-age-groups-destroy', $workshopAgeGroup->id) }}"
                              method="POST" class="d-none">
                            @csrf @method('DELETE')
                        </form>
                        <button type="button" class="btn btn-danger btn-sm"
                                onclick="confirmDelete({{ $workshopAgeGroup->id }}, '{{ addslashes($workshopAgeGroup->name) }}')">
                            <i class="fa fa-trash me-1"></i> Delete Age Group
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmDelete(id, name) {
    Swal.fire({
        title: 'Are you sure?', text: `Deleting "${name}" removes all cities & schools!`,
        icon: 'warning', showCancelButton: true,
        confirmButtonColor: '#d33', cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it!',
    }).then(r => { if (r.isConfirmed) document.getElementById(`delete-form-${id}`).submit(); });
}

</script>
@endsection
