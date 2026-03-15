@extends('backend.layout.app')
@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Add Event</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="{{ route('events-index') }}">Events</a></li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="#">Add Event</a></li>
                </ul>
            </div>

            <div class="row">
                <div class="col-md-9 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Create New Event</div>
                        </div>

                        <form action="{{ route('events-store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="card-body">

                                {{-- TITLE --}}
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label>Event Title <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="title"
                                            class="form-control @error('title') is-invalid @enderror"
                                            value="{{ old('title') }}" required>
                                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                {{-- DESCRIPTION --}}
                                <div class="form-group row">
                                    <div class="col-md-3"><label>Description</label></div>
                                    <div class="col-md-9">
                                        <textarea name="description" id="descriptionEditor"
                                            class="form-control">{{ old('description') }}</textarea>
                                    </div>
                                </div>

                                {{-- EVENT DATE --}}
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label>Start Date <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="date" name="event_date"
                                            class="form-control @error('event_date') is-invalid @enderror"
                                            value="{{ old('event_date') }}" required>
                                        @error('event_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                    </div>
                                </div>

                                {{-- END DATE --}}
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label>End Date
                                            <small class="text-muted d-block fw-normal">Optional</small>
                                        </label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="date" name="event_end_date"
                                            class="form-control @error('event_end_date') is-invalid @enderror"
                                            value="{{ old('event_end_date') }}">
                                        @error('event_end_date') <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- BANNER IMAGE --}}
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label>Banner Image
                                            <small class="text-muted d-block fw-normal">Optional</small>
                                        </label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="file" name="banner_image"
                                            class="form-control @error('banner_image') is-invalid @enderror"
                                            accept="image/*" onchange="previewBanner(this)">
                                        @error('banner_image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                        <div id="bannerPreview" class="mt-2" style="display:none;">
                                            <img id="previewImg" src="" alt="Preview" class="rounded"
                                                style="max-height:150px;">
                                        </div>
                                    </div>
                                </div>

                                {{-- INSTAGRAM --}}
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label>Instagram Link
                                            <small class="text-muted d-block fw-normal">Optional</small>
                                        </label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="url" name="instagram_link" class="form-control"
                                            placeholder="https://instagram.com/..." value="{{ old('instagram_link') }}">
                                    </div>
                                </div>

                                {{-- HIGHLIGHTS --}}
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label>Highlights Link
                                            <small class="text-muted d-block fw-normal">Optional</small>
                                        </label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="url" name="highlights_link" class="form-control"
                                            placeholder="https://youtube.com/..." value="{{ old('highlights_link') }}">
                                    </div>
                                </div>

                            </div>

                            <div class="card-action d-flex justify-content-between align-items-center">
                                <a href="{{ route('events-index') }}" class="btn btn-secondary">
                                    <i class="fa fa-arrow-left me-1"></i> Back
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-save me-1"></i> Save Event
                                </button>
                            </div>

                        </form>
                    </div>

                    <div class="alert alert-info mt-3">
                        <i class="fa fa-info-circle me-1"></i>
                        After saving the event, you can add <strong>Sub Events</strong> from the event detail page.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    <script>
        ClassicEditor.create(document.querySelector('#descriptionEditor'), {
            toolbar: ['heading', '|', 'bold', 'italic', 'underline', '|', 'bulletedList', 'numberedList', '|', 'link', 'blockQuote', '|', 'undo', 'redo']
        }).catch(error => console.error(error));

        function previewBanner(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = e => {
                    document.getElementById('previewImg').src = e.target.result;
                    document.getElementById('bannerPreview').style.display = 'block';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

@endsection