@extends('backend.layout.app')

@section('content')
    <div class="container">
        <h2>Add Action Item</h2>

        <form method="POST" action="{{ route('action-items.store') }}">
            @csrf

            <div class="mb-3">
                <label>Title</label>
                <input type="text" name="title" class="form-control">
            </div>

            <div class="mb-3">
                <label>Icon (FontAwesome class)</label>
                <input type="text" name="icon" class="form-control" placeholder="fas fa-book-open">
            </div>

            <div class="mb-3">
                <label>Route Name</label>
                <input type="text" name="route" class="form-control">
            </div>

            <div class="mb-3">
                <label>Order</label>
                <input type="number" name="order" class="form-control">
            </div>

            <button class="btn btn-success">Save</button>
        </form>
    </div>
@endsection
