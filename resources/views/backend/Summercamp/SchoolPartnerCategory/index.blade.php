@extends('backend.layout.app')
@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">School Partner Categories</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="{{ route('school-sections.index') }}">School Sections</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Categories</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">All Categories</div>
                            <div class="card-tools">
                                <a href="{{ route('school-partner-categories.create') }}" class="btn btn-success btn-sm">
                                    <i class="fa fa-plus me-1"></i> Add Category
                                </a>
                            </div>
                        </div>

                        {{-- Section filter --}}
                        <div class="mt-3">
                            <ul class="nav nav-pills nav-sm" id="sectionTabs">
                                <li class="nav-item">
                                    <a class="nav-link {{ is_null($activeSection) ? 'active' : '' }}"
                                       href="{{ route('school-partner-categories.index') }}">
                                        All <span class="badge badge-secondary ms-1">{{ $categories->count() }}</span>
                                    </a>
                                </li>
                                @foreach($sections as $sec)
                                    <li class="nav-item">
                                        <a class="nav-link {{ $activeSection == $sec->id ? 'active' : '' }}"
                                           href="{{ route('school-partner-categories.index', ['section' => $sec->id]) }}">
                                            {{ $sec->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Category Name</th>
                                        <th>Section</th>
                                        <th>Slug</th>
                                        <th class="text-center">Schools</th>
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
                                                @if($cat->section)
                                                    <span class="badge badge-info">{{ $cat->section->name }}</span>
                                                @else
                                                    <span class="text-muted">—</span>
                                                @endif
                                            </td>
                                            <td><code>{{ $cat->slug }}</code></td>
                                            <td class="text-center">
                                                <span class="badge badge-secondary">{{ $cat->school_count }}</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-secondary">{{ $cat->sort_order }}</span>
                                            </td>
                                            <td class="text-center">
                                                <label class="switch">
                                                    <input type="checkbox" class="toggle-status"
                                                           data-id="{{ $cat->id }}"
                                                           data-url="{{ route('school-partner-categories.status') }}"
                                                           {{ $cat->status ? 'checked' : '' }}>
                                                    <span class="record-toggle"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center gap-1">
                                                    <a href="{{ route('school-partner-categories.edit', $cat) }}"
                                                       class="btn btn-primary btn-sm">
                                                        <i class="fa fa-edit me-1"></i> Edit
                                                    </a>
                                                    <form id="delete-form-{{ $cat->id }}"
                                                          action="{{ route('school-partner-categories.destroy', $cat) }}"
                                                          method="POST" class="d-none">
                                                        @csrf @method('DELETE')
                                                    </form>
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                            onclick="confirmDelete({{ $cat->id }}, '{{ addslashes($cat->name) }}')">
                                                        <i class="fa fa-trash me-1"></i> Delete
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center text-muted py-4">
                                                No categories yet.
                                                <a href="{{ route('school-partner-categories.create') }}">Add one</a>
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
    Swal.fire({ title:'Are you sure?', text:`Delete category "${name}"?`, icon:'warning',
        showCancelButton:true, confirmButtonColor:'#d33', cancelButtonColor:'#6c757d',
        confirmButtonText:'Yes, delete!' })
        .then(r => { if(r.isConfirmed) document.getElementById(`delete-form-${id}`).submit(); });
}


</script>
@endsection
