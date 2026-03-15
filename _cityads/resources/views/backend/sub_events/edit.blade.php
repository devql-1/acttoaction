@extends('backend.layout.app')
@section('content')

    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Edit Sub Event</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="{{ route('events-index') }}">Events</a></li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a
                            href="{{ route('events-show', $subEvent->event->id) }}">{{ $subEvent->event->title }}</a></li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="#">Edit Sub Event</a></li>
                </ul>
            </div>

            {{-- Parent Event Info Bar --}}
            <div class="alert alert-light border mb-4 d-flex align-items-center gap-3">
                <img src="{{ asset($subEvent->event->banner_image) }}" class="rounded"
                    style="width:45px;height:45px;object-fit:cover;">
                <div>
                    <strong>{{ $subEvent->event->title }}</strong>
                    <small class="text-muted d-block">
                        <i class="fa fa-calendar me-1"></i>
                        {{ $subEvent->event->event_date?->format('d M Y') ?? '--' }}
                        @if($subEvent->event->event_end_date)
                            → {{ $subEvent->event->event_end_date->format('d M Y') }}
                        @endif
                    </small>
                </div>
            </div>

            <div class="row">
                <div class="col-md-10 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Edit Sub Event Details</div>
                        </div>

                        <form action="{{ route('sub-events-update', $subEvent->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="card-body">

                                {{-- TITLE --}}
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label>Title <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="title"
                                            class="form-control @error('title') is-invalid @enderror"
                                            value="{{ old('title', $subEvent->title) }}" required>
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- DESCRIPTION --}}
                                <div class="form-group row">
                                    <div class="col-md-3"><label>Description</label></div>
                                    <div class="col-md-9">
                                        <textarea name="description" id="descriptionEditor" class="form-control"
                                            rows="3">{{ old('description', $subEvent->description) }}</textarea>
                                    </div>
                                </div>

                                {{-- DATE --}}
                                <div class="form-group row">
                                    <div class="col-md-3"><label>Event Date</label></div>
                                    <div class="col-md-9">
                                        <input type="date" name="event_date" class="form-control"
                                            value="{{ old('event_date', $subEvent->event_date?->format('Y-m-d')) }}">
                                    </div>
                                </div>

                                {{-- TIME --}}
                                <div class="form-group row">
                                    <div class="col-md-3"><label>Time</label></div>
                                    <div class="col-md-9">
                                        <div class="row">
                                            <div class="col-6">
                                                <label class="text-muted" style="font-size:12px;">Start Time</label>
                                                <input type="time" name="start_time" class="form-control"
                                                    value="{{ old('start_time', $subEvent->start_time) }}">
                                            </div>
                                            <div class="col-6">
                                                <label class="text-muted" style="font-size:12px;">End Time</label>
                                                <input type="time" name="end_time" class="form-control"
                                                    value="{{ old('end_time', $subEvent->end_time) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- FEES --}}
                                <div class="form-group row">
                                    <div class="col-md-3"><label>Fees (₹)</label></div>
                                    <div class="col-md-9">
                                        <input type="number" name="fees" class="form-control"
                                            value="{{ old('fees', $subEvent->fees) }}" min="0" placeholder="0 for free">
                                        <small class="text-muted">Enter 0 for a free event.</small>
                                    </div>
                                </div>

                                {{-- AGE GROUP --}}
                                <div class="form-group row">
                                    <div class="col-md-3"><label>Age Group</label></div>
                                    <div class="col-md-9">
                                        <input type="text" name="age_group" class="form-control"
                                            placeholder="e.g. 6-15 Years"
                                            value="{{ old('age_group', $subEvent->age_group) }}">
                                    </div>
                                </div>

                                {{-- MODE --}}
                                <div class="form-group row">
                                    <div class="col-md-3"><label>Mode</label></div>
                                    <div class="col-md-9">
                                        <select name="mode" class="form-control">
                                            <option value="offline" {{ old('mode', $subEvent->mode) == 'offline' ? 'selected' : '' }}>Offline</option>
                                            <option value="online" {{ old('mode', $subEvent->mode) == 'online' ? 'selected' : '' }}>Online</option>
                                            <option value="both" {{ old('mode', $subEvent->mode) == 'both' ? 'selected' : '' }}>Both</option>
                                        </select>
                                    </div>
                                </div>

                                {{-- MAX SEATS --}}
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label>Max Seats
                                            <small class="text-muted d-block fw-normal">Optional</small>
                                        </label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="number" name="max_seats" class="form-control"
                                            placeholder="Leave empty for unlimited"
                                            value="{{ old('max_seats', $subEvent->max_seats) }}" min="1">
                                    </div>
                                </div>

                                {{-- BANNER IMAGE --}}
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label>Sub Event Banner</label>
                                        <small class="text-muted d-block fw-normal">Optional. JPG, PNG, WEBP up to
                                            2MB.</small>
                                    </div>
                                    <div class="col-md-9">

                                        {{-- Existing image --}}
                                        @if($subEvent->banner_image)
                                            <div class="mb-2 d-flex align-items-center gap-3">
                                                <img src="{{ asset($subEvent->banner_image) }}" alt="Current Banner"
                                                    style="width:120px;height:80px;object-fit:cover;border-radius:6px;border:1px solid #ddd;">
                                                <div>
                                                    <small class="text-muted d-block mb-1">Current banner image</small>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" name="remove_banner"
                                                            id="removeBanner" value="1">
                                                        <label class="form-check-label text-danger" for="removeBanner">
                                                            <i class="fa fa-trash me-1"></i> Remove current image
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        <input type="file" name="banner_image" accept="image/*"
                                            class="form-control @error('banner_image') is-invalid @enderror"
                                            id="bannerInput">
                                        @error('banner_image')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror

                                        {{-- New image preview --}}
                                        <div class="mt-2">
                                            <img id="bannerPreviewImg" src="#" alt="Preview" style="display:none;max-width:200px;max-height:150px;
                                                                       border-radius:5px;object-fit:cover;">
                                        </div>

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

                                <div id="stateRowsContainer"></div>

                                <div id="noStateMsg" class="text-center text-muted py-3 border rounded bg-light"
                                    style="display:none;">
                                    <i class="fa fa-map-marker me-1"></i>
                                    Click <strong>"Add State"</strong> to assign centers to this sub event.
                                </div>

                            </div>

                            <div class="card-action d-flex justify-content-between align-items-center">
                                <a href="{{ route('sub-events-index', $subEvent->event->id) }}" class="btn btn-secondary">
                                    <i class="fa fa-arrow-left me-1"></i> Back
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-save me-1"></i> Update Sub Event
                                </button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    <script>
        // CKEditor
        ClassicEditor.create(document.querySelector('#descriptionEditor'), {
            toolbar: ['bold', 'italic', '|', 'bulletedList', 'numberedList', '|', 'undo', 'redo']
        }).catch(error => console.error(error));

        // Banner image preview
        document.getElementById('bannerInput').addEventListener('change', function (e) {
            const file = e.target.files[0];
            const preview = document.getElementById('bannerPreviewImg');
            if (file) {
                preview.src = URL.createObjectURL(file);
                preview.style.display = 'block';
            } else {
                preview.src = '';
                preview.style.display = 'none';
            }
        });

        // ── Centers ──
        const allStates = @json($states);
        const selectedCenters = @json($selectedCenters);  // pre-selected IDs from DB
        const centersByState = @json($centersByState);   // { state_id: [centers] }
        let rowCount = 0;

        // Pre-load existing state rows on page load
        window.addEventListener('DOMContentLoaded', () => {
            const stateIds = Object.keys(centersByState);
            if (stateIds.length === 0) {
                document.getElementById('noStateMsg').style.display = 'block';
            } else {
                stateIds.forEach(stateId => {
                    addStateRow(parseInt(stateId));
                });
            }
        });

        function addStateRow(preSelectedStateId = null) {
            rowCount++;
            const rowId = `stateRow_${rowCount}`;

            let options = `<option value="">-- Select State --</option>`;
            allStates.forEach(state => {
                const selected = preSelectedStateId && state.id == preSelectedStateId ? 'selected' : '';
                options += `<option value="${state.id}" ${selected}>${state.name}</option>`;
            });

            const html = `
                                <div class="border rounded p-3 mb-3 bg-light" id="${rowId}">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <select class="form-control w-50" onchange="loadCenters(this, '${rowId}')">
                                            ${options}
                                        </select>
                                        <button type="button" class="btn btn-outline-danger btn-sm"
                                            onclick="removeStateRow('${rowId}')">
                                            <i class="fa fa-times me-1"></i> Remove
                                        </button>
                                    </div>
                                    <div id="centers_${rowId}">
                                        <small class="text-muted">Select a state to see centers.</small>
                                    </div>
                                </div>`;

            document.getElementById('stateRowsContainer').insertAdjacentHTML('beforeend', html);
            document.getElementById('noStateMsg').style.display = 'none';

            // Auto-load centers if pre-selected state
            if (preSelectedStateId) {
                const select = document.querySelector(`#${rowId} select`);
                loadCenters(select, rowId, preSelectedStateId);
            }
        }

        function removeStateRow(rowId) {
            document.getElementById(rowId).remove();
            if (document.getElementById('stateRowsContainer').children.length === 0) {
                document.getElementById('noStateMsg').style.display = 'block';
            }
        }

        function loadCenters(selectEl, rowId, preSelectedStateId = null) {
            const stateId = selectEl.value || preSelectedStateId;
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
                        container.innerHTML = '<small class="text-warning"><i class="fa fa-exclamation-circle me-1"></i> No active centers found for this state.</small>';
                        return;
                    }
                    let html = '<div class="row">';
                    centers.forEach(center => {
                        // Pre-check if this center was previously selected
                        const checked = selectedCenters.includes(center.id) ? 'checked' : '';
                        html += `
                                            <div class="col-md-6 mb-2">
                                                <div class="form-check border rounded p-2 bg-white">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="center_ids[]"
                                                        value="${center.id}"
                                                        id="center_${center.id}_${rowId}"
                                                        ${checked}>
                                                    <label class="form-check-label w-100" for="center_${center.id}_${rowId}">
                                                        <strong>${center.name}</strong>
                                                        <small class="text-muted d-block">
                                                            <i class="fa fa-map-marker me-1"></i>${center.address ?? 'No address'}
                                                        </small>
                                                        ${center.phone ? `<small class="text-muted"><i class="fa fa-phone me-1"></i>${center.phone}</small>` : ''}
                                                    </label>
                                                </div>
                                            </div>`;
                    });
                    html += '</div>';
                    container.innerHTML = html;
                })
                .catch(() => {
                    container.innerHTML = '<small class="text-danger"><i class="fa fa-times-circle me-1"></i> Failed to load centers. Try again.</small>';
                });
        }
    </script>

@endsection