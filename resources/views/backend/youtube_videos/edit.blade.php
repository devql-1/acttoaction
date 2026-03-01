@extends('backend.layout.app')

@section('content')

<div class="container">
<div class="page-inner">

<div class="page-header">
    <h3 class="fw-bold mb-3">Edit Youtube Video</h3>
</div>

<div class="card">
<div class="card-header">
    <div class="card-title">Edit Video</div>
</div>

<form action="{{ route('youtubeVideos.update', $video->id) }}" method="POST">
@csrf

<div class="card-body">

    <div class="mb-3">
        <label>Category</label>
        <select name="youtube_category_id" class="form-control">
            @foreach($categories as $category)
                <option value="{{ $category->id }}"
                    {{ $video->youtube_category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label>Video Title</label>
        <input type="text"
               name="name"
               value="{{ $video->name }}"
               class="form-control">
    </div>

    <div class="mb-3">
        <label>Youtube Link</label>
        <input type="text"
               name="youtube_link"
               value="https://www.youtube.com/watch?v={{ $video->youtube_id }}"
               class="form-control">
    </div>

    <div class="mb-3">
        <label>Current Video</label>
        <iframe width="100%" height="250"
            src="https://www.youtube.com/embed/{{ $video->youtube_id }}"
            frameborder="0"
            allowfullscreen>
        </iframe>
    </div>

</div>

<div class="card-action text-center">
    <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('youtubeVideos.index') }}" class="btn btn-danger">Cancel</a>
</div>

</form>

</div>
</div>
</div>

@endsection