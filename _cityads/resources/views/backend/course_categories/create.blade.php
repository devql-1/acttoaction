@extends('backend.layout.app')
@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Add Category</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="{{ route('course-categories-index') }}">Course Categories</a></li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="#">Add Category</a></li>
                </ul>
            </div>

            <div class="row">
                <div class="col-md-8 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Create New Category</div>
                        </div>

                        <form action="{{ route('course-categories-store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                {{-- NAME --}}
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label>Category Name <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name') }}" placeholder="e.g. Web Design" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- DESCRIPTION --}}
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label>Description
                                            <small class="text-muted d-block fw-normal">Optional</small>
                                        </label>
                                    </div>
                                    <div class="col-md-9">
                                        <textarea name="description" id="descriptionEditor"
                                            class="form-control">{{ old('description') }}</textarea>
                                    </div>
                                </div>

                                {{-- IMAGE --}}
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label>Image
                                            <small class="text-muted d-block fw-normal">Optional</small>
                                        </label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="file" name="image"
                                            class="form-control @error('image') is-invalid @enderror" accept="image/*"
                                            onchange="previewImage(this)">
                                        @error('image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">JPG, PNG, WEBP. Max 2MB.</small>
                                        <div id="imagePreview" class="mt-2" style="display:none;">
                                            <img id="previewImg" src="" class="rounded" style="max-height:120px;">
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="card-action d-flex justify-content-between align-items-center">
                                <a href="{{ route('course-categories-index') }}" class="btn btn-secondary">
                                    <i class="fa fa-arrow-left me-1"></i> Back
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-save me-1"></i> Save Category
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.querySelector('#descriptionEditor'), {
            toolbar: ['heading', '|', 'bold', 'italic', 'underline', '|', 'bulletedList', 'numberedList', '|', 'link', 'blockQuote', '|', 'undo', 'redo']
        }).catch(error => console.error(error));

        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = e => {
                    document.getElementById('previewImg').src = e.target.result;
                    document.getElementById('imagePreview').style.display = 'block';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

@endsection