@extends('backend.layout.app')
@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Add Partner</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="{{ route('summer-partners.index') }}">Partners</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Add</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-title">Partner Details</div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('summer-partners.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Category <span class="text-danger">*</span></label>
                                <select name="category" class="form-select @error('category') is-invalid @enderror">
                                    <option value="">-- Select Category --</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->slug }}" {{ old('category') === $cat->slug ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Partner Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" value="{{ old('name') }}"
                                       class="form-control @error('name') is-invalid @enderror"
                                       placeholder="e.g. Rajasthan Tourism">
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Logo <span class="text-danger">*</span></label>
                                <input type="file" name="logo" id="logoInput"
                                       accept="image/jpeg,image/png,image/webp,image/svg+xml"
                                       class="form-control @error('logo') is-invalid @enderror"
                                       onchange="previewLogo(this)">
                                <div class="form-text text-muted">JPG, PNG, WEBP, SVG — max 2MB. Transparent PNG preferred.</div>
                                @error('logo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <div id="logoPreviewWrap" class="mt-2" style="display:none;">
                                    <img id="logoPreview" src="" alt="Preview"
                                         style="max-width:200px;max-height:80px;object-fit:contain;
                                                border:1px solid #dee2e6;border-radius:8px;padding:8px;background:#f9f9f9;">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Website URL</label>
                                <input type="url" name="website_url" value="{{ old('website_url') }}"
                                       class="form-control @error('website_url') is-invalid @enderror"
                                       placeholder="https://example.com">
                                @error('website_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Sort Order</label>
                                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}"
                                           min="0" max="255" class="form-control">
                                    <div class="form-text text-muted">Lower = appears first.</div>
                                </div>
                                <div class="col-md-8 d-flex align-items-end pb-1">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="status"
                                               id="status" value="1" {{ old('status', true) ? 'checked' : '' }}>
                                        <label class="form-check-label fw-semibold" for="status">Active (visible on site)</label>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-save me-1"></i> Save Partner
                                </button>
                                <a href="{{ route('summer-partners.index') }}" class="btn btn-secondary">
                                    <i class="fa fa-arrow-left me-1"></i> Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-title"><i class="fa fa-info-circle text-info me-1"></i> Category Guide</div>
                    </div>
                    <div class="card-body">
                        @foreach($categories as $cat)
                        <div class="mb-2 d-flex align-items-center gap-2">
                            <span class="badge badge-secondary">{{ $cat->name }}</span>
                            <small class="text-muted font-monospace" style="font-size:11px;">{{ $cat->slug }}</small>
                        </div>
                        @endforeach
                        <hr>
                        <ul class="list-unstyled small text-muted mb-0" style="line-height:2.2">
                            <li><i class="fa fa-check text-success me-2"></i>Transparent PNG logos look best</li>
                            <li><i class="fa fa-check text-success me-2"></i>Recommended size: 400Ã—200px (landscape)</li>
                            <li><i class="fa fa-check text-success me-2"></i>Use Sort Order to control logo sequence</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function previewLogo(input) {
    if (!input.files || !input.files[0]) return;
    const reader = new FileReader();
    reader.onload = e => {
        document.getElementById('logoPreview').src = e.target.result;
        document.getElementById('logoPreviewWrap').style.display = 'block';
    };
    reader.readAsDataURL(input.files[0]);
}

</script>
@endsection
