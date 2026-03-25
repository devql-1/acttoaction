@extends('backend.layout.app')
@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Workshop Age Groups</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Workshop Age Groups</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">All Age Groups</div>
                            <div class="card-tools d-flex gap-2">
                                <a href="{{ route('workshop-cities-index') }}" class="btn btn-info btn-sm">
                                    <i class="fa fa-map-marker me-1"></i> Cities
                                </a>
                                <a href="{{ route('workshop-schools-index') }}" class="btn btn-warning btn-sm">
                                    <i class="fa fa-building me-1"></i> Schools
                                </a>
                                <a href="{{ route('workshop-age-groups-create') }}" class="btn btn-success btn-sm">
                                    <i class="fa fa-plus me-1"></i> Add Age Group
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0" id="basic-datatables">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th class="text-center">Cities</th>
                                        <th class="text-center">Schools</th>
                                        <th class="text-center">Sort</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($ageGroups as $group)
                                    <tr id="record-row-{{ $group->id }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <strong>{{ $group->name }}</strong>
                                            @if($group->description)
                                                <br><small class="text-muted">{{ $group->description }}</small>
                                            @endif
                                        </td>
                                        <td><code>{{ $group->slug }}</code></td>
                                        <td class="text-center">
                                            <a href="{{ route('workshop-cities-index', ['age_group_id' => $group->id]) }}"
                                               class="badge badge-info text-decoration-none">
                                                {{ $group->cities_count }} Cities
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('workshop-schools-index', ['age_group_id' => $group->id]) }}"
                                               class="badge badge-warning text-decoration-none">
                                                {{ $group->schools_count }} Schools
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge badge-secondary">{{ $group->sort_order }}</span>
                                        </td>
                                        <td class="text-center">
                                            <label class="switch">
                                                <input type="checkbox" class="toggle-status"
                                                    data-id="{{ $group->id }}"
                                                    data-url="{{ route('workshop-age-groups-status') }}"
                                                    {{ $group->status ? 'checked' : '' }}>
                                                <span class="record-toggle"></span>
                                            </label>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-1">
                                                <a href="{{ route('workshop-cities-create', ['age_group_id' => $group->id]) }}"
                                                   class="btn btn-info btn-sm" title="Add City">
                                                    <i class="fa fa-plus"></i> City
                                                </a>
                                                <a href="{{ route('workshop-age-groups-edit', $group->id) }}"
                                                   class="btn btn-primary btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <form id="delete-form-{{ $group->id }}"
                                                      action="{{ route('workshop-age-groups-destroy', $group->id) }}"
                                                      method="POST" class="d-none">
                                                    @csrf @method('DELETE')
                                                </form>
                                                <button type="button" class="btn btn-danger btn-sm"
                                                        onclick="confirmDelete({{ $group->id }}, '{{ addslashes($group->name) }}', {{ $group->cities_count }}, {{ $group->schools_count }})">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted py-4">
                                            No age groups yet.
                                            <a href="{{ route('workshop-age-groups-create') }}">Create your first</a>
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
function confirmDelete(id, name, cities, schools) {
    Swal.fire({
        title: 'Are you sure?',
        text: `Deleting "${name}" will also delete ${cities} cities and ${schools} schools!`,
        icon: 'warning', showCancelButton: true,
        confirmButtonColor: '#d33', cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it!',
    }).then(r => { if (r.isConfirmed) document.getElementById(`delete-form-${id}`).submit(); });
}
@if(session('success'))
    Swal.fire({ icon: 'success', title: 'Success!', text: '{{ session('success') }}', timer: 2500, showConfirmButton: false });
@endif
@if(session('error'))
    Swal.fire({ icon: 'error', title: 'Error!', text: '{{ session('error') }}' });
@endif
</script>
@endsection
