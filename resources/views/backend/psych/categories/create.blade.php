{{-- resources/views/backend/psych/categories/create.blade.php --}}
@extends('backend.layout.app')
@section('title', 'Add Category')

@section('content')

    <div class="container">
        <div class="page-inner">

            {{-- PAGE HEADER --}}
            <div class="page-header">

                <h3 class="fw-bold mb-3">Add Category</h3>

                <ul class="breadcrumbs mb-3">

                    <li class="nav-home">
                        <a href="#">
                            <i class="icon-home"></i>
                        </a>
                    </li>

                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>

                    <li class="nav-item">
                        <a href="#">Psychometric Tests</a>
                    </li>

                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('quiz-tests.index') }}">Tests</a>
                    </li>

                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('quiz-categories.index', $test->id) }}">
                            {{ $test->test_name }}
                        </a>
                    </li>

                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>

                    <li class="nav-item">
                        <a href="#">Add Category</a>
                    </li>

                </ul>

            </div>


            {{-- FORM CARD --}}
            <div class="row justify-content-center">

                <div class="col-lg-8">

                    <div class="card shadow-sm">

                        <div class="card-header">

                            <div class="d-flex justify-content-between align-items-center">

                                <h4 class="card-title mb-0">
                                    <i class="fa fa-plus-circle me-2"></i>
                                    Create New Category
                                </h4>

                                <a href="{{ route('quiz-categories.index', $test->id) }}"
                                    class="btn btn-outline-secondary btn-sm">

                                    <i class="fa fa-arrow-left"></i> Back

                                </a>

                            </div>

                        </div>


                        <div class="card-body">

                            {{-- TEST NAME --}}
                            <div class="mb-4">

                                <span class="badge bg-primary fs-6">

                                    <i class="fa fa-brain me-1"></i>
                                    {{ $test->test_name }}

                                </span>

                            </div>


                            {{-- ERROR --}}
                            @if($errors->any())

                                <div class="alert alert-danger">

                                    <ul class="mb-0">

                                        @foreach($errors->all() as $error)

                                            <li>{{ $error }}</li>

                                        @endforeach

                                    </ul>

                                </div>

                            @endif


                            <form action="{{ route('quiz-categories.store', $test->id) }}" method="POST">

                                @csrf


                                <div class="mb-3">

                                    <label class="form-label fw-bold">
                                        Category Name <span class="text-danger">*</span>
                                    </label>

                                    <input type="text" name="category_name"
                                        class="form-control @error('category_name') is-invalid @enderror"
                                        value="{{ old('category_name') }}"
                                        placeholder="Example: Leadership, Personality, Emotional Intelligence" required>

                                    @error('category_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                </div>


                                <div class="mb-4">

                                    <label class="form-label fw-bold">
                                        Description
                                        <small class="text-muted">(optional)</small>
                                    </label>

                                    <textarea name="description" rows="4"
                                        class="form-control @error('description') is-invalid @enderror"
                                        placeholder="Explain what this category measures...">{{ old('description') }}</textarea>

                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                </div>


                                <div class="d-flex gap-2">

                                    <button type="submit" class="btn btn-primary">

                                        <i class="fa fa-save me-1"></i>
                                        Save Category

                                    </button>

                                    <a href="{{ route('quiz-categories.index', $test->id) }}"
                                        class="btn btn-outline-secondary">

                                        Cancel

                                    </a>

                                </div>


                            </form>

                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>

@endsection