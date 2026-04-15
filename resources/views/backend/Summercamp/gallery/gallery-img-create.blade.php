@extends('backend.layout.app')
@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Upload Gallery Images</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="{{ route('gallery-images-index') }}">Gallery Images</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Upload</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="card card-round">
                    <div class="card-header"><div class="card-title">Bulk Upload</div></div>
                    <div class="card-body">
                        <form action="{{ route('gallery-images-store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Category <span class="text-danger">*</span></label>
                                <select name="gallery_category_id" class="form-select @error('gallery_category_id') is-invalid @enderror">
                                    <option value="">-- Select Category --</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ (old('gallery_category_id', request('category_id')) == $cat->id) ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('gallery_category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            {{-- Drag-drop upload --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Images <span class="text-danger">*</span></label>
                                <div id="dropZone" style="border:2px dashed #dee2e6;border-radius:12px;padding:40px;text-align:center;cursor:pointer;background:#fafafa;transition:.2s;"
                                     onclick="document.getElementById('imagesInput').click()"
                                     ondragover="event.preventDefault();this.style.borderColor='#ff6a00';"
                                     ondragleave="this.style.borderColor='#dee2e6';"
                                     ondrop="handleDrop(event)">
                                    <i class="fa fa-cloud-upload" style="font-size:2.5rem;color:#ccc;display:block;margin-bottom:12px;"></i>
                                    <p class="mb-1 fw-semibold">Click or drag images here</p>
                                    <p class="text-muted small mb-0">JPG, PNG, WEBP — up to 4MB each — select multiple</p>
                                </div>
                                <input type="file" name="images[]" id="imagesInput" multiple
                                       accept="image/jpeg,image/png,image/webp"
                                       class="d-none @error('images') is-invalid @enderror"
                                       onchange="showPreviews(this.files)">
                                @error('images') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                                @error('images.*') <div class="text-danger small mt-1">{{ $message }}</div> @enderror

                                {{-- Preview grid --}}
                                <div id="previewGrid" class="row g-2 mt-3"></div>
                                <div id="previewCount" class="text-muted small mt-1"></div>
                            </div>

                            <hr>

                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Label / Caption</label>
                                    <input type="text" name="label" value="{{ old('label') }}"
                                           class="form-control" placeholder="e.g. Opening Ceremony">
                                    <div class="form-text text-muted">Shown on hover over the image.</div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Alt Text</label>
                                    <input type="text" name="alt_text" value="{{ old('alt_text') }}"
                                           class="form-control" placeholder="e.g. Kids performing on stage">
                                </div>
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Strip Size</label>
                                    <select name="size" class="form-select">
                                        <option value="sm" {{ old('size')=='sm' ? 'selected':'' }}>Small (200Ã—150)</option>
                                        <option value="md" {{ old('size','md')=='md' ? 'selected':'' }}>Medium (260Ã—175)</option>
                                        <option value="lg" {{ old('size')=='lg' ? 'selected':'' }}>Large (320Ã—200)</option>
                                    </select>
                                    <div class="form-text text-muted">Card size in the scrolling strip.</div>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Strip Row</label>
                                    <select name="strip_row" class="form-select">
                                        <option value="1" {{ old('strip_row','1')=='1' ? 'selected':'' }}>Row 1 (→ forward)</option>
                                        <option value="2" {{ old('strip_row')=='2' ? 'selected':'' }}>Row 2 (â† backward)</option>
                                        <option value="3" {{ old('strip_row')=='3' ? 'selected':'' }}>Row 3 (→ forward slow)</option>
                                    </select>
                                    <div class="form-text text-muted">Which animated row to appear in.</div>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Sort Order</label>
                                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" min="0" class="form-control">
                                </div>
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured') ? 'checked':'' }}>
                                        <label class="form-check-label fw-semibold" for="is_featured">
                                            Featured <small class="text-muted">(shows in featured grid layout)</small>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="status" id="status" value="1" {{ old('status',true) ? 'checked':'' }}>
                                        <label class="form-check-label fw-semibold" for="status">Active (visible on site)</label>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-upload me-1"></i> Upload Images
                                </button>
                                <a href="{{ route('gallery-images-index') }}" class="btn btn-secondary">
                                    <i class="fa fa-arrow-left me-1"></i> Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-round">
                    <div class="card-header"><div class="card-title"><i class="fa fa-info-circle text-info me-1"></i> Size Guide</div></div>
                    <div class="card-body small">
                        <p class="fw-semibold mb-1">Strip Rows:</p>
                        <p class="text-muted mb-2">The gallery uses 3 horizontal scrolling strips. Assign images to any row.</p>
                        <p class="fw-semibold mb-1">Strip Size:</p>
                        <p class="text-muted mb-2">Controls the width/height of each image card in the strip.</p>
                        <p class="fw-semibold mb-1">Featured:</p>
                        <p class="text-muted mb-0">Featured images appear in the large grid layout panel (2 col Ã— 2 row hero layout).</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function showPreviews(files) {
    const grid = document.getElementById('previewGrid');
    const count = document.getElementById('previewCount');
    grid.innerHTML = '';
    Array.from(files).forEach(file => {
        const reader = new FileReader();
        reader.onload = e => {
            grid.insertAdjacentHTML('beforeend',
                `<div class="col-3"><img src="${e.target.result}" style="width:100%;height:80px;object-fit:cover;border-radius:8px;"></div>`);
        };
        reader.readAsDataURL(file);
    });
    count.textContent = files.length + ' file(s) selected';
}

function handleDrop(e) {
    e.preventDefault();
    document.getElementById('dropZone').style.borderColor = '#dee2e6';
    const dt = e.dataTransfer;
    const input = document.getElementById('imagesInput');
    // Transfer dropped files to the input
    const dataTransfer = new DataTransfer();
    Array.from(dt.files).forEach(f => dataTransfer.items.add(f));
    input.files = dataTransfer.files;
    showPreviews(dt.files);
}


</script>
@endsection
