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
                                                <td class="text-center" style="white-space:nowrap;">
                                                    <button type="button"
                                                            class="btn btn-sm btn-icon btn-info btn-round me-1"
                                                            title="View email content"
                                                            onclick="viewLog({{ $log->id }})">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
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

    {{-- ──────────────────────────────────────────────────────────────── --}}
    {{-- View-email modal — shows rendered subject + body + metadata     --}}
    {{-- ──────────────────────────────────────────────────────────────── --}}
    <div class="modal fade" id="emailViewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fa fa-envelope-open-text me-2"></i>
                        Email Preview
                        <span id="elvLogId" class="text-muted ms-2" style="font-size:13px;"></span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="elvLoading" class="text-center py-5 text-muted">
                        <div class="spinner-border text-primary" role="status"></div>
                        <div class="mt-2">Loading…</div>
                    </div>

                    <div id="elvError" class="alert alert-danger d-none"></div>

                    <div id="elvContent" class="d-none">
                        {{-- Metadata row --}}
                        <div class="row g-3 mb-3">
                            <div class="col-md-6">
                                <div class="small text-muted">Template</div>
                                <code id="elvSlug" style="font-size:12px;"></code>
                            </div>
                            <div class="col-md-6">
                                <div class="small text-muted">Recipient</div>
                                <div id="elvTo" style="font-size:14px;font-weight:500;"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="small text-muted">Status</div>
                                <span id="elvStatus" class="badge"></span>
                                <span id="elvMailer" class="text-muted ms-2" style="font-size:12px;"></span>
                            </div>
                            <div class="col-md-6">
                                <div class="small text-muted">Sent / Attempted At</div>
                                <div id="elvCreated" style="font-size:13px;"></div>
                            </div>
                            <div class="col-12">
                                <div class="small text-muted">Subject</div>
                                <div id="elvSubject" style="font-size:15px;font-weight:600;"></div>
                            </div>
                        </div>

                        {{-- Error box, shown only if the log is failed --}}
                        <div id="elvErrorBox" class="alert alert-danger d-none" style="font-size:12px;">
                            <strong class="d-block mb-1"><i class="fa fa-exclamation-triangle me-1"></i>Delivery error</strong>
                            <code id="elvErrorText" style="white-space:pre-wrap;display:block;"></code>
                        </div>

                        {{-- Rendered body (iframe-isolated so email CSS cannot leak into admin) --}}
                        <div class="mb-2 fw-bold text-muted" style="font-size:13px;">
                            <i class="fa fa-file-code me-1"></i>Rendered body
                        </div>
                        <div id="elvBodyWrap" style="border:1px solid #e5e7eb;border-radius:6px;overflow:hidden;background:#f8f9fa;">
                            <iframe id="elvBodyFrame" style="width:100%;min-height:520px;border:0;background:#fff;"></iframe>
                        </div>
                        <div id="elvTemplateMissing" class="alert alert-warning mt-2 d-none" style="font-size:13px;">
                            <i class="fa fa-exclamation-circle me-1"></i>
                            The source template for this log (slug above) no longer exists or is inactive — rendered body is not available.
                        </div>

                        {{-- Variables payload --}}
                        <div class="mt-4 mb-2 fw-bold text-muted" style="font-size:13px;">
                            <i class="fa fa-code me-1"></i>Placeholders used
                        </div>
                        <pre id="elvVars" style="background:#f8f9fa;border:1px solid #e5e7eb;border-radius:6px;padding:12px;font-size:12px;max-height:240px;overflow:auto;"></pre>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

@endsection

{{-- ────────────────────────────────────────────────────────────────── --}}
{{-- Pushed into @stack('after_scripts') in backend.layout.app, which   --}}
{{-- sits AFTER bootstrap.min.js — so `bootstrap` is guaranteed loaded. --}}
{{-- ────────────────────────────────────────────────────────────────── --}}
@push('after_scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        (function () {
            // Tooltips
            document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(el => {
                new bootstrap.Tooltip(el, { placement: 'top' });
            });

            // ─── View email modal — lazy-init to survive load order ──
            let _emailViewModal = null;
            function getEmailViewModal() {
                if (!_emailViewModal) {
                    const el = document.getElementById('emailViewModal');
                    if (!el) { console.error('emailViewModal element missing'); return null; }
                    _emailViewModal = new bootstrap.Modal(el);
                }
                return _emailViewModal;
            }

            window.viewLog = async function (id) {
                const modal = getEmailViewModal();
                if (!modal) { alert('Modal failed to initialise — Bootstrap not loaded?'); return; }

                document.getElementById('elvLoading').classList.remove('d-none');
                document.getElementById('elvContent').classList.add('d-none');
                document.getElementById('elvError').classList.add('d-none');
                document.getElementById('elvLogId').textContent = '#' + id;
                modal.show();

                try {
                    const res = await fetch('{{ url('admin/email-logs') }}/' + id, {
                        headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
                    });
                    if (!res.ok) throw new Error('HTTP ' + res.status);
                    const data = await res.json();

                    document.getElementById('elvSlug').textContent    = data.slug || '—';
                    document.getElementById('elvTo').textContent      = data.to_email || '—';
                    document.getElementById('elvSubject').textContent = data.subject || '(no subject)';
                    document.getElementById('elvCreated').textContent = data.created_at || '—';
                    document.getElementById('elvMailer').textContent  = data.mailer ? '(' + data.mailer + ')' : '';

                    const badge = document.getElementById('elvStatus');
                    badge.textContent = (data.status || '').toUpperCase();
                    badge.className   = 'badge badge-' + (data.status === 'sent' ? 'success' : 'danger');

                    const errBox = document.getElementById('elvErrorBox');
                    if (data.error_message) {
                        document.getElementById('elvErrorText').textContent = data.error_message;
                        errBox.classList.remove('d-none');
                    } else {
                        errBox.classList.add('d-none');
                    }

                    const frame = document.getElementById('elvBodyFrame');
                    const missing = document.getElementById('elvTemplateMissing');
                    if (data.body_html) {
                        frame.srcdoc = data.body_html;
                        frame.parentElement.classList.remove('d-none');
                        missing.classList.add('d-none');
                    } else {
                        frame.srcdoc = '';
                        frame.parentElement.classList.add('d-none');
                        missing.classList.remove('d-none');
                    }

                    document.getElementById('elvVars').textContent =
                        JSON.stringify(data.variables || {}, null, 2);

                    document.getElementById('elvLoading').classList.add('d-none');
                    document.getElementById('elvContent').classList.remove('d-none');
                } catch (e) {
                    document.getElementById('elvLoading').classList.add('d-none');
                    const err = document.getElementById('elvError');
                    err.textContent = 'Failed to load log: ' + e.message;
                    err.classList.remove('d-none');
                }
            };

            window.confirmDeleteLog = function (id) {
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
            };

            window.confirmClear = function () {
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
            };
        })();
    </script>
@endpush
