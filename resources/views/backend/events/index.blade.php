@extends('backend.layout.app')
@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Events</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Events</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">All Events</div>
                            <div class="card-tools">
                                <a href="{{ route('events-create') }}" class="btn btn-success btn-sm">
                                    <i class="fa fa-plus me-1"></i> Add Event
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
                                        <th>Banner</th>
                                        <th>Event Title</th>
                                        <th class="text-center">Date</th>
                                        <th class="text-center">Sub Events</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($events as $event)
                                    <tr id="record-row-{{ $event->id }}">

                                        <td>{{ $loop->iteration }}</td>

                                        <td>
                                            <div class="avatar">
                                                <img src="{{ $event->banner_url }}"
                                                    alt="{{ $event->title }}"
                                                    class="avatar-img rounded"
                                                    style="width:50px;height:50px;object-fit:cover;">
                                            </div>
                                        </td>

                                        <td>
                                            <strong>{{ $event->title }}</strong>
                                            @if($event->instagram_link || $event->highlights_link)
                                                <br>
                                                @if($event->instagram_link)
                                                    <a href="{{ $event->instagram_link }}" target="_blank"
                                                        class="text-danger me-2" style="font-size:12px;">
                                                        <i class="fa fa-instagram"></i> Instagram
                                                    </a>
                                                @endif
                                                @if($event->highlights_link)
                                                    <a href="{{ $event->highlights_link }}" target="_blank"
                                                        class="text-primary" style="font-size:12px;">
                                                        <i class="fa fa-play-circle"></i> Highlights
                                                    </a>
                                                @endif
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            <small>
                                                <strong>{{ $event->event_date?->format('d M Y') ?? '--' }}</strong>
                                                @if($event->event_end_date)
                                                    <br>to {{ $event->event_end_date->format('d M Y') }}
                                                @endif
                                            </small>
                                        </td>

                                        <td class="text-center">
                                            <span class="badge badge-primary">
                                                {{ $event->sub_events_count }} Sub Events
                                            </span>
                                        </td>

                                        <td class="text-center">
                                            <label class="switch">
                                                <input type="checkbox" class="toggle-status"
                                                    data-id="{{ $event->id }}"
                                                    data-url="{{ route('events-status') }}"
                                                    {{ $event->status == 1 ? 'checked' : '' }}>
                                                <span class="record-toggle"></span>
                                            </label>
                                        </td>

                                        <td class="text-center">
                                            <div class="d-flex justify-content-center align-items-center gap-1 flex-wrap">

                                                {{-- Sub Events --}}
                                                <a href="{{ route('sub-events-index', $event->id) }}"
                                                    class="btn btn-info btn-sm">
                                                    <i class="fa fa-list me-1"></i> Sub Events
                                                </a>

                                                {{-- Add Sub Event --}}
                                                <a href="{{ route('sub-events-create', $event->id) }}"
                                                    class="btn btn-success btn-sm">
                                                    <i class="fa fa-plus me-1"></i> Add Sub Event
                                                </a>

                                                {{-- Edit --}}
                                                <a href="{{ route('events-edit', $event->id) }}"
                                                    class="btn btn-primary btn-sm">
                                                    <i class="fa fa-edit me-1"></i> Edit
                                                </a>

                                                {{-- Delete --}}
                                                <form id="delete-form-{{ $event->id }}"
                                                    action="{{ route('events-destroy', $event->id) }}"
                                                    method="POST" class="d-none">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <button type="button"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="confirmDelete({{ $event->id }}, '{{ addslashes($event->title) }}')">
                                                    <i class="fa fa-trash me-1"></i> Delete
                                                </button>

                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">
                                            No events found.
                                            <a href="{{ route('events-create') }}">Create your first event</a>
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
    function confirmDelete(id, name) {
        Swal.fire({
            title: 'Are you sure?',
            text: `Deleting "${name}" will also delete all its sub events!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`delete-form-${id}`).submit();
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