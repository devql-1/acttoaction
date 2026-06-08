@extends('backend.layout.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Course Details</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home">
                        <a href="#"><i class="icon-home"></i></a>
                    </li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="{{ route('courses') }}">Courses</a></li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="#">{{ $course->title }}</a></li>
                </ul>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">{{ $course->title }}</div>
                        </div>

                        <div class="card-body">
                            <!-- Banner Image -->
                            @if ($course->banner_image)
                                <div class="mb-4">
                                    <img src="{{ $course->banner_url }}" alt="{{ $course->title }}"
                                        class="img-fluid rounded"
                                        style="max-width: 100%; max-height: 400px; object-fit: cover;">
                                </div>
                            @else
                                <div class="mb-4 p-5 bg-light rounded text-center text-muted">
                                    <i class="fa fa-image" style="font-size: 3rem;"></i>
                                    <p class="mt-2">No banner image</p>
                                </div>
                            @endif

                            <!-- Course Slug -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label"><strong>Slug</strong></label>
                                    <div class="form-control-plaintext">
                                        <code class="bg-light p-2 rounded">{{ $course->slug }}</code>
                                    </div>
                                </div>
                            </div>

                            <!-- Course Category & Duration -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label"><strong>Category</strong></label>
                                    <div class="form-control-plaintext">
                                        @if ($course->category)
                                            <span class="badge bg-primary">{{ $course->category->name }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label"><strong>Duration</strong></label>
                                    <div class="form-control-plaintext">
                                        {{ $course->duration ?? '-' }}
                                    </div>
                                </div>
                            </div>

                            <!-- Mode & Age Group -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label"><strong>Mode</strong></label>
                                    <div class="form-control-plaintext">
                                        @if ($course->mode)
                                            <span class="badge bg-info">{{ ucfirst($course->mode) }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label"><strong>Age Group</strong></label>
                                    <div class="form-control-plaintext">
                                        {{ $course->age_group ?? '-' }}
                                    </div>
                                </div>
                            </div>

                            <!-- Sessions -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label class="form-label"><strong>Total Sessions</strong></label>
                                    <div class="form-control-plaintext">
                                        {{ $course->sessions ?? 0 }}
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <!-- Description -->
                            @if ($course->description)
                                <div class="mb-3">
                                    <label class="form-label"><strong>Description</strong></label>
                                    <div class="form-control-plaintext">
                                        <div class="content">
                                            {!! $course->description !!}
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            @endif

                            <!-- Social Links -->
                            <div class="row mb-3">
                                @if ($course->instagram_link)
                                    <div class="col-md-6">
                                        <label class="form-label"><strong>Instagram Link</strong></label>
                                        <div class="form-control-plaintext">
                                            <a href="{{ $course->instagram_link }}" target="_blank"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="fab fa-instagram me-2"></i> Visit Instagram
                                            </a>
                                        </div>
                                    </div>
                                @endif

                                @if ($course->highlights_link)
                                    <div class="col-md-6">
                                        <label class="form-label"><strong>Highlights Link</strong></label>
                                        <div class="form-control-plaintext">
                                            <a href="{{ $course->highlights_link }}" target="_blank"
                                                class="btn btn-sm btn-outline-danger">
                                                <i class="fab fa-youtube me-2"></i> Watch Highlights
                                            </a>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <hr>

                            <!-- Documents Section -->
                            @if ($course->documents && $course->documents->count() > 0)
                                <div class="mb-3">
                                    <h5 class="mb-3">Course Documents</h5>
                                    <div class="list-group">
                                        @foreach ($course->documents as $doc)
                                            <a href="{{ asset('storage/' . $doc->document_file) }}" target="_blank"
                                                class="list-group-item list-group-item-action">
                                                <i class="fa fa-file-pdf text-danger me-2"></i>
                                                {{ $doc->document_name }}
                                                <small class="float-end text-muted">
                                                    {{ $doc->created_at->format('M d, Y') }}
                                                </small>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                                <hr>
                            @endif

                            <!-- Sessions Section -->
                            @php
                                $courseSessions = $course->sessions()->get();
                            @endphp
                            @if ($courseSessions && $courseSessions->count() > 0)
                                <div class="mb-3">
                                    <h5 class="mb-3">Course Sessions ({{ $courseSessions->count() }})</h5>
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Title</th>
                                                    <th>Start Date</th>
                                                    <th>Description</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($courseSessions as $session)
                                                    <tr>
                                                        <td>
                                                            <strong>{{ $session->title ?? 'Session' }}</strong>
                                                        </td>
                                                        <td>
                                                            {{ $session->start_date ? $session->start_date->format('M d, Y') : '-' }}
                                                        </td>
                                                        <td>
                                                            {{ $session->description ? substr($session->description, 0, 50) . '...' : '-' }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <hr>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-md-4">
                    <!-- Centers & Fees Card -->
                    <div class="card mb-3">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">
                                <i class="fa fa-map-marker me-2"></i>
                                Centers & Fees
                                @if ($course->centers)
                                    <span class="badge bg-light text-dark float-end">{{ $course->centers->count() }}</span>
                                @endif
                            </h5>
                        </div>
                        <div class="card-body">
                            @if ($course->centers && $course->centers->count() > 0)
                                <div class="centers-list">
                                    @foreach ($course->centers as $center)
                                        <div class="center-item border-bottom pb-3 mb-3">
                                            <h6 class="fw-bold mb-2">{{ $center->name }}</h6>

                                            @if ($center->address)
                                                <p class="small text-muted mb-1">
                                                    <i class="fa fa-map-pin me-2"></i>
                                                    {{ $center->address }}
                                                </p>
                                            @endif

                                            @if ($center->phone)
                                                <p class="small text-muted mb-2">
                                                    <i class="fa fa-phone me-2"></i>
                                                    <a href="tel:{{ $center->phone }}" class="text-decoration-none">
                                                        {{ $center->phone }}
                                                    </a>
                                                </p>
                                            @endif

                                            @if ($center->state)
                                                <p class="small text-muted mb-2">
                                                    <i class="fa fa-location-dot me-2"></i>
                                                    {{ $center->state->name }}
                                                </p>
                                            @endif

                                            <div class="price-section bg-light p-2 rounded mt-2">
                                                <h5 class="text-success fw-bold mb-0">
                                                    ₹{{ number_format($center->pivot->fees, 2) }}
                                                </h5>
                                                <small class="text-muted">Course Fee</small>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="alert alert-info mb-0">
                                    <i class="fa fa-info-circle me-2"></i>
                                    No centers assigned yet.
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Course Status Card -->
                    <div class="card mb-3">
                        <div class="card-header bg-secondary text-white">
                            <h5 class="mb-0">Status & Actions</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label"><strong>Current Status</strong></label>
                                <div>
                                    @if ($course->status == 1)
                                        <span class="badge bg-success">
                                            <i class="fa fa-check me-1"></i> Active
                                        </span>
                                    @else
                                        <span class="badge bg-danger">
                                            <i class="fa fa-times me-1"></i> Inactive
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label"><strong>Created</strong></label>
                                <div class="form-control-plaintext">
                                    <small class="text-muted">
                                        {{ $course->created_at->format('M d, Y H:i A') }}
                                    </small>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label"><strong>Last Updated</strong></label>
                                <div class="form-control-plaintext">
                                    <small class="text-muted">
                                        {{ $course->updated_at->format('M d, Y H:i A') }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons Card -->
                    <div class="card">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">Actions</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <a href="{{ route('courses.edit', $course->slug) }}" class="btn btn-warning btn-sm">
                                    <i class="fa fa-edit me-2"></i> Edit Course
                                </a>
                                {{-- <form action="{{ route('courses.destroy', $course->slug) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm w-100"
                                        onclick="return confirm('Are you sure you want to delete this course? This action cannot be undone.');">
                                        <i class="fa fa-trash me-2"></i> Delete Course
                                    </button>
                                </form> --}}
                                <a href="{{ route('courses') }}" class="btn btn-secondary btn-sm">
                                    <i class="fa fa-arrow-left me-2"></i> Back to Courses
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .center-item:last-child {
            border-bottom: none !important;
        }

        .price-section {
            text-align: center;
        }

        .content {
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .content p {
            margin-bottom: 1rem;
        }
    </style>
@endsection
