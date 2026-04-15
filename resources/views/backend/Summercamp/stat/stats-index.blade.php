@extends('backend.layout.app')
@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Stats Counter</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Stats</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">All Stats</div>
                            <div class="card-tools">
                                <a href="{{ route('stats-create') }}" class="btn btn-success btn-sm">
                                    <i class="fa fa-plus me-1"></i> Add Stat
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
                                        <th>Icon</th>
                                        <th>Value</th>
                                        <th>Suffix</th>
                                        <th>Label</th>
                                        <th class="text-center">Preview</th>
                                        <th class="text-center">Sort</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($stats as $stat)
                                    <tr id="record-row-{{ $stat->id }}">

                                        <td>{{ $loop->iteration }}</td>

                                        <td>
                                            <i class="bi {{ $stat->icon }} fs-4 text-primary"></i>
                                            <br><small class="text-muted" style="font-size:10px;">{{ $stat->icon }}</small>
                                        </td>

                                        <td><strong>{{ $stat->value }}</strong></td>

                                        <td><code>{{ $stat->suffix }}</code></td>

                                        <td>{{ $stat->label }}</td>

                                        {{-- Live preview matching frontend style --}}
                                        <td class="text-center">
                                            <div style="background:linear-gradient(135deg,#112344,#1c3d75);
                                                        border-radius:10px; padding:12px 16px; display:inline-block;">
                                                <div style="font-family:'Montserrat',sans-serif;
                                                            font-size:1.4rem; font-weight:800;
                                                            color:#fff; line-height:1;">
                                                    {{ $stat->value }}<span style="color:#ff6a00;font-size:1rem;">{{ $stat->suffix }}</span>
                                                </div>
                                                <div style="font-size:11px;color:rgba(255,255,255,.6);margin-top:4px;">
                                                    {{ $stat->label }}
                                                </div>
                                            </div>
                                        </td>

                                        <td class="text-center">
                                            <span class="badge badge-secondary">{{ $stat->sort_order }}</span>
                                        </td>

                                        <td class="text-center">
                                            <label class="switch">
                                                <input type="checkbox" class="toggle-status"
                                                    data-id="{{ $stat->id }}"
                                                    data-url="{{ route('stats-status') }}"
                                                    {{ $stat->status ? 'checked' : '' }}>
                                                <span class="record-toggle"></span>
                                            </label>
                                        </td>

                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-1">
                                                <a href="{{ route('stats-edit', $stat->id) }}"
                                                   class="btn btn-primary btn-sm">
                                                    <i class="fa fa-edit me-1"></i> Edit
                                                </a>
                                                <form id="delete-form-{{ $stat->id }}"
                                                      action="{{ route('stats-destroy', $stat->id) }}"
                                                      method="POST" class="d-none">
                                                    @csrf @method('DELETE')
                                                </form>
                                                <button type="button" class="btn btn-danger btn-sm"
                                                        onclick="confirmDelete({{ $stat->id }}, '{{ addslashes($stat->label) }}')">
                                                    <i class="fa fa-trash me-1"></i> Delete
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-muted py-4">
                                            No stats yet. <a href="{{ route('stats-create') }}">Add your first stat</a>
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
function confirmDelete(id, label) {
    Swal.fire({
        title: 'Are you sure?',
        text: `Deleting stat "${label}"?`,
        icon: 'warning', showCancelButton: true,
        confirmButtonColor: '#d33', cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it!',
    }).then(r => { if (r.isConfirmed) document.getElementById(`delete-form-${id}`).submit(); });
}


</script>
@endsection
