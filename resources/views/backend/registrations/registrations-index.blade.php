@extends('backend.layout.app')

@section('content')
    <div class="container">
        <div class="page-inner">

            {{-- PAGE HEADER --}}
            <div class="page-header">
                <div class="d-flex align-items-center justify-content-between">
                    <h3 class="fw-bold mb-3">Event Registrations</h3>
                </div>

                <ul class="breadcrumbs mb-3">
                    <li class="nav-home">
                        <a href="#"><i class="icon-home"></i></a>
                    </li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item">
                        <a href="#">Registrations</a>
                    </li>
                </ul>
            </div>

            {{-- STATS --}}
            <div class="row mb-3">

                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="numbers">
                                <p class="card-category">Total Registrations</p>
                                <h4 class="card-title">{{ $registrations->total() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="numbers">
                                <p class="card-category">Confirmed</p>
                                <h4 class="card-title">{{ $stats['confirmed'] ?? 0 }}</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="numbers">
                                <p class="card-category">Pending</p>
                                <h4 class="card-title">{{ $stats['pending'] ?? 0 }}</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="numbers">
                                <p class="card-category">Cancelled</p>
                                <h4 class="card-title">{{ $stats['cancelled'] ?? 0 }}</h4>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- FILTERS --}}
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Filters</h5>
                </div>

                <div class="card-body">
                    <form method="GET">
                        <div class="row g-3">

                            <div class="col-md-4">
                                <label class="form-label">Event</label>
                                <select name="event_id" class="form-control">
                                    <option value="">All Events</option>
                                    @foreach ($events as $ev)
                                        <option value="{{ $ev->id }}"
                                            {{ request('event_id') == $ev->id ? 'selected' : '' }}>
                                            {{ $ev->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-5">
                                <label class="form-label">Search</label>
                                <input type="text" name="search" class="form-control"
                                    placeholder="Name, phone, registration #" value="{{ request('search') }}">
                            </div>

                            <div class="col-md-3 d-flex align-items-end">
                                <button class="btn btn-primary w-100">
                                    <i class="fas fa-search me-1"></i> Apply
                                </button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>

            {{-- TABLE --}}
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 class="card-title mb-0">
                            Registrations
                            <span class="badge bg-primary">{{ $registrations->total() }}</span>
                        </h5>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">

                            <thead class="thead-light">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Location</th>
                                    <th>Event</th>
                                    <th>Tickets</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($registrations as $reg)
                                    <tr>

                                        <td>{{ $reg->registration_number }}</td>

                                        <td class="fw-bold">
                                            {{ $reg->name }}
                                        </td>

                                        <td>{{ $reg->phone }}</td>

                                        <td class="text-muted small">
                                            {{ $reg->city }}, {{ $reg->state }}
                                        </td>

                                        <td>
                                            <div class="fw-bold small">
                                                {{ optional($reg->event)->title ?? '—' }}
                                            </div>
                                            <div class="text-muted small">
                                                {{ optional($reg->subEvent)->title ?? '—' }}
                                            </div>
                                        </td>

                                        <td>{{ $reg->tickets }}</td>

                                        <td class="fw-bold text-success">
                                            {{ $reg->total_amount == 0 ? 'Free' : '₹' . number_format($reg->total_amount) }}
                                        </td>

                                        <td>
                                            <select class="form-control form-control-sm status-select"
                                                data-id="{{ $reg->id }}">
                                                <option value="pending" {{ $reg->status == 'pending' ? 'selected' : '' }}>
                                                    Pending</option>
                                                <option value="confirmed"
                                                    {{ $reg->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                                <option value="cancelled"
                                                    {{ $reg->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                            </select>
                                        </td>

                                        <td class="text-muted small">
                                            {{ $reg->created_at->format('d M Y') }}
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center py-5 text-muted">
                                            <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                            No registrations found
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>
                    </div>
                </div>

                {{-- PAGINATION SAME STYLE --}}
                @if ($registrations->hasPages())
                    <div class="card-footer">
                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">

                            <div class="text-muted" style="font-size:13px;">
                                Showing
                                <strong>{{ $registrations->firstItem() }}</strong>–
                                <strong>{{ $registrations->lastItem() }}</strong>
                                of <strong>{{ $registrations->total() }}</strong>
                            </div>

                            {{ $registrations->withQueryString()->links() }}

                        </div>
                    </div>
                @endif

            </div>

        </div>
    </div>

    {{-- STATUS UPDATE --}}
    <script>
        document.querySelectorAll('.status-select').forEach(el => {
            el.addEventListener('change', function() {

                fetch(`/admin/registrations/${this.dataset.id}/status`, {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            status: this.value
                        })
                    })
                    .then(res => res.json())
                    .then(res => {
                        if (res.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Updated',
                                toast: true,
                                position: 'top-end',
                                timer: 1500,
                                showConfirmButton: false
                            });
                        }
                    });
            });
        });
    </script>

    {{-- SweetAlert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
