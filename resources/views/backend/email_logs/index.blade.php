@extends('backend.layout.app')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Email Logs</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="{{ route('email-templates.index') }}">Email</a></li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="#">Logs</a></li>
                </ul>
            </div>

            {{-- Stats row --}}
            <div class="row mb-4">
                <div class="col-sm-4">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-success bubble-shadow-small">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Sent</p>
                                        <h4 class="card-title">{{ \App\Models\EmailLog::where('status','sent')->count() }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-danger bubble-shadow-small">
                                        <i class="fas fa-times-circle"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Failed</p>
                                        <h4 class="card-title">{{ \App\Models\EmailLog::where('status','failed')->count() }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-primary bubble-shadow-small">
                                        <i class="fas fa-envelope"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Total</p>
                                        <h4 class="card-title">{{ \App\Models\EmailLog::count() }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
                                <div class="card-title mb-0">All Logs</div>
                                <div class="d-flex gap-2 align-items-center flex-wrap">
                                    {{-- Filters --}}
                                    <form method="GET" action="{{ route('email-logs.index') }}" class="d-flex gap-2 flex-wrap">
                                        <select name="status" class="form-select form-select-sm" style="width:110px;" onchange="this.form.submit()">
                                            <option value="">All Status</option>
                                            <option value="sent"   {{ request('status') === 'sent'   ? 'selected' : '' }}>Sent</option>
                                            <option value="failed" {{ request('status') === 'failed' ? 'selected' : '' }}>Failed</option>
                                        </select>
                                        <select name="slug" class="form-select form-select-sm" style="width:200px;" onchange="this.form.submit()">
                                            <option value="">All Templates</option>
                                            @foreach($slugs as $s)
                                                <option value="{{ $s }}" {{ request('slug') === $s ? 'selected' : '' }}>{{ $s }}</option>
                                            @endforeach
                                        </select>
                                        <input type="text" name="email" class="form-control form-control-sm" style="width:180px;"
                                               placeholder="Filter by email…" value="{{ request('email') }}">
                                        <button type="submit" class="btn btn-sm btn-primary btn-round">
                                            <i class="fa fa-search"></i>
                                        </button>
                                        @if(request()->hasAny(['status','slug','email']))
                                            <a href="{{ route('email-logs.index') }}" class="btn btn-sm btn-secondary btn-round">
                                                <i class="fa fa-times"></i>
                                            </a>
                                        @endif
                                    </form>

                                    {{-- Clear button --}}
                                    <form id="clearForm" method="POST" action="{{ route('email-logs.clear') }}">
                                        @csrf
                                        @if(request('status'))
                                            <input type="hidden" name="status" value="{{ request('status') }}">
                                        @endif
                                        <button type="button" class="btn btn-sm btn-danger btn-round" onclick="confirmClear()">
                                            <i class="fa fa-trash me-1"></i> Clear
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Template</th>
                                            <th>Recipient</th>
                                            <th>Subject</th>
                                            <th class="text-center">Status</th>
                                            <th>Error</th>
                                            <th>Sent At</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($logs as $log)
                                            <tr>
                                                <td class="text-muted" style="font-size:12px;">{{ $log->id }}</td>
                                                <td>
                                                    <code style="font-size:11px;">{{ $log->slug }}</code>
                                                </td>
                                                <td style="font-size:13px;">{{ $log->to_email }}</td>
                                                <td style="font-size:13px;max-width:180px;" class="text-truncate">
                                                    {{ $log->subject ?? '—' }}
                                                </td>
                                                <td class="text-center">
                                                    <span class="badge badge-{{ $log->status === 'sent' ? 'success' : 'danger' }}">
                                                        {{ ucfirst($log->status) }}
                                                    </span>
                                                </td>
                                                <td style="font-size:12px;max-width:220px;">
                                                    @if($log->error_message)
                                                        <span class="text-danger text-truncate d-inline-block" style="max-width:210px;"
                                                              title="{{ $log->error_message }}" data-bs-toggle="tooltip">
                                                            {{ $log->error_message }}
                                                        </span>
                                                    @else
                                                        <span class="text-muted">—</span>
                                                    @endif
                                                </td>
                                                <td style="font-size:12px;white-space:nowrap;">
                                                    {{ $log->created_at->format('d M Y, h:i A') }}
                                                </td>
                                                <td class="text-center">
                                                    <form id="del-log-{{ $log->id }}" method="POST"
                                                          action="{{ route('email-logs.destroy', $log->id) }}"
                                                          style="display:none;">
                                                        @csrf @method('DELETE')
                                                    </form>
                                                    <button type="button"
                                                            class="btn btn-sm btn-icon btn-danger btn-round"
                                                            title="Delete"
                                                            onclick="confirmDeleteLog({{ $log->id }})">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="8" class="text-center py-5 text-muted">
                                                    <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                                    No email logs yet.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        @if($logs->hasPages())
                            <div class="card-footer d-flex justify-content-between align-items-center">
                                <small class="text-muted">
                                    Showing {{ $logs->firstItem() }}–{{ $logs->lastItem() }} of {{ $logs->total() }} entries
                                </small>
                                {{ $logs->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Tooltips
        document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => {
            new bootstrap.Tooltip(el, { placement: 'top' });
        });

        function confirmDeleteLog(id) {
            Swal.fire({
                title: 'Delete Log?',
                text: 'This log entry will be permanently removed.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e74a3b',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="fas fa-trash me-1"></i> Delete',
                cancelButtonText: 'Cancel',
            }).then(result => {
                if (result.isConfirmed) {
                    document.getElementById('del-log-' + id).submit();
                }
            });
        }

        function confirmClear() {
            const status = document.querySelector('[name="status"]')?.value || '';
            const label  = status ? `all <strong>${status}</strong>` : 'all';
            Swal.fire({
                title: 'Clear Logs?',
                html: `This will permanently delete ${label} log entries.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e74a3b',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="fas fa-trash me-1"></i> Yes, Clear',
                cancelButtonText: 'Cancel',
            }).then(result => {
                if (result.isConfirmed) {
                    document.getElementById('clearForm').submit();
                }
            });
        }
    </script>
@endsection
