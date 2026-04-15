@extends('backend.layout.app')

@section('content')
<div class="container">
    <div class="page-inner">

        {{-- PAGE HEADER --}}
        <div class="page-header">
            <h3 class="fw-bold mb-3">Event Registrations</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Registrations</a></li>
            </ul>
        </div>

        {{-- STATS --}}
        <div class="row mb-4">
            <div class="col-sm-6 col-md-3">
                <div class="card card-stats card-round">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-icon">
                                <div class="icon-big text-center icon-primary bubble-shadow-small">
                                    <i class="fas fa-list"></i>
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
                                    <i class="fas fa-clock"></i>
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
                                <div class="icon-big text-center icon-danger bubble-shadow-small">
                                    <i class="fas fa-times-circle"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Cancelled</p>
                                    <h4 class="card-title">{{ $stats['cancelled'] }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- FILTERS --}}
        <div class="card card-round mb-4">
            <div class="card-header">
                <div class="card-head-row">
                    <div class="card-title">Filters</div>
                    @if(request()->hasAny(['event_id','status','search']))
                        <div class="card-tools">
                            <a href="{{ route('event-registrations.index') }}" class="btn btn-outline-secondary btn-sm">
                                <i class="fa fa-times me-1"></i> Clear
                            </a>
                        </div>
                    @endif
                </div>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('event-registrations.index') }}">
                    <div class="row g-3 align-items-end">

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Event</label>
                            <select name="event_id" class="form-select">
                                <option value="">All Events</option>
                                @foreach ($events as $ev)
                                    <option value="{{ $ev->id }}" {{ request('event_id') == $ev->id ? 'selected' : '' }}>
                                        {{ $ev->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label class="form-label fw-semibold">Status</label>
                            <select name="status" class="form-select">
                                <option value="">All</option>
                                <option value="pending"   {{ request('status') == 'pending'   ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Search</label>
                            <input type="text" name="search" class="form-control"
                                placeholder="Name, phone, email, reg #"
                                value="{{ request('search') }}">
                        </div>

                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-search me-1"></i> Search
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>

        {{-- TABLE --}}
        <div class="card card-round">
            <div class="card-header">
                <div class="card-head-row card-tools-still-right">
                    <div class="card-title">
                        Registrations
                        <span class="badge bg-primary ms-1">{{ $registrations->total() }}</span>
                    </div>
                    <div class="card-tools">
                        <a href="{{ route('event-registrations.export') }}?{{ http_build_query(request()->only(['event_id','status','search'])) }}"
                           class="btn btn-success btn-sm">
                            <i class="fa fa-download me-1"></i> Export CSV
                        </a>
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th style="width:130px">#</th>
                                <th>Primary Contact</th>
                                <th>Event / Session</th>
                                <th class="text-center">Tickets</th>
                                <th class="text-center">Amount</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($registrations as $reg)
                                @php $primary = $reg->primary; @endphp
                                <tr>
                                    <td>
                                        <span class="badge badge-secondary" style="font-size:11px;letter-spacing:.3px;">
                                            {{ $reg->registration_number }}
                                        </span>
                                    </td>

                                    <td>
                                        <div class="fw-bold">{{ $primary?->name ?? '—' }}</div>
                                        @if($primary?->phone)
                                            <small class="text-muted"><i class="fa fa-phone me-1"></i>{{ $primary->phone }}</small>
                                        @endif
                                        @if($primary?->email)
                                            <br><small class="text-muted"><i class="fa fa-envelope me-1"></i>{{ $primary->email }}</small>
                                        @endif
                                        @if($reg->city || $reg->state)
                                            <br><small class="text-muted"><i class="fa fa-map-marker me-1"></i>{{ implode(', ', array_filter([$reg->city, $reg->state])) }}</small>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="fw-semibold small">{{ optional($reg->event)->title ?? '—' }}</div>
                                        <small class="text-muted">{{ optional($reg->subEvent)->title ?? '—' }}</small>
                                    </td>

                                    <td class="text-center">
                                        <span class="badge badge-info">{{ $reg->tickets }}</span>
                                    </td>

                                    <td class="text-center fw-bold {{ $reg->total_amount == 0 ? 'text-muted' : 'text-success' }}">
                                        {{ $reg->total_amount == 0 ? 'Free' : '₹' . number_format($reg->total_amount) }}
                                    </td>

                                    <td class="text-center">
                                        <select class="form-select form-select-sm status-select"
                                            data-id="{{ $reg->id }}"
                                            style="min-width:110px;">
                                            <option value="pending"   {{ $reg->status == 'pending'   ? 'selected' : '' }}>Pending</option>
                                            <option value="confirmed" {{ $reg->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                            <option value="cancelled" {{ $reg->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        </select>
                                    </td>

                                    <td class="text-center text-muted small">
                                        {{ $reg->created_at->format('d M Y') }}<br>
                                        <small>{{ $reg->created_at->format('h:i A') }}</small>
                                    </td>

                                    <td class="text-center">
                                        <a href="{{ route('event-registrations.show', $reg->id) }}"
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="fa fa-eye me-1"></i> View
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5 text-muted">
                                        <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                        No registrations found
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if ($registrations->hasPages())
                <div class="card-footer">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <div class="text-muted" style="font-size:13px;">
                            Showing
                            <strong>{{ $registrations->firstItem() }}</strong>–<strong>{{ $registrations->lastItem() }}</strong>
                            of <strong>{{ $registrations->total() }}</strong>
                        </div>
                        {{ $registrations->withQueryString()->links() }}
                    </div>
                </div>
            @endif
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.querySelectorAll('.status-select').forEach(el => {
    el.addEventListener('change', function () {
        const select = this;
        fetch(`/admin/event-registrations/${this.dataset.id}/status`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ status: this.value })
        })
        .then(res => res.json())
        .then(res => {
            if (res.success) {
                Swal.fire({
                    icon: 'success', title: 'Status updated',
                    toast: true, position: 'top-end',
                    timer: 1500, showConfirmButton: false
                });
            }
        })
        .catch(() => {
            Swal.fire({ icon: 'error', title: 'Failed to update status', toast: true, position: 'top-end', timer: 2000, showConfirmButton: false });
        });
    });
});


</script>
@endsection
