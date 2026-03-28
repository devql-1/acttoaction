@extends('backend.layout.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Edit Gallery Image</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home">
                        <a href="#"><i class="icon-home"></i></a>
                    </li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="#">Gallery</a></li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="#">Edit Image</a></li>
                </ul>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-round">
                        <div class="card-header">
                            <div class="card-head-row card-tools-still-right">
                                <div class="card-title">Edit Gallery Image</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('galleries.update', $gallery->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                {{-- Gallery Category --}}
                                <div class="mb-3">
                                    <label class="form-label">Category <span class="text-danger">*</span></label>
                                    <select name="gallery_category_id"
                                        class="form-select @error('gallery_category_id') is-invalid @enderror">
                                        <option value="">— Select Category —</option>
                                        @foreach ($categories as $cat)
                                            <option value="{{ $cat->id }}"
                                                {{ old('gallery_category_id', $gallery->gallery_category_id) == $cat->id ? 'selected' : '' }}>
                                                {{ $cat->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('gallery_category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Gallery Title --}}
                                <div class="mb-3">
                                    <label class="form-label">Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title"
                                        class="form-control @error('title') is-invalid @enderror"
                                        value="{{ old('title', $gallery->title) }}" />
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Gallery Image --}}
                                <div class="mb-3">
                                    <label class="form-label">Replace Image <span class="text-muted">(leave blank to keep
                                            current)</span></label>
                                    <input type="file" name="image"
                                        class="form-control @error('image') is-invalid @enderror" accept="image/*"
                                        onchange="previewImg(this)" />
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <img id="imgPreview" src="{{ asset('storage/' . $gallery->image) }}"
                                        style="margin-top:10px;max-height:160px;border-radius:8px;" />
                                </div>

                                <button type="submit" class="btn btn-primary">Update Image</button>
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
        function previewImg(input) {
            var preview = document.getElementById('imgPreview');
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
