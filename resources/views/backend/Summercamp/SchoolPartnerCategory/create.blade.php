@extends('backend.layout.app')
@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Add School Partner Category</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="{{ route('school-sections.index') }}">School Sections</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="{{ route('school-partner-categories.index') }}">Categories</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Add</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-7">
                <div class="card card-round">
                    <div class="card-header"><div class="card-title">Category Details</div></div>
                    <div class="card-body">
                        <form action="{{ route('school-partner-categories.store') }}" method="POST">
                            @csrf

                            {{-- Section (parent) --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Section (Parent Page) <span class="text-danger">*</span></label>
                                <select name="school_section_id"
                                        class="form-select @error('school_section_id') is-invalid @enderror">
                                    <option value="">— No Section / Global —</option>
                                    @foreach($sections as $sec)
                                        <option value="{{ $sec->id }}"
                                            {{ (old('school_section_id', $preselectedSection) == $sec->id) ? 'selected' : '' }}>
                                            {{ $sec->name }} ({{ $sec->slug }})
                                        </option>
                                    @endforeach
                                </select>
                                <div class="form-text text-muted">
                                    This category will appear as a tab under the selected section page.
                                </div>
                                @error('school_section_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                @if($sections->isEmpty())
                                    <div class="alert alert-warning mt-2 py-2 px-3" style="font-size:13px;">
                                        No sections yet.
                                        <a href="{{ route('school-sections.create') }}">Create a section first</a>
                                        (e.g. "Curriculum", "DFD").
                                    </div>
                                @endif
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Category Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="catName" value="{{ old('name') }}"
                                       class="form-control @error('name') is-invalid @enderror"
                                       placeholder="e.g. CBSE Schools, ICSE Schools"
                                       oninput="autoSlug(this.value)">
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Slug</label>
                                <input type="text" name="slug" id="catSlug" value="{{ old('slug') }}"
                                       class="form-control font-monospace @error('slug') is-invalid @enderror"
                                       placeholder="auto-generated">
                                <div class="form-text text-muted">
                                    URL segment — e.g. slug <code>cbse-schools</code> → <code>/section/cbse-schools</code>
                                </div>
                                @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
                                        <label class="form-check-label fw-semibold" for="status">Active</label>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-save me-1"></i> Save Category
                                </button>
                                <a href="{{ route('school-partner-categories.index') }}" class="btn btn-secondary">
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
function autoSlug(val) {
    const s = document.getElementById('catSlug');
    if (!s.dataset.manual) {
        s.value = val.toLowerCase().replace(/[^a-z0-9\s-]/g,'').trim().replace(/\s+/g,'-');
    }
}
document.getElementById('catSlug').addEventListener('input', function(){ this.dataset.manual='true'; });
</script>
@endsection
