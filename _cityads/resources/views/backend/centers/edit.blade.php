@extends('backend.layout.app')
@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Edit Center</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="#"><i class="icon-home"></i></a>
                </li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Masters</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item">
                    <a href="{{ route('admin.centers-index') }}">Centers</a>
                </li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Edit Center</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            Edit Center — <span class="text-muted">{{ $center->name }}</span>
                        </div>
                    </div>

                    <form action="{{ route('admin.centers-update', $center->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="card-body">

                            <div class="row">

                                {{-- STATE --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>State <span class="text-danger">*</span></label>
                                        <select name="state_id"
                                            class="form-control @error('state_id') is-invalid @enderror" required>
                                            <option value="">-- Select State --</option>
                                            @foreach($states as $state)
                                            <option value="{{ $state->id }}" {{ old('state_id', $center->state_id) ==
                                                $state->id ? 'selected' : '' }}>
                                                {{ $state->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('state_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- CENTER NAME --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Center Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="e.g. Jaipur Center" value="{{ old('name', $center->name) }}"
                                            required>
                                        @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- ADDRESS --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Full Address</label>
                                        <textarea name="address"
                                            class="form-control @error('address') is-invalid @enderror" rows="3"
                                            placeholder="Street, Area, City, Pincode">{{ old('address', $center->address) }}</textarea>
                                        @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- PHONE --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" name="phone"
                                            class="form-control @error('phone') is-invalid @enderror"
                                            placeholder="9876543210" value="{{ old('phone', $center->phone) }}">
                                        @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- EMAIL --}}
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            placeholder="center@example.com" value="{{ old('email', $center->email) }}">
                                        @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- MAP LINK --}}
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Google Map Link</label>
                                        <input type="url" name="map_link"
                                            class="form-control @error('map_link') is-invalid @enderror"
                                            placeholder="https://maps.google.com/..."
                                            value="{{ old('map_link', $center->map_link) }}">
                                        @error('map_link')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">
                                            Paste the Google Maps share link for this center location.
                                        </small>
                                    </div>
                                </div>

                                {{-- Current Map Preview --}}
                                @if($center->map_link)
                                <div class="col-md-12">
                                    <div class="alert alert-light border">
                                        <small class="text-muted">
                                            <i class="fa fa-map-marker me-1 text-danger"></i>
                                            Current map:
                                            <a href="{{ $center->map_link }}" target="_blank">
                                                View on Google Maps
                                            </a>
                                        </small>
                                    </div>
                                </div>
                                @endif

                            </div>

                        </div>

                        <div class="card-action d-flex justify-content-between align-items-center">
                            <a href="{{ route('admin.centers-index') }}" class="btn btn-secondary">
                                <i class="fa fa-arrow-left me-1"></i> Back
                            </a>
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-save me-1"></i> Update Center
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection