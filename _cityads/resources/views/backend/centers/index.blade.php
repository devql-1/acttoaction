@extends('backend.layout.app')
@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Centers</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="#"><i class="icon-home"></i></a>
                </li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Masters</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Centers</a></li>
            </ul>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">All Centers</div>
                            <div class="card-tools d-flex align-items-center gap-2">

                                {{-- Filter by State --}}
                                <form method="GET" action="{{ route('centers-index') }}" class="d-flex gap-2">
                                    <select name="state_id" class="form-control form-control-sm"
                                        onchange="this.form.submit()">
                                        <option value="">All States</option>
                                        @foreach($states as $state)
                                            <option value="{{ $state->id }}"
                                                {{ request('state_id') == $state->id ? 'selected' : '' }}>
                                                {{ $state->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if(request('state_id'))
                                        <a href="{{ route('centers-index') }}"
                                            class="btn btn-secondary btn-sm">Clear</a>
                                    @endif
                                </form>

                                <a href="{{ route('centers-create') }}" class="btn btn-success btn-sm">
                                    <i class="fa fa-plus me-1"></i> Add Center
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
                                        <th>Center Name</th>
                                        <th>State</th>
                                        <th>Address</th>
                                        <th>Contact</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($centers as $center)
                                    <tr id="record-row-{{ $center->id }}">

                                        <td>{{ $loop->iteration }}</td>

                                        <td>
                                            <strong>{{ $center->name }}</strong>
                                        </td>

                                        <td>
                                            <span class="badge badge-info">
                                                {{ $center->state->name }}
                                            </span>
                                        </td>

                                        <td>
                                            <small class="text-muted">
                                                {{ $center->address ?? '--' }}
                                            </small>
                                            @if($center->map_link)
                                                <br>
                                                <a href="{{ $center->map_link }}" target="_blank"
                                                    class="text-primary" style="font-size:12px;">
                                                    <i class="fa fa-map-marker me-1"></i>View on Map
                                                </a>
                                            @endif
                                        </td>

                                        <td>
                                            @if($center->phone)
                                                <small><i class="fa fa-phone me-1"></i>{{ $center->phone }}</small><br>
                                            @endif
                                            @if($center->email)
                                                <small><i class="fa fa-envelope me-1"></i>{{ $center->email }}</small>
                                            @endif
                                            @if(!$center->phone && !$center->email)
                                                <small class="text-muted">--</small>
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            <label class="switch">
                                                <input type="checkbox" class="toggle-status"
                                                    data-id="{{ $center->id }}"
                                                    data-url="{{ route('centers-status') }}"
                                                    {{ $center->status == 1 ? 'checked' : '' }}>
                                                <span class="record-toggle"></span>
                                            </label>
                                        </td>

                                        <td class="text-center">
                                            <div class="form-button-action">

                                                <a href="{{ route('centers-edit', $center->id) }}"
                                                    class="btn btn-link btn-primary btn-lg me-2" title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </a>

                                                {{-- Hidden delete form --}}
                                                <form id="delete-form-{{ $center->id }}"
                                                    action="{{ route('centers-destroy', $center->id) }}"
                                                    method="POST" class="d-none">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>

                                                <button type="button"
                                                    class="btn btn-link btn-danger btn-lg"
                                                    onclick="confirmDelete({{ $center->id }}, '{{ addslashes($center->name) }}')"
                                                    title="Delete">
                                                    <i class="fa fa-trash"></i>
                                                </button>

                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">
                                            No centers found.
                                            <a href="{{ route('centers-create') }}">Add your first center</a>
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

{{-- SweetAlert2 CDN --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function confirmDelete(id, name) {
        Swal.fire({
            title: 'Are you sure?',
            text: `You are about to delete "${name}". This cannot be undone!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`delete-form-${id}`).submit();
            }
        });
    }

    // SweetAlert for session success/error (auto popup)
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
            timer: 2500,
            showConfirmButton: false,
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: '{{ session('error') }}',
        });
    @endif
</script>

@endsection