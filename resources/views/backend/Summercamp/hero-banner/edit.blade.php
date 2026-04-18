{{-- resources/views/admin/hero-banner/edit.blade.php --}}
@extends('backend.layout.app')
{{-- ← change to your admin layout --}}

@section('title', 'Edit Hero Banner')

@section('content')
    <div class="container-fluid px-4 py-4">

        {{-- Header --}}
        <div class="d-flex align-items-center gap-3 mb-4">
            <a href="{{ route('hero-banner.index') }}" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-arrow-left"></i>
            </a>
            <div>
                <h4 class="fw-bold mb-0">Edit Hero Banner #{{ $heroBanner->id }}</h4>
                <p class="text-muted small mb-0">Leave image empty to keep the current banner image.</p>
            </div>
        </div>

        <div class="row g-4">

            {{-- Form --}}
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">

                        <form action="{{ route('hero-banner.update', $heroBanner) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- Current image preview --}}
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Current Banner</label>
                                <div class="rounded-3 overflow-hidden border">
                                    <img src="{{ $heroBanner->image_url }}" alt="{{ $heroBanner->alt_text }}"
                                        class="img-fluid w-100" style="max-height:200px; object-fit:cover;"
                                        id="currentPreview" />
                                </div>
                            </div>

                            {{-- Replace image --}}
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Replace Image <span
                                        class="text-muted fw-normal">(optional)</span></label>

                                <div id="dropZone"
                                    class="border-2 border-dashed rounded-3 p-4 text-center position-relative"
                                    style="border-color:#dee2e6; cursor:pointer; min-height:120px; display:flex; align-items:center; justify-content:center; flex-direction:column; transition:.2s;"
                                    ondragover="event.preventDefault(); this.style.borderColor='#ff6a00'; this.style.background='#fff8f4';"
                                    ondragleave="this.style.borderColor='#dee2e6'; this.style.background='';"
                                    ondrop="handleDrop(event)">

                                    <input type="file" name="image" id="imageInput"
                                        accept="image/jpeg,image/png,image/webp"
                                        class="position-absolute top-0 start-0 w-100 h-100 opacity-0"
                                        style="cursor:pointer; z-index:2;" onchange="previewReplace(this)">

                                    <div id="dropPlaceholder">
                                        <i class="bi bi-arrow-repeat fs-2 text-muted"></i>
                                        <p class="mt-2 mb-0 small fw-semibold">Click or drag to replace image</p>
                                        <p class="text-muted small mb-0">JPG, PNG, WEBP — max 5MB</p>
                                    </div>

                                    <div id="newPreviewWrap" style="display:none; width:100%">
                                        <img id="newPreviewImg" src="" alt="New preview" class="img-fluid rounded"
                                            style="max-height:200px; object-fit:cover; width:100%;" />
                                        <p class="small text-muted mt-2 mb-0" id="newPreviewName"></p>
                                    </div>
                                </div>

                                @error('image')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Alt text --}}
                            <div class="mb-4">
                                <label for="alt_text" class="form-label fw-semibold">Alt Text</label>
                                <input type="text" name="alt_text" id="alt_text"
                                    value="{{ old('alt_text', $heroBanner->alt_text) }}"
                                    class="form-control @error('alt_text') is-invalid @enderror"
                                    placeholder="Describe the banner" />
                                @error('alt_text')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Active toggle --}}
                            <div class="mb-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" name="is_active"
                                        id="is_active" value="1" {{ $heroBanner->is_active ? 'checked' : '' }}>
                                    <label class="form-check-label fw-semibold" for="is_active">
                                        Active Banner
                                    </label>
                                    <div class="form-text">Enabling this will deactivate any other active banner.</div>
                                </div>
                            </div>

                            {{-- Actions --}}
                            <div class="d-flex gap-3">
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="bi bi-save me-1"></i> Save Changes
                                </button>
                                <a href="{{ route('hero-banner.index') }}" class="btn btn-outline-secondary px-4">
                                    Cancel
                                </a>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

            {{-- Info sidebar --}}
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h6 class="fw-bold mb-3">Banner Details</h6>
                        <table class="table table-sm table-borderless mb-0">
                            <tr>
                                <td class="text-muted small">ID</td>
                                <td class="small">{{ $heroBanner->id }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted small">Status</td>
                                <td>
                                    @if ($heroBanner->is_active)
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted small">Stored at</td>
                                <td class="small text-break">{{ $heroBanner->image_path }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted small">Uploaded</td>
                                <td class="small">{{ $heroBanner->created_at->format('d M Y, h:i A') }}</td>
                            </tr>
                            <tr>
                                <td class="text-muted small">Updated</td>
                                <td class="small">{{ $heroBanner->updated_at->format('d M Y, h:i A') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>

                {{-- Danger zone --}}
                <div class="card border-0 shadow-sm mt-3 border-danger border-opacity-25">
                    <div class="card-body p-4">
                        <h6 class="fw-bold text-danger mb-2"><i class="bi bi-exclamation-triangle me-2"></i>Danger Zone</h6>
                        <p class="small text-muted mb-3">Deleting this banner will permanently remove the image from
                            storage.</p>
                        <form action="{{ route('hero-banner.destroy', $heroBanner) }}" method="POST"
                            data-confirm="The banner image will be permanently removed from storage."
                            data-confirm-title="Delete Banner?" data-confirm-button="Yes, delete">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                <i class="bi bi-trash me-1"></i> Delete Banner
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
        <script>
            function previewReplace(input) {
                if (!input.files || !input.files[0]) return;
                const file = input.files[0];
                const reader = new FileReader();
                reader.onload = e => {
                    document.getElementById('currentPreview').src = e.target.result;
                    document.getElementById('newPreviewImg').src = e.target.result;
                    document.getElementById('newPreviewName').textContent = file.name + ' (' + (file.size / 1024 / 1024)
                        .toFixed(2) + ' MB)';
                    document.getElementById('dropPlaceholder').style.display = 'none';
                    document.getElementById('newPreviewWrap').style.display = 'block';
                };
                reader.readAsDataURL(file);
            }

            function handleDrop(e) {
                e.preventDefault();
                document.getElementById('dropZone').style.borderColor = '#dee2e6';
                document.getElementById('dropZone').style.background = '';
                const dt = e.dataTransfer;
                if (dt.files.length) {
                    const input = document.getElementById('imageInput');
                    input.files = dt.files;
                    previewReplace(input);
                }
            }
        </script>
    @endpush
@endsection
