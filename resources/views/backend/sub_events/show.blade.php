@extends('backend.layout.app')
@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Sub Events</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="{{ route('events-index') }}">Events</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">{{ $event->title }}</a></li>
            </ul>
        </div>

        {{-- Parent Event Info Bar --}}
        <div class="card card-round mb-4">
            <div class="card-body py-3">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <img src="{{ $event->banner_url }}" alt="{{ $event->title }}"
                            class="rounded" style="width:65px;height:65px;object-fit:cover;">
                    </div>
                    <div class="col">
                        <h5 class="fw-bold mb-1">{{ $event->title }}</h5>
                        <small class="text-muted">
                            <i class="fa fa-calendar me-1"></i>
                            {{ $event->event_date?->format('d M Y') ?? '--' }}
                            @if($event->event_end_date)
                                &nbsp;→&nbsp;{{ $event->event_end_date->format('d M Y') }}
                            @endif
                        </small>
                        @if($event->instagram_link)
                            <a href="{{ $event->instagram_link }}" target="_blank"
                                class="ms-3 text-danger" style="font-size:12px;">
                                <i class="fa fa-instagram"></i> Instagram
                            </a>
                        @endif
                        @if($event->highlights_link)
                            <a href="{{ $event->highlights_link }}" target="_blank"
                                class="ms-2 text-primary" style="font-size:12px;">
                                <i class="fa fa-play-circle"></i> Highlights
                            </a>
                        @endif
                    </div>
                    <div class="col-auto d-flex gap-2">
                        <a href="{{ route('sub-events-create', $event->id) }}"
                            class="btn btn-success btn-sm">
                            <i class="fa fa-plus me-1"></i> Add Sub Event
                        </a>
                        <a href="{{ route('events-edit', $event->id) }}"
                            class="btn btn-primary btn-sm">
                            <i class="fa fa-edit me-1"></i> Edit Event
                        </a>
                        <a href="{{ route('events-index') }}"
                            class="btn btn-secondary btn-sm">
                            <i class="fa fa-arrow-left me-1"></i> Back
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sub Events Table --}}
        <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">
                                All Sub Events
                                <span class="badge badge-primary ms-2">
                                    {{ $event->subEvents->count() }}
                                </span>
                            </div>
                            <div class="card-tools">
                                <a href="{{ route('sub-events-create', $event->id) }}"
                                    class="btn btn-success btn-sm">
                                    <i class="fa fa-plus me-1"></i> Add Sub Event
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
                                        <th>Title</th>
                                        <th class="text-center">Date</th>
                                        <th class="text-center">Time</th>
                                        <th class="text-center">Fees</th>
                                        <th class="text-center">Age Group</th>
                                        <th class="text-center">Mode</th>
                                        <th class="text-center">Seats</th>
                                        <th class="text-center">Centers</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($event->subEvents as $subEvent)
                                    <tr id="record-row-{{ $subEvent->id }}">

                                        <td>{{ $loop->iteration }}</td>

                                        <td>
                                            <strong>{{ $subEvent->title }}</strong>
                                            @if($subEvent->description)
                                                <br>
                                                <small class="text-muted">
                                                    {{ Str::limit(strip_tags($subEvent->description), 60) }}
                                                </small>
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            <small>{{ $subEvent->event_date?->format('d M Y') ?? '--' }}</small>
                                        </td>

                                        <td class="text-center">
                                            <small class="text-muted">{{ $subEvent->time_range }}</small>
                                        </td>

                                        <td class="text-center">
                                            @if($subEvent->is_free)
                                                <span class="badge badge-success">Free</span>
                                            @else
                                                <strong>₹{{ number_format($subEvent->fees, 2) }}</strong>
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            <small>{{ $subEvent->age_group ?? '--' }}</small>
                                        </td>

                                        <td class="text-center">
                                            @if($subEvent->mode == 'online')
                                                <span class="badge badge-info">Online</span>
                                            @elseif($subEvent->mode == 'offline')
                                                <span class="badge badge-warning">Offline</span>
                                            @else
                                                <span class="badge badge-secondary">Both</span>
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            <small>{{ $subEvent->max_seats ?? 'Unlimited' }}</small>
                                        </td>

                                        <td class="text-center">
                                            <span class="badge badge-primary">
                                                {{ $subEvent->centers->count() }} Centers
                                            </span>
                                        </td>

                                        <td class="text-center">
                                            <label class="switch">
                                                <input type="checkbox" class="toggle-status"
                                                    data-id="{{ $subEvent->id }}"
                                                    data-url="{{ route('sub-events-status') }}"
                                                    {{ $subEvent->status == 1 ? 'checked' : '' }}>
                                                <span class="record-toggle"></span>
                                            </label>
                                        </td>

                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-1">

                                                <a href="{{ route('sub-events-edit', $subEvent->id) }}"
                                                    class="btn btn-primary btn-sm">
                                                    <i class="fa fa-edit me-1"></i> Edit
                                                </a>

                                                <form id="delete-sub-{{ $subEvent->id }}"
                                                    action="{{ route('sub-events-destroy', $subEvent->id) }}"
                                                    method="POST" class="d-none">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="confirmDeleteSub({{ $subEvent->id }}, '{{ addslashes($subEvent->title) }}')">
                                                    <i class="fa fa-trash me-1"></i> Delete
                                                </button>

                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="11" class="text-center text-muted py-5">
                                            <i class="fa fa-calendar-o fa-2x mb-2 d-block"></i>
                                            No sub events yet.
                                            <a href="{{ route('sub-events-create', $event->id) }}">
                                                Add your first sub event
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDeleteSub(id, name) {
        Swal.fire({
            title: 'Delete Sub Event?',
            text: `"${name}" will be permanently deleted.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`delete-sub-${id}`).submit();
            }
        });
    }

    @if(session('success'))
        Swal.fire({ icon: 'success', title: 'Success!', text: '{{ session('success') }}', timer: 2500, showConfirmButton: false });
    @endif
    @if(session('error'))
        Swal.fire({ icon: 'error', title: 'Error!', text: '{{ session('error') }}' });
    @endif
</script>

@endsection