@extends('backend.layout.app')

@section('content')
    <div class="container-fluid">
        <h2>Action Items</h2>

        <a href="{{ route('action-items.create') }}" class="btn btn-primary mb-3">Add New</a>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Icon</th>
                    <th>Route</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($actions as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->title }}</td>
                        <td><i class="{{ $item->icon }}"></i></td>
                        <td>{{ $item->route }}</td>
                        <td>{{ $item->order }}</td>
                        <td>
                            <button class="btn btn-sm toggleStatus" data-id="{{ $item->id }}"
                                data-status="{{ $item->status }}">
                                {{ $item->status ? 'Active' : 'Inactive' }}
                            </button>
                        </td>
                        <td>
                            <a href="{{ route('action-items.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('action-items.destroy', $item->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Delete?')" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
<script>
    document.querySelectorAll('.toggleStatus').forEach(btn => {
        btn.addEventListener('click', function() {
            fetch("{{ route('action-items.status') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    id: this.dataset.id,
                    status: this.dataset.status == 1 ? 0 : 1
                })
            }).then(() => location.reload());
        });
    });
</script>
