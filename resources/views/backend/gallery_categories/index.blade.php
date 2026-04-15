@extends('backend.layout.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Gallery Categories</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home">
                        <a href="#"><i class="icon-home"></i></a>
                    </li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="#">Masters</a></li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="#">Gallery Categories</a></li>
                </ul>
            </div>

            <!-- Success and Error Messages -->
            

            

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-round">
                        <div class="card-header">
                            <div class="card-head-row card-tools-still-right">
                                <div class="card-title">All Gallery Categories</div>
                                <div class="card-tools d-flex align-items-center gap-2">
                                    <a href="{{ route('galleryCategories.create') }}" class="btn btn-success btn-sm">
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
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Images</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories as $cat)
                                            <tr id="record-row-{{ $cat->id }}">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <strong>{{ $cat->name }}</strong>
                                                </td>
                                                <td>
                                                    <code>{{ $cat->slug }}</code>
                                                </td>
                                                <td>{{ $cat->galleries_count }}</td>
                                                <td class="text-center">
                                                    <div class="form-button-action">
                                                        <a href="{{ route('galleryCategories.edit', $cat->id) }}"
                                                            class="btn btn-link btn-warning btn-lg me-2" title="Edit">
                                                            <i class="fa fa-edit"></i>
                                                        </a>

                                                        {{-- Delete Form --}}
                                                        <form id="delete-form-{{ $cat->id }}"
                                                            action="{{ route('galleryCategories.destroy', $cat->id) }}"
                                                            method="POST" class="d-none">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                        <button type="button" class="btn btn-link btn-danger btn-lg"
                                                            onclick="confirmDelete({{ $cat->id }}, '{{ addslashes($cat->name) }}')"
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

                    <!-- Pagination Links -->
                    <div class="d-flex justify-content-center mt-3">
                        {{ $categories->links() }}
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
        

        
    </script>
@endsection
