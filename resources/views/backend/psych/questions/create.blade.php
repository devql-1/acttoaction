{{-- resources/views/backend/psych/questions/create.blade.php --}}
@extends('backend.layout.app')

<style>
    body { background: #f5f6fa; }

    /* CARD */
    .psych-card {
        border: none;
        border-radius: 14px;
        box-shadow: 0 6px 20px rgba(0,0,0,.06);
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
    .breadcrumb-psych .sep { margin: 0 6px; color: #9ca3af; }

    /* FORM ELEMENTS */
    .form-label {
        font-size: 13px;
        font-weight: 600;
        color: #374151;
    }
    .form-control, .form-select {
        border-radius: 8px;
        border: 1px solid #e5e7eb;
        font-size: 13px;
        padding: 8px 10px;
    }
    .form-control:focus, .form-select:focus {
        border-color: #6366f1;
        box-shadow: 0 0 0 2px rgba(99,102,241,.1);
    }
    textarea.form-control { resize: vertical; }

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
    .btn-purple:hover { background: #4f46e5; color: #fff; }

    .btn-add-row {
        border: 2px dashed #c7d2fe;
        background: #f8fafc;
        padding: 12px;
        border-radius: 10px;
        width: 100%;
        font-size: 13px;
        font-weight: 600;
        color: #4f46e5;
        transition: .2s;
        cursor: pointer;
    }
    .btn-add-row:hover { background: #eef2ff; border-color: #6366f1; }

    /* CHIPS */
    .summary-chips { display: flex; gap: 10px; }
    .chip {
        background: #eef2ff;
        color: #4f46e5;
        padding: 5px 12px;
        font-size: 12px;
        border-radius: 20px;
        font-weight: 600;
    }
    .chip.gold { background: #fef3c7; color: #92400e; }
    .chip.green { background: #f0fdf4; color: #166534; }

    /* QUESTION ROW */
    .question-row {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 14px;
        position: relative;
        transition: all .2s;
    }
    .question-row:hover {
        border-color: #c7d2fe;
        box-shadow: 0 3px 12px rgba(99,102,241,.08);
    }
    .question-row.removing {
        opacity: 0;
        transform: translateX(12px);
    }

    .q-number {
        width: 34px; height: 34px;
        border-radius: 50%;
        background: #6366f1;
        color: #fff;
        display: flex; align-items: center; justify-content: center;
        font-size: 13px; font-weight: 700;
        flex-shrink: 0;
    }

    .btn-remove-q {
        position: absolute;
        top: 12px; right: 12px;
        width: 28px; height: 28px;
        border-radius: 50%;
        background: #fee2e2;
        color: #dc2626;
        border: none;
        font-size: 11px;
        display: flex; align-items: center; justify-content: center;
        cursor: pointer;
        transition: background .15s;
    }
    .btn-remove-q:hover { background: #fca5a5; }

    /* SECTION LABEL */
    .form-section-label {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .6px;
        color: #9ca3af;
        margin-bottom: 10px;
    }

    /* SCALE DOTS */
    .scale-visual {
        display: flex;
        gap: 6px;
        align-items: center;
        margin-top: 10px;
        padding: 10px 12px;
        background: #f8fafc;
        border-radius: 8px;
        border: 1px solid #f1f5f9;
    }
    .scale-dot {
        width: 26px; height: 26px;
        border-radius: 50%;
        background: #eef2ff;
        border: 1px solid #c7d2fe;
        color: #4f46e5;
        font-size: 11px; font-weight: 700;
        display: flex; align-items: center; justify-content: center;
    }

    /* SIDEBAR TIPS */
    .tip-row {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        padding: 12px 16px;
        border-bottom: 1px solid #f1f5f9;
    }
    .tip-row:last-child { border-bottom: none; }
    .tip-icon {
        width: 30px; height: 30px;
        border-radius: 8px;
        background: #eef2ff;
        color: #6366f1;
        display: flex; align-items: center; justify-content: center;
        font-size: 13px; flex-shrink: 0;
    }
    .tip-title { font-size: 13px; font-weight: 600; color: #1e293b; margin-bottom: 2px; }
    .tip-sub   { font-size: 11px; color: #9ca3af; line-height: 1.5; }

    /* CATEGORY SIDEBAR LIST */
    .cat-list-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 12px 16px;
        border-bottom: 1px solid #f1f5f9;
    }
    .cat-list-item:last-child { border-bottom: none; }
    .cat-list-item strong { font-size: 13px; color: #1e293b; }
    .cat-list-item .sub   { font-size: 11px; color: #9ca3af; }
    .pts-badge {
        background: #eef2ff;
        color: #4f46e5;
        padding: 3px 10px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 600;
        white-space: nowrap;
        flex-shrink: 0;
    }

    /* INLINE NEW CATEGORY PANEL */
    .new-cat-panel {
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        border-radius: 8px;
        padding: 12px;
        margin-top: 10px;
        display: none;
    }
    .new-cat-panel.show { display: block; }

    /* GLOBAL CATEGORY PANEL */
    #globalCatPanel {
        display: none;
        background: #f8fafc;
        border-top: 1px solid #eef1f6;
        padding: 14px 16px;
    }
    #globalCatPanel.show { display: block; }

    /* SCALE LEGEND */
    .scale-legend-row {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 12px;
        margin-bottom: 6px;
        color: #6b7280;
    }
</style>

@section('content')
<div class="container">
    <div class="page-inner">
    {{-- PAGE HEADER --}}
    <div class="page-header">
        <h3 class="fw-bold mb-3">Blog Categories</h3>

        <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href="#"><i class="icon-home"></i></a>
            </li>

            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>

            <li class="nav-item">
                <a href="#">Blog System</a>
            </li>

            <li class="separator">
                <i class="icon-arrow-right"></i>
            </li>

            <li class="nav-item">
                <a href="#">Categories</a>
            </li>
        </ul>
    </div>

<div class="container-fluid">

    {{-- BREADCRUMB --}}
    <div class="breadcrumb-psych">
        <a href="{{ route('quiz-tests.index') }}"><i class="fas fa-brain me-1"></i>Tests</a>
        <span class="sep">/</span>
        <a href="{{ route('quiz-tests.show', $test->id) }}">{{ $test->test_name }}</a>
        <span class="sep">/</span>
        <span style="color:#6c757d;">Add Questions</span>
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

    <form action="{{ route('quiz-questions.store', $test->id) }}" method="POST" id="bulkForm">
    @csrf

    <div class="row g-4">

        {{-- ══════════════════════════════════════
             LEFT COL — Question Rows
        ══════════════════════════════════════ --}}
        <div class="col-lg-8">
            <div class="card psych-card">

                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5><i class="fas fa-question-circle me-2"></i>Questions</h5>
                    <div class="summary-chips">
                        <span class="chip">Q: <span id="qCount">1</span></span>
                        <span class="chip gold">Marks: <span id="marksCount">5</span></span>
                    </div>
                </div>

                <div class="card-body p-3" id="questionContainer">

                    {{-- First row --}}
                    <div class="question-row" id="row-0">
                        <button type="button" class="btn-remove-q" onclick="removeRow(0)" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                        <div class="d-flex align-items-start gap-3">
                            <span class="q-number">1</span>
                            <div class="flex-grow-1">

                                <div class="form-section-label">Question 1</div>

                                <div class="mb-3">
                                    <label class="form-label">
                                        Question Text <span class="text-danger">*</span>
                                    </label>
                                    <textarea name="questions[0][question_text]"
                                              rows="2"
                                              class="form-control"
                                              placeholder="e.g. I feel confident making decisions for a group."
                                              required></textarea>
                                </div>

                                <div class="mb-2">
                                    <label class="form-label">
                                        Assign to Category <span class="text-danger">*</span>
                                    </label>
                                    <select name="questions[0][category_id]"
                                            class="form-select cat-select" required>
                                        <option value="">— Select Category —</option>
                                        @foreach($categories as $cat)
                                            <option value="{{ $cat->id }}">
                                                {{ $cat->icon ?? '' }} {{ $cat->category_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="scale-visual">
                                    <span class="scale-dot">1</span>
                                    <span class="scale-dot">2</span>
                                    <span class="scale-dot">3</span>
                                    <span class="scale-dot">4</span>
                                    <span class="scale-dot">5</span>
                                    <small class="text-muted ms-2" style="font-size:11px;">
                                        = max 5 marks
                                    </small>
                                </div>

                            </div>
                        </div>
                    </div>

                </div><!-- /card-body -->

                <div class="card-footer bg-white border-top p-3">
                    <button type="button" class="btn-add-row" onclick="addRow()">
                        <i class="fas fa-plus me-2"></i>Add Another Question
                    </button>
                </div>

            </div><!-- /card -->

            <div class="d-flex gap-2 mt-3">
                <button type="submit" class="btn btn-purple px-4">
                    <i class="fas fa-save me-2"></i>Save All Questions
                </button>
                <a href="{{ route('quiz-tests.show', $test->id) }}"
                   class="btn btn-outline-secondary" style="font-size:13px;">
                    Cancel
                </a>
            </div>
        </div>

        {{-- ══════════════════════════════════════
             RIGHT COL — Sidebar
        ══════════════════════════════════════ --}}
        <div class="col-lg-4">

            {{-- Tips --}}
            <div class="card psych-card mb-3">
                <div class="card-header">
                    <h5><i class="fas fa-lightbulb me-2" style="color:#f59e0b;"></i>Writing Tips</h5>
                </div>
                <div>
                    <div class="tip-row">
                        <div class="tip-icon"><i class="fas fa-bullseye"></i></div>
                        <div>
                            <div class="tip-title">One idea per question</div>
                            <div class="tip-sub">Each question should test a single behaviour — avoid "and/or" in the question text.</div>
                        </div>
                    </div>
                    <div class="tip-row">
                        <div class="tip-icon"><i class="fas fa-child"></i></div>
                        <div>
                            <div class="tip-title">Keep it age-appropriate</div>
                            <div class="tip-sub">Use simple language a child aged {{ $test->age ?? '5–18' }} can understand easily.</div>
                        </div>
                    </div>
                    <div class="tip-row">
                        <div class="tip-icon"><i class="fas fa-layer-group"></i></div>
                        <div>
                            <div class="tip-title">Balance across categories</div>
                            <div class="tip-sub">Aim for 5–10 questions per category for reliable, balanced scoring.</div>
                        </div>
                    </div>
                    <div class="tip-row">
                        <div class="tip-icon"><i class="fas fa-star"></i></div>
                        <div>
                            <div class="tip-title">Scale is 1–5</div>
                            <div class="tip-sub">Never → Rarely → Sometimes → Often → Always. Each question adds 5 marks max.</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Categories card --}}
            <div class="card psych-card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5><i class="fas fa-layer-group me-2"></i>Categories</h5>
                    <div class="d-flex align-items-center gap-2">
                        <span class="chip" style="font-size:11px;">{{ $categories->count() }}</span>
                        <button type="button"
                                class="btn btn-sm btn-light fw-bold"
                                style="color:#6f42c1;font-size:12px;"
                                onclick="toggleGlobalPanel()">
                            <i class="fas fa-plus me-1"></i>New
                        </button>
                    </div>
                </div>

                {{-- Inline create --}}
                <div id="globalCatPanel">
                    <div class="form-section-label" style="padding: 0 0 6px;">
                        <i class="fas fa-plus-circle me-1"></i> New Category
                    </div>
                    <div class="mb-2">
                        <input type="text" class="form-control" id="globalCatName"
                               placeholder="Category name *">
                    </div>
                    <div class="mb-2">
                        <input type="text" class="form-control" id="globalCatDesc"
                               placeholder="Description (optional)">
                    </div>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-success btn-sm px-3"
                                onclick="saveGlobalCategory()">
                            <i class="fas fa-save me-1"></i>Save
                        </button>
                        <button type="button" class="btn btn-outline-secondary btn-sm"
                                onclick="document.getElementById('globalCatPanel').classList.remove('show')">
                            Cancel
                        </button>
                    </div>
                </div>

                {{-- List --}}
                <div id="catSidebarList">
                    @forelse($categories as $cat)
                        <div class="cat-list-item" id="catItem-{{ $cat->id }}">
                            <div>
                                <strong>{{ $cat->icon ?? '' }} {{ $cat->category_name }}</strong>
                                @if($cat->description)
                                    <div class="sub">{{ Str::limit($cat->description, 38) }}</div>
                                @endif
                            </div>
                            <span class="pts-badge">{{ $cat->total_marks ?? 0 }} pts</span>
                        </div>
                    @empty
                        <div class="text-center py-4" id="emptyCatNote">
                            <i class="fas fa-layer-group" style="font-size:24px;color:#e5e7eb;"></i>
                            <p style="font-size:12px;color:#9ca3af;margin-top:8px;">
                                No categories yet.<br>Create one above.
                            </p>
                        </div>
                    @endforelse
                </div>

                {{-- Scale legend --}}
                <div style="border-top:1px solid #eef1f6;padding:14px 16px;">
                    <div class="fw-bold mb-2" style="font-size:12px;color:#374151;">
                        <i class="fas fa-star me-1" style="color:#6f42c1;"></i>Rating Scale
                    </div>
                    @foreach(['Never','Rarely','Sometimes','Often','Always'] as $si => $sl)
                        <div class="scale-legend-row">
                            <span class="scale-dot">{{ $si + 1 }}</span>
                            <span>{{ $sl }}</span>
                        </div>
                    @endforeach
                    <div class="mt-2 pt-2" style="border-top:1px solid #f3f4f6;font-size:11px;color:#6b7280;">
                        Each question adds <strong style="color:#6f42c1;">5 marks</strong> to its category.
                    </div>
                </div>

            </div><!-- /categories card -->

        </div>

    </div>
    </form>

</div>
    </div>
@endsection

<script>
    const STORE_CAT  = '{{ route('quiz-categories.store', $test->id) }}';
    const CSRF_TOKEN = '{{ csrf_token() }}';

    let rowIndex = 1;
    let rowCount = 1;

    let allCategories = {!! json_encode($categories->map(function($c) {
        return ['id' => $c->id, 'category_name' => $c->category_name, 'icon' => $c->icon ?? ''];
    })->values()) !!};

    /* ── ADD ROW ── */
    function addRow() {
        const idx = rowIndex++;
        rowCount++;
        const div = document.createElement('div');
        div.className = 'question-row';
        div.id = 'row-' + idx;
        div.innerHTML = buildRowHTML(idx);
        document.getElementById('questionContainer').appendChild(div);
        refreshNumbers();
        refreshSummary();
    }

    function buildRowHTML(idx) {
        const opts = allCategories.map(c =>
            `<option value="${c.id}">${c.icon ? c.icon + ' ' : ''}${c.category_name}</option>`
        ).join('');

        return `
            <button type="button" class="btn-remove-q" onclick="removeRow(${idx})" title="Remove">
                <i class="fas fa-times"></i>
            </button>
            <div class="d-flex align-items-start gap-3">
                <span class="q-number">?</span>
                <div class="flex-grow-1">
                    <div class="form-section-label">Question ${idx + 1}</div>
                    <div class="mb-3">
                        <label class="form-label">Question Text <span class="text-danger">*</span></label>
                        <textarea name="questions[${idx}][question_text]" rows="2"
                                  class="form-control"
                                  placeholder="Type your question here..." required></textarea>
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Assign to Category <span class="text-danger">*</span></label>
                        <select name="questions[${idx}][category_id]"
                                class="form-select cat-select" required>
                            <option value="">— Select Category —</option>
                            ${opts}
                        </select>
                    </div>
                    <div class="scale-visual">
                        <span class="scale-dot">1</span>
                        <span class="scale-dot">2</span>
                        <span class="scale-dot">3</span>
                        <span class="scale-dot">4</span>
                        <span class="scale-dot">5</span>
                        <small class="text-muted ms-2" style="font-size:11px;">= max 5 marks</small>
                    </div>
                </div>
            </div>`;
    }

    /* ── REMOVE ROW ── */
    function removeRow(idx) {
        if (rowCount <= 1) return;
        const row = document.getElementById('row-' + idx);
        if (!row) return;
        row.classList.add('removing');
        setTimeout(() => {
            row.remove();
            rowCount--;
            refreshNumbers();
            refreshSummary();
        }, 250);
    }

    /* ── REFRESH ── */
    function refreshNumbers() {
        document.querySelectorAll('#questionContainer .question-row').forEach((row, i) => {
            const num = row.querySelector('.q-number');
            const lbl = row.querySelector('.form-section-label');
            if (num) num.textContent = i + 1;
            if (lbl) lbl.textContent = 'Question ' + (i + 1);
        });
    }
    function refreshSummary() {
        document.getElementById('qCount').textContent    = rowCount;
        document.getElementById('marksCount').textContent = rowCount * 5;
    }

    /* ── GLOBAL CATEGORY PANEL ── */
    function toggleGlobalPanel() {
        document.getElementById('globalCatPanel').classList.toggle('show');
    }

    function saveGlobalCategory() {
        const nameEl = document.getElementById('globalCatName');
        const descEl = document.getElementById('globalCatDesc');
        const name   = nameEl.value.trim();
        const desc   = descEl.value.trim();

        if (!name) { nameEl.classList.add('is-invalid'); nameEl.focus(); return; }
        nameEl.classList.remove('is-invalid');

        postCategory(name, desc).then(cat => {
            if (!cat) return;
            document.querySelectorAll('select.cat-select').forEach(s => appendOption(s, cat));
            addToSidebar(cat);
            nameEl.value = '';
            descEl.value = '';
            document.getElementById('globalCatPanel').classList.remove('show');
        });
    }

    /* ── POST CATEGORY ── */
    function postCategory(name, desc) {
        return fetch(STORE_CAT, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': CSRF_TOKEN,
                'Accept': 'application/json',
            },
            body: JSON.stringify({ category_name: name, description: desc })
        })
        .then(r => { if (!r.ok) throw new Error('Server error ' + r.status); return r.json(); })
        .then(data => {
            if (data.success) { allCategories.push(data.category); return data.category; }
            alert('Could not save: ' + (data.message || 'Name may already exist.'));
            return null;
        })
        .catch(err => { alert('Error: ' + err.message); return null; });
    }

    /* ── HELPERS ── */
    function appendOption(select, cat) {
        if (select.querySelector(`option[value="${cat.id}"]`)) return;
        const opt = document.createElement('option');
        opt.value = cat.id;
        opt.textContent = (cat.icon ? cat.icon + ' ' : '') + cat.category_name;
        select.appendChild(opt);
    }

    function addToSidebar(cat) {
        const empty = document.getElementById('emptyCatNote');
        if (empty) empty.remove();
        const div = document.createElement('div');
        div.className = 'cat-list-item';
        div.id = 'catItem-' + cat.id;
        div.innerHTML = `
            <div>
                <strong>${cat.icon ? cat.icon + ' ' : ''}${cat.category_name}</strong>
                ${cat.description ? `<div class="sub">${cat.description.substring(0, 38)}</div>` : ''}
            </div>
            <span class="pts-badge">0 pts</span>`;
        document.getElementById('catSidebarList').appendChild(div);
    }
</script>