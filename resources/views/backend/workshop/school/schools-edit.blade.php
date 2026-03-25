@extends('backend.layout.app')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Edit School / Venue</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="{{ route('workshop-schools-index') }}">Schools</a></li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="#">Edit</a></li>
                </ul>
            </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="card card-round">
                        <div class="card-header">
                            <div class="card-title">Edit — {{ $workshopSchool->name }}</div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('workshop-schools-update', $workshopSchool->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf @method('PUT')

                                <div class="row g-3 mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Age Group <span
                                                class="text-danger">*</span></label>
                                        <select name="age_group_id" id="ageGroupSelect"
                                            class="form-select @error('age_group_id') is-invalid @enderror"
                                            onchange="filterCities(this.value)">
                                            @foreach ($ageGroups as $group)
                                                <option value="{{ $group->id }}"
                                                    {{ old('age_group_id', $workshopSchool->age_group_id) == $group->id ? 'selected' : '' }}>
                                                    {{ $group->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('age_group_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">City <span
                                                class="text-danger">*</span></label>
                                        <select name="city_id" id="citySelect"
                                            class="form-select @error('city_id') is-invalid @enderror">
                                            @foreach ($cities as $city)
                                                <option value="{{ $city->id }}" data-age="{{ $city->age_group_id }}"
                                                    {{ old('city_id', $workshopSchool->city_id) == $city->id ? 'selected' : '' }}>
                                                    {{ $city->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('city_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">School / Venue Name <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="name" value="{{ old('name', $workshopSchool->name) }}"
                                        class="form-control @error('name') is-invalid @enderror">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Description</label>
                                    <textarea name="description" rows="3" class="form-control">{{ old('description', $workshopSchool->description) }}</textarea>
                                </div>

                                <div class="row g-3 mb-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Timings</label>
                                        <input type="text" name="timings"
                                            value="{{ old('timings', $workshopSchool->timings) }}" class="form-control"
                                            placeholder="e.g. 10:00 AM - 12:00 PM">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold">Registration Link</label>
                                        <input type="text" name="registration_url"
                                            value="{{ old('registration_url', $workshopSchool->registration_url) }}"
                                            class="form-control">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Address</label>
                                    <input type="text" name="address"
                                        value="{{ old('address', $workshopSchool->address) }}" class="form-control">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">
                                        Photo <span class="text-muted fw-normal">(leave empty to keep current)</span>
                                    </label>
                                    @if ($workshopSchool->image_url)
                                        <div class="mb-2">
                                            <img id="currentImg" src="{{ $workshopSchool->image_url }}"
                                                style="height:80px;border-radius:8px;object-fit:cover;">
                                            <small class="text-muted d-block mt-1">Current photo</small>
                                        </div>
                                    @endif
                                    <input type="file" name="image" accept="image/jpeg,image/png,image/webp"
                                        class="form-control @error('image') is-invalid @enderror"
                                        onchange="previewImage(this)">
                                    @error('image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">
                                        Fees (₹) <span class="text-danger">*</span>
                                    </label>

                                    <input type="number" name="fees" value="{{ old('fees', $workshopSchool->fees) }}"
                                        class="form-control @error('fees') is-invalid @enderror" placeholder="e.g. 1500"
                                        min="0" step="0.01">

                                    @error('fees')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="row g-3 mb-4">
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold">Sort Order</label>
                                        <input type="number" name="sort_order"
                                            value="{{ old('sort_order', $workshopSchool->sort_order) }}" min="0"
                                            class="form-control">
                                    </div>
                                    <div class="col-md-8 d-flex align-items-end pb-1">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" name="status"
                                                id="status" value="1"
                                                {{ $workshopSchool->status ? 'checked' : '' }}>
                                            <label class="form-check-label fw-semibold" for="status">Active</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-save me-1"></i> Update School
                                    </button>
                                    <a href="{{ route('workshop-schools-index') }}" class="btn btn-secondary">
                                        <i class="fa fa-arrow-left me-1"></i> Cancel
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card card-round">
                        <div class="card-header">
                            <div class="card-title"><i class="fa fa-info-circle text-info me-1"></i> Details</div>
                        </div>
                        <div class="card-body">
                            <table class="table table-sm table-borderless mb-0">
                                <tr>
                                    <td class="text-muted small">Age Group</td>
                                    <td><span class="badge badge-info">{{ $workshopSchool->ageGroup->name ?? '—' }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted small">City</td>
                                    <td>{{ $workshopSchool->city->name ?? '—' }}</td>
                                </tr>
                                <tr>
                                    <td class="text-muted small">Status</td>
                                    <td>
                                        @if ($workshopSchool->status)
                                        <span class="badge badge-success">Active</span>@else<span
                                                class="badge badge-secondary">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted small">Created</td>
                                    <td class="small">{{ $workshopSchool->created_at->format('d M Y') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="card card-round mt-3">
                        <div class="card-header">
                            <div class="card-title text-danger"><i class="fa fa-exclamation-triangle me-1"></i> Danger
                                Zone</div>
                        </div>
                        <div class="card-body">
                            <form id="delete-form-{{ $workshopSchool->id }}"
                                action="{{ route('workshop-schools-destroy', $workshopSchool->id) }}" method="POST"
                                class="d-none">
                                @csrf @method('DELETE')
                            </form>
                            <button type="button" class="btn btn-danger btn-sm"
                                onclick="confirmDelete({{ $workshopSchool->id }}, '{{ addslashes($workshopSchool->name) }}')">
                                <i class="fa fa-trash me-1"></i> Delete School
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function filterCities(ageGroupId) {
            const citySelect = document.getElementById('citySelect');
            citySelect.querySelectorAll('option[data-age]').forEach(opt => {
                opt.style.display = (!ageGroupId || opt.dataset.age === ageGroupId) ? '' : 'none';
            });
        }
        document.addEventListener('DOMContentLoaded', () => {
            filterCities(document.getElementById('ageGroupSelect').value);
        });

        function previewImage(input) {
            if (!input.files || !input.files[0]) return;
            const reader = new FileReader();
            reader.onload = e => {
                const cur = document.getElementById('currentImg');
                if (cur) cur.src = e.target.result;
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
            }).then(r => {
                if (r.isConfirmed) document.getElementById(`delete-form-${id}`).submit();
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
    </script>
@endsection
