@extends('backend.layout.app')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Course Categories</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="#">Course Categories</a></li>
                </ul>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-round">
                        <div class="card-header">
                            <div class="card-head-row card-tools-still-right">
                                <div class="card-title">All Categories</div>
                                <div class="card-tools">
                                    <a href="{{ route('course-categories-create') }}" class="btn btn-success btn-sm">
                                        <i class="fa fa-plus me-1"></i> Add Category
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0" id="basic-datatables">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Image</th>
                                            <th>Category Name</th>
                                            <th class="text-center">Courses</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($categories as $category)
                                                                        <tr id="record-row-{{ $category->id }}">

                                                                            <td>{{ $loop->iteration }}</td>

                                                                            <td>
                                                                                <img src="{{ $category->image_url }}" alt="{{ $category->name }}"
                                                                                    class="rounded" style="width:50px; height:50px; object-fit:cover;">
                                                                            </td>

                                                                            <td><strong>{{ $category->name }}</strong></td>

                                                                            <td class="text-center">
                                                                                <span class="badge badge-primary">
                                                                                    {{ $category->courses_count }} Courses
                                                                                </span>
                                                                            </td>

                                                                            <td class="text-center">
                                                                                <label class="switch">
                                                                                    <input type="checkbox" class="toggle-status"
                                                                                        data-id="{{ $category->id }}"
                                                                                        data-url="{{ route('course-categories-status') }}" {{
                                            $category->status == 1 ? 'checked' : '' }}>
                                                                                    <span class="record-toggle"></span>
                                                                                </label>
                                                                            </td>

                                                                            <td class="text-center">
                                                                                <div class="d-flex justify-content-center gap-1">
                                                                                    <a href="{{ route('course-categories-edit', $category->id) }}"
                                                                                        class="btn btn-primary btn-sm">
                                                                                        <i class="fa fa-edit me-1"></i> Edit
                                                                                    </a>
                                                                                    <form id="delete-form-{{ $category->id }}"
                                                                                        action="{{ route('course-categories-destroy', $category->id) }}"
                                                                                        method="POST" class="d-none">
                                                                                        @csrf
                                                                                        @method('DELETE')
                                                                                    </form>
                                                                                    <button type="button" class="btn btn-danger btn-sm"
                                                                                        onclick="confirmDelete({{ $category->id }}, '{{ addslashes($category->name) }}')">
                                                                                        <i class="fa fa-trash me-1"></i> Delete
                                                                                    </button>
                                                                                </div>
                                                                            </td>

                                                                        </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center text-muted py-4">
                                                    No categories found.
                                                    <a href="{{ route('course-categories-create') }}">Create your first
                                                        category</a>
                                                </td>
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
        function confirmDelete(id, name) {
            Swal.fire({
                title: 'Delete Category?',
                text: `"${name}" will be permanently deleted.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${id}`).submit();
                }
            });
        }

        @if (session('success'))
            Swal.fire({ icon: 'success', title: 'Success!', text: '{{ session('success') }}', timer: 2500, showConfirmButton: false });
        @endif
        @if (session('error'))
            Swal.fire({ icon: 'error', title: 'Error!', text: '{{ session('error') }}' });
        @endif
    </script>

@endsection