@extends('backend.layout.app')
@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Courses</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home">
                        <a href="#"><i class="icon-home"></i></a>
                    </li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="#">Courses</a></li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="#">All Courses</a></li>
                </ul>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-round">
                        <div class="card-header">
                            <div class="card-head-row card-tools-still-right">
                                <div class="card-title">All Courses</div>
                                <div class="card-tools">
                                    <a href="{{ route('courses.create') }}" class="btn btn-success btn-sm">
                                        <i class="fa fa-plus me-1"></i> Add Course
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-2">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0" id="basic-datatables">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th class="text-center">Duration</th>
                                            <th class="text-center">Sessions</th>
                                            <th class="text-center">Mode</th>
                                            <th class="text-center">Age Group</th>
                                            <th class="text-center">Fees</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($courses as $course)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td><strong>{{ $course->title }}</strong></td>
                                                <td class="text-center">{{ $course->duration ?? '--' }}</td>
                                                <td class="text-center">{{ $course->sessions ?? '--' }}</td>
                                                <td class="text-center">
                                                    @if($course->mode == 'online')
                                                        <span class="badge badge-info">Online</span>
                                                    @elseif($course->mode == 'offline')
                                                        <span class="badge badge-warning">Offline</span>
                                                    @else
                                                        <span class="badge badge-secondary">Both</span>
                                                    @endif
                                                </td>
                                                <td class="text-center">{{ $course->age_group ?? '--' }}</td>
                                                <td class="text-center">&#8377;{{ number_format($course->fees, 2) }}</td>
                                                <td class="text-center">
                                                <td class="text-center">
                                                    <label class="switch">
                                                        <input type="checkbox" class="toggle-status"
                                                            data-id="{{ $course->id }}"
                                                            data-url="{{ route('courses.status-update', $course->id) }}"
                                                            {{ $course->status == 1 ? 'checked' : '' }}>
                                                        <span class="record-toggle"></span>
                                                    </label>
                                                </td>
                                                </td>
                                                <td class="text-center">
                                                    <div class="form-button-action">

                                                        <a href="{{ route('courses.show', $course->id) }}"
                                                            class="btn btn-link btn-info btn-lg me-2" title="View">
                                                            <i class="fa fa-eye"></i>
                                                        </a>

                                                        <a href="{{ route('courses.edit', $course->id) }}"
                                                            class="btn btn-link btn-primary btn-lg me-2" title="Edit">
                                                            <i class="fa fa-edit"></i>
                                                        </a>

                                                        {{-- Hidden delete form --}}
                                                        <form id="delete-form-{{ $course->id }}"
                                                            action="{{ route('courses.delete', $course->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>

                                                        <a href="javascript:void(0)"
                                                            class="btn btn-link btn-danger btn-lg delete-record"
                                                            data-id="{{ $course->id }}"
                                                            title="Delete">
                                                            <i class="fa fa-trash"></i>
                                                        </a>

                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" class="text-center text-muted py-4">No courses found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).on('click', '.delete-record', function () {
            const id = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: 'This course will be permanently deleted.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }
            });
        });

        // ── Status Toggle ─────────────────────────────────────────
        $(document).on('change', '.toggle-status', function () {
            const id     = $(this).data('id');
            const url    = $(this).data('url');
            const status = $(this).is(':checked') ? 1 : 0;
            const token  = '{{ csrf_token() }}';

            $.post(url, { _token: token, id: id, status: status });
        });

    </script>

@endsection