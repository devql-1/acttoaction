@extends('backend.layout.app')
@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">School Partners</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">School Partners</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">All Schools</div>
                            <div class="card-tools d-flex gap-2">
                                <a href="{{ route('school-partner-categories.index') }}" class="btn btn-info btn-sm">
                                    <i class="fa fa-tags me-1"></i> Manage Categories
                                </a>
                                <a href="{{ route('school-partners.create') }}" class="btn btn-success btn-sm">
                                    <i class="fa fa-plus me-1"></i> Add School
                                </a>
                            </div>
                        </div>

                        {{-- Category filter tabs --}}
                        <div class="mt-3">
                            <ul class="nav nav-pills nav-sm" id="catTabs">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#" data-cat="all">
                                        All
                                        <span class="badge badge-secondary ms-1">
                                            {{ collect($schools)->flatten()->count() }}
                                        </span>
                                    </a>
                                </li>
                                @foreach($categories as $cat)
                                    <li class="nav-item">
                                        <a class="nav-link" href="#" data-cat="{{ $cat->id }}">
                                            {{ $cat->name }}
                                            <span class="badge badge-secondary ms-1">
                                                {{ isset($schools[$cat->id]) ? $schools[$cat->id]->count() : 0 }}
                                            </span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0" id="basic-datatables">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Logo</th>
                                        <th>School Name</th>
                                        <th class="text-center">Category</th>
                                        <th class="text-center">Sort</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse(collect($schools)->flatten(1) as $school)
                                        <tr id="record-row-{{ $school->id }}" data-cat="{{ $school->category_id }}">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <a data-fancybox="school-logos" href="{{ $school->logo_url }}">
                                                    <img src="{{ $school->logo_url }}" alt="{{ $school->name }}"
                                                         style="width:80px;height:50px;object-fit:contain;
                                                                border-radius:6px;border:1px solid #eee;
                                                                background:#f9f9f9;padding:4px;">
                                                </a>
                                            </td>
                                            <td>
                                                <strong>{{ $school->name }}</strong>
                                                @if($school->website_url)
                                                    <br>
                                                    <a href="{{ $school->website_url }}" target="_blank"
                                                       class="text-muted" style="font-size:11px;">
                                                        <i class="fa fa-external-link me-1"></i>{{ $school->website_url }}
                                                    </a>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-secondary">
                                                    {{ isset($categories[$school->category_id]) ? $categories[$school->category_id]->name : '—' }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-secondary">{{ $school->sort_order }}</span>
                                            </td>
                                            <td class="text-center">
                                                <label class="switch">
                                                    <input type="checkbox" class="toggle-status"
                                                           data-id="{{ $school->id }}"
                                                           data-url="{{ route('school-partners.status') }}"
                                                           {{ $school->status ? 'checked' : '' }}>
                                                    <span class="record-toggle"></span>
                                                </label>
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex justify-content-center align-items-center gap-1">
                                                    <a href="{{ route('school-partners.edit', $school) }}"
                                                       class="btn btn-primary btn-sm">
                                                        <i class="fa fa-edit me-1"></i> Edit
                                                    </a>
                                                    <form id="delete-form-{{ $school->id }}"
                                                          action="{{ route('school-partners.destroy', $school) }}"
                                                          method="POST" class="d-none">
                                                        @csrf @method('DELETE')
                                                    </form>
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                            onclick="confirmDelete({{ $school->id }}, '{{ addslashes($school->name) }}')">
                                                        <i class="fa fa-trash me-1"></i> Delete
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted py-4">
                                                No schools found.
                                                <a href="{{ route('school-partners.create') }}">Add your first school</a>
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
document.querySelectorAll('#catTabs .nav-link').forEach(tab => {
    tab.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelectorAll('#catTabs .nav-link').forEach(t => t.classList.remove('active'));
        this.classList.add('active');
        const cat = this.dataset.cat;
        document.querySelectorAll('tbody tr[data-cat]').forEach(row => {
            row.style.display = (cat === 'all' || row.dataset.cat === cat) ? '' : 'none';
        });
    });
});

function confirmDelete(id, name) {
    Swal.fire({
        title: 'Are you sure?',
        text: `Deleting "${name}"?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete!',
    }).then(result => {
        if (result.isConfirmed) document.getElementById(`delete-form-${id}`).submit();
    });
}



</script>
@endsection
