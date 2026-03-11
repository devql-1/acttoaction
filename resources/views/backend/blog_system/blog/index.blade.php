@extends('backend.layout.app')
@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">DataTables.Net</h3>
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
                        <a href="#">Tables</a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Datatables</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-round">
                        <div class="card-header">
                            <div class="card-head-row card-tools-still-right">
                                <div class="card-title">Blogs Info</div>
                                <a href="{{route('admin.blog-create')}}" class="btn btn-dark ms-auto"><i
                                        class="fa fa-plus"></i> Add Blogs</a>
                                <!-- <button
                                        class="btn btn-dark  ms-auto"
                                        data-bs-toggle="modal"
                                        data-bs-target="#addRowModal">
                                        <i class="fa fa-plus"></i>
                                        Add About
                                    </button> -->
                            </div>
                        </div>
                        <div class="card-body p-2">
                            <div class="table-responsive">
                                <!-- Projects table -->
                                <table class="table align-items-center mb-0" id="basic-datatables">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Image</th>
                                            <th scope="col" class="text-end">Title</th>
                                            <th scope="col" class="text-end">Category</th>
                                            <th scope="col" class="text-end">Short Desc</th>
                                            <th scope="col" class="text-end">Published</th>
                                            <th scope="col" class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($blogs as $blog)
                                            <tr id="record-row-{{ $blog->id }}">
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <p class="demo">
                                                    <div class="avatar">
                                                        <img src="{{asset($blog->image ? 'img/' . $blog->image : '../assets/img/placeholder-image-3.jpg')}}"
                                                            alt="{{ $blog->title }}" class="avatar-img rounded">
                                                    </div>
                                                    </p>
                                                </td>
                                                <th scope="row">
                                                    <button class="btn btn-icon btn-round btn-success btn-sm me-2">
                                                        <i class="fa fa-check"></i>
                                                    </button>
                                                    {{ $blog->title ? $blog->title : '--' }}
                                                </th>

                                                <td class="text-end">
                                                    @if($blog->category != null)
                                                        {{ $blog->category->category_name }}
                                                    @else
                                                        --
                                                    @endif
                                                </td>
                                                <td class="text-end">
                                                    {{ $blog->short_description ? $blog->short_description : '--' }}
                                                </td>

                                                <td class="text-end">
                                                    <label class="switch">
                                                        <input type="checkbox" class="toggle-status" data-id="{{ $blog->id }}"
                                                            data-url="{{ route('admin.blog-status') }}" {{ $blog->status == 1 ? 'checked' : '' }}>
                                                        <span class="record-toggle"></span>
                                                    </label>
                                                    <!-- <span class="badge badge-success">Completed</span> -->
                                                </td>
                                                <td class="text-end">
                                                    <div class="form-button-action">


                                                        <a href="{{route('admin.blog-edit', $blog->id)}}"
                                                            class="btn btn-icon btn-round btn-primary btn-lg me-3">
                                                            <i class="fa fa-edit"></i>
                                                        </a>

                                                        <form id="delete-form-{{ $blog->id }}"
                                                            action="{{ route('admin.blog-destroy', $blog->id) }}" method="POST"
                                                            style="display:inline">

                                                            @csrf
                                                            @method('DELETE')

                                                            <button type="button"
                                                                onclick="confirmDelete({{ $blog->id }}, '{{ $blog->title }}')"
                                                                class="btn btn-icon btn-round btn-danger btn-lg">

                                                                <i class="fa fa-trash"></i>

                                                            </button>

                                                        </form>





                                                        <!-- <button
                                                                    type="button"
                                                                    data-bs-toggle="tooltip"
                                                                    title=""
                                                                    class="btn btn-link btn-danger"
                                                                    data-original-title="Remove">
                                                                    <i class="fa fa-times"></i>
                                                                </button> -->
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function confirmDelete(id, title) {

            Swal.fire({
                title: 'Are you sure?',
                text: `You are about to delete "${title}".`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes delete it!',
                cancelButtonText: 'Cancel'

            }).then((result) => {

                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + id).submit();
                }

            });

        }
    </script>

@endsection