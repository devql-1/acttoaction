@extends('backend.layout.app')
@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Edit Gallery Category</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="{{ route('gallery-categories-index') }}">Gallery Categories</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Edit</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card card-round">
                    <div class="card-header"><div class="card-title">Edit — {{ $galleryCategory->name }}</div></div>
                    <div class="card-body">
                        <form action="{{ route('gallery-categories-update', $galleryCategory->id) }}" method="POST">
                            @csrf @method('PUT')
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" value="{{ old('name', $galleryCategory->name) }}"
                                       class="form-control @error('name') is-invalid @enderror">
                                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Slug</label>
                                <input type="text" name="slug" value="{{ old('slug', $galleryCategory->slug) }}"
                                       class="form-control @error('slug') is-invalid @enderror">
                                @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="row g-3 mb-4">
                                <div class="col-md-5">
                                    <label class="form-label fw-semibold">Sort Order</label>
                                    <input type="number" name="sort_order" value="{{ old('sort_order', $galleryCategory->sort_order) }}" min="0" class="form-control">
                                </div>
                                <div class="col-md-7 d-flex align-items-end pb-1">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="status" id="status" value="1" {{ $galleryCategory->status ? 'checked' : '' }}>
                                        <label class="form-check-label fw-semibold" for="status">Active</label>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save me-1"></i> Update</button>
                                <a href="{{ route('gallery-categories-index') }}" class="btn btn-secondary"><i class="fa fa-arrow-left me-1"></i> Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-round">
                    <div class="card-header"><div class="card-title">Quick Actions</div></div>
                    <div class="card-body">
                        <a href="{{ route('gallery-images-create') }}?category_id={{ $galleryCategory->id }}" class="btn btn-info btn-sm mb-2">
                            <i class="fa fa-upload me-1"></i> Upload Images to this Category
                        </a>
                        <a href="{{ route('gallery-images-index') }}?category_id={{ $galleryCategory->id }}" class="btn btn-secondary btn-sm mb-2">
                            <i class="fa fa-images me-1"></i> View Images in this Category
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
@if(session('success')) Swal.fire({ icon:'success', title:'Success!', text:'{{ session('success') }}', timer:2500, showConfirmButton:false }); @endif
</script>
@endsection
