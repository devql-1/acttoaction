@extends('backend.layout.app')
@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Partner Categories</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="{{ route('summer-partners.index') }}">Partners</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Categories</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">All Partner Categories</div>
                            <div class="card-tools">
                                <a href="{{ route('summer-partner-categories.create') }}" class="btn btn-success btn-sm">
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
                                        <th class="text-center">Partners</th>
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

                                            <td>
                                                <code style="font-size:12px;background:#f4f4f4;padding:2px 8px;border-radius:4px;">
                                                    {{ $cat->slug }}
                                                </code>
                                            </td>

                                            <td class="text-center">
                                                <a href="{{ route('summer-partners.index') }}?cat={{ $cat->slug }}"
                                                   class="badge badge-info" style="font-size:13px;">
                                                    {{ $cat->partner_count }}
                                                </a>
                                            </td>

                                            <td class="text-center">
                                                <span class="badge badge-secondary">{{ $cat->sort_order }}</span>
                                            </td>

                                            <td class="text-center">
                                                <label class="switch">
                                                    <input type="checkbox" class="toggle-status"
                                                           data-id="{{ $cat->id }}"
                                                           data-url="{{ route('summer-partner-categories.status') }}"
                                                           {{ $cat->status ? 'checked' : '' }}>
                                                    <span class="record-toggle"></span>
                                                </label>
                                            </td>

                                            <td class="text-center">
                                                <div class="d-flex justify-content-center align-items-center gap-1">
                                                    <a href="{{ route('summer-partner-categories.edit', $cat->id) }}"
                                                       class="btn btn-primary btn-sm">
                                                        <i class="fa fa-edit me-1"></i> Edit
                                                    </a>
                                                    <form id="del-cat-{{ $cat->id }}"
                                                          action="{{ route('summer-partner-categories.destroy', $cat->id) }}"
                                                          method="POST" class="d-none">
                                                        @csrf @method('DELETE')
                                                    </form>
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                            onclick="confirmDelete({{ $cat->id }}, '{{ addslashes($cat->name) }}', {{ $cat->partner_count }})">
                                                        <i class="fa fa-trash me-1"></i> Delete
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted py-4">
                                                No categories yet.
                                                <a href="{{ route('summer-partner-categories.create') }}">Add the first one</a>
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
function confirmDelete(id, name, partnerCount) {
    if (partnerCount > 0) {
        Swal.fire({
            icon: 'warning',
            title: 'Cannot Delete',
            html: `<strong>${name}</strong> has <strong>${partnerCount}</strong> partner(s) assigned.<br>Reassign or delete them first.`,
        });
        return;
    }
    Swal.fire({
        title: 'Delete Category?',
        text: `"${name}" will be permanently removed.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete',
    }).then(result => {
        if (result.isConfirmed) document.getElementById(`del-cat-${id}`).submit();
    });
}



</script>
@endsection
