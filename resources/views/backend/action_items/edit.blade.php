@extends('backend.layout.app')

@section('content')
    <div class="container">
        <h2>Edit Action Item</h2>

        <form method="POST" action="{{ route('action-items.update', $action->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Title</label>
                <input type="text" name="title" value="{{ $action->title }}" class="form-control">
            </div>

            <div class="mb-3">
                <label>Icon</label>
                <input type="text" name="icon" value="{{ $action->icon }}" class="form-control">
            </div>

            <div class="mb-3">
                <label>Route</label>
                <input type="text" name="route" value="{{ $action->route }}" class="form-control">
            </div>

            <div class="mb-3">
                <label>Order</label>
                <input type="number" name="order" value="{{ $action->order }}" class="form-control">
            </div>

            <button class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
