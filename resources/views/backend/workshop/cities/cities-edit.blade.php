@extends('backend.layout.app')
@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Edit City</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="{{ route('workshop-cities-index') }}">Cities</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Edit</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-7">
                <div class="card card-round">
                    <div class="card-header"><div class="card-title">Edit — {{ $workshopCity->name }}</div></div>
                    <div class="card-body">
                        <form action="{{ route('workshop-cities-update', $workshopCity->id) }}" method="POST">
                            @csrf @method('PUT')

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Age Group <span class="text-danger">*</span></label>
                                <select name="age_group_id"
                                        class="form-select @error('age_group_id') is-invalid @enderror">
                                    @foreach($ageGroups as $group)
                                        <option value="{{ $group->id }}"
                                            {{ old('age_group_id', $workshopCity->age_group_id) == $group->id ? 'selected' : '' }}>
                                            {{ $group->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('age_group_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">City Name <span class="text-danger">*</span></label>
                                <input type="text" name="name"
                                       value="{{ old('name', $workshopCity->name) }}"
                                       class="form-control @error('name') is-invalid @enderror">
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Sort Order</label>
                                    <input type="number" name="sort_order"
                                           value="{{ old('sort_order', $workshopCity->sort_order) }}"
                                           min="0" class="form-control">
                                </div>
                                <div class="col-md-8 d-flex align-items-end pb-1">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox"
                                               name="status" id="status" value="1"
                                               {{ $workshopCity->status ? 'checked' : '' }}>
                                        <label class="form-check-label fw-semibold" for="status">Active</label>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save me-1"></i> Update City
                                </button>
                                <a href="{{ route('workshop-cities-index') }}" class="btn btn-secondary">
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
                            <tr><td class="text-muted small">Age Group</td><td>{{ $workshopCity->ageGroup->name ?? '—' }}</td></tr>
                            <tr><td class="text-muted small">Schools</td><td>{{ $workshopCity->allSchools()->count() }}</td></tr>
                            <tr><td class="text-muted small">Created</td><td class="small">{{ $workshopCity->created_at->format('d M Y') }}</td></tr>
                        </table>
                    </div>
                </div>

                <div class="card card-round mt-3">
                    <div class="card-header"><div class="card-title text-danger"><i class="fa fa-exclamation-triangle me-1"></i> Danger Zone</div></div>
                    <div class="card-body">
                        <p class="small text-muted mb-3">Deleting this city will also delete all its schools.</p>
                        <form id="delete-form-{{ $workshopCity->id }}"
                              action="{{ route('workshop-cities-destroy', $workshopCity->id) }}"
                              method="POST" class="d-none">
                            @csrf @method('DELETE')
                        </form>
                        <button type="button" class="btn btn-danger btn-sm"
                                onclick="confirmDelete({{ $workshopCity->id }}, '{{ addslashes($workshopCity->name) }}')">
                            <i class="fa fa-trash me-1"></i> Delete City
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
        title: 'Are you sure?', text: `Deleting "${name}" removes all its schools!`,
        icon: 'warning', showCancelButton: true, confirmButtonColor: '#d33', cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it!',
    }).then(r => { if (r.isConfirmed) document.getElementById(`delete-form-${id}`).submit(); });
}
@if(session('success'))
    Swal.fire({ icon: 'success', title: 'Success!', text: '{{ session('success') }}', timer: 2500, showConfirmButton: false });
@endif
</script>
@endsection
