@extends('backend.layout.app')
@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Edit State</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="#"><i class="icon-home"></i></a>
                </li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Masters</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item">
                    <a href="{{ route('admin.states-index') }}">States</a>
                </li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Edit State</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Edit State — <span class="text-muted">{{ $state->name }}</span></div>
                    </div>

                    <form action="{{ route('admin.states-update', $state->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="card-body">
                            <div class="form-group">
                                <label>State Name <span class="text-danger">*</span></label>
                                <input
                                    type="text"
                                    name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    placeholder="e.g. Rajasthan"
                                    value="{{ old('name', $state->name) }}"
                                    required
                                >
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">State name must be unique.</small>
                            </div>

                            {{-- Info --}}
                            <div class="alert alert-light border mt-3 mb-0">
                                <small class="text-muted">
                                    <i class="fa fa-info-circle me-1"></i>
                                    This state has <strong>{{ $state->centers_count }}</strong> center(s) assigned.
                                </small>
                            </div>
                        </div>

                        <div class="card-action d-flex justify-content-between align-items-center">
                            <a href="{{ route('admin.states-index') }}" class="btn btn-secondary">
                                <i class="fa fa-arrow-left me-1"></i> Back
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-save me-1"></i> Update State
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

    </div>
</div>

@endsection
