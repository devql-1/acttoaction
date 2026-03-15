{{-- resources/views/backend/psych/tests/create.blade.php --}}

@extends('backend.layout.app')
@section('title', 'Create Test')

@push('styles')

    <style>
        .psych-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.07);
        }

        .psych-card .card-header {
            background: linear-gradient(135deg, #6f42c1, #8b5cf6);
            color: white;
            border-radius: 10px 10px 0 0 !important;
            padding: 14px 20px;
        }

        .psych-card .card-header h5 {
            margin: 0;
            font-weight: 600;
        }

        .btn-purple {
            background: #6f42c1;
            color: white;
            border-color: #6f42c1;
        }

        .btn-purple:hover {
            background: #5a32a3;
            color: white;
        }

        .form-label {
            font-weight: 600;
            font-size: 14px;
        }
    </style>

@endpush

@section('content')

    <div class="container">

        <div class="page-inner">

            <!-- PAGE HEADER -->

            <div class="page-header">
                <h3 class="fw-bold mb-3">Create New Test</h3>

                <ul class="breadcrumbs mb-3">

                    <li class="nav-home">
                        <a href="#"><i class="icon-home"></i></a>
                    </li>

                    <li class="separator"><i class="icon-arrow-right"></i></li>

                    <li class="nav-item">
                        <a href="{{ route('quiz-tests.index') }}">Tests</a>
                    </li>

                    <li class="separator"><i class="icon-arrow-right"></i></li>

                    <li class="nav-item">
                        <a href="#">Create Test</a>
                    </li>

                </ul>

            </div>

            @if($errors->any())

                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row justify-content-center">

                <div class="col-lg-6 col-md-8">

                    <div class="card psych-card">

                        <div class="card-header">
                            <h5><i class="fas fa-plus-circle me-2"></i>Create New Test</h5>
                        </div>

                        <div class="card-body p-4">

                            <form action="{{ route('quiz-tests.store') }}" method="POST">

                                @csrf

                                <!-- TEST NAME -->

                                <div class="mb-3">

                                    <label class="form-label">
                                        Test Name <span class="text-danger">*</span>
                                    </label>

                                    <input type="text" name="test_name"
                                        class="form-control @error('test_name') is-invalid @enderror"
                                        value="{{ old('test_name') }}" placeholder="e.g. Leadership Personality Assessment"
                                        required>

                                    @error('test_name')

                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                </div>

                                <!-- DESCRIPTION -->

                                <div class="mb-3">

                                    <label class="form-label">Description</label>

                                    <textarea name="description" rows="4"
                                        class="form-control @error('description') is-invalid @enderror"
                                        placeholder="What does this test measure?">{{ old('description') }}</textarea>

                                    @error('description')

                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                </div>

                                <!-- DURATION -->

                                <div class="mb-3">

                                    <label class="form-label">Duration</label>

                                    <input type="text" name="duration"
                                        class="form-control @error('duration') is-invalid @enderror"
                                        value="{{ old('duration') }}" placeholder="e.g. 30 minutes">

                                    @error('duration')

                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                </div>

                                <!-- AGE RANGE -->

                                <div class="mb-4">

                                    <label class="form-label">Age Range</label>

                                    <input type="text" name="age" class="form-control @error('age') is-invalid @enderror"
                                        value="{{ old('age') }}" placeholder="e.g. 18-35">

                                    @error('age')

                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                </div>

                                <div class="d-flex gap-2">

                                    <button type="submit" class="btn btn-purple px-4">
                                        <i class="fas fa-arrow-right me-1"></i> Save & Go to Categories
                                    </button>

                                    <a href="{{ route('quiz-tests.index') }}" class="btn btn-outline-secondary">
                                        Cancel
                                    </a>

                                </div>

                            </form>

                        </div>

                    </div>

                    <!-- BACK BUTTON -->



                </div>

            </div>

        </div>

    </div>

@endsection