@extends('backend.layout.app')
@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Add School Section</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="{{ route('school-sections.index') }}">School Sections</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Add</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-7">
                <div class="card card-round">
                    <div class="card-header"><div class="card-title">Section Details</div></div>
                    <div class="card-body">
                        <form action="{{ route('school-sections.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Section Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="secName" value="{{ old('name') }}"
                                       class="form-control @error('name') is-invalid @enderror"
                                       placeholder="e.g. Curriculum, DFD, After School"
                                       oninput="autoSlug(this.value)">
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Slug <span class="text-muted fw-normal">(URL)</span></label>
                                <div class="input-group">
                                    <span class="input-group-text text-muted">/</span>
                                    <input type="text" name="slug" id="secSlug" value="{{ old('slug') }}"
                                           class="form-control font-monospace @error('slug') is-invalid @enderror"
                                           placeholder="auto-generated">
                                </div>
                                <div class="form-text text-muted">
                                    This becomes the page URL — e.g. slug <code>dfd</code> → <code>/dfd</code>
                                </div>
                                @error('slug')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Description</label>
                                <textarea name="description" rows="3"
                                          class="form-control @error('description') is-invalid @enderror"
                                          placeholder="Short description shown on the section page…">{{ old('description') }}</textarea>
                                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Sort Order</label>
                                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}"
                                           min="0" max="255" class="form-control">
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
                                    <i class="fa fa-save me-1"></i> Save Section
                                </button>
                                <a href="{{ route('school-sections.index') }}" class="btn btn-secondary">
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
                        <div class="card-title"><i class="fa fa-info-circle text-info me-1"></i> How Sections Work</div>
                    </div>
                    <div class="card-body small text-muted">
                        <ul class="list-unstyled mb-0" style="line-height:2.6">
                            <li><i class="fa fa-check text-success me-2"></i>Each section creates its own frontend page</li>
                            <li><i class="fa fa-check text-success me-2"></i>Add school categories under the section</li>
                            <li><i class="fa fa-check text-success me-2"></i>Add schools under each category</li>
                            <li><i class="fa fa-globe text-primary me-2"></i>URL: <code>/your-slug</code> and <code>/your-slug/category</code></li>
                            <li><i class="fa fa-times text-danger me-2"></i>Cannot delete if it has categories inside</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
function autoSlug(val) {
    const s = document.getElementById('secSlug');
    if (!s.dataset.manual) {
        s.value = val.toLowerCase().replace(/[^a-z0-9\s-]/g,'').trim().replace(/\s+/g,'-');
    }
}
document.getElementById('secSlug').addEventListener('input', function(){ this.dataset.manual='true'; });
</script>
@endsection
