{{-- resources/views/backend/themes/edit.blade.php --}}
@extends('backend.layout.app')

@section('content')
    <div class="container">
        <h3>Edit Theme</h3>

        <form action="{{ route('themes.update', $theme->id) }}" method="POST">
            @csrf

            <input type="text" name="title" value="{{ $theme->title }}" class="form-control mb-2">

            <input type="text" name="icon" value="{{ $theme->icon }}" class="form-control mb-2">

            <input type="text" name="tag" value="{{ $theme->tag }}" class="form-control mb-2">

            <textarea name="description" class="form-control mb-2">{{ $theme->description }}</textarea>

            <input type="text" name="bg_color" value="{{ $theme->bg_color }}" class="form-control mb-2">

            <input type="text" name="tag_color" value="{{ $theme->tag_color }}" class="form-control mb-2">

            <input type="number" name="sort_order" value="{{ $theme->sort_order }}" class="form-control mb-2">

            <select name="status" class="form-control mb-3">
                <option value="1" {{ $theme->status ? 'selected' : '' }}>Active</option>
                <option value="0" {{ !$theme->status ? 'selected' : '' }}>Inactive</option>
            </select>

            <button class="btn btn-success">Update</button>
        </form>
    </div>
@endsection
