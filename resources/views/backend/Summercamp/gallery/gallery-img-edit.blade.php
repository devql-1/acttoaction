@extends('backend.layout.app')
@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Edit Gallery Image</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="{{ route('gallery-images-index') }}">Gallery Images</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Edit</a></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-7">
                <div class="card card-round">
                    <div class="card-header"><div class="card-title">Edit Image Settings</div></div>
                    <div class="card-body">
                        <form action="{{ route('gallery-images-update', $galleryImage->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf @method('PUT')

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Category <span class="text-danger">*</span></label>
                                <select name="gallery_category_id" class="form-select @error('gallery_category_id') is-invalid @enderror">
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ old('gallery_category_id',$galleryImage->gallery_category_id)==$cat->id ? 'selected':'' }}>{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                                @error('gallery_category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Replace Image <small class="text-muted">(leave empty to keep)</small></label>
                                <input type="file" name="image" accept="image/jpeg,image/png,image/webp"
                                       class="form-control @error('image') is-invalid @enderror"
                                       onchange="previewNew(this)">
                                @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Label / Caption</label>
                                    <input type="text" name="label" value="{{ old('label',$galleryImage->label) }}" class="form-control" placeholder="e.g. Opening Ceremony">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Alt Text</label>
                                    <input type="text" name="alt_text" value="{{ old('alt_text',$galleryImage->alt_text) }}" class="form-control">
                                </div>
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Strip Size</label>
                                    <select name="size" class="form-select">
                                        <option value="sm" {{ old('size',$galleryImage->size)=='sm'?'selected':'' }}>Small</option>
                                        <option value="md" {{ old('size',$galleryImage->size)=='md'?'selected':'' }}>Medium</option>
                                        <option value="lg" {{ old('size',$galleryImage->size)=='lg'?'selected':'' }}>Large</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Strip Row</label>
                                    <select name="strip_row" class="form-select">
                                        <option value="1" {{ old('strip_row',$galleryImage->strip_row)==1?'selected':'' }}>Row 1</option>
                                        <option value="2" {{ old('strip_row',$galleryImage->strip_row)==2?'selected':'' }}>Row 2</option>
                                        <option value="3" {{ old('strip_row',$galleryImage->strip_row)==3?'selected':'' }}>Row 3</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Sort Order</label>
                                    <input type="number" name="sort_order" value="{{ old('sort_order',$galleryImage->sort_order) }}" min="0" class="form-control">
                                </div>
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="is_featured" id="is_featured" value="1" {{ $galleryImage->is_featured?'checked':'' }}>
                                        <label class="form-check-label fw-semibold" for="is_featured">Featured</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" name="status" id="status" value="1" {{ $galleryImage->status?'checked':'' }}>
                                        <label class="form-check-label fw-semibold" for="status">Active</label>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save me-1"></i> Update</button>
                                <a href="{{ route('gallery-images-index') }}" class="btn btn-secondary"><i class="fa fa-arrow-left me-1"></i> Back</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card card-round mb-3">
                    <div class="card-header"><div class="card-title">Current Image</div></div>
                    <div class="card-body text-center">
                        <img id="currentImg" src="{{ $galleryImage->image_url }}" alt="{{ $galleryImage->alt_text }}"
                             style="max-width:100%;max-height:260px;border-radius:10px;object-fit:cover;">
                    </div>
                </div>
                <div class="card card-round">
                    <div class="card-header"><div class="card-title text-danger"><i class="fa fa-exclamation-triangle me-1"></i> Danger Zone</div></div>
                    <div class="card-body">
                        <form id="del-img-{{ $galleryImage->id }}" action="{{ route('gallery-images-destroy', $galleryImage->id) }}" method="POST" class="d-none">@csrf @method('DELETE')</form>
                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete({{ $galleryImage->id }})">
                            <i class="fa fa-trash me-1"></i> Delete Image
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function previewNew(input) {
    if (!input.files[0]) return;
    const reader = new FileReader();
    reader.onload = e => document.getElementById('currentImg').src = e.target.result;
    reader.readAsDataURL(input.files[0]);
}
function confirmDelete(id) {
    Swal.fire({ title:'Delete image?', text:'This cannot be undone.', icon:'warning',
        showCancelButton:true, confirmButtonColor:'#d33', cancelButtonColor:'#6c757d', confirmButtonText:'Yes, delete!'
    }).then(r => { if(r.isConfirmed) document.getElementById(`del-img-${id}`).submit(); });
}

</script>
@endsection
