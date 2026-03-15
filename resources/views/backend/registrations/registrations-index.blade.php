{{-- resources/views/backend/registrations/index.blade.php --}}

@extends('backend.layouts.app')

@section('content')
<div class="container-fluid">

    <div class="d-flex align-items-center justify-content-between mb-4">
        <div>
            <h4 class="fw-bold mb-0">Event Registrations</h4>
            <p class="text-muted small mb-0">All registrations across events</p>
        </div>
        <span class="badge bg-primary fs-6">{{ $registrations->total() }} Total</span>
    </div>

    {{-- Filters --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body py-3">
            <form method="GET" class="row g-2 align-items-end">
                <div class="col-md-4">
                    <label class="form-label small fw-semibold">Filter by Event</label>
                    <select name="event_id" class="form-select form-select-sm">
                        <option value="">All Events</option>
                        @foreach($events as $ev)
                            <option value="{{ $ev->id }}" {{ request('event_id') == $ev->id ? 'selected' : '' }}>
                                {{ $ev->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-5">
                    <label class="form-label small fw-semibold">Search</label>
                    <input type="text" name="search" class="form-control form-control-sm"
                           placeholder="Name, phone, or registration #"
                           value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary btn-sm w-100">
                        <i class="bi bi-search me-1"></i> Search
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Table --}}
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-3">Reg #</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>City / State</th>
                            <th>Event · Session</th>
                            <th>Tickets</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th class="pe-3">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($registrations as $reg)
                        <tr>
                            <td class="ps-3">
                                <a href="{{ route('admin.registrations.show', $reg->id) }}"
                                   class="text-decoration-none fw-semibold text-primary small">
                                    {{ $reg->registration_number }}
                                </a>
                            </td>
                            <td class="fw-semibold">{{ $reg->name }}</td>
                            <td>{{ $reg->phone }}</td>
                            <td class="text-muted small">{{ $reg->city }}, {{ $reg->state }}</td>
                            <td>
                                <div class="small fw-semibold">{{ $reg->event->title ?? '—' }}</div>
                                <div class="text-muted" style="font-size:11px;">{{ $reg->subEvent->title ?? '—' }}</div>
                            </td>
                            <td class="text-center">{{ $reg->tickets }}</td>
                            <td class="fw-bold">
                                {{ $reg->total_amount == 0 ? 'Free' : '₹'.number_format($reg->total_amount, 0) }}
                            </td>
                            <td>
                                <select class="form-select form-select-sm status-select"
                                        data-id="{{ $reg->id }}"
                                        style="width:auto;min-width:110px;">
                                    <option value="pending"   {{ $reg->status == 'pending'   ? 'selected' : '' }}>Pending</option>
                                    <option value="confirmed" {{ $reg->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                    <option value="cancelled" {{ $reg->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                            </td>
                            <td class="pe-3 text-muted small">{{ $reg->created_at->format('M j, Y') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted py-5">
                                <i class="bi bi-inbox" style="font-size:32px;display:block;margin-bottom:8px;"></i>
                                No registrations found
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($registrations->hasPages())
        <div class="card-footer bg-white">
            {{ $registrations->withQueryString()->links() }}
        </div>
        @endif
    </div>

</div>

<script>
document.querySelectorAll('.status-select').forEach(sel => {
    sel.addEventListener('change', function () {
        const id = this.dataset.id;
        const status = this.value;
        fetch(`/admin/registrations/${id}/status`, {
            method: 'PATCH',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
            },
            body: JSON.stringify({ status })
        }).then(r => r.json()).then(d => {
            if (d.success) {
                // Quick toast or flash
                const old = sel.style.color;
                sel.style.outline = '2px solid #059669';
                setTimeout(() => sel.style.outline = '', 1500);
            }
        });
    });
});
</script>
@endsection
