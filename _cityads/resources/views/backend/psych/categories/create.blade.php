{{-- resources/views/backend/psych/categories/create.blade.php --}}
@extends('backend.layout.app')
@section('title', 'Add Category')

<style>
    body {
        background: #f5f6fa;
    }

    /* CARD */
    .psych-card {
        border: none;
        border-radius: 14px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, .06);
        overflow: hidden;
        background: #fff;
    }

    .psych-card .card-header {
        background: #fff;
        border-bottom: 1px solid #eef1f6;
        padding: 16px 20px;
    }

    .psych-card .card-header h5 {
        font-size: 16px;
        font-weight: 600;
        color: #2d3748;
        margin: 0;
    }

    /* BREADCRUMB */
    .breadcrumb-psych {
        background: #fff;
        padding: 12px 16px;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
        margin-bottom: 20px;
        font-size: 13px;
    }

    .breadcrumb-psych a {
        color: #6366f1;
        font-weight: 500;
        text-decoration: none;
    }

    .breadcrumb-psych .sep {
        margin: 0 6px;
        color: #9ca3af;
    }

    /* FORM ELEMENTS */
    .form-label {
        font-size: 13px;
        font-weight: 600;
        color: #374151;
    }

    .form-control,
    .form-select {
        border-radius: 8px;
        border: 1px solid #e5e7eb;
        font-size: 13px;
        padding: 8px 10px;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 2px rgba(99, 102, 241, .1);
    }

    textarea.form-control {
        resize: vertical;
        min-height: 90px;
    }

    /* BUTTONS */
    .btn-purple {
        background: #6366f1;
        border: none;
        border-radius: 8px;
        padding: 8px 18px;
        font-size: 13px;
        font-weight: 600;
        color: #fff;
    }

    .btn-purple:hover {
        background: #4f46e5;
        color: #fff;
    }

    /* CHIPS */
    .summary-chips {
        display: flex;
        gap: 10px;
    }

    .chip {
        background: #eef2ff;
        color: #4f46e5;
        padding: 5px 12px;
        font-size: 12px;
        border-radius: 20px;
        font-weight: 600;
    }

    .chip.green {
        background: #f0fdf4;
        color: #166534;
    }

    /* TIPS SIDEBAR */
    .tip-row {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        padding: 12px 16px;
        border-bottom: 1px solid #f1f5f9;
    }

    .tip-row:last-child {
        border-bottom: none;
    }

    .tip-icon {
        width: 30px;
        height: 30px;
        border-radius: 8px;
        background: #eef2ff;
        color: #6366f1;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        flex-shrink: 0;
    }

    .tip-title {
        font-size: 13px;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 2px;
    }

    .tip-sub {
        font-size: 11px;
        color: #9ca3af;
        line-height: 1.5;
    }

    /* EXAMPLE CHIPS */
    .example-chips {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        padding: 12px 16px;
    }

    .ex-chip {
        background: #f8fafc;
        border: 1px solid #e5e7eb;
        border-radius: 20px;
        padding: 3px 10px;
        font-size: 11px;
        font-weight: 500;
        color: #374151;
        cursor: pointer;
        transition: all .15s;
    }

    .ex-chip:hover {
        background: #eef2ff;
        border-color: #c7d2fe;
        color: #4f46e5;
    }

    /* CHAR COUNTER */
    .char-counter {
        font-size: 11px;
        color: #9ca3af;
        text-align: right;
        margin-top: 4px;
    }

    .char-counter.warn {
        color: #dc2626;
    }

    /* EXISTING CATEGORIES LIST */
    .cat-list-item {
        display: flex;
        justify-content: space-between;
        padding: 12px 16px;
        border-bottom: 1px solid #f1f5f9;
    }

    .cat-list-item:last-child {
        border-bottom: none;
    }

    .cat-list-item strong {
        font-size: 13px;
        color: #1e293b;
    }

    .cat-list-item .sub {
        font-size: 11px;
        color: #9ca3af;
    }

    .pts-badge {
        background: #eef2ff;
        color: #4f46e5;
        padding: 3px 10px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 600;
        white-space: nowrap;
    }

    /* FORM SECTION DIVIDER */
    .form-section-label {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .6px;
        color: #9ca3af;
        margin-bottom: 10px;
    }

    /* COLOR PICKER ROW */
    .color-options {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
        margin-top: 6px;
    }

    .color-swatch {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        cursor: pointer;
        border: 2px solid transparent;
        transition: transform .15s, border-color .15s;
    }

    .color-swatch:hover {
        transform: scale(1.15);
    }

    .color-swatch.selected {
        border-color: #1e293b;
        transform: scale(1.15);
    }
</style>

@section('content')
    <div class="container-fluid">

        {{-- BREADCRUMB --}}
        <div class="breadcrumb-psych">
            <a href="{{ route('quiz-tests.index') }}"><i class="fas fa-brain me-1"></i>Tests</a>
            <span class="sep">/</span>
            <a href="{{ route('quiz-categories.index', $test->id) }}">{{ $test->test_name }}</a>
            <span class="sep">/</span>
            <span style="color:#6c757d;">Add Category</span>
        </div>

        {{-- ALERTS --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show border-0">
                <strong>Fix the errors below:</strong>
                <ul class="mb-0 mt-1">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row g-4">

            {{-- ══════════════════════════════════════
            LEFT COL — Main Form
            ══════════════════════════════════════ --}}
            <div class="col-lg-8">
                <div class="card psych-card">

                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5><i class="fas fa-layer-group me-2"></i>New Category</h5>
                        <div class="summary-chips">
                            <span class="chip">
                                <i class="fas fa-brain me-1"></i>{{ $test->test_name }}
                            </span>
                            <span class="chip green">

                            </span>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <form action="{{ route('quiz-categories.store', $test->id) }}" method="POST" id="catForm">
                            @csrf

                            {{-- Category Name --}}
                            <div class="mb-4">
                                <div class="form-section-label">Category Details</div>
                                <label class="form-label">
                                    Category Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="category_name" id="catName"
                                    class="form-control @error('category_name') is-invalid @enderror"
                                    value="{{ old('category_name') }}"
                                    placeholder="e.g. Leadership, Emotional Intelligence, Stage Confidence" maxlength="80"
                                    required oninput="updateNameCounter(this)">
                                <div class="char-counter" id="nameCounter">0 / 80</div>
                                @error('category_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="mt-2">
                                    <div style="font-size:11px;color:#9ca3af;margin-bottom:6px;">
                                        Quick picks:
                                    </div>
                                    <div class="d-flex flex-wrap gap-2" id="exampleChips">
                                        @foreach(['Leadership', 'Emotional Intelligence', 'Stage Confidence', 'Creativity', 'Communication', 'Empathy', 'Screen Presence', 'Storytelling'] as $ex)
                                            <span class="ex-chip" onclick="pickExample('{{ $ex }}')">{{ $ex }}</span>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            {{-- Description --}}
                            <div class="mb-4">
                                <label class="form-label">
                                    Description
                                    <small class="text-muted fw-normal">(optional)</small>
                                </label>
                                <textarea name="description" id="catDesc"
                                    class="form-control @error('description') is-invalid @enderror"
                                    placeholder="Describe what this category measures — e.g. 'Measures a child\'s natural ability to lead and command attention in group settings.'"
                                    maxlength="300" oninput="updateDescCounter(this)">{{ old('description') }}</textarea>
                                <div class="char-counter" id="descCounter">0 / 300</div>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Icon --}}
                            <div class="mb-4">
                                <label class="form-label">Icon (Emoji)</label>
                                <input type="text" name="icon" id="catIcon" class="form-control"
                                    value="{{ old('icon', '') }}" placeholder="e.g. 🎭 or 👑" maxlength="4"
                                    style="width:100px;font-size:22px;text-align:center;">
                                <div style="font-size:11px;color:#9ca3af;margin-top:4px;">
                                    Paste a single emoji — shown in result charts and cards
                                </div>
                            </div>

                            {{-- Color --}}
                            <div class="mb-4">
                                <label class="form-label">Accent Color</label>
                                <div class="color-options" id="colorOptions">
                                    @php
                                        $colors = ['#175cdd', '#7c3aed', '#059669', '#d97706', '#db2777', '#0891b2', '#dc2626', '#0f172a'];
                                    @endphp
                                    @foreach($colors as $c)
                                        <div class="color-swatch {{ old('color', '#175cdd') === $c ? 'selected' : '' }}"
                                            style="background:{{ $c }};" onclick="pickColor('{{ $c }}', this)" title="{{ $c }}">
                                        </div>
                                    @endforeach
                                </div>
                                <input type="hidden" name="color" id="colorInput" value="{{ old('color', '#175cdd') }}">
                            </div>

                        </form>
                    </div>

                    <div class="card-footer bg-white border-top p-3 d-flex gap-2">
                        <button type="submit" form="catForm" class="btn btn-purple px-4">
                            <i class="fas fa-save me-2"></i>Save Category
                        </button>
                        <a href="{{ route('quiz-categories.index', $test->id) }}" class="btn btn-outline-secondary"
                            style="font-size:13px;">
                            Cancel
                        </a>
                    </div>

                </div>
            </div>

            {{-- ══════════════════════════════════════
            RIGHT COL — Sidebar
            ══════════════════════════════════════ --}}
            <div class="col-lg-4">

                {{-- Tips card --}}
                <div class="card psych-card mb-3">
                    <div class="card-header">
                        <h5><i class="fas fa-lightbulb me-2" style="color:#f59e0b;"></i>Category Tips</h5>
                    </div>
                    <div>
                        <div class="tip-row">
                            <div class="tip-icon"><i class="fas fa-bullseye"></i></div>
                            <div>
                                <div class="tip-title">Keep it focused</div>
                                <div class="tip-sub">Each category should measure one clear trait — e.g. "Stage Confidence",
                                    not "Confidence and Creativity".</div>
                            </div>
                        </div>
                        <div class="tip-row">
                            <div class="tip-icon"><i class="fas fa-question-circle"></i></div>
                            <div>
                                <div class="tip-title">Plan your questions</div>
                                <div class="tip-sub">Each question in this category adds 5 marks. Aim for 5–10 questions per
                                    category.</div>
                            </div>
                        </div>
                        <div class="tip-row">
                            <div class="tip-icon"><i class="fas fa-palette"></i></div>
                            <div>
                                <div class="tip-title">Use distinct colors</div>
                                <div class="tip-sub">Pick a unique color per category — it'll appear in result charts so
                                    children can instantly identify each section.</div>
                            </div>
                        </div>
                        <div class="tip-row">
                            <div class="tip-icon"><i class="fas fa-smile"></i></div>
                            <div>
                                <div class="tip-title">Add an emoji icon</div>
                                <div class="tip-sub">An emoji makes the result page more engaging for kids and parents —
                                    e.g. 🎭 for performance, 👑 for leadership.</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Existing categories --}}
                <div class="card psych-card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5><i class="fas fa-list me-2"></i>Existing Categories</h5>
                        <span class="chip" style="font-size:11px;">{{ $categories->count() }}</span>
                    </div>
                    <div>
                        @forelse($categories as $cat)
                            <div class="cat-list-item">
                                <div>
                                    <strong>
                                        @if($cat->icon) {{ $cat->icon }} @endif
                                        {{ $cat->category_name }}
                                    </strong>
                                    @if($cat->description)
                                        <div class="sub">{{ Str::limit($cat->description, 40) }}</div>
                                    @endif
                                </div>
                                <span class="pts-badge">{{ $cat->total_marks ?? 0 }} pts</span>
                            </div>
                        @empty
                            <div class="text-center py-4">
                                <i class="fas fa-layer-group" style="font-size:24px;color:#e5e7eb;"></i>
                                <p style="font-size:12px;color:#9ca3af;margin-top:8px;">
                                    No categories yet.<br>This will be the first one.
                                </p>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection

<script>
    /* ── Quick pick example name ── */
    function pickExample(name) {
        const el = document.getElementById('catName');
        el.value = name;
        updateNameCounter(el);
        el.focus();
    }

    /* ── Color picker ── */
    function pickColor(hex, el) {
        document.querySelectorAll('.color-swatch').forEach(s => s.classList.remove('selected'));
        el.classList.add('selected');
        document.getElementById('colorInput').value = hex;
    }

    /* ── Character counters ── */
    function updateNameCounter(el) {
        const c = document.getElementById('nameCounter');
        c.textContent = el.value.length + ' / 80';
        c.classList.toggle('warn', el.value.length > 70);
    }
    function updateDescCounter(el) {
        const c = document.getElementById('descCounter');
        c.textContent = el.value.length + ' / 300';
        c.classList.toggle('warn', el.value.length > 270);
    }

    /* ── Init counters on load ── */
    document.addEventListener('DOMContentLoaded', () => {
        const n = document.getElementById('catName');
        const d = document.getElementById('catDesc');
        if (n.value) updateNameCounter(n);
        if (d.value) updateDescCounter(d);
    });
</script>