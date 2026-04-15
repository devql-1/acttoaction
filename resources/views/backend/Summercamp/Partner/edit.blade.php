@extends('backend.layout.app')
@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Edit Partner</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="{{ route('summer-partners.index') }}">Partners</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Edit</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-title">Partner Details</div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('summer-partners.update', ['partner' => $summerPartner->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Category <span class="text-danger">*</span></label>
                                <select name="category" class="form-select @error('category') is-invalid @enderror">
                                    <option value="">-- Select Category --</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->slug }}"
                                            {{ old('category', $summerPartner->category) === $cat->slug ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Partner Name <span class="text-danger">*</span></label>
                                <input type="text" name="name"
                                       value="{{ old('name', $summerPartner->name) }}"
                                       class="form-control @error('name') is-invalid @enderror">
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Logo</label>
                                <div class="mb-2">
                                    <img src="{{ $summerPartner->logo_url }}" alt="{{ $summerPartner->name }}"
                                         style="max-width:200px;max-height:80px;object-fit:contain;
                                                border:1px solid #dee2e6;border-radius:8px;padding:8px;background:#f9f9f9;">
                                    <small class="text-muted ms-2">Current logo</small>
                                </div>
                                <input type="file" name="logo" id="logoInput"
                                       accept="image/jpeg,image/png,image/webp,image/svg+xml"
                                       class="form-control @error('logo') is-invalid @enderror"
                                       onchange="previewLogo(this)">
                                <div class="form-text text-muted">Leave blank to keep current logo.</div>
                                @error('logo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <div id="logoPreviewWrap" class="mt-2" style="display:none;">
                                    <img id="logoPreview" src="" alt="Preview"
                                         style="max-width:200px;max-height:80px;object-fit:contain;
                                                border:1px solid #dee2e6;border-radius:8px;padding:8px;background:#f9f9f9;">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Website URL</label>
                                <input type="url" name="website_url"
                                       value="{{ old('website_url', $summerPartner->website_url) }}"
                                       class="form-control @error('website_url') is-invalid @enderror"
                                       placeholder="https://example.com">
                                @error('website_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Sort Order</label>
                                    <input type="number" name="sort_order"
                                           value="{{ old('sort_order', $summerPartner->sort_order) }}"
                                           min="0" max="255" class="form-control">
                                </div>
                                <div class="col-md-8 d-flex align-items-end pb-1">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="status"
                                               id="status" value="1"
                                               {{ old('status', $summerPartner->status) ? 'checked' : '' }}>
                                        <label class="form-check-label fw-semibold" for="status">Active (visible on site)</label>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-save me-1"></i> Update Partner
                                </button>
                                <a href="{{ route('summer-partners.index') }}" class="btn btn-secondary">
                                    <i class="fa fa-arrow-left me-1"></i> Cancel
                                </a>
                            </div>
                        </form>
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
