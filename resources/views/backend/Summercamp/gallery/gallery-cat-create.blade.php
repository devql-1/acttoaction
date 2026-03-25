@extends('backend.layout.app')
@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Add Gallery Category</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="{{ route('gallery-categories-index') }}">Gallery Categories</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Add</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card card-round">
                    <div class="card-header"><div class="card-title">Category Details</div></div>
                    <div class="card-body">
                        <form action="{{ route('gallery-categories-store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" value="{{ old('name') }}"
                                       class="form-control @error('name') is-invalid @enderror"
                                       placeholder="e.g. Summer Camp 2025"
                                       oninput="autoSlug(this.value)">
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Slug</label>
                                <input type="text" name="slug" id="slugField"
                                       value="{{ old('slug') }}"
                                       class="form-control @error('slug') is-invalid @enderror"
                                       placeholder="auto-generated">
                                <div class="form-text text-muted">Used as the tab identifier. Leave blank to auto-generate.</div>
                                @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="row g-3 mb-4">
                                <div class="col-md-5">
                                    <label class="form-label fw-semibold">Sort Order</label>
                                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}" min="0" class="form-control">
                                    <div class="form-text text-muted">Lower = first tab.</div>
                                </div>
                                <div class="col-md-7 d-flex align-items-end pb-1">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="status" id="status" value="1" {{ old('status', true) ? 'checked' : '' }}>
                                        <label class="form-check-label fw-semibold" for="status">Active (visible as tab)</label>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-success"><i class="fa fa-save me-1"></i> Save Category</button>
                                <a href="{{ route('gallery-categories-index') }}" class="btn btn-secondary"><i class="fa fa-arrow-left me-1"></i> Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-round">
                    <div class="card-header"><div class="card-title"><i class="fa fa-info-circle text-info me-1"></i> Examples</div></div>
                    <div class="card-body small text-muted" style="line-height:2;">
                        <p class="mb-1"><strong>All</strong> — shows all images (default first tab)</p>
                        <p class="mb-1"><strong>Drama</strong> — acting / theatre photos</p>
                        <p class="mb-1"><strong>Dance</strong> — dance performance photos</p>
                        <p class="mb-1"><strong>Music</strong> — music session photos</p>
                        <p class="mb-0"><strong>Summer Camp 2025</strong> — event-specific album</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function autoSlug(val) {
    document.getElementById('slugField').value = val.toLowerCase().replace(/\s+/g,'-').replace(/[^a-z0-9\-]/g,'');
}
</script>
@endsection
