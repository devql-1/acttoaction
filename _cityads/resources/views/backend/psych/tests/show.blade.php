{{-- resources/views/backend/psych/tests/show.blade.php --}}
@extends('backend.layout.app')
@section('title', $test->test_name)

@section('content')

    <div class="container">
        <div class="page-inner">

            <!-- Page Header -->
            <div class="page-header">
                <h3 class="fw-bold mb-3">{{ $test->test_name }}</h3>

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
                        <a href="{{ route('quiz-tests.index') }}">Psychometric Tests</a>
                    </li>

                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>

                    <li class="nav-item">
                        <a href="#">{{ $test->test_name }}</a>
                    </li>

                </ul>
            </div>


            <!-- Top Actions -->
            <div class="d-flex justify-content-between align-items-start mb-4 flex-wrap gap-2">

                <div>

                    @if($test->duration)
                        <span class="badge bg-light text-dark border me-2">
                            <i class="fas fa-clock me-1"></i>{{ $test->duration }}
                        </span>
                    @endif

                    @if($test->description)
                        <p class="text-muted mt-2 mb-0">{{ $test->description }}</p>
                    @endif

                </div>


                <div class="d-flex gap-2 flex-wrap">

                    <a href="{{ route('quiz-tests.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-arrow-left me-1"></i> Back
                    </a>

                    <a href="{{ route('quiz-tests.edit', $test->id) }}" class="btn btn-outline-warning btn-sm">
                        <i class="fas fa-edit me-1"></i> Edit Test
                    </a>

                    <a href="{{ route('quiz-categories.create', $test->id) }}" class="btn btn-outline-primary btn-sm">
                        <i class="fas fa-layer-group me-1"></i> Add Category
                    </a>

                    <a href="{{ route('quiz-questions.create', $test->id) }}" class="btn btn-success btn-sm">
                        <i class="fas fa-plus me-1"></i> Add Questions
                    </a>

                </div>

            </div>



            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                </div>
            @endif



            <!-- Stats -->
            <div class="row mb-4">

                <div class="col-md-4">
                    <div class="card text-center">

                        <div class="card-body">

                            <h2 class="fw-bold text-primary">{{ $test->categories_count }}</h2>
                            <p class="text-muted mb-0">Categories</p>

                        </div>

                    </div>
                </div>


                <div class="col-md-4">
                    <div class="card text-center">

                        <div class="card-body">

                            <h2 class="fw-bold text-success">{{ $test->questions_count }}</h2>
                            <p class="text-muted mb-0">Questions</p>

                        </div>

                    </div>
                </div>


                <div class="col-md-4">
                    <div class="card text-center">

                        <div class="card-body">

                            <h2 class="fw-bold text-warning">{{ $test->total_marks }}</h2>
                            <p class="text-muted mb-0">Total Marks</p>

                        </div>

                    </div>
                </div>

            </div>



            <!-- Categories Section -->
            <div class="card">

                <div class="card-header d-flex justify-content-between align-items-center">

                    <h4 class="card-title">
                        <i class="fas fa-layer-group me-2"></i>
                        Categories & Marks Breakdown
                    </h4>

                    <a href="{{ route('quiz-categories.index', $test->id) }}" class="btn btn-sm btn-outline-primary">
                        Manage Categories
                    </a>

                </div>



                <div class="card-body">

                    @forelse($categories as $cat)

                        <div class="border rounded p-3 mb-3">

                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">

                                <div>

                                    <strong>{{ $cat->category_name }}</strong>

                                    @if($cat->description)
                                        <div class="text-muted small">
                                            {{ Str::limit($cat->description, 60) }}
                                        </div>
                                    @endif

                                </div>


                                <div class="d-flex align-items-center gap-2">

                                    <span class="badge bg-primary">
                                        {{ $cat->questions_count }} Questions
                                    </span>

                                    <span class="badge bg-warning text-dark">
                                        {{ $cat->total_marks }} pts
                                    </span>

                                    <a href="{{ route('quiz-questions.index', [$test->id, $cat->id]) }}"
                                        class="btn btn-sm btn-outline-secondary">

                                        <i class="fas fa-list-ul me-1"></i>
                                        View Questions

                                    </a>

                                </div>

                            </div>


                            @if($test->total_marks > 0)

                                <div class="progress mt-2" style="height:8px">

                                    <div class="progress-bar bg-primary"
                                        style="width:{{ ($cat->total_marks / $test->total_marks) * 100 }}%">

                                    </div>

                                </div>

                                <small class="text-muted">

                                    {{ round(($cat->total_marks / $test->total_marks) * 100) }}% of total marks

                                </small>

                            @endif


                        </div>

                    @empty

                        <div class="text-center py-4 text-muted">

                            <i class="fas fa-layer-group fa-2x mb-2"></i>

                            <p>No categories yet.</p>

                            <a href="{{ route('quiz-categories.create', $test->id) }}" class="btn btn-sm btn-primary">

                                Add Category

                            </a>

                        </div>

                    @endforelse

                </div>

            </div>

        </div>
    </div>

@endsection