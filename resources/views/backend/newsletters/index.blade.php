@extends('backend.layout.app')

@section('content')

<div class="container">
    <div class="page-inner">

        {{-- Page Header --}}
        <div class="page-header">
            <h3 class="fw-bold mb-3">Newsletter Subscribers</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="{{ route('admin') }}"><i class="icon-home"></i></a>
                </li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Newsletters</a></li>
            </ul>
        </div>

        {{-- Stats Cards --}}
        <div class="row mb-4">
            <div class="col-sm-6 col-md-3">
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
                                    <p class="card-category">Total Subscribers</p>
                                    <h4 class="card-title">{{ $total }}</h4>
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
                                    <p class="card-category">Active</p>
                                    <h4 class="card-title">{{ $active }}</h4>
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
                                    <i class="fas fa-ban"></i>
                                </div>
                            </div>
                            <div class="col col-stats ms-3 ms-sm-0">
                                <div class="numbers">
                                    <p class="card-category">Unsubscribed</p>
                                    <h4 class="card-title">{{ $total - $active }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Filters + Export --}}
        <div class="card card-round mb-3">
            <div class="card-body">
                <form method="GET" action="{{ route('admin.newsletters.index') }}" class="row g-2 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label mb-1">Search Email</label>
                        <input type="text" name="search" value="{{ request('search') }}"
                            class="form-control form-control-sm" placeholder="email@example.com">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label mb-1">Status</label>
                        <select name="status" class="form-select form-select-sm">
                            <option value="">All</option>
                            <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="unsubscribed" {{ request('status') === 'unsubscribed' ? 'selected' : '' }}>Unsubscribed</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label mb-1">Source</label>
                        <select name="source" class="form-select form-select-sm">
                            <option value="">All Sources</option>
                            @foreach($sources as $src)
                                <option value="{{ $src }}" {{ request('source') === $src ? 'selected' : '' }}>
                                    {{ ucfirst($src) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary btn-sm w-100">
                            <i class="fas fa-filter me-1"></i> Filter
                        </button>
                    </div>
                    <div class="col-md-3 text-end">
                        <a href="{{ route('admin.newsletters.export', request()->only('status','source','search')) }}"
                            class="btn btn-success btn-sm">
                            <i class="fas fa-file-csv me-1"></i> Export CSV
                        </a>
                    </div>
                </form>
            </div>
        </div>

        {{-- Table --}}
        <div class="card card-round">
            <div class="card-header">
                <div class="card-head-row">
                    <div class="card-title">Subscribers List</div>
                    <div class="card-tools ms-auto text-muted small">
                        Showing {{ $subscribers->firstItem() }}–{{ $subscribers->lastItem() }} of {{ $subscribers->total() }}
                    </div>
                </div>
            </div>
            <div class="card-body p-2">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0" id="nl-table">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Email</th>
                                <th>Source</th>
                                <th>Status</th>
                                <th>IP Address</th>
                                <th>Subscribed At</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($subscribers as $i => $sub)
                            <tr id="nl-row-{{ $sub->id }}">
                                <td>{{ $subscribers->firstItem() + $i }}</td>
                                <td>{{ $sub->email }}</td>
                                <td>
                                    <span class="badge bg-info text-white">{{ ucfirst($sub->source) }}</span>
                                </td>
                                <td>
                                    @if($sub->status === 'active')
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Unsubscribed</span>
                                    @endif
                                </td>
                                <td class="text-muted small">{{ $sub->ip_address ?? '—' }}</td>
                                <td class="small">{{ $sub->created_at->format('d M Y, h:i A') }}</td>
                                <td class="text-end">
                                    <button class="btn btn-sm btn-danger"
                                        onclick="deleteSubscriber({{ $sub->id }})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">No subscribers found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                @if($subscribers->hasPages())
                <div class="d-flex justify-content-center mt-3">
                    {{ $subscribers->links() }}
                </div>
                @endif
            </div>
        </div>

    </div>
</div>

@endsection

@push('after_scripts')
<script>
    function deleteSubscriber(id) {
        if (!confirm('Delete this subscriber?')) return;

        $.ajax({
            url: '/admin/newsletters/' + id,
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Accept': 'application/json',
            },
            success: function (data) {
                if (data.status === 200) {
                    $('#nl-row-' + id).fadeOut(300, function () { $(this).remove(); });
                    toastr.success(data.message);
                }
            },
            error: function () {
                toastr.error('Failed to delete subscriber.');
            }
        });
    }
</script>
@endpush
