@extends('backend.layout.app')
@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Workshop Cities</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="{{ route('workshop-age-groups-index') }}">Age Groups</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Cities</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">All Cities</div>
                            <div class="card-tools d-flex gap-2">
                                <a href="{{ route('workshop-age-groups-index') }}" class="btn btn-secondary btn-sm">
                                    <i class="fa fa-arrow-left me-1"></i> Age Groups
                                </a>
                                <a href="{{ route('workshop-cities-create') }}" class="btn btn-success btn-sm">
                                    <i class="fa fa-plus me-1"></i> Add City
                                </a>
                            </div>
                        </div>

                        {{-- Age Group filter tabs --}}
                        <div class="mt-3">
                            <ul class="nav nav-pills nav-sm flex-wrap gap-1">
                                <li class="nav-item">
                                    <a class="nav-link {{ !$activeAgeGroup ? 'active' : '' }}"
                                       href="{{ route('workshop-cities-index') }}">
                                        All <span class="badge badge-secondary ms-1">{{ $cities->count() }}</span>
                                    </a>
                                </li>
                                @foreach($ageGroups as $group)
                                <li class="nav-item">
                                    <a class="nav-link {{ $activeAgeGroup == $group->id ? 'active' : '' }}"
                                       href="{{ route('workshop-cities-index', ['age_group_id' => $group->id]) }}">
                                        {{ $group->name }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0" id="basic-datatables">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>City Name</th>
                                        <th>Age Group</th>
                                        <th class="text-center">Schools</th>
                                        <th class="text-center">Sort</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($cities as $city)
                                    <tr id="record-row-{{ $city->id }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td><strong>{{ $city->name }}</strong></td>
                                        <td><span class="badge badge-info">{{ $city->ageGroup->name ?? '—' }}</span></td>
                                        <td class="text-center">
                                            <a href="{{ route('workshop-schools-index', ['city_id' => $city->id]) }}"
                                               class="badge badge-warning text-decoration-none">
                                                {{ $city->all_schools_count }} Schools
                                            </a>
                                        </td>
                                        <td class="text-center"><span class="badge badge-secondary">{{ $city->sort_order }}</span></td>
                                        <td class="text-center">
                                            <label class="switch">
                                                <input type="checkbox" class="toggle-status"
                                                    data-id="{{ $city->id }}"
                                                    data-url="{{ route('workshop-cities-status') }}"
                                                    {{ $city->status ? 'checked' : '' }}>
                                                <span class="record-toggle"></span>
                                            </label>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-1">
                                                <a href="{{ route('workshop-schools-create', ['city_id' => $city->id, 'age_group_id' => $city->age_group_id]) }}"
                                                   class="btn btn-warning btn-sm" title="Add School">
                                                    <i class="fa fa-plus"></i> School
                                                </a>
                                                <a href="{{ route('workshop-cities-edit', $city->id) }}"
                                                   class="btn btn-primary btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <form id="delete-form-{{ $city->id }}"
                                                      action="{{ route('workshop-cities-destroy', $city->id) }}"
                                                      method="POST" class="d-none">
                                                    @csrf @method('DELETE')
                                                </form>
                                                <button type="button" class="btn btn-danger btn-sm"
                                                        onclick="confirmDelete({{ $city->id }}, '{{ addslashes($city->name) }}', {{ $city->all_schools_count }})">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">
                                            No cities found. <a href="{{ route('workshop-cities-create') }}">Add one</a>
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
function confirmDelete(id, name, schools) {
    Swal.fire({
        title: 'Are you sure?',
        text: `Deleting "${name}" will also delete ${schools} schools!`,
        icon: 'warning', showCancelButton: true,
        confirmButtonColor: '#d33', cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it!',
    }).then(r => { if (r.isConfirmed) document.getElementById(`delete-form-${id}`).submit(); });
}

</script>
@endsection
