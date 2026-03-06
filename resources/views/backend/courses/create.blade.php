@extends('backend.layout.app')
@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Add Course</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home">
                        <a href="#"><i class="icon-home"></i></a>
                    </li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="{{ route('courses') }}">Courses</a></li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="#">Add Course</a></li>
                </ul>
            </div>

            <div class="row">
                <div class="col-md-10 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Create Course</div>
                        </div>

                        <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="card-body">

                                {{-- TITLE --}}
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label>Course Title <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="title"
                                            class="form-control @error('title') is-invalid @enderror"
                                            value="{{ old('title') }}" required>
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
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

                                {{-- DURATION --}}
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label>Duration <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="duration"
                                            class="form-control @error('duration') is-invalid @enderror"
                                            placeholder="e.g. 1 Month" value="{{ old('duration') }}" required>
                                        @error('duration')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- CATEGORY --}}
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label>Category <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-9">
                                        <select name="category_id"
                                            class="form-control @error('category_id') is-invalid @enderror" required>
                                            <option value="">-- Select Category --</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                {{-- TOTAL SESSIONS --}}
                                <div class="form-group row">
                                    <div class="col-md-3"><label>Total Sessions</label></div>
                                    <div class="col-md-9">
                                        <input type="number" name="total_sessions" class="form-control"
                                            value="{{ old('total_sessions') }}" min="1">
                                    </div>
                                </div>

                                {{-- MODE --}}
                                <div class="form-group row">
                                    <div class="col-md-3"><label>Mode</label></div>
                                    <div class="col-md-9">
                                        <select name="mode" class="form-control">
                                            <option value="online" {{ old('mode') == 'online' ? 'selected' : '' }}>Online
                                            </option>
                                            <option value="offline" {{ old('mode') == 'offline' ? 'selected' : '' }}>Offline
                                            </option>
                                            <option value="both" {{ old('mode') == 'both' ? 'selected' : '' }}>Both</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- AGE GROUP --}}
                                <div class="form-group row">
                                    <div class="col-md-3"><label>Age Group</label></div>
                                    <div class="col-md-9">
                                        <input type="text" name="age_group" class="form-control"
                                            placeholder="e.g. 3-15 Years" value="{{ old('age_group') }}">
                                    </div>
                                </div>

                                {{-- FEES --}}
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label>Fees (₹) <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="number" name="fees"
                                            class="form-control @error('fees') is-invalid @enderror"
                                            value="{{ old('fees') }}" min="0" required>
                                        @error('fees')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- INSTAGRAM (optional) --}}
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

                                {{-- HIGHLIGHTS (optional) --}}
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

                                <hr>

                                {{-- MULTI STATE + CENTER SELECTION --}}
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="mb-0">Available Centers</h5>
                                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="addStateRow()">
                                        <i class="fa fa-plus me-1"></i> Add State
                                    </button>
                                </div>

                                <div id="stateRowsContainer">
                                    {{-- State rows added dynamically --}}
                                </div>

                                <div id="noStateMsg" class="text-center text-muted py-3 border rounded bg-light">
                                    <i class="fa fa-map-marker me-1"></i>
                                    Click <strong>"Add State"</strong> to select states and centers for this course.
                                </div>

                                <hr>

                                {{-- PDF DOCUMENTS --}}
                                <div class="form-group row mt-2">
                                    <div class="col-md-3">
                                        <label>Documents (PDF)
                                            <small class="text-muted d-block fw-normal">Optional</small>
                                        </label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="file" name="documents[]" multiple class="form-control" accept=".pdf">
                                        <small class="form-text text-muted">You can upload multiple PDF files.</small>
                                    </div>
                                </div>

                            </div>

                            <div class="card-action d-flex justify-content-between align-items-center">
                                <a href="{{ route('courses') }}" class="btn btn-secondary">
                                    <i class="fa fa-arrow-left me-1"></i> Back
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-save me-1"></i> Save Course
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- CKEditor 5 --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

    <script>
        // CKEditor init
        ClassicEditor.create(document.querySelector('#descriptionEditor'), {
            toolbar: ['heading', '|', 'bold', 'italic', 'underline', '|', 'bulletedList', 'numberedList', '|', 'link', 'blockQuote', '|', 'undo', 'redo']
        }).catch(error => console.error(error));

        // All states from Laravel (for dropdown)
        const allStates = @json($states);

        let rowCount = 0;

        function addStateRow() {
            rowCount++;
            const rowId = `stateRow_${rowCount}`;

            // Build state options
            let options = `<option value="">-- Select State --</option>`;
            allStates.forEach(state => {
                options += `<option value="${state.id}">${state.name}</option>`;
            });

            const html = `
                                                    <div class="border rounded p-3 mb-3 bg-light" id="${rowId}">
                                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                                            <select class="form-control w-50" onchange="loadCenters(this, '${rowId}')">
                                                                ${options}
                                                            </select>
                                                            <button type="button" class="btn btn-sm btn-outline-danger"
                                                                onclick="removeStateRow('${rowId}')">
                                                                <i class="fa fa-times me-1"></i> Remove
                                                            </button>
                                                        </div>
                                                        <div class="centers-container" id="centers_${rowId}">
                                                            <small class="text-muted">Select a state to see centers.</small>
                                                        </div>
                                                    </div>`;

            document.getElementById('stateRowsContainer').insertAdjacentHTML('beforeend', html);
            document.getElementById('noStateMsg').style.display = 'none';
        }

        function removeStateRow(rowId) {
            document.getElementById(rowId).remove();
            // show placeholder if no rows left
            if (document.getElementById('stateRowsContainer').children.length === 0) {
                document.getElementById('noStateMsg').style.display = 'block';
            }
        }

        function loadCenters(selectEl, rowId) {
            const stateId = selectEl.value;
            const container = document.getElementById(`centers_${rowId}`);

            if (!stateId) {
                container.innerHTML = '<small class="text-muted">Select a state to see centers.</small>';
                return;
            }

            container.innerHTML = '<small class="text-muted"><i class="fa fa-spinner fa-spin me-1"></i> Loading centers...</small>';

            fetch(`{{ route('centers-by-state') }}?state_id=${stateId}`)
                .then(res => res.json())
                .then(centers => {
                    if (centers.length === 0) {
                        container.innerHTML = '<small class="text-warning"><i class="fa fa-exclamation-circle me-1"></i>No active centers found for this state.</small>';
                        return;
                    }

                    let html = '<div class="row">';
                    centers.forEach(center => {
                        html += `
                                                                <div class="col-md-6 mb-2">
                                                                    <div class="form-check border rounded p-2 bg-white">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            name="center_ids[]"
                                                                            value="${center.id}"
                                                                            id="center_${center.id}_${rowId}">
                                                                        <label class="form-check-label w-100" for="center_${center.id}_${rowId}">
                                                                            <strong>${center.name}</strong>
                                                                            <small class="text-muted d-block">
                                                                                <i class="fa fa-map-marker me-1"></i>${center.address ?? 'No address provided'}
                                                                            </small>
                                                                            ${center.phone
                                ? `<small class="text-muted"><i class="fa fa-phone me-1"></i>${center.phone}</small>`
                                : ''}
                                                                        </label>
                                                                    </div>
                                                                </div>`;
                    });
                    html += '</div>';

                    container.innerHTML = html;
                })
                .catch(() => {
                    container.innerHTML = '<small class="text-danger"><i class="fa fa-times-circle me-1"></i> Failed to load centers. Please try again.</small>';
                });
        }
    </script>

@endsection