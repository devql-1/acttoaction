@extends('backend.layout.app')

@section('content')

<div class="container">
    <div class="page-inner">

        <!-- Page Header -->
        <div class="page-header">
            <h3 class="fw-bold mb-3">Youtube Videos</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="#"><i class="icon-home"></i></a>
                </li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Youtube</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Add Video</a></li>
            </ul>
        </div>

        <!-- Card -->
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">Add Youtube Video</div>
                    </div>

                    <form action="{{ route('youtubeVideo.store') }}" method="POST">
                        @csrf

                        <div class="card-body">

                            <!-- Category -->
                            <div class="form-group row mb-3">
                                <div class="col-md-3">
                                    <label>Category</label>
                                    <span class="text-danger">*</span>
                                </div>
                                <div class="col-md-9">
                                    <select name="youtube_category_id"
                                            class="form-control @error('youtube_category_id') is-invalid @enderror">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ old('youtube_category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('youtube_category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Video Title -->
                            <div class="form-group row mb-3">
                                <div class="col-md-3">
                                    <label>Video Title</label>
                                    <span class="text-danger">*</span>
                                </div>
                                <div class="col-md-9">
                                    <input type="text"
                                           name="name"
                                           value="{{ old('name') }}"
                                           class="form-control @error('name') is-invalid @enderror"
                                           placeholder="Enter Video Title">

                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- YouTube Link -->
                            <div class="form-group row mb-3">
                                <div class="col-md-3">
                                    <label>YouTube Link</label>
                                    <span class="text-danger">*</span>
                                </div>
                                <div class="col-md-9">
                                    <input type="text"
                                           name="youtube_link"
                                           id="youtube_link"
                                           value="{{ old('youtube_link') }}"
                                           onkeyup="previewVideo(this.value)"
                                           class="form-control @error('youtube_link') is-invalid @enderror"
                                           placeholder="Paste full YouTube link">

                                    @error('youtube_link')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror

                                    <small class="text-muted">
                                        Example: https://www.youtube.com/watch?v=VIDEO_ID
                                    </small>
                                </div>
                            </div>

                            <!-- Preview Section -->
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label>Preview</label>
                                </div>
                                <div class="col-md-9">
                                    <div id="videoPreview"></div>
                                </div>
                            </div>

                        </div>

                        <div class="card-action text-center">
                            <button type="submit" class="btn btn-success">
                                Save Video
                            </button>

                            {{-- <a href="{{ route('youtube-videos.index') }}"
                               class="btn btn-danger">
                                Cancel
                            </a> --}}
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection


@section('script')
<script>
function previewVideo(link) {

    let match = link.match(/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&]+)/);

    if (match && match[1]) {
        let videoId = match[1];

        document.getElementById('videoPreview').innerHTML =
            `<iframe width="100%" height="250"
                src="https://www.youtube.com/embed/${videoId}"
                frameborder="0"
                allowfullscreen>
            </iframe>`;
    } else {
        document.getElementById('videoPreview').innerHTML = '';
    }
}
</script>
@endsection