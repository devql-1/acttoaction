@extends('backend.layout.app')
@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Gallery Categories</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Gallery Categories</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">All Categories</div>
                            <div class="card-tools d-flex gap-2">
                                <a href="{{ route('gallery-images-index') }}" class="btn btn-outline-primary btn-sm">
                                    <i class="fa fa-images me-1"></i> Manage Images
                                </a>
                                <a href="{{ route('gallery-categories-create') }}" class="btn btn-success btn-sm">
                                    <i class="fa fa-plus me-1"></i> Add Category
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0" id="basic-datatables">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th class="text-center">Images</th>
                                        <th class="text-center">Sort</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($categories as $cat)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td><strong>{{ $cat->name }}</strong></td>
                                        <td><code>{{ $cat->slug }}</code></td>
                                        <td class="text-center">
                                            <a href="{{ route('gallery-images-index', ['category_id' => $cat->id]) }}"
                                               class="badge badge-primary">
                                                {{ $cat->images_count }} images
                                            </a>
                                        </td>
                                        <td class="text-center"><span class="badge badge-secondary">{{ $cat->sort_order }}</span></td>
                                        <td class="text-center">
                                            <label class="switch">
                                                <input type="checkbox" class="toggle-status"
                                                    data-id="{{ $cat->id }}"
                                                    data-url="{{ route('gallery-categories-status') }}"
                                                    {{ $cat->status ? 'checked' : '' }}>
                                                <span class="record-toggle"></span>
                                            </label>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-1">
                                                <a href="{{ route('gallery-images-create') }}?category_id={{ $cat->id }}"
                                                   class="btn btn-info btn-sm" title="Add Images">
                                                    <i class="fa fa-upload"></i>
                                                </a>
                                                <a href="{{ route('gallery-categories-edit', $cat->id) }}"
                                                   class="btn btn-primary btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <form id="del-cat-{{ $cat->id }}"
                                                      action="{{ route('gallery-categories-destroy', $cat->id) }}"
                                                      method="POST" class="d-none">
                                                    @csrf @method('DELETE')
                                                </form>
                                                <button type="button" class="btn btn-danger btn-sm"
                                                        onclick="confirmDelete({{ $cat->id }},'{{ addslashes($cat->name) }}')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr><td colspan="7" class="text-center text-muted py-4">No categories yet. <a href="{{ route('gallery-categories-create') }}">Add one</a></td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmDelete(id, name) {
    Swal.fire({ title:'Are you sure?', text:`Deleting "${name}" will also delete all its images.`, icon:'warning',
        showCancelButton:true, confirmButtonColor:'#d33', cancelButtonColor:'#6c757d', confirmButtonText:'Yes, delete!'
    }).then(r => { if(r.isConfirmed) document.getElementById(`del-cat-${id}`).submit(); });
}
@if(session('success')) Swal.fire({ icon:'success', title:'Success!', text:'{{ session('success') }}', timer:2500, showConfirmButton:false }); @endif
</script>
@endsection
