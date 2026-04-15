@extends('backend.layout.app')
@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Edit Section: {{ $schoolSection->name }}</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="{{ route('school-sections.index') }}">School Sections</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Edit</a></li>
            </ul>
        </div>

        <form action="{{ route('school-sections.update', $schoolSection) }}" method="POST">
            @csrf @method('PUT')

            <div class="row">

                {{-- Left: Section details --}}
                <div class="col-md-6">
                    <div class="card card-round">
                        <div class="card-header">
                            <div class="card-title">Section Details</div>
                        </div>
                        <div class="card-body">

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Section Name <span class="text-danger">*</span></label>
                                <input type="text" name="name"
                                       value="{{ old('name', $schoolSection->name) }}"
                                       class="form-control @error('name') is-invalid @enderror">
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Slug / URL</label>
                                <div class="input-group">
                                    <span class="input-group-text text-muted">/</span>
                                    <input type="text" name="slug"
                                           value="{{ old('slug', $schoolSection->slug) }}"
                                           class="form-control font-monospace @error('slug') is-invalid @enderror">
                                </div>
                                @error('slug')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Description</label>
                                <textarea name="description" rows="3"
                                          class="form-control">{{ old('description', $schoolSection->description) }}</textarea>
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Sort Order</label>
                                    <input type="number" name="sort_order"
                                           value="{{ old('sort_order', $schoolSection->sort_order) }}"
                                           min="0" max="255" class="form-control">
                                </div>
                                <div class="col-md-8 d-flex align-items-end pb-1">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="status"
                                               id="status" value="1"
                                               {{ old('status', $schoolSection->status) ? 'checked' : '' }}>
                                        <label class="form-check-label fw-semibold" for="status">Active</label>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-save me-1"></i> Update Section
                                </button>
                                <a href="{{ route('school-sections.index') }}" class="btn btn-secondary">
                                    <i class="fa fa-arrow-left me-1"></i> Cancel
                                </a>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- Right: Category assignment --}}
                <div class="col-md-6">
                    <div class="card card-round">
                        <div class="card-header">
                            <div class="card-head-row card-tools-still-right">
                                <div class="card-title">
                                    <i class="fa fa-tags me-1 text-primary"></i>
                                    Assign Categories
                                    <small class="text-muted ms-1" style="font-size:12px;">
                                        (checked = shown under /{{ $schoolSection->slug }})
                                    </small>
                                </div>
                                <div class="card-tools">
                                    <a href="{{ route('school-partner-categories.create', ['section_id' => $schoolSection->id]) }}"
                                       class="btn btn-sm btn-outline-success">
                                        <i class="fa fa-plus me-1"></i> New Category
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">

                            @if($allCategories->isEmpty())
                                <div class="text-muted text-center py-3" style="font-size:.9rem;">
                                    No categories yet.
                                    <a href="{{ route('school-partner-categories.create', ['section_id' => $schoolSection->id]) }}">
                                        Create one
                                    </a>
                                </div>
                            @else
                                <div class="mb-2 d-flex gap-2">
                                    <button type="button" class="btn btn-xs btn-outline-secondary"
                                            onclick="toggleAll(true)">Check All</button>
                                    <button type="button" class="btn btn-xs btn-outline-secondary"
                                            onclick="toggleAll(false)">Uncheck All</button>
                                </div>

                                <div class="cat-pick-list" style="max-height:360px;overflow-y:auto;">
                                    @foreach($allCategories as $cat)
                                        <label class="cat-pick-item d-flex align-items-center gap-2
                                                       p-2 rounded mb-1 {{ in_array($cat->id, $assignedIds) ? 'assigned' : '' }}"
                                               style="cursor:pointer;border:1px solid #eee;
                                                      background: {{ in_array($cat->id, $assignedIds) ? 'color-mix(in srgb,var(--bs-success,#28a745),transparent 88%)' : '#fafafa' }};">
                                            <input type="checkbox" name="category_ids[]"
                                                   value="{{ $cat->id }}"
                                                   class="form-check-input cat-cb m-0"
                                                   {{ in_array($cat->id, old('category_ids', $assignedIds)) ? 'checked' : '' }}
                                                   onchange="highlightRow(this)">
                                            <span class="fw-semibold" style="font-size:14px;">{{ $cat->name }}</span>
                                            <code class="ms-auto text-muted" style="font-size:11px;">{{ $cat->slug }}</code>
                                            @if($cat->school_section_id && $cat->school_section_id !== $schoolSection->id)
                                                <span class="badge badge-warning ms-1" title="Currently in another section">
                                                    other section
                                                </span>
                                            @endif
                                        </label>
                                    @endforeach
                                </div>

                                <div class="form-text text-muted mt-2">
                                    <i class="fa fa-info-circle me-1"></i>
                                    Checking a category that belongs to another section will
                                    <strong>move</strong> it here.
                                </div>
                            @endif

                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function toggleAll(check) {
    document.querySelectorAll('.cat-cb').forEach(cb => {
        cb.checked = check;
        highlightRow(cb);
    });
}
function highlightRow(cb) {
    const label = cb.closest('label');
    label.style.background = cb.checked
        ? 'color-mix(in srgb,#28a745,transparent 88%)'
        : '#fafafa';
}


</script>
@endsection
