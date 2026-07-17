@extends('backend.layout.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Edit Testimonial Video</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home">
                        <a href="#"><i class="icon-home"></i></a>
                    </li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item">
                        <a href="{{ route('admin.testimonials.index') }}">Testimonial Videos</a>
                    </li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="#">Edit</a></li>
                </ul>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="card card-round">
                        <div class="card-header">
                            <div class="card-title">
                                <i class="fab fa-youtube text-danger me-2"></i> Video Details
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.testimonials.update', $video) }}" method="POST" id="videoForm">
                                @csrf
                                @method('PUT')

                                <div class="form-group mb-3">
                                    <label class="form-label fw-bold">
                                        YouTube Video ID <span class="text-danger">*</span>
                                        <small class="text-muted fw-normal d-block">
                                            The part after ?v= or youtu.be/ - e.g. <code>jnAlL91guDI</code>
                                        </small>
                                    </label>
                                    <input type="text" name="youtube_video_id" id="youtube_video_id"
                                        class="form-control @error('youtube_video_id') is-invalid @enderror"
                                        value="{{ old('youtube_video_id', $video->youtube_video_id) }}"
                                        placeholder="jnAlL91guDI" oninput="livePreview(this.value)" required />
                                    @error('youtube_video_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label fw-bold">
                                        Title <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                        value="{{ old('title', $video->title) }}"
                                        placeholder="Parent shares transformation story..." required />
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label fw-bold">Description</label>
                                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3"
                                        placeholder="Brief description shown under the video card...">{{ old('description', $video->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label fw-bold">
                                                Duration
                                                <small class="text-muted fw-normal">e.g. 2:30</small>
                                            </label>
                                            <input type="text" name="duration"
                                                class="form-control @error('duration') is-invalid @enderror"
                                                value="{{ old('duration', $video->duration) }}" placeholder="2:30" />
                                            @error('duration')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label fw-bold">
                                                Sort Order
                                                <small class="text-muted fw-normal">Lower = first</small>
                                            </label>
                                            <input type="number" name="sort_order"
                                                class="form-control @error('sort_order') is-invalid @enderror"
                                                value="{{ old('sort_order', $video->sort_order ?? 0) }}" min="0" />
                                            @error('sort_order')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label fw-bold">Channel Name</label>
                                            <input type="text" name="channel_name" class="form-control"
                                                value="{{ old('channel_name', $video->channel_name ?? 'Threat Expert') }}" />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label fw-bold">
                                        Watch URL Override
                                        <small class="text-muted fw-normal d-block">Optional - auto-generated from video ID if blank</small>
                                    </label>
                                    <input type="url" name="watch_url"
                                        class="form-control @error('watch_url') is-invalid @enderror"
                                        value="{{ old('watch_url', $video->watch_url) }}" placeholder="https://youtu.be/..." />
                                    @error('watch_url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-4">
                                    <label class="form-label fw-bold">
                                        Thumbnail URL Override
                                        <small class="text-muted fw-normal d-block">Optional - uses YouTube thumbnail if blank</small>
                                    </label>
                                    <input type="url" name="thumbnail_url"
                                        class="form-control @error('thumbnail_url') is-invalid @enderror"
                                        value="{{ old('thumbnail_url', $video->thumbnail_url) }}" placeholder="https://..." />
                                    @error('thumbnail_url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-save me-1"></i> Update Video
                                    </button>
                                    <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">
                                        <i class="fa fa-times me-1"></i> Cancel
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-round mb-3">
                        <div class="card-header">
                            <div class="card-title"><i class="fa fa-eye me-2"></i> Thumbnail Preview</div>
                        </div>
                        <div class="card-body">
                            <div style="position:relative;border-radius:10px;overflow:hidden;background:#111;aspect-ratio:16/9">
                                <img id="previewImg"
                                    src="{{ $video->thumbnail_url ?: 'https://i.ytimg.com/vi/' . $video->youtube_video_id . '/mqdefault.jpg' }}"
                                    style="width:100%;height:100%;object-fit:cover;display:block;transition:opacity .3s"
                                    alt="Preview" />
                                <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center">
                                    <i class="fa fa-play-circle" style="font-size:40px;color:rgba(255,255,255,.8)"></i>
                                </div>
                            </div>
                            <div class="mt-2">
                                <small class="text-muted">
                                    Video ID: <code id="previewId">{{ $video->youtube_video_id }}</code><br />
                                    <a id="previewLink" href="https://youtu.be/{{ $video->youtube_video_id }}" target="_blank"
                                        class="text-primary">youtu.be/{{ $video->youtube_video_id }}</a>
                                </small>
                            </div>
                        </div>
                    </div>

                    <div class="card card-round mb-3">
                        <div class="card-header">
                            <div class="card-title"><i class="fa fa-layer-group me-2"></i> Page Category</div>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-0">
                                <label class="form-label fw-bold">
                                    Assign to Page <span class="text-danger">*</span>
                                    <small class="text-muted fw-normal d-block">Which page carousel shows this video</small>
                                </label>
                                <select name="page_category_id" form="videoForm"
                                    class="form-select @error('page_category_id') is-invalid @enderror" required>
                                    <option value="">- Select a page -</option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}"
                                            {{ old('page_category_id', $video->page_category_id) == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->name }} ({{ $cat->slug }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('page_category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="card card-round mb-3">
                        <div class="card-header">
                            <div class="card-title"><i class="fa fa-tag me-2"></i> Video Category</div>
                        </div>
                        <div class="card-body">
                            <div class="form-group mb-3">
                                <label class="form-label fw-bold">Filter Tab <span class="text-danger">*</span></label>

                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="video_category" form="videoForm"
                                        id="catParent" value="parent"
                                        {{ old('video_category', $video->video_category ?? 'parent') === 'parent' ? 'checked' : '' }} />
                                    <label class="form-check-label" for="catParent">
                                        <span class="badge badge-primary me-1">●</span> Parent Feedback
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="video_category" form="videoForm"
                                        id="catStudent" value="student"
                                        {{ old('video_category', $video->video_category) === 'student' ? 'checked' : '' }} />
                                    <label class="form-check-label" for="catStudent">
                                        <span class="badge badge-success me-1">●</span> Student Journey
                                    </label>
                                </div>
                                @error('video_category')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-0">
                                <label class="form-label fw-bold">
                                    Custom Label
                                    <small class="text-muted fw-normal d-block">Overrides the default tab label</small>
                                </label>
                                <input type="text" name="video_category_label" form="videoForm" class="form-control"
                                    value="{{ old('video_category_label', $video->video_category_label) }}"
                                    placeholder="Parent Feedback" />
                            </div>
                        </div>
                    </div>

                    <div class="card card-round">
                        <div class="card-header">
                            <div class="card-title"><i class="fa fa-toggle-on me-2"></i> Visibility</div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <div class="fw-bold">Active / Visible</div>
                                    <small class="text-muted">Inactive videos are hidden from all carousels</small>
                                </div>
                                <label class="switch">
                                    <input type="checkbox" name="is_active" form="videoForm" value="1"
                                        {{ old('is_active', $video->is_active) ? 'checked' : '' }} />
                                    <span class="record-toggle"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        let previewTimer = null;

        function livePreview(val) {
            clearTimeout(previewTimer);
            previewTimer = setTimeout(function() {
                const id = val.trim();
                if (!id) {
                    return;
                }

                document.getElementById('previewId').textContent = id;
                document.getElementById('previewLink').href = 'https://youtu.be/' + id;
                document.getElementById('previewLink').textContent = 'youtu.be/' + id;

                const img = document.getElementById('previewImg');
                img.style.opacity = '.4';
                img.src = 'https://i.ytimg.com/vi/' + id + '/mqdefault.jpg';
                img.onload = function() {
                    img.style.opacity = '1';
                };
            }, 500);
        }
    </script>
@endsection
