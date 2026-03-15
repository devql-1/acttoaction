@extends('backend.layout.app')
@section('title', 'Quiz Tests')

@section('content')

    <div class="container">
        <div class="page-inner">

            {{-- PAGE HEADER --}}

            <div class="page-header">

                <h3 class="fw-bold mb-3">Psychological Tests</h3>

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
                        <a href="#">Psychometric</a>
                    </li>

                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>

                    <li class="nav-item">
                        <a href="#">Tests</a>
                    </li>

                </ul>

            </div>


            {{-- HEADER CARD --}}

            <div class="card shadow-sm mb-4">

                <div class="card-body d-flex justify-content-between align-items-center flex-wrap">

                    <div>

                        <h4 class="mb-1 fw-bold">
                            <i class="fas fa-brain me-2"></i>
                            Psychological Tests
                        </h4>

                        <p class="text-muted mb-0 small">
                            Create tests, add categories and questions. Marks auto-calculate per category.
                        </p>

                    </div>

                    <a href="{{ route('quiz-tests.create') }}" class="btn btn-primary btn-sm">

                        <i class="fas fa-plus me-1"></i>
                        Create Test

                    </a>

                </div>

            </div>



            {{-- SUCCESS MESSAGE --}}

            @if(session('success'))

                <div class="alert alert-success alert-dismissible fade show">

                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}

                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>

                </div>

            @endif



            {{-- TABLE CARD --}}

            <div class="card">

                <div class="card-header d-flex justify-content-between align-items-center">

                    <h5 class="mb-0">
                        <i class="fas fa-list me-2"></i>
                        All Tests
                    </h5>

                    <span class="badge bg-primary">
                        {{ $tests->count() }}
                    </span>

                </div>


                <div class="card-body p-0">

                    @if($tests->isEmpty())

                        <div class="text-center p-5 text-muted">

                            <i class="fas fa-brain fa-3x mb-3"></i>

                            <p>No tests created yet.</p>

                            <a href="{{ route('quiz-tests.create') }}" class="btn btn-primary btn-sm">

                                Create First Test

                            </a>

                        </div>

                    @else


                        <div class="table-responsive">

                            <table class="table table-hover align-middle mb-0">

                                <thead class="table-light">

                                    <tr>

                                        <th>#</th>

                                        <th>Test Name</th>

                                        <th>Duration</th>

                                        <th>Categories</th>

                                        <th>Questions</th>

                                        <th>Total Marks</th>

                                        <th>Actions</th>

                                    </tr>

                                </thead>


                                <tbody>

                                    @foreach($tests as $i => $test)

                                        <tr>

                                            <td>{{ $i + 1 }}</td>

                                            <td>

                                                <strong>{{ $test->test_name }}</strong>

                                                @if($test->description)

                                                    <div class="text-muted small">
                                                        {{ Str::limit($test->description, 60) }}
                                                    </div>

                                                @endif

                                            </td>


                                            <td>

                                                @if($test->duration)

                                                    <span class="badge bg-light border text-dark">

                                                        <i class="fas fa-clock me-1"></i>
                                                        {{ $test->duration }}

                                                    </span>

                                                @else
                                                    <span class="text-muted">—</span>
                                                @endif

                                            </td>


                                            <td>

                                                <span class="badge bg-info">
                                                    {{ $test->categories_count }}
                                                </span>

                                            </td>


                                            <td>

                                                <span class="badge bg-primary">
                                                    {{ $test->questions_count }}
                                                </span>

                                            </td>


                                            <td>

                                                <span class="badge bg-warning text-dark">
                                                    {{ $test->total_marks }} pts
                                                </span>

                                            </td>


                                            <td>

                                                <a href="{{ route('quiz-tests.show', $test->id) }}"
                                                    class="btn btn-sm btn-outline-info me-1">

                                                    <i class="fas fa-eye"></i>

                                                </a>

                                                <a href="{{ route('quiz-categories.index', $test->id) }}"
                                                    class="btn btn-sm btn-outline-secondary me-1">

                                                    <i class="fas fa-layer-group"></i>

                                                </a>

                                                <a href="{{ route('quiz-questions.create', $test->id) }}"
                                                    class="btn btn-sm btn-outline-success me-1">

                                                    <i class="fas fa-plus-circle"></i>

                                                </a>

                                                <a href="{{ route('quiz-tests.edit', $test->id) }}"
                                                    class="btn btn-sm btn-outline-warning me-1">

                                                    <i class="fas fa-edit"></i>

                                                </a>

                                                <button class="btn btn-sm btn-outline-danger btn-delete"
                                                    data-url="{{ route('quiz-tests.destroy', $test->id) }}"
                                                    data-name="{{ $test->test_name }}">

                                                    <i class="fas fa-trash"></i>

                                                </button>

                                            </td>

                                        </tr>

                                    @endforeach

                                </tbody>

                            </table>

                        </div>

                    @endif

                </div>

            </div>


        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>

        document.querySelectorAll('.btn-delete').forEach(btn => {

            btn.addEventListener('click', function () {

                Swal.fire({

                    title: 'Delete "' + this.dataset.name + '"?',

                    text: 'All categories and questions will be deleted.',

                    icon: 'warning',

                    showCancelButton: true,

                    confirmButtonColor: '#6366f1',

                    confirmButtonText: 'Delete'

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