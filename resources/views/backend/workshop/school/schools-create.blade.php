@extends('backend.layout.app')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Add School / Venue</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="{{ route('workshop-schools-index') }}">Schools</a></li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="#">Add</a></li>
                </ul>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="card card-round">
                        <div class="card-header">
                            <div class="card-title">School / Venue Details</div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('workshop-schools-store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="row g-3 mb-3">
                                    {{-- Age Group --}}
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Age Group <span
                                                class="text-danger">*</span></label>
                                        <select name="age_group_id" id="ageGroupSelect"
                                            class="form-select @error('age_group_id') is-invalid @enderror"
                                            onchange="filterCities(this.value)">
                                            <option value="">-- Select Age Group --</option>
                                            @foreach ($ageGroups as $group)
                                                <option value="{{ $group->id }}"
                                                    {{ old('age_group_id', request('age_group_id')) == $group->id ? 'selected' : '' }}>
                                                    {{ $group->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('age_group_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- City --}}
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">City <span
                                                class="text-danger">*</span></label>
                                        <select name="city_id" id="citySelect"
                                            class="form-select @error('city_id') is-invalid @enderror">
                                            <option value="">-- Select City --</option>
                                            @foreach ($cities as $city)
                                                <option value="{{ $city->id }}" data-age="{{ $city->age_group_id }}"
                                                    {{ old('city_id', request('city_id')) == $city->id ? 'selected' : '' }}>
                                                    {{ $city->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('city_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Name --}}
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">School / Venue Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="name" value="{{ old('name') }}"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="e.g. Mayoor School, Vedanta Academy">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Description --}}
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Description</label>
                                    <textarea name="description" rows="3" class="form-control"
                                        placeholder="Short description about the workshop at this venue...">{{ old('description') }}</textarea>
                                </div>

                                <div class="row g-3 mb-3">
                                    {{-- Timings --}}
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Timings</label>
                                        <input type="text" name="timings" value="{{ old('timings') }}"
                                            class="form-control" placeholder="e.g. 10:00 AM - 12:00 PM">
                                    </div>

                                    {{-- Registration URL --}}
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Registration Link</label>
                                        <input type="text" name="registration_url" value="{{ old('registration_url') }}"
                                            class="form-control" placeholder="https:// or tel: or wa.me/...">
                                    </div>
                                </div>
                                {{-- Fees --}}
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Fees (₹) <span
                                            class="text-danger">*</span></label>
                                    <input type="number" name="fees" value="{{ old('fees') }}"
                                        class="form-control @error('fees') is-invalid @enderror" placeholder="e.g. 1500"
                                        min="0" step="0.01">
                                    @error('fees')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                {{-- Address --}}
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Address</label>
                                    <input type="text" name="address" value="{{ old('address') }}" class="form-control"
                                        placeholder="e.g. Sector 5, Vaishali Nagar, Jaipur">
                                </div>

                                {{-- Image --}}
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Photo <span
                                            class="text-muted fw-normal">(optional)</span></label>
                                    <input type="file" name="image" id="imageInput"
                                        accept="image/jpeg,image/png,image/webp"
                                        class="form-control @error('image') is-invalid @enderror"
                                        onchange="previewImage(this)">
                                    <div class="form-text text-muted">JPG, PNG, WEBP — max 3MB.</div>
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div id="imgPreviewWrap" class="mt-2" style="display:none;">
                                        <img id="imgPreview" src="" alt="Preview"
                                            style="height:80px;border-radius:8px;object-fit:cover;">
                                    </div>
                                </div>

                                <div class="row g-3 mb-4">
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Sort Order</label>
                                        <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}"
                                            min="0" class="form-control">
                                    </div>
                                    <div class="col-md-8 d-flex align-items-end pb-1">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="status"
                                                id="status" value="1" {{ old('status', true) ? 'checked' : '' }}>
                                            <label class="form-check-label fw-semibold" for="status">Active (visible on
                                                site)</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-success">
                                        <i class="fa fa-save me-1"></i> Save School
                                    </button>
                                    <a href="{{ route('workshop-schools-index') }}" class="btn btn-secondary">
                                        <i class="fa fa-arrow-left me-1"></i> Cancel
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Filter cities based on selected age group
        function filterCities(ageGroupId) {
            const citySelect = document.getElementById('citySelect');
            const options = citySelect.querySelectorAll('option[data-age]');
            citySelect.value = '';
            options.forEach(opt => {
                opt.style.display = (!ageGroupId || opt.dataset.age === ageGroupId) ? '' : 'none';
            });
        }

        // Run on load to handle old() values
        document.addEventListener('DOMContentLoaded', () => {
            const ageVal = document.getElementById('ageGroupSelect').value;
            if (ageVal) filterCities(ageVal);
        });

        function previewImage(input) {
            if (!input.files || !input.files[0]) return;
            const reader = new FileReader();
            reader.onload = e => {
                document.getElementById('imgPreview').src = e.target.result;
                document.getElementById('imgPreviewWrap').style.display = 'block';
            };
            reader.readAsDataURL(input.files[0]);
        }
        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{{ session('error') }}'
            });
        @endif
    </script>
@endsection
