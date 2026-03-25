@extends('backend.layout.app')
@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Workshop Schools</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="{{ route('workshop-age-groups-index') }}">Age Groups</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Schools</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">All Schools / Venues</div>
                            <div class="card-tools">
                                <a href="{{ route('workshop-schools-create') }}" class="btn btn-success btn-sm">
                                    <i class="fa fa-plus me-1"></i> Add School
                                </a>
                            </div>
                        </div>

                        {{-- Filters --}}
                        <div class="mt-3 d-flex gap-3 flex-wrap align-items-center">
                            <form method="GET" action="{{ route('workshop-schools-index') }}"
                                  class="d-flex gap-2 flex-wrap align-items-center">
                                <select name="age_group_id" class="form-select form-select-sm" style="width:auto;"
                                        onchange="this.form.submit()">
                                    <option value="">All Age Groups</option>
                                    @foreach($ageGroups as $group)
                                        <option value="{{ $group->id }}"
                                            {{ $activeAgeGroup == $group->id ? 'selected' : '' }}>
                                            {{ $group->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <select name="city_id" class="form-select form-select-sm" style="width:auto;"
                                        onchange="this.form.submit()">
                                    <option value="">All Cities</option>
                                    @foreach($cities as $city)
                                        <option value="{{ $city->id }}"
                                            {{ $activeCity == $city->id ? 'selected' : '' }}>
                                            {{ $city->name }} ({{ $city->ageGroup->name ?? '' }})
                                        </option>
                                    @endforeach
                                </select>
                                @if($activeAgeGroup || $activeCity)
                                    <a href="{{ route('workshop-schools-index') }}" class="btn btn-outline-secondary btn-sm">
                                        <i class="fa fa-times me-1"></i> Clear
                                    </a>
                                @endif
                            </form>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0" id="basic-datatables">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Photo</th>
                                        <th>School / Venue</th>
                                        <th>Age Group</th>
                                        <th>City</th>
                                        <th class="text-center">Timings</th>
                                        <th class="text-center">Sort</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($schools as $school)
                                    <tr id="record-row-{{ $school->id }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if($school->image_url)
                                                <a data-fancybox="school-gallery" href="{{ $school->image_url }}">
                                                    <img src="{{ $school->image_url }}" alt="{{ $school->name }}"
                                                         style="width:50px;height:50px;object-fit:cover;border-radius:8px;box-shadow:0 4px 12px rgba(0,0,0,.15);">
                                                </a>
                                            @else
                                                <div style="width:50px;height:50px;background:#f0f0f0;border-radius:8px;display:flex;align-items:center;justify-content:center;">
                                                    <i class="fa fa-building text-muted"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <strong>{{ $school->name }}</strong>
                                            @if($school->address)
                                                <br><small class="text-muted"><i class="fa fa-map-marker me-1"></i>{{ Str::limit($school->address, 50) }}</small>
                                            @endif
                                            @if($school->registration_url)
                                                <br><a href="{{ $school->registration_url }}" target="_blank" class="text-success" style="font-size:11px;">
                                                    <i class="fa fa-link me-1"></i>Registration Link
                                                </a>
                                            @endif
                                        </td>
                                        <td><span class="badge badge-info">{{ $school->ageGroup->name ?? '—' }}</span></td>
                                        <td><span class="badge badge-secondary">{{ $school->city->name ?? '—' }}</span></td>
                                        <td class="text-center">
                                            @if($school->timings)
                                                <small><i class="fa fa-clock-o me-1"></i>{{ $school->timings }}</small>
                                            @else
                                                <span class="text-muted">—</span>
                                            @endif
                                        </td>
                                        <td class="text-center"><span class="badge badge-secondary">{{ $school->sort_order }}</span></td>
                                        <td class="text-center">
                                            <label class="switch">
                                                <input type="checkbox" class="toggle-status"
                                                    data-id="{{ $school->id }}"
                                                    data-url="{{ route('workshop-schools-status') }}"
                                                    {{ $school->status ? 'checked' : '' }}>
                                                <span class="record-toggle"></span>
                                            </label>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-1">
                                                <a href="{{ route('workshop-schools-edit', $school->id) }}"
                                                   class="btn btn-primary btn-sm">
                                                    <i class="fa fa-edit me-1"></i> Edit
                                                </a>
                                                <form id="delete-form-{{ $school->id }}"
                                                      action="{{ route('workshop-schools-destroy', $school->id) }}"
                                                      method="POST" class="d-none">
                                                    @csrf @method('DELETE')
                                                </form>
                                                <button type="button" class="btn btn-danger btn-sm"
                                                        onclick="confirmDelete({{ $school->id }}, '{{ addslashes($school->name) }}')">
                                                    <i class="fa fa-trash me-1"></i> Delete
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-muted py-4">
                                            No schools found. <a href="{{ route('workshop-schools-create') }}">Add one</a>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmDelete(id, name) {
    Swal.fire({
        title: 'Are you sure?', text: `Deleting "${name}"?`, icon: 'warning',
        showCancelButton: true, confirmButtonColor: '#d33', cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it!',
    }).then(r => { if (r.isConfirmed) document.getElementById(`delete-form-${id}`).submit(); });
}
@if(session('success'))
    Swal.fire({ icon: 'success', title: 'Success!', text: '{{ session('success') }}', timer: 2500, showConfirmButton: false });
@endif
</script>
@endsection
