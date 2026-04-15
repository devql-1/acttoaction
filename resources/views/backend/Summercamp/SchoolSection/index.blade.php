@extends('backend.layout.app')
@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">School Sections</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">School Sections</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">All Sections
                                <small class="text-muted ms-2" style="font-size:12px;">
                                    Each section = one page on the frontend (e.g. /curriculum, /dfd)
                                </small>
                            </div>
                            <div class="card-tools">
                                <a href="{{ route('school-sections.create') }}" class="btn btn-success btn-sm">
                                    <i class="fa fa-plus me-1"></i> Add Section
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Section Name</th>
                                        <th>Slug / URL</th>
                                        <th class="text-center">Categories</th>
                                        <th class="text-center">Sort</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($sections as $section)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <strong>{{ $section->name }}</strong>
                                                @if($section->description)
                                                    <br><small class="text-muted">{{ Str::limit($section->description, 60) }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                <code>/{{ $section->slug }}</code>
                                                <a href="{{ url('/' . $section->slug) }}" target="_blank"
                                                   class="ms-1 text-muted" title="View on site">
                                                    <i class="fa fa-external-link" style="font-size:11px;"></i>
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('school-partner-categories.index', ['section' => $section->id]) }}"
                                                   class="badge badge-secondary text-decoration-none">
                                                    {{ $section->category_count }}
                                                    <i class="fa fa-arrow-right ms-1" style="font-size:9px;"></i>
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-secondary">{{ $section->sort_order }}</span>
                                            </td>
                                            <td class="text-center">
                                                <label class="switch">
                                                    <input type="checkbox" class="toggle-status"
                                                           data-id="{{ $section->id }}"
                                                           data-url="{{ route('school-sections.status') }}"
                                                           {{ $section->status ? 'checked' : '' }}>
                                                    <span class="record-toggle"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-1 flex-wrap">
                                                    {{-- Quick link: manage categories for this section --}}
                                                    <a href="{{ route('school-partner-categories.create', ['section_id' => $section->id]) }}"
                                                       class="btn btn-info btn-sm" title="Add Category under this section">
                                                        <i class="fa fa-plus me-1"></i> Add Category
                                                    </a>
                                                    <a href="{{ route('school-sections.edit', $section) }}"
                                                       class="btn btn-primary btn-sm">
                                                        <i class="fa fa-edit me-1"></i> Edit
                                                    </a>
                                                    <form id="delete-form-{{ $section->id }}"
                                                          action="{{ route('school-sections.destroy', $section) }}"
                                                          method="POST" class="d-none">
                                                        @csrf @method('DELETE')
                                                    </form>
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                            onclick="confirmDelete({{ $section->id }}, '{{ addslashes($section->name) }}')">
                                                        <i class="fa fa-trash me-1"></i> Delete
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted py-4">
                                                No sections yet.
                                                <a href="{{ route('school-sections.create') }}">Create your first section</a>
                                                (e.g. "Curriculum", "DFD")
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
        title: 'Are you sure?',
        text: `Delete section "${name}"? All categories inside must be removed first.`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete!',
    }).then(r => { if (r.isConfirmed) document.getElementById(`delete-form-${id}`).submit(); });
}


</script>
@endsection
