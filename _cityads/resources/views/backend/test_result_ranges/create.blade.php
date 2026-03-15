{{-- resources/views/backend/test_result_ranges/create.blade.php --}}
@extends('backend.layout.app')@section('title', 'Add Result Range')

@section('content')
    <div class="container-fluid py-4">

        <div class="d-flex align-items-center gap-3 mb-4">
            <a href="{{ route('test-result-ranges.index', $test->id) }}" class="btn btn-sm btn-light border">
                <i class="bi bi-arrow-left"></i>
            </a>
            <div>
                <h4 class="fw-bold mb-0">➕ Add Result Range</h4>
                <p class="text-muted small mb-0">Test: <strong>{{ $test->test_name }}</strong></p>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $e)
                                        <li>{{ $e }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('test-result-ranges.store', $test->id) }}" method="POST">
                            @csrf

                            {{-- Percent range --}}
                            <div class="row g-3 mb-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">
                                        Min % <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" name="min_percent"
                                        class="form-control @error('min_percent') is-invalid @enderror"
                                        value="{{ old('min_percent', 0) }}" min="0" max="100" required>
                                    <div class="form-text">e.g. 0 for range starting at 0%</div>
                                    @error('min_percent')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">
                                        Max % <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" name="max_percent"
                                        class="form-control @error('max_percent') is-invalid @enderror"
                                        value="{{ old('max_percent', 39) }}" min="0" max="100" required>
                                    <div class="form-text">e.g. 39 for range ending at 39%</div>
                                    @error('max_percent')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            {{-- Label + Emoji --}}
                            <div class="row g-3 mb-3">
                                <div class="col-md-9">
                                    <label class="form-label fw-semibold">
                                        Label <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="label"
                                        class="form-control @error('label') is-invalid @enderror" value="{{ old('label') }}"
                                        placeholder="e.g. The Performer" required>
                                    @error('label')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold">Emoji</label>
                                    <input type="text" name="emoji" class="form-control" value="{{ old('emoji', '⭐') }}"
                                        placeholder="🎭" maxlength="5">
                                </div>
                            </div>

                            {{-- Tagline --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Tagline <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="tagline"
                                    class="form-control @error('tagline') is-invalid @enderror" value="{{ old('tagline') }}"
                                    placeholder="e.g. Natural On-Screen Magnetism" required>
                                @error('tagline')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Description --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Description <span class="text-danger">*</span>
                                </label>
                                <textarea name="description" rows="4"
                                    class="form-control @error('description') is-invalid @enderror"
                                    placeholder="Full description shown to the user on result page..."
                                    required>{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Recommended course --}}
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Recommended Course
                                    <span class="text-muted fw-normal">(optional)</span>
                                </label>
                                <input type="text" name="recommended_course" class="form-control"
                                    value="{{ old('recommended_course') }}"
                                    placeholder="e.g. Screen Acting + Camera Techniques">
                            </div>

                            {{-- Tags + Color --}}
                            <div class="row g-3 mb-4">
                                <div class="col-md-9">
                                    <label class="form-label fw-semibold">
                                        Tags
                                        <span class="text-muted fw-normal">(comma separated)</span>
                                    </label>
                                    <input type="text" name="tags" class="form-control" value="{{ old('tags') }}"
                                        placeholder="e.g. Charismatic, Camera-Ready, Energetic">
                                    <div class="form-text">
                                        These appear as pills on the result page.
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label fw-semibold">Color</label>
                                    <input type="color" name="color" class="form-control form-control-color w-100"
                                        value="{{ old('color', '#175cdd') }}" style="height:42px;">
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary px-4">
                                    <i class="bi bi-floppy me-1"></i> Save Range
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
@endsection