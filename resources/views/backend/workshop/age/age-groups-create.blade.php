@extends('backend.layout.app')
@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Add Age Group</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="{{ route('workshop-age-groups-index') }}">Age Groups</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Add</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-7">
                <div class="card card-round">
                    <div class="card-header"><div class="card-title">Age Group Details</div></div>
                    <div class="card-body">
                        <form action="{{ route('workshop-age-groups-store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" value="{{ old('name') }}"
                                       class="form-control @error('name') is-invalid @enderror"
                                       placeholder="e.g. Ages 3-6, Ages 7-10, Ages 11-15">
                                <div class="form-text text-muted">This name shows in the navbar dropdown.</div>
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Description</label>
                                <input type="text" name="description" value="{{ old('description') }}"
                                       class="form-control"
                                       placeholder="e.g. Little Stars, Young Performers">
                                <div class="form-text text-muted">Optional subtitle shown on the workshops page.</div>
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Sort Order</label>
                                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}"
                                           min="0" class="form-control">
                                    <div class="form-text text-muted">Lower = appears first.</div>
                                </div>
                                <div class="col-md-8 d-flex align-items-end pb-1">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox"
                                               name="status" id="status" value="1"
                                               {{ old('status', true) ? 'checked' : '' }}>
                                        <label class="form-check-label fw-semibold" for="status">Active</label>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-save me-1"></i> Save Age Group
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
                    <div class="card-header"><div class="card-title"><i class="fa fa-info-circle text-info me-1"></i> How it works</div></div>
                    <div class="card-body small text-muted" style="line-height:2">
                        <p class="mb-2"><strong>Step 1:</strong> Create Age Groups (e.g. "Ages 3-6")</p>
                        <p class="mb-2"><strong>Step 2:</strong> Add Cities to each Age Group (e.g. "Jaipur")</p>
                        <p class="mb-2"><strong>Step 3:</strong> Add Schools to each City</p>
                        <hr>
                        <p class="mb-0">On the website, users select an age group → city → and see all schools with their details.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
@if(session('error'))
    Swal.fire({ icon: 'error', title: 'Error!', text: '{{ session('error') }}' });
@endif
</script>
@endsection
