@extends('backend.layout.app')
@section('title', 'Questions - ' . $category->category_name)

@section('content')

    <div class="container">
        <div class="page-inner">

            <!-- Page Header -->
            <div class="page-header">
                <h3 class="fw-bold mb-3">Questions</h3>

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
                        <a href="{{ route('quiz-tests.show', $test->id) }}">
                            {{ $test->test_name }}
                        </a>
                    </li>

                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('quiz-categories.index', $test->id) }}">Categories</a>
                    </li>

                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>

                    <li class="nav-item">
                        <a href="#">{{ $category->category_name }}</a>
                    </li>

                </ul>
            </div>



            <!-- Top Section -->
            <div class="d-flex justify-content-between align-items-start mb-4 flex-wrap gap-2">

                <div>

                    <h4 class="fw-bold mb-1">{{ $category->category_name }}</h4>

                    <small class="text-muted">
                        Test: <strong>{{ $test->test_name }}</strong>
                    </small>

                    <span class="badge bg-warning text-dark ms-2">
                        {{ $category->total_marks }} pts
                    </span>

                </div>


                <div class="d-flex gap-2">

                    <a href="{{ route('quiz-categories.index', $test->id) }}" class="btn btn-outline-secondary btn-sm">

                        <i class="fas fa-arrow-left me-1"></i>
                        Back

                    </a>

                    <a href="{{ route('quiz-questions.create', $test->id) }}" class="btn btn-primary btn-sm">

                        <i class="fas fa-plus me-1"></i>
                        Add Questions

                    </a>

                </div>

            </div>



            @if(session('success'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                </div>
            @endif



            <!-- Scale Legend -->
            <div class="mb-3">

                <span class="fw-bold text-muted me-2">Scale:</span>

                @foreach(['Strongly Disagree', 'Disagree', 'Neutral', 'Agree', 'Strongly Agree'] as $si => $sl)

                    <span class="badge bg-light text-dark border me-1">
                        {{ $si + 1 }} – {{ $sl }}
                    </span>

                @endforeach

            </div>



            <!-- Questions Card -->
            <div class="card">

                <div class="card-header d-flex justify-content-between align-items-center">

                    <h4 class="card-title">
                        <i class="fas fa-question-circle me-2"></i>
                        Questions
                    </h4>

                    <span class="badge bg-primary">
                        {{ $questions->count() }}
                    </span>

                </div>


                <div class="card-body">

                    @if($questions->isEmpty())

                        <div class="text-center py-5 text-muted">

                            <i class="fas fa-question-circle fa-2x mb-2"></i>

                            <p>No questions added yet.</p>

                            <a href="{{ route('quiz-questions.create', $test->id) }}" class="btn btn-sm btn-primary">

                                Add Questions

                            </a>

                        </div>

                    @else


                        @foreach($questions as $i => $q)

                            <div class="border rounded p-3 mb-3">

                                <div class="d-flex align-items-start justify-content-between gap-3">

                                    <div class="flex-grow-1">

                                        <div class="fw-semibold mb-1">

                                            <span class="badge bg-primary me-2">
                                                {{ $i + 1 }}
                                            </span>

                                            {{ $q->question_text }}

                                        </div>


                                        <div class="mt-1">

                                            @for($s = 1; $s <= 5; $s++)
                                                <span class="badge bg-light text-dark border me-1">{{ $s }}</span>
                                            @endfor

                                            <small class="text-muted ms-2">
                                                = 5 marks
                                            </small>

                                        </div>

                                    </div>


                                    <div class="d-flex gap-1">

                                        <a href="{{ route('quiz-questions.edit', [$test->id, $category->id, $q->id]) }}"
                                            class="btn btn-sm btn-outline-warning">

                                            <i class="fas fa-edit"></i>

                                        </a>


                                        <form id="delete-form-{{ $q->id }}"
                                            action="{{ route('quiz-questions.destroy', [$test->id, $category->id, $q->id]) }}"
                                            method="POST" class="d-none">

                                            @csrf
                                            @method('DELETE')

                                        </form>


                                        <button type="button" class="btn btn-sm btn-outline-danger"
                                            onclick="confirmDelete({{ $q->id }},'Q{{ $i + 1 }}')">

                                            <i class="fas fa-trash"></i>

                                        </button>

                                    </div>

                                </div>

                            </div>

                        @endforeach

                    @endif

                </div>

            </div>

        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>

        function confirmDelete(id, name) {

            Swal.fire({

                title: 'Delete "' + name + '"?',

                text: 'This question will be permanently deleted.',

                icon: 'warning',

                showCancelButton: true,

                confirmButtonColor: '#6366f1',

                cancelButtonColor: '#6c757d',

                confirmButtonText: 'Yes, Delete'

            }).then((result) => {

                if (result.isConfirmed) {

                    document.getElementById('delete-form-' + id).submit();

                }

            });

        }

    </script>

@endsection