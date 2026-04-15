@extends('backend.layout.app')
@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Chatbot Support Tickets</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="{{ route('admin') }}"><i class="icon-home"></i></a>
                </li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Chatbot</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Support Tickets</a></li>
            </ul>
        </div>

        @if($newCount > 0)
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            You have <strong>{{ $newCount }}</strong> new unread support ticket(s).
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">
                                All Support Tickets
                                @if($newCount > 0)
                                    <span class="badge bg-danger ms-2">{{ $newCount }} New</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-2">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0" id="basic-datatables">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Received</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($tickets as $ticket)
                                    <tr id="record-row-{{ $ticket->id }}" class="{{ $ticket->status === 'new' ? 'table-warning fw-bold' : '' }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            @if($ticket->status === 'new')
                                                <span class="badge bg-danger me-1">New</span>
                                            @endif
                                            {{ $ticket->name }}
                                        </td>
                                        <td>{{ $ticket->email }}</td>
                                        <td>{{ $ticket->mobile }}</td>
                                        <td class="text-center">
                                            @if($ticket->status === 'new')
                                                <span class="badge badge-danger">New</span>
                                            @elseif($ticket->status === 'read')
                                                <span class="badge badge-warning">Read</span>
                                            @else
                                                <span class="badge badge-success">Resolved</span>
                                            @endif
                                        </td>
                                        <td class="text-center">{{ $ticket->created_at->format('d M Y, h:i A') }}</td>
                                        <td class="text-center">
                                            <div class="form-button-action">
                                                <a href="{{ route('admin.chatbot-tickets-show', $ticket->id) }}"
                                                   class="btn btn-link btn-primary btn-lg me-2"
                                                   title="View">
                                                   <i class="fa fa-eye"></i>
                                                </a>
                                                @if($ticket->status !== 'resolved')
                                                <button type="button"
                                                    class="btn btn-link btn-success btn-lg me-2 resolve-ticket"
                                                    data-id="{{ $ticket->id }}"
                                                    title="Mark Resolved">
                                                    <i class="fa fa-check-circle"></i>
                                                </button>
                                                @endif
                                                <a href="javascript:void(0)"
                                                   class="btn btn-link btn-danger btn-lg delete-record"
                                                   data-id="{{ $ticket->id }}"
                                                   data-url="{{ route('admin.chatbot-tickets-destroy', $ticket->id) }}"
                                                   title="Delete">
                                                   <i class="fa fa-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">No support tickets yet.</td>
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

@push('scripts')
<script>
    document.querySelectorAll('.resolve-ticket').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            fetch(`/admin/chatbot/tickets/${id}/status`, {
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
                    location.reload();
                }
            });
        });
    });
</script>
@endpush

@endsection
