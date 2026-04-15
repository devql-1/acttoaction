@extends('backend.layout.app')
@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Add School Partner</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="{{ route('school-partners.index') }}">School Partners</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Add</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-title">School Details</div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('school-partners.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Category <span class="text-danger">*</span></label>
                                <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                                    <option value="">— Select Category —</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                @if($categories->isEmpty())
                                    <div class="form-text text-warning">
                                        No active categories.
                                        <a href="{{ route('school-partner-categories.create') }}">Create one first</a>
                                    </div>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">School Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" value="{{ old('name') }}"
                                       class="form-control @error('name') is-invalid @enderror"
                                       placeholder="e.g. Delhi Public School">
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">School Logo / Image</label>
                                <input type="file" name="logo" accept="image/*"
                                       class="form-control @error('logo') is-invalid @enderror"
                                       onchange="previewImage(this)">
                                <div class="form-text text-muted">JPG, PNG, WEBP or SVG. Max 2 MB.</div>
                                @error('logo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <div id="logoPreview" class="mt-2" style="display:none;">
                                    <img id="previewImg" src="" alt="Preview"
                                         style="max-width:200px;max-height:120px;object-fit:contain;
                                                border:1px solid #eee;border-radius:6px;padding:6px;background:#f9f9f9;">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Website URL</label>
                                <input type="url" name="website_url" value="{{ old('website_url') }}"
                                       class="form-control @error('website_url') is-invalid @enderror"
                                       placeholder="https://school.edu.in">
                                @error('website_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Sort Order</label>
                                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}"
                                           min="0" max="255" class="form-control">
                                    <div class="form-text text-muted">Lower = shown first.</div>
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
                                    <i class="fa fa-save me-1"></i> Save School
                                </button>
                                <a href="{{ route('school-partners.index') }}" class="btn btn-secondary">
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

<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('previewImg').src = e.target.result;
            document.getElementById('logoPreview').style.display = '';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
