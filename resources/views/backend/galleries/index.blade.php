@extends('backend.layout.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Gallery Images</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home">
                        <a href="#"><i class="icon-home"></i></a>
                    </li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="#">Gallery</a></li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="#">Gallery Images</a></li>
                </ul>
            </div>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-round">
                        <div class="card-header">
                            <div class="card-head-row card-tools-still-right">
                                <div class="card-title">Gallery Images</div>
                                <div class="card-tools d-flex align-items-center gap-2">
                                    <a href="{{ route('galleries.create') }}" class="btn btn-success btn-sm">
                                        + Upload Image
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-bordered align-middle">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Image</th>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($galleries as $g)
                                            <tr id="record-row-{{ $g->id }}">

                                                <td>{{ $loop->iteration }}</td>

                                                <td>
                                                    <img src="{{ asset('storage/' . $g->image) }}" alt="{{ $g->title }}"
                                                        style="width:80px;height:55px;object-fit:cover;border-radius:6px;" />
                                                </td>

                                                <td>{{ $g->title }}</td>

                                                <td>{{ $g->galleryCategory->name ?? '—' }}</td>

                                                <td>
                                                    <div class="form-button-action">
                                                        <a href="{{ route('galleries.edit', $g->id) }}"
                                                            class="btn btn-link btn-primary btn-lg me-2" title="Edit">
                                                            <i class="fa fa-edit"></i>
                                                        </a>

                                                        {{-- Hidden delete form --}}
                                                        <form id="delete-form-{{ $g->id }}"
                                                            action="{{ route('galleries.destroy', $g->id) }}"
                                                            method="POST" class="d-none">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>

                                                        <button type="button" class="btn btn-link btn-danger btn-lg"
                                                            onclick="confirmDelete({{ $g->id }}, '{{ addslashes($g->title) }}')"
                                                            title="Delete">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- SweetAlert2 CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function confirmDelete(id, name) {
            Swal.fire({
                title: 'Are you sure?',
                text: `You are about to delete "${name}". This cannot be undone!`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${id}`).submit();
                }
            });
        }

        // SweetAlert for session success/error (auto popup)
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                timer: 2500,
                showConfirmButton: false,
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{{ session('error') }}',
            });
        @endif
    </script>
@endsection
