{{-- resources/views/backend/test_result_ranges/edit.blade.php --}}
@extends('backend.layout.app')
@section('title', 'Edit Result Range')

@section('content')
    <div class="container-fluid py-4">

        <div class="d-flex align-items-center gap-3 mb-4">
            <a href="{{ route('test-result-ranges.index', $test->id) }}" class="btn btn-sm btn-light border">
                <i class="bi bi-arrow-left"></i>
            </a>
            <div>
                <h4 class="fw-bold mb-0">✏️ Edit Result Range</h4>
                <p class="text-muted small mb-0">
                    Test: <strong>{{ $test->test_name }}</strong> —
                    Range: <strong>{{ $range->min_percent }}%–{{ $range->max_percent }}%</strong>
                </p>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">

                {{-- Live preview --}}
                <div class="alert border-0 mb-4 d-flex align-items-center gap-3" id="preview-banner" style="background:{{ $range->color }}15;
                                                    border-left:4px solid {{ $range->color }} !important;">
                    <div style="font-size:32px;" id="preview-emoji">{{ $range->emoji }}</div>
                    <div>
                        <div class="fw-bold" id="preview-label">{{ $range->label }}</div>
                        <div class="text-muted small" id="preview-tagline">{{ $range->tagline }}</div>
                        <div class="mt-1">
                            <span class="badge px-2" id="preview-range" style="background:{{ $range->color }};color:#fff;">
                                {{ $range->min_percent }}% – {{ $range->max_percent }}%
                            </span>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">

                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show">
                                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $e)
                                        <li>{{ $e }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('test-result-ranges.update', [$test->id, $range->id]) }}" method="POST">
                            @csrf @method('PUT')

                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">
                                        Min % <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" name="min_percent" id="f-min"
                                        class="form-control @error('min_percent') is-invalid @enderror"
                                        value="{{ old('min_percent', $range->min_percent) }}" min="0" max="100" required>
                                    @error('min_percent')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">
                                        Max % <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" name="max_percent" id="f-max"
                                        class="form-control @error('max_percent') is-invalid @enderror"
                                        value="{{ old('max_percent', $range->max_percent) }}" min="0" max="100" required>
                                    @error('max_percent')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-md-9">
                                    <label class="form-label fw-semibold">
                                        Label <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="label" id="f-label"
                                        class="form-control @error('label') is-invalid @enderror"
                                        value="{{ old('label', $range->label) }}" required>
                                    @error('label')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold">Emoji</label>
                                    <input type="text" name="emoji" id="f-emoji" class="form-control"
                                        value="{{ old('emoji', $range->emoji) }}" maxlength="5">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Tagline <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="tagline" id="f-tagline"
                                    class="form-control @error('tagline') is-invalid @enderror"
                                    value="{{ old('tagline', $range->tagline) }}" required>
                                @error('tagline')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Description <span class="text-danger">*</span>
                                </label>
                                <textarea name="description" rows="4"
                                    class="form-control @error('description') is-invalid @enderror"
                                    required>{{ old('description', $range->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold">Recommended Course</label>
                                <input type="text" name="recommended_course" class="form-control"
                                    value="{{ old('recommended_course', $range->recommended_course) }}"
                                    placeholder="e.g. Screen Acting + Camera Techniques">
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-md-9">
                                    <label class="form-label fw-semibold">
                                        Tags
                                        <span class="text-muted fw-normal">(comma separated)</span>
                                    </label>
                                    <input type="text" name="tags" class="form-control"
                                        value="{{ old('tags', $range->tags ? implode(', ', $range->tags) : '') }}"
                                        placeholder="e.g. Charismatic, Camera-Ready, Energetic">
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold">Color</label>
                                    <input type="color" name="color" id="f-color"
                                        class="form-control form-control-color w-100"
                                        value="{{ old('color', $range->color) }}" style="height:42px;">
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="bi bi-floppy me-1"></i> Update Range
                                </button>
                                <a href="{{ route('test-result-ranges.index', $test->id) }}"
                                    class="btn btn-light border px-4">Cancel</a>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Live preview script --}}
    <script>
        const fields = {
            label: ['f-label', 'preview-label'],
            tagline: ['f-tagline', 'preview-tagline'],
            emoji: ['f-emoji', 'preview-emoji'],
        };

        Object.entries(fields).forEach(([_, [inputId, previewId]]) => {
            const input = document.getElementById(inputId);
            const preview = document.getElementById(previewId);
            if (input && preview) {
                input.addEventListener('input', () => {
                    preview.textContent = input.value;
                });
            }
        });

        // Update range badge
        ['f-min', 'f-max'].forEach(id => {
            document.getElementById(id)?.addEventListener('input', () => {
                const min = document.getElementById('f-min').value;
                const max = document.getElementById('f-max').value;
                document.getElementById('preview-range').textContent = `${min}% – ${max}%`;
            });
        });

        // Update color
        document.getElementById('f-color')?.addEventListener('input', (e) => {
            const c = e.target.value;
            document.getElementById('preview-banner').style.borderLeftColor = c;
            document.getElementById('preview-banner').style.background = c + '15';
            document.getElementById('preview-range').style.background = c;
        });
    </script>
@endsection