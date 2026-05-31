@extends('backend.layout.app')

@section('content')
    <div class="container">
        <div class="page-inner">

            {{-- PAGE HEADER --}}
            <div class="page-header">
                <h3 class="fw-bold mb-3">Upload Hero Banner</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="{{ route('hero-banner.index') }}">Hero Banners</a></li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="#">Upload Banner</a></li>
                </ul>
            </div>

            <div class="row">
                {{-- FORM --}}
                <div class="col-md-9 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Create New Banner</div>
                        </div>

                        <form action="{{ route('hero-banner.store') }}" method="POST" enctype="multipart/form-data"
                            id="bannerForm">
                            @csrf

                            <div class="card-body">

                                {{-- IMAGE UPLOAD --}}
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label>Banner Image <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-9">

                                        <div id="dropZone"
                                            class="border-2 border-dashed rounded-3 p-4 text-center position-relative"
                                            style="border-color:#dee2e6; cursor:pointer; min-height:180px; display:flex; align-items:center; justify-content:center; flex-direction:column;"
                                            ondragover="event.preventDefault(); this.style.borderColor='#7C3AED'; this.style.background='#fff8f4';"
                                            ondragleave="this.style.borderColor='#dee2e6'; this.style.background='';"
                                            ondrop="handleDrop(event)">

                                            <input type="file" name="image" id="imageInput"
                                                accept="image/jpeg,image/png,image/webp"
                                                class="position-absolute top-0 start-0 w-100 h-100 opacity-0"
                                                style="cursor:pointer;" onchange="previewImage(this)">

                                            <div id="dropPlaceholder">
                                                <i class="fa fa-upload fa-2x text-muted"></i>
                                                <p class="mt-2 mb-1 fw-semibold">Drag & drop or click to upload</p>
                                                <p class="text-muted small mb-0">
                                                    JPG, PNG, WEBP — max 5MB<br>
                                                    Recommended: 1376×495px
                                                </p>
                                            </div>

                                            <div id="previewWrap" style="display:none; width:100%;">
                                                <img id="previewImg" src="" class="img-fluid rounded"
                                                    style="max-height:240px; object-fit:cover; width:100%;">
                                                <p class="small text-muted mt-2 mb-0" id="previewName"></p>
                                            </div>
                                        </div>

                                        @error('image')
                                            <div class="text-danger small mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- ALT TEXT --}}
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label>Alt Text</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="alt_text"
                                            value="{{ old('alt_text', 'Summer Camp Banner') }}"
                                            class="form-control @error('alt_text') is-invalid @enderror"
                                            placeholder="Describe the banner">
                                        <small class="text-muted">Used for screen readers & SEO.</small>
                                        @error('alt_text')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- ACTIVE SWITCH --}}
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label>Set Active</label>
                                    </div>
                                    <div class="col-md-9">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="is_active" value="1"
                                                {{ old('is_active', true) ? 'checked' : '' }}>
                                            <label class="form-check-label">
                                                Set as Active Banner
                                            </label>
                                        </div>
                                        <small class="text-muted">
                                            This will deactivate any currently active banner.
                                        </small>
                                    </div>
                                </div>

                            </div>

                            {{-- ACTIONS --}}
                            <div class="card-action d-flex justify-content-between align-items-center">
                                <a href="{{ route('hero-banner.index') }}" class="btn btn-secondary">
                                    <i class="fa fa-arrow-left me-1"></i> Back
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-upload me-1"></i> Upload Banner
                                </button>
                            </div>

                        </form>
                    </div>

                    {{-- INFO --}}
                    <div class="alert alert-info mt-3">
                        <i class="fa fa-info-circle me-1"></i>
                        Recommended size: <strong>1376 × 495 px</strong>. Avoid text-heavy images for better responsiveness.
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- SCRIPTS --}}
    <script>
        function previewImage(input) {
            if (!input.files || !input.files[0]) return;
            const file = input.files[0];
            const reader = new FileReader();
            reader.onload = e => {
                document.getElementById('previewImg').src = e.target.result;
                document.getElementById('previewName').textContent =
                    file.name + ' (' + (file.size / 1024 / 1024).toFixed(2) + ' MB)';
                document.getElementById('dropPlaceholder').style.display = 'none';
                document.getElementById('previewWrap').style.display = 'block';
            };
            reader.readAsDataURL(file);
        }

        function handleDrop(e) {
            e.preventDefault();
            document.getElementById('dropZone').style.borderColor = '#dee2e6';
            document.getElementById('dropZone').style.background = '';
            const dt = e.dataTransfer;
            if (dt.files.length) {
                const input = document.getElementById('imageInput');
                input.files = dt.files;
                previewImage(input);
            }
        }
    </script>
@endsection
