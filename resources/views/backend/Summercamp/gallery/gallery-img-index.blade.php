@extends('backend.layout.app')
@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Gallery Images</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Gallery Images</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">
                                All Images
                                @if($activeCategory)
                                    — <span class="text-primary">{{ $categories->find($activeCategory)?->name }}</span>
                                @endif
                            </div>
                            <div class="card-tools d-flex gap-2">
                                {{-- Category filter --}}
                                <form method="GET" action="{{ route('gallery-images-index') }}" class="d-flex gap-2">
                                    <select name="category_id" class="form-select form-select-sm" onchange="this.form.submit()" style="width:180px;">
                                        <option value="">All Categories</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}" {{ $activeCategory == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </form>
                                <a href="{{ route('gallery-images-create') }}{{ $activeCategory ? '?category_id='.$activeCategory : '' }}"
                                   class="btn btn-success btn-sm">
                                    <i class="fa fa-upload me-1"></i> Upload Images
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($images->isEmpty())
                            <div class="text-center py-5 text-muted">
                                No images yet. <a href="{{ route('gallery-images-create') }}">Upload some</a>
                            </div>
                        @else
                        {{-- Thumbnail grid --}}
                        <div class="row g-3">
                            @foreach($images as $img)
                            <div class="col-6 col-md-3 col-lg-2">
                                <div class="card h-100 border {{ $img->status ? '' : 'border-danger' }}" style="overflow:hidden;">
                                    <div style="height:120px;overflow:hidden;position:relative;">
                                        <img src="{{ $img->image_url }}" alt="{{ $img->alt_text }}"
                                             style="width:100%;height:100%;object-fit:cover;">
                                        {{-- Featured badge --}}
                                        @if($img->is_featured)
                                        <span style="position:absolute;top:4px;left:4px;background:#ff6a00;color:#fff;font-size:9px;font-weight:700;padding:2px 6px;border-radius:8px;">FEATURED</span>
                                        @endif
                                        {{-- Status badge --}}
                                        @if(!$img->status)
                                        <span style="position:absolute;top:4px;right:4px;background:rgba(220,53,69,.85);color:#fff;font-size:9px;font-weight:700;padding:2px 6px;border-radius:8px;">HIDDEN</span>
                                        @endif
                                    </div>
                                    <div class="card-body p-2">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <span class="badge badge-secondary" style="font-size:9px;">{{ strtoupper($img->size) }}</span>
                                            <span class="badge badge-info" style="font-size:9px;">Row {{ $img->strip_row }}</span>
                                        </div>
                                        @if($img->label)
                                        <p class="mb-1" style="font-size:10px;color:#666;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $img->label }}</p>
                                        @endif
                                        <p class="mb-2" style="font-size:10px;color:#aaa;">{{ $img->category->name ?? '—' }}</p>
                                        <div class="d-flex gap-1">
                                            <label class="switch mb-0" title="Toggle status">
                                                <input type="checkbox" class="toggle-status"
                                                    data-id="{{ $img->id }}"
                                                    data-url="{{ route('gallery-images-status') }}"
                                                    {{ $img->status ? 'checked' : '' }}>
                                                <span class="record-toggle"></span>
                                            </label>
                                            <a href="{{ route('gallery-images-edit', $img->id) }}"
                                               class="btn btn-primary btn-xs px-2" style="font-size:11px;">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form id="del-img-{{ $img->id }}" action="{{ route('gallery-images-destroy', $img->id) }}" method="POST" class="d-none">@csrf @method('DELETE')</form>
                                            <button type="button" class="btn btn-danger btn-xs px-2" style="font-size:11px;"
                                                    onclick="confirmDelete({{ $img->id }})">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmDelete(id) {
    Swal.fire({ title:'Delete image?', text:'This cannot be undone.', icon:'warning',
        showCancelButton:true, confirmButtonColor:'#d33', cancelButtonColor:'#6c757d', confirmButtonText:'Yes, delete!'
    }).then(r => { if(r.isConfirmed) document.getElementById(`del-img-${id}`).submit(); });
}
@if(session('success')) Swal.fire({ icon:'success', title:'Success!', text:'{{ session('success') }}', timer:2500, showConfirmButton:false }); @endif
</script>
@endsection
