@extends('backend.layout.app')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Enrollments</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="#">Enrollments</a></li>
                </ul>
            </div>

            {{-- Stats --}}
            <div class="row mb-3">
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-primary bubble-shadow-small">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Total</p>
                                        <h4 class="card-title">{{ $stats['total'] }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
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
                                        <p class="card-category">Confirmed</p>
                                        <h4 class="card-title">{{ $stats['confirmed'] }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-warning bubble-shadow-small">
                                        <i class="fas fa-hourglass-half"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Pending</p>
                                        <h4 class="card-title">{{ $stats['pending'] }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-info bubble-shadow-small">
                                        <i class="fas fa-user-clock"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Leads</p>
                                        <h4 class="card-title">{{ $stats['lead'] }}</h4>
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
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="card-title">All Enrollments</div>
                            </div>
                        </div>

                        {{-- Filters --}}
                        <div class="card-body border-bottom pb-3">
                            <form method="GET" action="{{ route('enrollments.index') }}" class="row g-2 align-items-end">
                                <div class="col-md-5">
                                    <input type="text" name="search" class="form-control form-control-sm"
                                        placeholder="Search name, phone, email, reference ID..."
                                        value="{{ request('search') }}">
                                </div>
                                <div class="col-md-3">
                                    <select name="status" class="form-control form-control-sm">
                                        <option value="">All Statuses</option>
                                        <option value="lead" {{ request('status') === 'lead' ? 'selected' : '' }}>
                                            Lead</option>
                                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>
                                            Pending</option>
                                        <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>
                                            Confirmed</option>
                                        <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>
                                            Cancelled</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary btn-sm w-100">
                                        <i class="fa fa-search me-1"></i> Search
                                    </button>
                                </div>
                                <div class="col-md-2">
                                    <a href="{{ route('enrollments.index') }}" class="btn btn-secondary btn-sm w-100">
                                        <i class="fa fa-times me-1"></i> Clear
                                    </a>
                                </div>
                            </form>
                        </div>

                        

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Student</th>
                                            <th>Course</th>
                                            <th>Centre / State</th>
                                            <th>Reference ID</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-end">Fee</th>
                                            <th class="text-center">Date</th>
                                            <th class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($enrollments as $e)
                                            <tr>
                                                <td class="text-muted" style="font-size:12px;">{{ $e->id }}</td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div class="avatar avatar-sm">
                                                            <span class="avatar-title rounded-circle bg-primary text-white"
                                                                style="font-size:12px;width:34px;height:34px;display:inline-flex;align-items:center;justify-content:center;">
                                                                {{ strtoupper(substr($e->first_name, 0, 1)) }}
                                                            </span>
                                                        </div>
                                                        <div>
                                                            <div class="fw-bold" style="font-size:13px;">
                                                                {{ $e->first_name }} {{ $e->last_name }}
                                                            </div>
                                                            <div class="text-muted" style="font-size:11px;">
                                                                {{ $e->phone }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td style="font-size:13px;max-width:160px;">
                                                    <div class="text-truncate">{{ $e->course }}</div>
                                                    <div class="text-muted" style="font-size:11px;">{{ $e->mode }}
                                                    </div>
                                                </td>
                                                <td style="font-size:12px;">
                                                    {{ $e->centre }}<br>
                                                    <span class="text-muted">{{ $e->state }}</span>
                                                </td>
                                                <td>
                                                    <code style="font-size:11px;">{{ $e->reference_id ?? '—' }}</code>
                                                </td>
                                                <td class="text-center">
                                                    @php
                                                        $badge =
                                                            [
                                                                'confirmed' => 'success',
                                                                'pending' => 'warning',
                                                                'lead' => 'info',
                                                                'cancelled' => 'danger',
                                                            ][$e->status] ?? 'secondary';
                                                    @endphp
                                                    <span class="badge badge-{{ $badge }}">
                                                        {{ ucfirst($e->status) }}
                                                    </span>
                                                </td>
                                                <td class="text-end fw-bold" style="color:#059669;">
                                                    ₹{{ number_format($e->fee ?? 0) }}
                                                </td>
                                                <td class="text-center" style="font-size:12px;white-space:nowrap;">
                                                    {{ $e->created_at->format('d M Y') }}<br>
                                                    <span class="text-muted">{{ $e->created_at->format('g:ia') }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <div class="d-flex gap-1 justify-content-center">
                                                        <a href="{{ route('enrollments.show', $e->id) }}"
                                                            class="btn btn-sm btn-icon btn-primary btn-round"
                                                            title="View">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                        {{-- Hidden delete form --}}
                                                        <form id="del-form-{{ $e->id }}" method="POST"
                                                            action="{{ route('enrollments.destroy', $e->id) }}"
                                                            style="display:none;">
                                                            @csrf @method('DELETE')
                                                        </form>
                                                        <button type="button"
                                                            class="btn btn-sm btn-icon btn-danger btn-round"
                                                            title="Delete"
                                                            onclick="confirmDelete({{ $e->id }}, '{{ $e->first_name }} {{ $e->last_name }}')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" class="text-center py-5 text-muted">
                                                    <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                                    No enrollments found.
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        {{-- Custom Pagination --}}
                        @if ($enrollments->hasPages())
                            <nav aria-label="Page navigation" class="card-footer">
                                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                                    <div class="text-muted" style="font-size:13px;">
                                        Showing
                                        <strong>{{ $enrollments->firstItem() }}</strong>–<strong>{{ $enrollments->lastItem() }}</strong>
                                        of <strong>{{ $enrollments->total() }}</strong> enrollments
                                    </div>
                                    <ul class="pagination pagination-sm mb-0">
                                        {{-- Previous Page Link --}}
                                        @if ($enrollments->onFirstPage())
                                            <li class="page-item disabled">
                                                <span class="page-link">
                                                    <i class="fas fa-chevron-left"></i> Previous
                                                </span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $enrollments->previousPageUrl() }}"
                                                    rel="prev">
                                                    <i class="fas fa-chevron-left"></i> Previous
                                                </a>
                                            </li>
                                        @endif

                                        {{-- Page Number Links --}}
                                        @if ($enrollments->lastPage() > 1)
                                            @php
                                                $currentPage = $enrollments->currentPage();
                                                $lastPage = $enrollments->lastPage();
                                                $start = max(1, $currentPage - 2);
                                                $end = min($lastPage, $currentPage + 2);
                                            @endphp

                                            {{-- First page link --}}
                                            @if ($start > 1)
                                                <li class="page-item">
                                                    <a class="page-link" href="{{ $enrollments->url(1) }}">1</a>
                                                </li>
                                                @if ($start > 2)
                                                    <li class="page-item disabled">
                                                        <span class="page-link">...</span>
                                                    </li>
                                                @endif
                                            @endif

                                            {{-- Page range --}}
                                            @foreach ($enrollments->getUrlRange($start, $end) as $page => $url)
                                                @if ($page == $currentPage)
                                                    <li class="page-item active">
                                                        <span class="page-link">
                                                            {{ $page }}
                                                            <span class="visually-hidden">(current)</span>
                                                        </span>
                                                    </li>
                                                @else
                                                    <li class="page-item">
                                                        <a class="page-link"
                                                            href="{{ $url }}">{{ $page }}</a>
                                                    </li>
                                                @endif
                                            @endforeach

                                            {{-- Last page link --}}
                                            @if ($end < $lastPage)
                                                @if ($end < $lastPage - 1)
                                                    <li class="page-item disabled">
                                                        <span class="page-link">...</span>
                                                    </li>
                                                @endif
                                                <li class="page-item">
                                                    <a class="page-link"
                                                        href="{{ $enrollments->url($lastPage) }}">{{ $lastPage }}</a>
                                                </li>
                                            @endif
                                        @endif

                                        {{-- Next Page Link --}}
                                        @if ($enrollments->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link" href="{{ $enrollments->nextPageUrl() }}"
                                                    rel="next">
                                                    Next <i class="fas fa-chevron-right"></i>
                                                </a>
                                            </li>
                                        @else
                                            <li class="page-item disabled">
                                                <span class="page-link">
                                                    Next <i class="fas fa-chevron-right"></i>
                                                </span>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </nav>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(id, name) {
            Swal.fire({
                title: 'Delete Enrollment?',
                html: `Are you sure you want to delete <strong>${name}</strong>?<br><small class="text-muted">This action cannot be undone.</small>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e74a3b',
                cancelButtonColor: '#6c757d',
                confirmButtonText: '<i class="fas fa-trash me-1"></i> Yes, Delete',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('del-form-' + id).submit();
                }
            });
        }

        
    </script>
@endsection
