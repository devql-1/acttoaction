@extends('backend.layout.app')
@section('content')
    <div class="container">
        <div class="page-inner">

            <div class="page-header">
                <h3 class="fw-bold mb-3">Blog Tags</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="#">Blog System</a></li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item">Tags</li>
                </ul>
            </div>

            {{-- Success / Error --}}
            

            <div class="row">

                {{-- ── LEFT: Create Tag Form ── --}}
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Add New Tag</div>
                        </div>
                        <form action="{{ route('admin.blog-tags.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Tag Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name" value="{{ old('name') }}"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="e.g. Acting Tips">
                                    @error('name')
                                        <p class="invalid-feedback">{{ $message }}</p>
                                    @enderror
                                    <small class="form-text text-muted">Slug is auto-generated from name.</small>
                                </div>
                            </div>
                            <div class="card-action text-center">
                                <button type="submit" class="btn btn-success">Add Tag</button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- ── RIGHT: Tags Table ── --}}
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <div class="card-title mb-0">All Tags</div>
                            <span class="badge bg-primary">{{ $tags->total() }} total</span>
                        </div>
                        <div class="card-body p-0">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Slug</th>
                                        <th>Posts</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($tags as $tag)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td><strong>{{ $tag->name }}</strong></td>
                                            <td><code>{{ $tag->slug }}</code></td>
                                            <td>
                                                <span class="badge bg-secondary">{{ $tag->blogs_count }}</span>
                                            </td>
                                            <td class="text-center">
                                                {{-- Edit Button --}}
                                                <button class="btn btn-sm btn-warning"
                                                    onclick="openEdit({{ $tag->id }}, '{{ addslashes($tag->name) }}')">
                                                    <i class="icon-pencil"></i> Edit
                                                </button>

                                                {{-- Delete Button --}}
                                                <form action="{{ route('admin.blog-tags.destroy', $tag) }}" method="POST"
                                                    class="d-inline"
                                                    data-confirm="Delete tag '{{ $tag->name }}'? It will be removed from all posts."
                                                    data-confirm-title="Delete Tag?"
                                                    data-confirm-button="Yes, delete">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger">
                                                        <i class="icon-trash"></i> Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-muted py-4">
                                                No tags yet. Create your first tag.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination --}}
                        @if ($tags->hasPages())
                            <div class="card-footer">
                                {{ $tags->links() }}
                            </div>
                        @endif

                    </div>
                </div>

            </div>{{-- /row --}}
        </div>
    </div>

    {{-- ── Edit Modal ── --}}
    <div class="modal fade" id="editTagModal" tabindex="-1">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Tag</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="editTagForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Tag Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="editTagName" class="form-control"
                                placeholder="Tag name" required>
                            <small class="form-text text-muted">Slug updates automatically.</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-warning">Update Tag</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function openEdit(id, name) {
            // Set form action dynamically
            const base = "{{ url('admin/blog-tags') }}";
            document.getElementById('editTagForm').action = base + '/' + id;
            document.getElementById('editTagName').value = name;

            // Show modal
            new bootstrap.Modal(document.getElementById('editTagModal')).show();
        }
    </script>
@endsection
