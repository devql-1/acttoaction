{{-- resources/views/backend/themes/create.blade.php --}}
@extends('backend.layout.app')

@section('content')
    <div class="container">
        <h3>Add Theme</h3>

        <form action="{{ route('themes.store') }}" method="POST">
            @csrf

            <input type="text" name="title" class="form-control mb-2" placeholder="Title">

            <input type="text" name="icon" class="form-control mb-2"
                placeholder="Icon (🎭 or <i class='fa fa-star'></i>)">

            <input type="text" name="tag" class="form-control mb-2" placeholder="Tag">

            <textarea name="description" class="form-control mb-2" placeholder="Description"></textarea>

            <input type="text" name="bg_color" class="form-control mb-2" placeholder="Background Color">

            <input type="text" name="tag_color" class="form-control mb-2" placeholder="Tag Color">

            <input type="number" name="sort_order" class="form-control mb-2" placeholder="Sort Order">

            <select name="status" class="form-control mb-3">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>

            <button class="btn btn-success">Save</button>
        </form>
    </div>
@endsection
