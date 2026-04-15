@extends('backend.layout.app')
@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Add Merchandise Item</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="{{ route('merchandise.index') }}">Merchandise</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Add</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-title">Item Details</div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('merchandise.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            {{-- Name --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Item Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" value="{{ old('name') }}"
                                    class="form-control @error('name') is-invalid @enderror"
                                    placeholder="e.g. Summer Camp T-Shirt">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Description --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Description</label>
                                <textarea name="description" rows="3" class="form-control"
                                    placeholder="Brief description of the item...">{{ old('description') }}</textarea>
                            </div>

                            {{-- Price --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Price (₹) <span class="text-danger">*</span></label>
                                <input type="number" name="price" value="{{ old('price') }}"
                                    class="form-control @error('price') is-invalid @enderror"
                                    placeholder="e.g. 299" min="0" step="0.01">
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Image --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Photo <span class="text-muted fw-normal">(optional)</span></label>
                                <input type="file" name="image" id="imageInput"
                                    accept="image/jpeg,image/png,image/webp"
                                    class="form-control @error('image') is-invalid @enderror"
                                    onchange="previewImage(this)">
                                <div class="form-text text-muted">JPG, PNG, WEBP — max 3MB.</div>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div id="imgPreviewWrap" class="mt-2" style="display:none;">
                                    <img id="imgPreview" src="" alt="Preview"
                                        style="height:80px;border-radius:8px;object-fit:cover;">
                                </div>
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Sort Order</label>
                                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}"
                                        min="0" class="form-control">
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
                                    <i class="fa fa-save me-1"></i> Save Item
                                </button>
                                <a href="{{ route('merchandise.index') }}" class="btn btn-secondary">
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
function previewImage(input) {
    if (!input.files || !input.files[0]) return;
    const reader = new FileReader();
    reader.onload = e => {
        document.getElementById('imgPreview').src = e.target.result;
        document.getElementById('imgPreviewWrap').style.display = 'block';
    };
    reader.readAsDataURL(input.files[0]);
}

</script>
@endsection
