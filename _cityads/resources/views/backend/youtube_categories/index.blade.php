@extends('backend.layout.app')
@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Youtube Categories</h3>
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
                    <a href="#">Youtube</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Categories</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">Youtube Category List</div>

                            <a href="{{ route('youtubeCategory.create') }}" 
                               class="btn btn-dark ms-auto">
                                <i class="fa fa-plus"></i> Add Category
                            </a>
                        </div>
                    </div>

                    <div class="card-body p-2">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0" id="basic-datatables">
                               <thead class="thead-light">
                                        <tr>
                                            <th>ID</th>
                                            <th>Category Name</th>
                                            <th>Slug</th>
                                            <th>Created At</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    @forelse($youtubeCategories as $category)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>

                                        <td>
                                            <strong>{{ $category->name }}</strong>
                                        </td>

                                        <td>
                                            <strong>{{ $category->slug }}</strong>
                                            
                                        </td>

                                        <td>
                                            {{ $category->created_at->format('d M Y') }}
                                        </td>

                        <td class="text-end">
                            <div class="form-button-action">

                                <a href="{{ route('youtubeCategory.edit', $category->id) }}"
                                class="btn btn-icon btn-round btn-primary btn-sm me-2">
                                <i class="fa fa-edit"></i>
                                </a>

                               <form action="{{ route('youtubeCategory.destroy', $category->id) }}" 
                                method="POST" 
                                style="display:inline-block;"
                                class="delete-form">

                                @csrf
                                @method('DELETE')

                                <button type="button"
                                        class="btn btn-icon btn-round btn-danger btn-sm delete-btn">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </form>

                            </div>
                        </td>
        </tr>
@empty
<tr>
    <td colspan="5" class="text-center">
        No Youtube Categories Found
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



<script>
document.addEventListener("DOMContentLoaded", function () {

    document.querySelectorAll(".delete-btn").forEach(button => {
        button.addEventListener("click", function () {

            let form = this.closest("form");

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });

        });
    });

});
</script>
@endsection