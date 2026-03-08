{{-- resources/views/backend/psych/questions/create.blade.php --}}
@extends('backend.layout.app')
{{-- @section('title', 'Add Questions') --}}


<style>
    /* PAGE BACKGROUND */
    body {
        background: #f5f6fa;
    }

    /* CARD DESIGN */
    .psych-card {
        border: none;
        border-radius: 14px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.06);
        overflow: hidden;
        background: #fff;
    }

    /* CARD HEADER */
    .psych-card .card-header {
        background: #ffffff;
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
        background: #ffffff;
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

    /* SUMMARY CHIPS */
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

    .chip.gold {
        background: #fef3c7;
        color: #92400e;
    }

    /* QUESTION ROW */
    .question-row {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        padding: 18px;
        margin-bottom: 12px;
        position: relative;
        transition: all .2s ease;
    }

    .question-row:hover {
        border-color: #c7d2fe;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
    }

    .q-number {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: #6366f1;
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        font-weight: 600;
    }

    /* REMOVE BUTTON */
    .btn-remove-q {
        position: absolute;
        top: 10px;
        right: 10px;
        width: 28px;
        height: 28px;
        border-radius: 50%;
        background: #fee2e2;
        color: #dc2626;
        border: none;
        font-size: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
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
        box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.1);
    }

    /* SCALE DOTS */
    .scale-visual {
        display: flex;
        gap: 6px;
        align-items: center;
        margin-top: 10px;
    }

    .scale-dot {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: #eef2ff;
        border: 1px solid #c7d2fe;
        color: #4f46e5;
        font-size: 11px;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* ADD ROW BUTTON */
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
    }

    .btn-add-row:hover {
        background: #eef2ff;
        border-color: #6366f1;
    }

    /* SAVE BUTTON */
    .btn-purple {
        background: #6366f1;
        border: none;
        border-radius: 8px;
        padding: 8px 18px;
        font-size: 13px;
        font-weight: 600;
    }

    .btn-purple:hover {
        background: #4f46e5;
    }

    /* CATEGORY SIDEBAR */
    .cat-list-item {
        display: flex;
        justify-content: space-between;
        padding: 12px 16px;
        border-bottom: 1px solid #f1f5f9;
    }

    .cat-list-item strong {
        font-size: 13px;
        color: #1e293b;
    }

    .cat-list-item .sub {
        font-size: 11px;
        color: #9ca3af;
    }

    /* POINT BADGE */
    .pts-badge {
        background: #eef2ff;
        color: #4f46e5;
        padding: 3px 10px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 600;
    }

    /* INLINE CATEGORY PANEL */
    .new-cat-panel {
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        border-radius: 8px;
        padding: 12px;
        margin-top: 10px;
        display: none;
    }

    .new-cat-panel.show {
        display: block;
    }

    /* GLOBAL CATEGORY PANEL */
    #globalCatPanel {
        display: none;
        background: #f8fafc;
        border-top: 1px solid #eef1f6;
        padding: 14px;
    }

    #globalCatPanel.show {
        display: block;
    }

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
    <div class="container-fluid">

        <div class="breadcrumb-psych">
            <a href="{{ route('quiz-tests.index') }}"><i class="fas fa-brain me-1"></i>Tests</a>
            <span class="sep">/</span>
            <a href="{{ route('quiz-tests.show', $test->id) }}">{{ $test->test_name }}</a>
            <span class="sep">/</span>
            <span style="color:#6c757d;">Add Questions</span>
        </div>

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

                {{-- ══════════════════════════════════
                LEFT COL: Question rows
                ══════════════════════════════════ --}}
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

                            {{-- ── First row (Blade rendered) ── --}}
                            <div class="question-row" id="row-0">
                                <button type="button" class="btn-remove-q" onclick="removeRow(0)">
                                    <i class="fas fa-times"></i>
                                </button>
                                <div class="d-flex align-items-start gap-3">
                                    <span class="q-number">1</span>
                                    <div class="flex-grow-1">
                                        <div class="mb-3">
                                            <label class="form-label">Question Text <span
                                                    class="text-danger">*</span></label>
                                            <textarea name="questions[0][question_text]" rows="2" class="form-control"
                                                placeholder="e.g. I feel confident making decisions for a group."
                                                required></textarea>
                                        </div>
                                        <div>
                                            <label class="form-label">Assign to Category <span
                                                    class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <select name="questions[0][category_id]" class="form-select cat-select"
                                                    required>
                                                    <option value="">— Select Category —</option>
                                                    @foreach($categories as $cat)
                                                        <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                                                    @endforeach
                                                </select>
                                                {{-- <button type="button" class="btn btn-outline-success"
                                                    onclick="togglePanel(this)"
                                                    style="border-radius:0 6px 6px 0; padding:6px 12px;">
                                                    <i class="fas fa-plus"></i>
                                                </button> --}}
                                            </div>
                                            <div class="new-cat-panel">
                                                <div class="panel-title"><i class="fas fa-plus-circle me-1"></i>Create New
                                                    Category</div>
                                                <div class="row g-2 mb-2">
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control nc-name"
                                                            placeholder="Category name *">
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control nc-desc"
                                                            placeholder="Description (optional)">
                                                    </div>
                                                </div>
                                                <div class="d-flex gap-2">
                                                    <button type="button" class="btn btn-success btn-sm px-3"
                                                        onclick="saveInlineCat(this)">
                                                        <i class="fas fa-save me-1"></i>Save
                                                    </button>
                                                    <button type="button" class="btn btn-outline-secondary btn-sm"
                                                        onclick="this.closest('.new-cat-panel').classList.remove('show')">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="scale-visual">
                                            <span class="scale-dot">1</span><span class="scale-dot">2</span>
                                            <span class="scale-dot">3</span><span class="scale-dot">4</span>
                                            <span class="scale-dot">5</span>
                                            <small class="text-muted ms-2" style="font-size:11px;">= max 5 marks</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div><!-- /card-body -->

                        <div class="card-footer bg-white border-0 p-3">
                            <button type="button" class="btn-add-row" onclick="addRow()">
                                <i class="fas fa-plus me-2"></i>Add Another Question
                            </button>
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-3">
                        <button type="submit" class="btn btn-purple px-4">
                            <i class="fas fa-save me-2"></i>Save All Questions
                        </button>
                        <a href="{{ route('quiz-tests.show', $test->id) }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </div>

                {{-- ══════════════════════════════════
                RIGHT COL: Sidebar
                ══════════════════════════════════ --}}
                <div class="col-lg-4">

                    {{-- Categories card --}}
                    <div class="card psych-card mb-3">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5><i class="fas fa-layer-group me-2"></i>Categories</h5>
                            <button type="button" class="btn btn-sm btn-light fw-bold"
                                style="color:#6f42c1; font-size:12px;" onclick="toggleGlobalPanel()">
                                <i class="fas fa-plus me-1"></i>New
                            </button>
                        </div>

                        {{-- Inline create form --}}
                        <div id="globalCatPanel">
                            <div class="panel-title"><i class="fas fa-plus-circle me-1"></i>New Category</div>
                            <div class="mb-2">
                                <input type="text" class="form-control" id="globalCatName" placeholder="Category name *">
                            </div>
                            <div class="mb-2">
                                <input type="text" class="form-control" id="globalCatDesc"
                                    placeholder="Description (optional)">
                            </div>
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-success btn-sm px-3" onclick="saveGlobalCategory()">
                                    <i class="fas fa-save me-1"></i>Save
                                </button>
                                <button type="button" class="btn btn-outline-secondary btn-sm"
                                    onclick="document.getElementById('globalCatPanel').classList.remove('show')">Cancel</button>
                            </div>
                        </div>

                        {{-- List --}}
                        <div id="catSidebarList">
                            @forelse($categories as $cat)
                                <div class="cat-list-item" id="catItem-{{ $cat->id }}">
                                    <div>
                                        <strong>{{ $cat->category_name }}</strong>
                                        @if($cat->description)
                                            <div class="sub">{{ Str::limit($cat->description, 38) }}</div>
                                        @endif
                                    </div>
                                    <span class="pts-badge">{{ $cat->total_marks }} pts</span>
                                </div>
                            @empty
                                <div class="empty-cats" id="emptyCatNote">
                                    <i class="fas fa-layer-group"></i>
                                    <small>No categories yet.<br>Create one above.</small>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    {{-- Scale legend --}}
                    <div class="card psych-card">
                        <div class="card-body py-3 px-4">
                            <div class="fw-bold mb-2" style="font-size:13px;">
                                <i class="fas fa-star me-1" style="color:#6f42c1;"></i>Rating Scale
                            </div>
                            @foreach(['Strongly Disagree', 'Disagree', 'Neutral', 'Agree', 'Strongly Agree'] as $si => $sl)
                                <div class="scale-legend-row">
                                    <span class="scale-dot">{{ $si + 1 }}</span>
                                    <span>{{ $sl }}</span>
                                </div>
                            @endforeach
                            <div class="mt-2 pt-2" style="border-top:1px solid #f3f4f6; font-size:12px; color:#6b7280;">
                                Each question adds <strong style="color:#6f42c1;">5 marks</strong> to its category
                                automatically.
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
@endsection


<script>
    const STORE_CAT = '{{ route('quiz-categories.store', $test->id) }}';
    const CSRF_TOKEN = '{{ csrf_token() }}';

    let rowIndex = 1;   // always incrementing, never reused
    let rowCount = 1;   // visible rows count

    // Seeded from Blade, updated live when new categories are created
    let allCategories = @json($categories->map(fn($c) => ['id' => $c->id, 'category_name' => $c->category_name]));

    /* ─────────────────────────────────────
       ADD ROW
    ───────────────────────────────────── */
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
            `<option value="${c.id}">${c.category_name}</option>`
        ).join('');

        return `
            <button type="button" class="btn-remove-q" onclick="removeRow(${idx})">
                <i class="fas fa-times"></i>
            </button>
            <div class="d-flex align-items-start gap-3">
                <span class="q-number">?</span>
                <div class="flex-grow-1">
                    <div class="mb-3">
                        <label class="form-label">Question Text <span class="text-danger">*</span></label>
                        <textarea name="questions[${idx}][question_text]" rows="2" class="form-control"
                            placeholder="Type your question here..." required></textarea>
                    </div>
                    <div>
                        <label class="form-label">Assign to Category <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <select name="questions[${idx}][category_id]" class="form-select cat-select" required>
                                <option value="">— Select Category —</option>
                                ${opts}
                            </select>
                            <button type="button" class="btn btn-outline-success"
                                onclick="togglePanel(this)"
                                style="border-radius:0 6px 6px 0; padding:6px 12px;">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                        <div class="new-cat-panel">
                            <div class="panel-title"><i class="fas fa-plus-circle me-1"></i>Create New Category</div>
                            <div class="row g-2 mb-2">
                                <div class="col-sm-6">
                                    <input type="text" class="form-control nc-name" placeholder="Category name *">
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control nc-desc" placeholder="Description (optional)">
                                </div>
                            </div>
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-success btn-sm px-3" onclick="saveInlineCat(this)">
                                    <i class="fas fa-save me-1"></i>Save
                                </button>
                                <button type="button" class="btn btn-outline-secondary btn-sm"
                                    onclick="this.closest('.new-cat-panel').classList.remove('show')">Cancel</button>
                            </div>
                        </div>
                    </div>
                    <div class="scale-visual">
                        <span class="scale-dot">1</span><span class="scale-dot">2</span>
                        <span class="scale-dot">3</span><span class="scale-dot">4</span>
                        <span class="scale-dot">5</span>
                        <small class="text-muted ms-2" style="font-size:11px;">= max 5 marks</small>
                    </div>
                </div>
            </div>`;
    }

    /* ─────────────────────────────────────
       REMOVE ROW
    ───────────────────────────────────── */
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

    /* ─────────────────────────────────────
       REFRESH UI
    ───────────────────────────────────── */
    function refreshNumbers() {
        document.querySelectorAll('#questionContainer .question-row .q-number').forEach((el, i) => {
            el.textContent = i + 1;
        });
    }
    function refreshSummary() {
        document.getElementById('qCount').textContent = rowCount;
        document.getElementById('marksCount').textContent = rowCount * 5;
    }

    /* ─────────────────────────────────────
       TOGGLE INLINE PANEL (per row)
    ───────────────────────────────────── */
    function togglePanel(btn) {
        const panel = btn.closest('.input-group').parentElement.querySelector('.new-cat-panel');
        if (panel) panel.classList.toggle('show');
    }

    /* ─────────────────────────────────────
       SAVE INLINE CATEGORY
    ───────────────────────────────────── */
    function saveInlineCat(btn) {
        const panel = btn.closest('.new-cat-panel');
        const nameEl = panel.querySelector('.nc-name');
        const descEl = panel.querySelector('.nc-desc');
        const name = nameEl.value.trim();
        const desc = descEl.value.trim();

        if (!name) { nameEl.classList.add('is-invalid'); nameEl.focus(); return; }
        nameEl.classList.remove('is-invalid');

        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i>Saving...';

        postCategory(name, desc)
            .then(cat => {
                if (!cat) return;
                // Add to THIS row's select and auto-select it
                const select = panel.closest('div').querySelector('select.cat-select');
                appendOption(select, cat);
                select.value = cat.id;
                // Add to all other selects
                document.querySelectorAll('select.cat-select').forEach(s => {
                    if (s !== select) appendOption(s, cat);
                });
                addToSidebar(cat);
                nameEl.value = '';
                descEl.value = '';
                panel.classList.remove('show');
            })
            .finally(() => {
                btn.disabled = false;
                btn.innerHTML = '<i class="fas fa-save me-1"></i>Save';
            });
    }

    /* ─────────────────────────────────────
       TOGGLE + SAVE GLOBAL CATEGORY
    ───────────────────────────────────── */
    function toggleGlobalPanel() {
        const p = document.getElementById('globalCatPanel');
        p.classList.toggle('show');
        if (p.classList.contains('show')) document.getElementById('globalCatPanel').focus();
    }

    function saveGlobalCategory() {
        const nameEl = document.getElementById('globalCatName');
        const descEl = document.getElementById('globalCatDesc');
        const name = nameEl.value.trim();
        const desc = descEl.value.trim();

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

    /* ─────────────────────────────────────
       SHARED: POST TO SERVER
    ───────────────────────────────────── */
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
            .then(r => {
                if (!r.ok) throw new Error('Server error ' + r.status);
                return r.json();
            })
            .then(data => {
                if (data.success) {
                    allCategories.push(data.category);
                    return data.category;
                }
                alert('Could not save: ' + (data.message || 'Name may already exist.'));
                return null;
            })
            .catch(err => { alert('Error: ' + err.message); return null; });
    }

    /* ─────────────────────────────────────
       HELPERS
    ───────────────────────────────────── */
    function appendOption(select, cat) {
        if (select.querySelector(`option[value="${cat.id}"]`)) return; // no duplicates
        const opt = document.createElement('option');
        opt.value = cat.id;
        opt.textContent = cat.category_name;
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
                    <strong>${cat.category_name}</strong>
                    ${cat.description ? `<div class="sub">${cat.description.substring(0, 38)}</div>` : ''}
                </div>
                <span class="pts-badge">0 pts</span>`;
        document.getElementById('catSidebarList').appendChild(div);
    }
</script>