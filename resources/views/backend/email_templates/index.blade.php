@extends('backend.layout.app')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Email Templates</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="#">Email Templates</a></li>
                </ul>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="card-title">All Templates</div>
                                <a href="{{ route('email-templates.create') }}" class="btn btn-primary btn-sm btn-round">
                                    <i class="fa fa-plus me-1"></i> New Template
                                </a>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Subject</th>
                                            <th>Category</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($templates as $t)
                                            <tr>
                                                <td class="text-muted" style="font-size:12px;">
                                                    {{ $t->id }}
                                                </td>
                                                <td class="fw-bold" style="font-size:13px;">
                                                    {{ $t->name }}
                                                </td>
                                                <td>
                                                    <code style="font-size:11px;">{{ $t->slug }}</code>
                                                </td>
                                                <td style="font-size:13px;max-width:200px;" class="text-truncate">
                                                    {{ $t->subject }}
                                                </td>
                                                <td>
                                                    @php
                                                        $catBadge =
                                                            [
                                                                'enrollment' => 'primary',
                                                                'payment' => 'success',
                                                                'volunteer' => 'warning',
                                                                'general' => 'info',
                                                            ][$t->category] ?? 'secondary';
                                                    @endphp
                                                    <span class="badge badge-{{ $catBadge }}">
                                                        {{ ucfirst($t->category) }}
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge badge-{{ $t->is_active ? 'success' : 'secondary' }}">
                                                        {{ $t->is_active ? 'Active' : 'Inactive' }}
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-flex gap-1 justify-content-center">
                                                        <a href="{{ route('email-templates.edit', $t->id) }}"
                                                            class="btn btn-sm btn-icon btn-primary btn-round"
                                                            title="Edit">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <button type="button"
                                                            class="btn btn-sm btn-icon btn-success btn-round"
                                                            title="Send Test"
                                                            onclick="openTestModal({{ $t->id }}, '{{ addslashes($t->name) }}')">
                                                            <i class="fa fa-paper-plane"></i>
                                                        </button>
                                                        <form id="del-tpl-{{ $t->id }}" method="POST"
                                                            action="{{ route('email-templates.destroy', $t->id) }}"
                                                            style="display:none;">
                                                            @csrf @method('DELETE')
                                                        </form>
                                                        <button type="button"
                                                            class="btn btn-sm btn-icon btn-danger btn-round" title="Delete"
                                                            onclick="confirmDelete({{ $t->id }}, '{{ addslashes($t->name) }}')">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center py-5 text-muted">
                                                    <i class="fas fa-envelope fa-2x mb-2 d-block"></i>
                                                    No templates yet.
                                                    <a href="{{ route('email-templates.create') }}">
                                                        Create your first one
                                                    </a>
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

    {{-- Test email modal --}}
    <div class="modal fade" id="testModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="testForm" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">
                            <i class="fa fa-paper-plane me-2"></i> Send Test Email
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p class="text-muted" style="font-size:13px;">
                            Template: <strong id="testTemplateName"></strong>
                        </p>
                        <div class="form-group">
                            <label class="fw-bold" style="font-size:13px;">
                                Send to <span class="text-danger">*</span>
                            </label>
                            <input type="email" name="test_email" class="form-control" placeholder="test@email.com"
                                required>
                            <small class="text-muted">
                                Placeholder values will be used for all variables.
                            </small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-success btn-sm">
                            <i class="fa fa-paper-plane me-1"></i> Send Test
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(id, name) {
            Swal.fire({
                title: 'Delete Template?',
                html: `Delete <strong>${name}</strong>?<br>
                   <small class="text-muted">This cannot be undone.</small>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e74a3b',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="fas fa-trash me-1"></i> Yes, Delete',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('del-tpl-' + id).submit();
                }
            });
        }

        function openTestModal(id, name) {
            document.getElementById('testTemplateName').textContent = name;

            // Use Laravel route helper as a data attribute
            let route = `{{ route('email-templates.test', ':id') }}`;
            route = route.replace(':id', id);

            document.getElementById('testForm').action = route;
            new bootstrap.Modal(document.getElementById('testModal')).show();
        }

        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Done!',
                text: '{{ session('success') }}',
                timer: 2500,
                showConfirmButton: false,
                toast: true,
                position: 'top-end',
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Failed!',
                text: '{{ session('error') }}',
                timer: 3000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end',
            });
        @endif
    </script>
@endsection
