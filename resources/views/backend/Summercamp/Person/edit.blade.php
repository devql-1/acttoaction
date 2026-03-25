@extends('backend.layout.app')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Edit Person</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="{{ route('people-index') }}">People</a></li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="#">Edit</a></li>
                </ul>
            </div>

            <div class="row">

                {{-- Main form --}}
                <div class="col-md-8">
                    <div class="card card-round">
                        <div class="card-header">
                            <div class="card-title">Edit — {{ $person->name }}</div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('people-update', $person->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                {{-- Section --}}
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        Section <span class="text-danger">*</span>
                                    </label>
                                    <select name="section" class="form-select @error('section') is-invalid @enderror">
                                        @foreach ($sections as $key => $label)
                                            <option value="{{ $key }}"
                                                {{ old('section', $person->section) === $key ? 'selected' : '' }}>
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
                                    <input type="text" name="name" value="{{ old('name', $person->name) }}"
                                        class="form-control @error('name') is-invalid @enderror">
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
                                        value="{{ old('role_badge', $person->role_badge) }}"
                                        class="form-control @error('role_badge') is-invalid @enderror">
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
                                        value="{{ old('designation', $person->designation) }}"
                                        class="form-control @error('designation') is-invalid @enderror">
                                    @error('designation')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Bio --}}
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Bio / Description</label>
                                    <textarea name="bio" rows="3" class="form-control @error('bio') is-invalid @enderror">{{ old('bio', $person->bio) }}</textarea>
                                    @error('bio')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Photo --}}
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        Photo <span class="text-muted fw-normal">(leave empty to keep current)</span>
                                    </label>

                                    {{-- Current photo --}}
                                    <div class="mb-2">
                                        <img id="currentPhoto" src="{{ $person->photo_url }}" alt="{{ $person->name }}"
                                            style="width:80px;height:80px;object-fit:cover;border-radius:10px;border:2px solid #dee2e6;">
                                        <small class="text-muted d-block mt-1">Current photo</small>
                                    </div>

                                    <input type="file" name="photo" id="photoInput"
                                        accept="image/jpeg,image/png,image/webp"
                                        class="form-control @error('photo') is-invalid @enderror"
                                        onchange="previewPhoto(this)">
                                    <div class="form-text text-muted">JPG, PNG, WEBP — max 3MB.</div>
                                    @error('photo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <hr>

                                {{-- Social Links --}}
                                <p class="fw-semibold text-muted mb-3">
                                    <i class="fa fa-share-alt me-1"></i> Social & Press Links
                                </p>

                                <div class="row g-3 mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Instagram URL</label>
                                        <div class="input-group">
                                            <span class="input-group-text text-danger">
                                                <i class="fa fa-instagram"></i>
                                            </span>
                                            <input type="url" name="instagram_url"
                                                value="{{ old('instagram_url', $person->instagram_url) }}"
                                                class="form-control" placeholder="https://instagram.com/...">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">YouTube URL</label>
                                        <div class="input-group">
                                            <span class="input-group-text text-danger">
                                                <i class="fa fa-youtube-play"></i>
                                            </span>
                                            <input type="url" name="youtube_url"
                                                value="{{ old('youtube_url', $person->youtube_url) }}"
                                                class="form-control" placeholder="https://youtube.com/...">
                                        </div>
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
                                                value="{{ old('press_url', $person->press_url) }}" class="form-control"
                                                placeholder="https://...">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Press Label</label>
                                        <input type="text" name="press_label"
                                            value="{{ old('press_label', $person->press_label) }}" class="form-control"
                                            placeholder="e.g. Dainik Bhaskar">
                                    </div>
                                </div>

                                <hr>

                                {{-- Sort + Status --}}
                                <div class="row g-3 mb-4">
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Sort Order</label>
                                        <input type="number" name="sort_order"
                                            value="{{ old('sort_order', $person->sort_order) }}" min="0"
                                            max="255" class="form-control">
                                    </div>
                                    <div class="col-md-8 d-flex align-items-end pb-1">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="status"
                                                id="status" value="1" {{ $person->status ? 'checked' : '' }}>
                                            <label class="form-check-label fw-semibold" for="status">
                                                Active (visible on site)
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                {{-- Actions --}}
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-save me-1"></i> Update Person
                                    </button>
                                    <a href="{{ route('people-index') }}" class="btn btn-secondary">
                                        <i class="fa fa-arrow-left me-1"></i> Cancel
                                    </a>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

                {{-- Sidebar --}}
                <div class="col-md-4">
                    <div class="card card-round">
                        <div class="card-header">
                            <div class="card-title">
                                <i class="fa fa-info-circle text-info me-1"></i> Details
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-sm table-borderless mb-0">
                                <tr>
                                    <td class="text-muted small">ID</td>
                                    <td class="small">{{ $person->id }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted small">Section</td>
                                    <td>
                                        <span class="badge badge-info">{{ ucfirst($person->section) }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted small">Status</td>
                                    <td>
                                        @if ($person->status)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-secondary">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted small">Created</td>
                                    <td class="small">{{ $person->created_at->format('d M Y') }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted small">Updated</td>
                                    <td class="small">{{ $person->updated_at->format('d M Y') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    {{-- Danger zone --}}
                    <div class="card card-round mt-3">
                        <div class="card-header">
                            <div class="card-title text-danger">
                                <i class="fa fa-exclamation-triangle me-1"></i> Danger Zone
                            </div>
                        </div>
                        <div class="card-body">
                            <p class="small text-muted mb-3">
                                Permanently delete this person and their photo.
                            </p>
                            <form id="delete-form-{{ $person->id }}"
                                action="{{ route('people-destroy', $person->id) }}" method="POST" class="d-none">
                                @csrf
                                @method('DELETE')
                            </form>
                            <button type="button" class="btn btn-danger btn-sm"
                                onclick="confirmDelete({{ $person->id }}, '{{ addslashes($person->name) }}')">
                                <i class="fa fa-trash me-1"></i> Delete Person
                            </button>
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
                document.getElementById('currentPhoto').src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
        }

        function confirmDelete(id, name) {
            Swal.fire({
                title: 'Are you sure?',
                text: `Deleting "${name}"?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-form-${id}`).submit();
                }
            });
        }

        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                timer: 2500,
                showConfirmButton: false
            });
        @endif
        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{{ session('error') }}'
            });
        @endif
    </script>
@endsection
