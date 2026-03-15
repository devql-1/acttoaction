{{-- resources/views/backend/blog_system/category/index.blade.php --}}
@extends('backend.layout.app')

@section('content')

<div class="container">
    <div class="page-inner">

```
    {{-- PAGE HEADER --}}
    <div class="page-header">
        <h3 class="fw-bold mb-3">Blog Categories</h3>

        <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href="#"><i class="icon-home"></i></a>
            </li>

            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>

            <li class="nav-item">
                <a href="#">Blog System</a>
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

        {{-- CATEGORY TABLE --}}
        <div class="col-md-7">

            <div class="card card-round">

                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">
                        <div class="card-title">Blogs Category Info</div>
                    </div>
                </div>


                <div class="card-body p-2">

                    <div class="table-responsive">

                        <table class="table align-items-center mb-0" id="basic-datatables">

                            <thead class="thead-light">
                                <tr>
                                    <th>ID</th>
                                    <th class="text-center">Category Name</th>
                                    <th class="text-center">Published</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>


                            <tbody>

                                @foreach($blogs_category as $blog)

                                <tr>

                                    <td>{{ $loop->iteration }}</td>


                                    <td class="text-center">
                                        {{ $blog->category_name ?? '--' }}
                                    </td>


                                    {{-- STATUS TOGGLE --}}
                                    <td class="text-center">

                                        <label class="switch">

                                            <input
                                                type="checkbox"
                                                class="toggle-status"
                                                data-id="{{ $blog->id }}"
                                                data-url="{{ route('admin.blog-category-status') }}"
                                                {{ $blog->status == 1 ? 'checked' : '' }}>

                                            <span class="record-toggle"></span>

                                        </label>

                                    </td>


                                    {{-- ACTIONS --}}
                                    <td class="text-center">

                                        <div class="form-button-action">

                                            {{-- EDIT --}}
                                            <a href="{{ route('admin.blog-category-edit',$blog->id) }}"
                                               class="btn btn-link btn-primary btn-lg me-2">

                                                <i class="fa fa-edit"></i>

                                            </a>


                                            {{-- DELETE --}}
                                            <form
                                                id="delete-form-{{ $blog->id }}"
                                                action="{{ route('admin.blog-category-destroy',$blog->id) }}"
                                                method="POST"
                                                style="display:inline">

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="button"
                                                    onclick="confirmDelete({{ $blog->id }}, '{{ $blog->category_name }}')"
                                                    class="btn btn-link btn-danger btn-lg">

                                                    <i class="fa fa-trash"></i>

                                                </button>

                                            </form>

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



        {{-- ADD CATEGORY FORM --}}
        <div class="col-md-5">

            <div class="card">

                <div class="card-header">
                    <div class="card-title">
                        Add Record for Blogs Posts Category
                    </div>
                </div>


                <form action="{{ route('admin.blog-category-store') }}" method="POST">

                    @csrf

                    <div class="card-body">

                        <div class="row">

                            <div class="col-md-12">


                                {{-- CATEGORY NAME --}}
                                <div class="form-group row">

                                    <div class="col-md-3">
                                        <label>Category Name</label>
                                        <span class="text-danger">*</span>
                                    </div>

                                    <div class="col-md-9">

                                        <input
                                            type="text"
                                            name="category_name"
                                            onkeyup="makeSlug(this.value)"
                                            class="form-control @error('category_name') is-invalid @enderror"
                                            placeholder="Enter Category">

                                        @error('category_name')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror

                                        <small class="form-text text-muted">
                                            This Category name your Blogs Category Name.
                                        </small>

                                    </div>

                                </div>


                                {{-- SLUG --}}
                                <div class="form-group row">

                                    <div class="col-md-3">
                                        <label>Slug</label>
                                        <span class="text-danger">*</span>
                                    </div>

                                    <div class="col-md-9">

                                        <input
                                            type="text"
                                            class="form-control"
                                            name="slug"
                                            id="slug"
                                            placeholder="slug">

                                        <small class="form-text text-muted">
                                            Creating a slug from your category name.
                                        </small>

                                    </div>

                                </div>


                            </div>

                        </div>

                    </div>


                    <div class="card-action text-center">

                        <button class="btn btn-success" type="submit">
                            Add Blogs
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>
```

</div>

@endsection

@section('script')

{{-- TOASTR --}}

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

{{-- SWEET ALERT --}}

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

toastr.options = {
    closeButton: true,
    progressBar: true,
    positionClass: "toast-top-right",
    timeOut: "3000"
};


// SUCCESS MESSAGE
@if(session('success'))
toastr.success("{{ session('success') }}"); 
@endif


// ERROR MESSAGE
@if(session('error'))
toastr.error("{{ session('error') }}");
@endif



// DELETE CONFIRMATION
function confirmDelete(id,name){

Swal.fire({
title:'Are you sure?',
text:`You are about to delete "${name}".`,
icon:'warning',
showCancelButton:true,
confirmButtonColor:'#d33',
cancelButtonColor:'#6c757d',
confirmButtonText:'Yes delete it!',
cancelButtonText:'Cancel'

}).then((result)=>{

if(result.isConfirmed){
document.getElementById('delete-form-'+id).submit();
}

});

}



// AUTO SLUG
function makeSlug(val){

let output = val.replace(/\s+/g,'-').toLowerCase();

$('#slug').val(output);

}

</script>

@endsection
