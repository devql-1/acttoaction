@extends('backend.layout.app')
@section('title', 'Categories')

@section('content')

    <div class="container">
        <div class="page-inner">

            {{-- PAGE HEADER --}}
            <div class="page-header">

                <h3 class="fw-bold mb-3">Categories</h3>

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
                        <a href="#">Psychometric Test</a>
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
                        <a href="#">{{ $test->test_name }}</a>
                    </li>

                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>

                    <li class="nav-item">
                        <a href="#">Categories</a>
                    </li>

                </ul>

            </div>


            {{-- ACTION BUTTONS --}}
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">

                <div>
                    <h4 class="fw-bold mb-0">{{ $test->test_name }}</h4>
                    <small class="text-muted">Manage Categories</small>
                </div>

                <div class="d-flex gap-2">

                    <a href="{{ route('quiz-tests.show', $test->id) }}" class="btn btn-outline-secondary btn-sm">

                        <i class="fa fa-arrow-left"></i> Back
                    </a>

                    <a href="{{ route('quiz-categories.create', $test->id) }}" class="btn btn-primary btn-sm">

                        <i class="fa fa-plus"></i> Add Category
                    </a>

                    <a href="{{ route('quiz-questions.create', $test->id) }}" class="btn btn-success btn-sm">

                        <i class="fa fa-plus"></i> Add Question
                    </a>

                </div>

            </div>


            {{-- STATS --}}
            <div class="row mb-4">

                <div class="col-md-4">

                    <div class="card card-stats card-round">

                        <div class="card-body">

                            <div class="row align-items-center">

                                <div class="col-icon">
                                    <div class="icon-big text-center icon-primary bubble-shadow-small">
                                        <i class="fas fa-layer-group"></i>
                                    </div>
                                </div>

                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">

                                        <p class="card-category">Categories</p>

                                        <h4 class="card-title">
                                            {{ $categories->count() }}
                                        </h4>

                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <div class="col-md-4">

                    <div class="card card-stats card-round">

                        <div class="card-body">

                            <div class="row align-items-center">

                                <div class="col-icon">
                                    <div class="icon-big text-center icon-success bubble-shadow-small">
                                        <i class="fas fa-question"></i>
                                    </div>
                                </div>

                                <div class="col col-stats ms-3 ms-sm-0">

                                    <div class="numbers">

                                        <p class="card-category">Questions</p>

                                        <h4 class="card-title">
                                            {{ $categories->sum('questions_count') }}
                                        </h4>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <div class="col-md-4">

                    <div class="card card-stats card-round">

                        <div class="card-body">

                            <div class="row align-items-center">

                                <div class="col-icon">
                                    <div class="icon-big text-center icon-warning bubble-shadow-small">
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>

                                <div class="col col-stats ms-3 ms-sm-0">

                                    <div class="numbers">

                                        <p class="card-category">Total Marks</p>

                                        <h4 class="card-title">
                                            {{ $categories->sum('total_marks') }}
                                        </h4>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- CATEGORY LIST --}}
            <div class="row">

                @forelse($categories as $cat)

                    <div class="col-md-4 mb-4">

                        <div class="card card-round shadow-sm h-100">

                            <div class="card-body">

                                <h5 class="fw-bold mb-1">
                                    {{ $cat->category_name }}
                                </h5>

                                <p class="text-muted small mb-3">
                                    {{ Str::limit($cat->description, 90) }}
                                </p>


                                <div class="d-flex justify-content-between mb-3">

                                    <span class="badge bg-info">
                                        {{ $cat->questions_count }} Questions
                                    </span>

                                    <span class="badge bg-warning text-dark">
                                        {{ $cat->total_marks }} Marks
                                    </span>

                                </div>


                                <div class="d-flex gap-2">

                                    <a href="{{ route('quiz-questions.index', [$test->id, $cat->id]) }}"
                                        class="btn btn-outline-info btn-sm">

                                        <i class="fa fa-list"></i>
                                    </a>

                                    <a href="{{ route('quiz-categories.edit', [$test->id, $cat->id]) }}"
                                        class="btn btn-outline-warning btn-sm">

                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <button class="btn btn-outline-danger btn-sm btn-delete"
                                        data-url="{{ route('quiz-categories.destroy', [$test->id, $cat->id]) }}"
                                        data-name="{{ $cat->category_name }}">

                                        <i class="fa fa-trash"></i>

                                    </button>

                                </div>

                            </div>

                        </div>

                    </div>

                @empty

                    <div class="col-12">

                        <div class="card">

                            <div class="card-body text-center text-muted p-5">

                                <i class="fa fa-layer-group fa-3x mb-3"></i>

                                <p>No categories added yet</p>

                                <a href="{{ route('quiz-categories.create', $test->id) }}" class="btn btn-primary btn-sm">

                                    Add First Category

                                </a>

                            </div>

                        </div>

                    </div>

                @endforelse

            </div>

        </div>
    </div>


    {{-- DELETE SCRIPT --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>

        document.querySelectorAll('.btn-delete').forEach(btn => {

            btn.addEventListener('click', function () {

                Swal.fire({

                    title: 'Delete "' + this.dataset.name + '"?',

                    icon: 'warning',

                    showCancelButton: true,

                    confirmButtonText: 'Delete',

                    confirmButtonColor: '#d33'

                }).then((result) => {

                    if (result.isConfirmed) {

                        fetch(this.dataset.url, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            }
                        }).then(() => location.reload())

                    }

                })

            })

        })

    </script>

@endsection