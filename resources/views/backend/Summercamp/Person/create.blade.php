@extends('backend.layout.app')
@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Add Person</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="{{ route('people-index') }}">People</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Add</a></li>
            </ul>
        </div>

        <div class="row">

            {{-- Main form --}}
            <div class="col-md-8">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-title">Person Details</div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('people-store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            {{-- Section --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Section <span class="text-danger">*</span>
                                </label>
                                <select name="section"
                                        class="form-select @error('section') is-invalid @enderror">
                                    <option value="">-- Select Section --</option>
                                    @foreach($sections as $key => $label)
                                        <option value="{{ $key }}"
                                            {{ old('section') === $key ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('section')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Name --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Full Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="name"
                                       value="{{ old('name') }}"
                                       class="form-control @error('name') is-invalid @enderror"
                                       placeholder="e.g. Sh. Premchand Bairwa">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Role Badge --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Role Badge <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="role_badge"
                                       value="{{ old('role_badge') }}"
                                       class="form-control @error('role_badge') is-invalid @enderror"
                                       placeholder="e.g. Chief Mentor / Keynote / Drama Lead">
                                <div class="form-text text-muted">
                                    Small badge shown on the photo card (max 80 chars).
                                </div>
                                @error('role_badge')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Designation --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Designation <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="designation"
                                       value="{{ old('designation') }}"
                                       class="form-control @error('designation') is-invalid @enderror"
                                       placeholder="e.g. Deputy Chief Minister, Rajasthan">
                                @error('designation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Bio --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Bio / Description</label>
                                <textarea name="bio" rows="3"
                                          class="form-control @error('bio') is-invalid @enderror"
                                          placeholder="Short description shown under their name on the card...">{{ old('bio') }}</textarea>
                                <div class="form-text text-muted">Max 500 characters.</div>
                                @error('bio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Photo --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Photo <span class="text-danger">*</span>
                                </label>
                                <input type="file" name="photo" id="photoInput"
                                       accept="image/jpeg,image/png,image/webp"
                                       class="form-control @error('photo') is-invalid @enderror"
                                       onchange="previewPhoto(this)">
                                <div class="form-text text-muted">
                                    JPG, PNG, WEBP — max 3MB. Recommended: square or portrait (490Ã—490px).
                                </div>
                                @error('photo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                {{-- Preview --}}
                                <div id="photoPreviewWrap" class="mt-2" style="display:none;">
                                    <img id="photoPreview" src="" alt="Preview"
                                         style="width:100px;height:100px;object-fit:cover;border-radius:10px;border:2px solid #dee2e6;">
                                </div>
                            </div>

                            <hr>

                            {{-- Social Links --}}
                            <p class="fw-semibold text-muted mb-3">
                                <i class="fa fa-share-alt me-1"></i> Social & Press Links
                                <small class="fw-normal">(all optional)</small>
                            </p>

                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Instagram URL</label>
                                    <div class="input-group">
                                        <span class="input-group-text text-danger">
                                            <i class="fa fa-instagram"></i>
                                        </span>
                                        <input type="url" name="instagram_url"
                                               value="{{ old('instagram_url') }}"
                                               class="form-control @error('instagram_url') is-invalid @enderror"
                                               placeholder="https://instagram.com/...">
                                    </div>
                                    @error('instagram_url')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">YouTube URL</label>
                                    <div class="input-group">
                                        <span class="input-group-text text-danger">
                                            <i class="fa fa-youtube-play"></i>
                                        </span>
                                        <input type="url" name="youtube_url"
                                               value="{{ old('youtube_url') }}"
                                               class="form-control @error('youtube_url') is-invalid @enderror"
                                               placeholder="https://youtube.com/...">
                                    </div>
                                    @error('youtube_url')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Press / News URL</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fa fa-newspaper-o"></i>
                                        </span>
                                        <input type="text" name="press_url"
                                               value="{{ old('press_url') }}"
                                               class="form-control @error('press_url') is-invalid @enderror"
                                               placeholder="https://dainikbhaskar.com/...">
                                    </div>
                                    @error('press_url')
                                        <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Press Label</label>
                                    <input type="text" name="press_label"
                                           value="{{ old('press_label') }}"
                                           class="form-control"
                                           placeholder="e.g. Dainik Bhaskar">
                                </div>
                            </div>

                            <hr>

                            {{-- Sort order + Status --}}
                            <div class="row g-3 mb-4">
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Sort Order</label>
                                    <input type="number" name="sort_order"
                                           value="{{ old('sort_order', 0) }}"
                                           min="0" max="255"
                                           class="form-control">
                                    <div class="form-text text-muted">Lower = appears first.</div>
                                </div>
                                <div class="col-md-8 d-flex align-items-end pb-1">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox"
                                               name="status" id="status"
                                               value="1" {{ old('status', true) ? 'checked' : '' }}>
                                        <label class="form-check-label fw-semibold" for="status">
                                            Active (visible on site)
                                        </label>
                                    </div>
                                </div>
                            </div>

                            {{-- Actions --}}
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-save me-1"></i> Save Person
                                </button>
                                <a href="{{ route('people-index') }}" class="btn btn-secondary">
                                    <i class="fa fa-arrow-left me-1"></i> Cancel
                                </a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

            {{-- Tips sidebar --}}
            <div class="col-md-4">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-title">
                            <i class="fa fa-info-circle text-info me-1"></i> Section Guide
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <span class="badge badge-warning me-1">Mentor</span>
                            <small class="text-muted">Visionary leaders — e.g. Deputy CM, Education Minister</small>
                        </div>
                        <div class="mb-3">
                            <span class="badge badge-info me-1">Speaker</span>
                            <small class="text-muted">Keynote &amp; expert speakers at the camp</small>
                        </div>
                        <div class="mb-3">
                            <span class="badge badge-success me-1">Guest</span>
                            <small class="text-muted">Distinguished guests &amp; guest performers</small>
                        </div>
                        <div class="mb-3">
                            <span class="badge badge-primary me-1">Faculty</span>
                            <small class="text-muted">Drama, Dance, Music &amp; Storytelling coaches</small>
                        </div>
                        <hr>
                        <ul class="list-unstyled small text-muted mb-0" style="line-height:2.2">
                            <li><i class="fa fa-check text-success me-2"></i>Photo: square preferred (490Ã—490px)</li>
                            <li><i class="fa fa-check text-success me-2"></i>Role badge is the small orange tag on photo</li>
                            <li><i class="fa fa-check text-success me-2"></i>Use Sort Order to control card sequence</li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function previewPhoto(input) {
    if (!input.files || !input.files[0]) return;
    const reader = new FileReader();
    reader.onload = e => {
        document.getElementById('photoPreview').src      = e.target.result;
        document.getElementById('photoPreviewWrap').style.display = 'block';
    };
    reader.readAsDataURL(input.files[0]);
}


</script>

@endsection
