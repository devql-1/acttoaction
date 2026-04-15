@extends('backend.layout.app')
@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Summer Camp Partners</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Partners</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">Co-host · Supported By · Knowledge · Gold State</div>
                            <div class="card-tools">
                                <a href="{{ route('summer-partners.create') }}" class="btn btn-success btn-sm">
                                    <i class="fa fa-plus me-1"></i> Add Partner
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
                                            {{ collect($partners)->flatten()->count() }}
                                        </span>
                                    </a>
                                </li>
                                @foreach($categories as $slug => $cat)
                                    <li class="nav-item">
                                        <a class="nav-link" href="#" data-cat="{{ $slug }}">
                                            {{ $cat->name }}
                                            <span class="badge badge-secondary ms-1">
                                                {{ isset($partners[$slug]) ? $partners[$slug]->count() : 0 }}
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
                                        <th>Name</th>
                                        <th class="text-center">Category</th>
                                        <th class="text-center">Sort</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse(collect($partners)->flatten(1) as $partner)
                                        <tr id="record-row-{{ $partner->id }}" data-cat="{{ $partner->category }}">
                                            <td>{{ $loop->iteration }}</td>

                                            <td>
                                                <a data-fancybox="partner-logos" href="{{ $partner->logo_url }}">
                                                    <img src="{{ $partner->logo_url }}" alt="{{ $partner->name }}"
                                                         style="width:80px;height:50px;object-fit:contain;
                                                                border-radius:6px;border:1px solid #eee;
                                                                background:#f9f9f9;padding:4px;">
                                                </a>
                                            </td>

                                            <td>
                                                <strong>{{ $partner->name }}</strong>
                                                @if($partner->website_url)
                                                    <br>
                                                    <a href="{{ $partner->website_url }}" target="_blank"
                                                       class="text-muted" style="font-size:11px;">
                                                        <i class="fa fa-external-link me-1"></i>{{ $partner->website_url }}
                                                    </a>
                                                @endif
                                            </td>

                                            <td class="text-center">
                                                <span class="badge badge-secondary">
                                                    {{ isset($categories[$partner->category]) ? $categories[$partner->category]->name : $partner->category }}
                                                </span>
                                            </td>

                                            <td class="text-center">
                                                <span class="badge badge-secondary">{{ $partner->sort_order }}</span>
                                            </td>

                                            <td class="text-center">
                                                <label class="switch">
                                                    <input type="checkbox" class="toggle-status"
                                                           data-id="{{ $partner->id }}"
                                                           data-url="{{ route('summer-partners.status') }}"
                                                           {{ $partner->status ? 'checked' : '' }}>
                                                    <span class="record-toggle"></span>
                                                </label>
                                            </td>

                                            <td class="text-center">
                                                <div class="d-flex justify-content-center align-items-center gap-1">
                                                    <a href="{{ route('summer-partners.edit', ['partner' => $partner->id]) }}"
                                                       class="btn btn-primary btn-sm">
                                                        <i class="fa fa-edit me-1"></i> Edit
                                                    </a>
                                                    <form id="delete-form-{{ $partner->id }}"
                                                          action="{{ route('summer-partners.destroy', ['partner' => $partner->id]) }}"
                                                          method="POST" class="d-none">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                            onclick="confirmDelete({{ $partner->id }}, '{{ addslashes($partner->name) }}')">
                                                        <i class="fa fa-trash me-1"></i> Delete
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted py-4">
                                                No partners found.
                                                <a href="{{ route('summer-partners.create') }}">Add your first partner</a>
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
        tab.addEventListener('click', function(e) {
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
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
        }).then(result => {
            if (result.isConfirmed) document.getElementById(`delete-form-${id}`).submit();
        });
    }

    
    
</script>
@endsection
