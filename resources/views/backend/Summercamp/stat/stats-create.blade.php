@extends('backend.layout.app')
@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Add Stat</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="{{ route('stats-index') }}">Stats</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Add</a></li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-7">
                <div class="card card-round">
                    <div class="card-header"><div class="card-title">Stat Details</div></div>
                    <div class="card-body">
                        <form action="{{ route('stats-store') }}" method="POST">
                            @csrf

                            {{-- Icon --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Bootstrap Icon <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text" id="iconPreviewWrap">
                                        <i class="bi bi-people-fill" id="iconPreview"></i>
                                    </span>
                                    <input type="text" name="icon" id="iconInput"
                                           value="{{ old('icon', 'bi-people-fill') }}"
                                           class="form-control @error('icon') is-invalid @enderror"
                                           placeholder="e.g. bi-people-fill"
                                           oninput="document.getElementById('iconPreview').className='bi '+this.value">
                                </div>
                                <div class="form-text text-muted">
                                    Browse at <a href="https://icons.getbootstrap.com" target="_blank">icons.getbootstrap.com</a>
                                </div>
                                @error('icon') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>

                            {{-- Value + Suffix --}}
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Value <span class="text-danger">*</span></label>
                                    <input type="text" name="value"
                                           value="{{ old('value') }}"
                                           class="form-control @error('value') is-invalid @enderror"
                                           placeholder="e.g. 500">
                                    <div class="form-text text-muted">The number shown (can be text like "10K").</div>
                                    @error('value') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Suffix</label>
                                    <input type="text" name="suffix"
                                           value="{{ old('suffix', '+') }}"
                                           class="form-control"
                                           placeholder="e.g.  +  %  k  x">
                                    <div class="form-text text-muted">Shown after the value in orange.</div>
                                </div>
                            </div>

                            {{-- Label --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Label <span class="text-danger">*</span></label>
                                <input type="text" name="label"
                                       value="{{ old('label') }}"
                                       class="form-control @error('label') is-invalid @enderror"
                                       placeholder="e.g. Kids Trained">
                                @error('label') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-4">
                                    <label class="form-label fw-semibold">Sort Order</label>
                                    <input type="number" name="sort_order"
                                           value="{{ old('sort_order', 0) }}"
                                           min="0" class="form-control">
                                    <div class="form-text text-muted">Lower = appears first.</div>
                                </div>
                                <div class="col-md-8 d-flex align-items-end pb-1">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox"
                                               name="status" id="status" value="1"
                                               {{ old('status', true) ? 'checked' : '' }}>
                                        <label class="form-check-label fw-semibold" for="status">
                                            Active (visible on site)
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-save me-1"></i> Save Stat
                                </button>
                                <a href="{{ route('stats-index') }}" class="btn btn-secondary">
                                    <i class="fa fa-arrow-left me-1"></i> Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-5">
                <div class="card card-round">
                    <div class="card-header"><div class="card-title"><i class="fa fa-info-circle text-info me-1"></i> Examples</div></div>
                    <div class="card-body">
                        <table class="table table-sm table-borderless small mb-0">
                            <thead><tr><th>Icon</th><th>Value</th><th>Suffix</th><th>Label</th></tr></thead>
                            <tbody>
                                <tr><td><i class="bi bi-people-fill text-primary"></i></td><td>500</td><td>+</td><td>Kids Trained</td></tr>
                                <tr><td><i class="bi bi-geo-alt-fill text-danger"></i></td><td>15</td><td>+</td><td>Venue Partners</td></tr>
                                <tr><td><i class="bi bi-star-fill text-warning"></i></td><td>200</td><td>+</td><td>Parent Reviews</td></tr>
                                <tr><td><i class="bi bi-trophy-fill text-success"></i></td><td>4</td><td>+</td><td>Art Forms</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
@if(session('error'))
    Swal.fire({ icon: 'error', title: 'Error!', text: '{{ session('error') }}' });
@endif
</script>
@endsection
