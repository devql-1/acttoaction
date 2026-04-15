@extends('backend.layout.app')
@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Support Ticket #{{ $ticket->id }}</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="{{ route('admin') }}"><i class="icon-home"></i></a>
                </li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="{{ route('admin.chatbot-tickets') }}">Support Tickets</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">#{{ $ticket->id }}</a></li>
            </ul>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card card-round">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="card-title mb-0">Ticket Details</div>
                        <div>
                            @if($ticket->status === 'new')
                                <span class="badge bg-danger fs-6">New</span>
                            @elseif($ticket->status === 'read')
                                <span class="badge bg-warning fs-6">Read</span>
                            @else
                                <span class="badge bg-success fs-6">Resolved</span>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">

                        <table class="table table-borderless">
                            <tr>
                                <th style="width:160px;" class="text-muted">Name</th>
                                <td>{{ $ticket->name }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">Email</th>
                                <td><a href="mailto:{{ $ticket->email }}">{{ $ticket->email }}</a></td>
                            </tr>
                            <tr>
                                <th class="text-muted">Mobile</th>
                                <td><a href="tel:{{ $ticket->mobile }}">{{ $ticket->mobile }}</a></td>
                            </tr>
                            <tr>
                                <th class="text-muted">Received</th>
                                <td>{{ $ticket->created_at->format('d M Y, h:i A') }}</td>
                            </tr>
                        </table>

                        <hr>

                        <div class="mt-3">
                            <h6 class="text-muted text-uppercase fw-bold" style="font-size:12px;letter-spacing:.5px;">
                                Problem Description
                            </h6>
                            <div class="p-3 rounded mt-2" style="background:#f8f9fb;border:1px solid #e0e4ea;line-height:1.7;">
                                {{ $ticket->message }}
                            </div>
                        </div>

                    </div>
                    <div class="card-footer d-flex gap-2 justify-content-between">
                        <a href="{{ route('admin.chatbot-tickets') }}" class="btn btn-secondary">
                            <i class="fa fa-arrow-left me-1"></i> Back to List
                        </a>
                        @if($ticket->status !== 'resolved')
                        <button id="resolveBtn" class="btn btn-success">
                            <i class="fa fa-check-circle me-1"></i> Mark as Resolved
                        </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    const resolveBtn = document.getElementById('resolveBtn');
    if (resolveBtn) {
        resolveBtn.addEventListener('click', function() {
            fetch(`/admin/chatbot/tickets/{{ $ticket->id }}/status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({ status: 'resolved' }),
            })
            .then(r => r.json())
            .then(data => {
                if (data.success) {
                    window.location.href = '{{ route("admin.chatbot-tickets") }}';
                }
            });
        });
    }
</script>
@endpush

@endsection
