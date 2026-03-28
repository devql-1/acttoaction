@extends('backend.layout.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Upload Bulk Gallery Images</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home">
                        <a href="#"><i class="icon-home"></i></a>
                    </li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="{{ route('galleries.index') }}">Gallery</a></li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="#">Upload Bulk Gallery Images</a></li>
                </ul>
            </div>

            <!-- Success and Error Messages -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="card card-round">
                        <div class="card-header">
                            <div class="card-head-row card-tools-still-right">
                                <div class="card-title">Upload Bulk Gallery Images</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('galleries.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <!-- Category Selection -->
                                <div class="mb-3">
                                    <label class="form-label">Category <span class="text-danger">*</span></label>
                                    <select name="gallery_category_id"
                                        class="form-select @error('gallery_category_id') is-invalid @enderror">
                                        <option value="">— Select Category —</option>
                                        @foreach ($categories as $cat)
                                            <option value="{{ $cat->id }}"
                                                {{ old('gallery_category_id') == $cat->id ? 'selected' : '' }}>
                                                {{ $cat->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('gallery_category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Image Title -->
                                <div class="mb-3">
                                    <label class="form-label">Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title"
                                        class="form-control @error('title') is-invalid @enderror"
                                        value="{{ old('title') }}" placeholder="e.g. Annual Day 2024" />
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Bulk Image Upload -->
                                <div class="mb-3">
                                    <label class="form-label">Images <span class="text-danger">*</span></label>
                                    <input type="file" name="images[]"
                                        class="form-control @error('images') is-invalid @enderror" accept="image/*" multiple
                                        onchange="previewImages(this)" />
                                    @error('images')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                    <div id="imgPreviewContainer" style="display: none; margin-top: 10px;">
                                        <!-- Preview images will be displayed here -->
                                    </div>
                                </div>

                                <!-- Submit and Cancel Buttons -->
                                <button type="submit" class="btn btn-success">Upload Images</button>
                                <a href="{{ route('galleries.index') }}" class="btn btn-secondary">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Image Preview Script --}}
    <script>
        function previewImages(input) {
            var previewContainer = document.getElementById('imgPreviewContainer');
            previewContainer.innerHTML = ''; // Clear previous previews
            previewContainer.style.display = 'block';

            if (input.files) {
                Array.from(input.files).forEach(function(file, index) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        var imgElement = document.createElement('img');
                        imgElement.src = e.target.result;
                        imgElement.style =
                            'max-height:160px; margin: 5px; border-radius: 8px; object-fit: cover;';
                        previewContainer.appendChild(imgElement);
                    };
                    reader.readAsDataURL(file);
                });
            }
        }
    </script>
@endsection
