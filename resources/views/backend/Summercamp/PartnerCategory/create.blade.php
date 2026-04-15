@extends('backend.layout.app')
@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Add Partner Category</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="{{ route('summer-partner-categories.index') }}">Partner Categories</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Add</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-7">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-title">Category Details</div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('summer-partner-categories.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Category Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="catName"
                                       value="{{ old('name') }}"
                                       class="form-control @error('name') is-invalid @enderror"
                                       placeholder="e.g. Title Sponsor"
                                       oninput="autoSlug(this.value)">
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Slug</label>
                                <input type="text" name="slug" id="catSlug"
                                       value="{{ old('slug') }}"
                                       class="form-control font-monospace @error('slug') is-invalid @enderror"
                                       placeholder="auto-generated from name">
                                <div class="form-text text-muted">Lowercase letters, numbers and hyphens only. Used internally to group partners.</div>
                                @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Sort Order</label>
                                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}"
                                           min="0" max="255" class="form-control">
                                    <div class="form-text text-muted">Lower = shown first on the partners page.</div>
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
                                    <i class="fa fa-save me-1"></i> Save Category
                                </button>
                                <a href="{{ route('summer-partner-categories.index') }}" class="btn btn-secondary">
                                    <i class="fa fa-arrow-left me-1"></i> Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-title"><i class="fa fa-info-circle text-info me-1"></i> How Categories Work</div>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled small text-muted mb-0" style="line-height:2.4">
                            <li><i class="fa fa-check text-success me-2"></i>Create any number of partner categories</li>
                            <li><i class="fa fa-check text-success me-2"></i>Each category gets a unique slug used to group logos</li>
                            <li><i class="fa fa-check text-success me-2"></i>Sort Order controls the display order on the public page</li>
                            <li><i class="fa fa-check text-success me-2"></i>Inactive categories are hidden on the frontend</li>
                            <li><i class="fa fa-times text-danger me-2"></i>Cannot delete a category that has partners assigned</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function autoSlug(val) {
    const slugField = document.getElementById('catSlug');
    if (!slugField.dataset.manual) {
        slugField.value = val.toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '')
            .trim()
            .replace(/[\s]+/g, '-');
    }
}
document.getElementById('catSlug').addEventListener('input', function() {
    this.dataset.manual = 'true';
});
</script>
@endsection
