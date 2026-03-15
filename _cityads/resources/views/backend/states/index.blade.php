@extends('backend.layout.app')
@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">States</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="#"><i class="icon-home"></i></a>
                </li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Masters</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">States</a></li>
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
                            <div class="card-title">All States</div>
                            <div class="card-tools">
                                <a href="{{ route('states-create') }}" class="btn btn-success btn-sm">
                                    <i class="fa fa-plus me-1"></i> Add State
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
                                        <th>State Name</th>
                                        <th class="text-center">Total Centers</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($states as $state)
                                    <tr id="record-row-{{ $state->id }}">

                                        <td>{{ $loop->iteration }}</td>

                                        <td><strong>{{ $state->name }}</strong></td>

                                        <td class="text-center">
                                            <span class="badge badge-primary">
                                                {{ $state->centers_count }}
                                            </span>
                                        </td>

                                        <td class="text-center">
                                            <label class="switch">
                                                <input type="checkbox" class="toggle-status"
                                                    data-id="{{ $state->id }}"
                                                    data-url="{{ route('states-status') }}"
                                                    {{ $state->status == 1 ? 'checked' : '' }}>
                                                <span class="record-toggle"></span>
                                            </label>
                                        </td>

                                        <td class="text-center">
                                            <div class="form-button-action">

                                                <a href="{{ route('states-edit', $state->id) }}"
                                                    class="btn btn-link btn-primary btn-lg me-2" title="Edit">
                                                    <i class="fa fa-edit"></i>
                                                </a>

                                                <form action="{{ route('states-destroy', $state->id) }}"
                                                    method="POST" class="d-inline"
                                                    onsubmit="return confirm('Are you sure you want to delete {{ addslashes($state->name) }}?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-link btn-danger btn-lg" title="Delete">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>

                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-muted py-4">
                                            No states found.
                                            <a href="#">Add your first state</a>
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

@endsection
