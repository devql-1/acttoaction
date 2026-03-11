{{-- resources/views/backend/psych/tests/edit.blade.php --}}

@extends('backend.layout.app')

@section('title', 'Edit Test')

@section('content')

    <div class="container">

        <div class="page-inner">

            <!-- PAGE HEADER -->

            <div class="page-header">
                <h3 class="fw-bold mb-3">Edit Test</h3>

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
                        <a href="#">Edit Test</a>
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
                <div class="col-md-8">

                    <div class="card card-round">

                        <div class="card-header">

                            <div class="card-head-row">

                                <div class="card-title">
                                    Edit: {{ $test->test_name }}
                                </div>

                            </div>

                        </div>

                        <div class="card-body">

                            <form action="{{ route('quiz-tests.update', $test->id) }}" method="POST">

                                @csrf
                                @method('PUT')

                                <!-- TEST NAME -->

                                <div class="form-group mb-3">

                                    <label class="form-label">
                                        Test Name <span class="text-danger">*</span>
                                    </label>

                                    <input type="text" name="test_name"
                                        class="form-control @error('test_name') is-invalid @enderror"
                                        value="{{ old('test_name', $test->test_name) }}" required>

                                    @error('test_name')

                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                </div>

                                <!-- DESCRIPTION -->

                                <div class="form-group mb-3">

                                    <label class="form-label">Description</label>

                                    <textarea name="description" rows="4"
                                        class="form-control @error('description') is-invalid @enderror">{{ old('description', $test->description) }}</textarea>

                                    @error('description')

                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                </div>

                                <!-- DURATION -->

                                <div class="form-group mb-3">

                                    <label class="form-label">Duration</label>

                                    <input type="text" name="duration"
                                        class="form-control @error('duration') is-invalid @enderror"
                                        value="{{ old('duration', $test->duration) }}" placeholder="e.g. 30 minutes">

                                    @error('duration')

                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                </div>

                                <!-- AGE RANGE -->

                                <div class="form-group mb-4">

                                    <label class="form-label">Age Range</label>

                                    <input type="text" name="age" class="form-control @error('age') is-invalid @enderror"
                                        value="{{ old('age', $test->age) }}" placeholder="e.g. 18-35">

                                    @error('age')

                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                </div>

                                <div class="d-flex gap-2">

                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-save me-1"></i> Update Test
                                    </button>

                                    <a href="{{ route('quiz-tests.index') }}" class="btn btn-secondary">
                                        Cancel
                                    </a>

                                </div>

                            </form>

                        </div>

                    </div>

                    <!-- BACK BUTTON -->

                    <div class="mt-3">

                        <a href="{{ route('quiz-tests.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fa fa-arrow-left"></i> Back
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection