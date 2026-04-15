@extends('backend.layout.app')
@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Merchandise</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Merchandise</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">All Merchandise Items</div>
                            <div class="card-tools">
                                <a href="{{ route('merchandise.create') }}" class="btn btn-success btn-sm">
                                    <i class="fa fa-plus me-1"></i> Add Item
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
                                        <th>Photo</th>
                                        <th>Name</th>
                                        <th class="text-center">Price (₹)</th>
                                        <th class="text-center">Sort</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($merchandises as $item)
                                    <tr id="record-row-{{ $item->id }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if($item->image_url)
                                                <a data-fancybox="merch-gallery" href="{{ $item->image_url }}">
                                                    <img src="{{ $item->image_url }}" alt="{{ $item->name }}"
                                                         style="width:50px;height:50px;object-fit:cover;border-radius:8px;box-shadow:0 4px 12px rgba(0,0,0,.15);">
                                                </a>
                                            @else
                                                <div style="width:50px;height:50px;background:#f0f0f0;border-radius:8px;display:flex;align-items:center;justify-content:center;">
                                                    <i class="fa fa-shopping-bag text-muted"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <strong>{{ $item->name }}</strong>
                                            @if($item->description)
                                                <br><small class="text-muted">{{ Str::limit($item->description, 60) }}</small>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <span class="badge badge-success fs-6">₹{{ number_format($item->price, 2) }}</span>
                                        </td>
                                        <td class="text-center">
                                            <span class="badge badge-secondary">{{ $item->sort_order }}</span>
                                        </td>
                                        <td class="text-center">
                                            <label class="switch">
                                                <input type="checkbox" class="toggle-status"
                                                    data-id="{{ $item->id }}"
                                                    data-url="{{ route('merchandise.status') }}"
                                                    {{ $item->status ? 'checked' : '' }}>
                                                <span class="record-toggle"></span>
                                            </label>
                                        </td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-1">
                                                <a href="{{ route('merchandise.edit', $item->id) }}"
                                                   class="btn btn-primary btn-sm">
                                                    <i class="fa fa-edit me-1"></i> Edit
                                                </a>
                                                <form id="delete-form-{{ $item->id }}"
                                                      action="{{ route('merchandise.destroy', $item->id) }}"
                                                      method="POST" class="d-none">
                                                    @csrf @method('DELETE')
                                                </form>
                                                <button type="button" class="btn btn-danger btn-sm"
                                                        onclick="confirmDelete({{ $item->id }}, '{{ addslashes($item->name) }}')">
                                                    <i class="fa fa-trash me-1"></i> Delete
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">
                                            No merchandise items yet. <a href="{{ route('merchandise.create') }}">Add one</a>
                                        </td>
                                    </tr>
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
    Swal.fire({
        title: 'Are you sure?', text: `Deleting "${name}"?`, icon: 'warning',
        showCancelButton: true, confirmButtonColor: '#d33', cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it!',
    }).then(r => { if (r.isConfirmed) document.getElementById(`delete-form-${id}`).submit(); });
}

</script>
@endsection
