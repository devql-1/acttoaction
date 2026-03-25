@extends('backend.layout.app')

@section('title', 'Page Categories')

@section('breadcrumb')
    <a href="{{ route('admin.testimonials.index') }}">Testimonial Videos</a>
    <span class="crumb-sep">/</span>
    <span class="crumb-current">Page Categories</span>
@endsection

@push('styles')
    <style>
        .page-header {
            margin-bottom: 24px;
        }

        .page-header h1 {
            font-size: 22px;
            font-weight: 800;
            margin-bottom: 4px;
        }

        .page-header p {
            font-size: 13.5px;
            color: var(--muted);
        }

        .two-col {
            display: grid;
            grid-template-columns: 1fr 380px;
            gap: 24px;
            align-items: start;
        }

        @media(max-width:960px) {
            .two-col {
                grid-template-columns: 1fr;
            }
        }

        .panel {
            background: var(--surface);
            border-radius: var(--radius);
            border: 1px solid var(--border);
            box-shadow: var(--shadow);
            overflow: hidden;
        }

        .panel-header {
            padding: 16px 22px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .panel-title {
            font-size: 15px;
            font-weight: 700;
        }

        /* cat list */
        .cat-list {
            padding: 8px 0;
        }

        .cat-row {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 13px 22px;
            border-bottom: 1px solid var(--border);
            transition: background .15s;
        }

        .cat-row:last-child {
            border-bottom: none;
        }

        .cat-row:hover {
            background: #f9fbff;
        }

        .cat-icon {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: var(--brand-light);
            color: var(--brand);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            flex-shrink: 0;
        }

        .cat-info {
            flex: 1;
            min-width: 0;
        }

        .cat-name {
            font-size: 14px;
            font-weight: 700;
            color: var(--text);
        }

        .cat-slug {
            font-size: 11px;
            color: var(--muted);
            font-family: monospace;
        }

        .cat-count {
            font-size: 11px;
            font-weight: 700;
            padding: 2px 9px;
            border-radius: 20px;
            background: var(--brand-light);
            color: var(--brand);
        }

        .cat-actions {
            display: flex;
            gap: 6px;
        }

        .cat-btn {
            width: 30px;
            height: 30px;
            border-radius: 7px;
            border: 1.5px solid var(--border);
            background: var(--surface);
            color: var(--muted);
            font-size: 13px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all .2s;
        }

        .cat-btn:hover {
            border-color: var(--brand);
            color: var(--brand);
            background: var(--brand-light);
        }

        .cat-btn.danger:hover {
            border-color: var(--danger);
            color: var(--danger);
            background: #fef2f2;
        }

        /* form fields */
        .field {
            margin-bottom: 16px;
        }

        .field label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .field input,
        .field textarea,
        .field select {
            width: 100%;
            padding: 9px 13px;
            border-radius: 8px;
            border: 1.5px solid var(--border);
            font-size: 13.5px;
            font-family: var(--font);
            color: var(--text);
            outline: none;
            transition: border-color .2s;
        }

        .field input:focus,
        .field textarea:focus {
            border-color: var(--brand);
            box-shadow: 0 0 0 3px rgba(23, 92, 221, .08);
        }

        .field .hint {
            font-size: 11px;
            color: var(--muted);
            margin-top: 4px;
        }

        .field .field-error {
            font-size: 11.5px;
            color: var(--danger);
            margin-top: 4px;
        }

        .toggle {
            position: relative;
            width: 38px;
            height: 22px;
        }

        .toggle input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .toggle-slider {
            position: absolute;
            inset: 0;
            border-radius: 22px;
            background: #e2e8f0;
            cursor: pointer;
            transition: background .2s;
        }

        .toggle-slider::before {
            content: "";
            position: absolute;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            background: #fff;
            top: 3px;
            left: 3px;
            transition: transform .2s;
            box-shadow: 0 1px 4px rgba(0, 0, 0, .2);
        }

        .toggle input:checked+.toggle-slider {
            background: var(--success);
        }

        .toggle input:checked+.toggle-slider::before {
            transform: translateX(16px);
        }

        .form-footer {
            padding: 16px 22px;
            border-top: 1px solid var(--border);
            display: flex;
            gap: 10px;
            background: #fafbff;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 9px 20px;
            border-radius: 9px;
            background: var(--brand);
            color: #fff;
            border: none;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            font-family: var(--font);
            transition: all .2s;
        }

        .btn-primary:hover {
            background: var(--brand-dark);
        }

        .btn-secondary {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 9px 16px;
            border-radius: 9px;
            background: var(--surface);
            color: var(--muted);
            border: 1.5px solid var(--border);
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            font-family: var(--font);
            transition: all .2s;
        }

        .btn-secondary:hover {
            border-color: var(--brand);
            color: var(--brand);
        }

        .empty-state {
            text-align: center;
            padding: 48px 20px;
            color: var(--muted);
        }

        .empty-state i {
            font-size: 44px;
            opacity: .25;
            display: block;
            margin-bottom: 12px;
        }

        .empty-state p {
            font-size: 13px;
        }

        .slug-preview {
            font-family: monospace;
            font-size: 12px;
            color: var(--brand);
            margin-top: 5px;
        }
    </style>
@endpush

@section('content')

    <div class="page-header">
        <h1>Page Categories</h1>
        <p>Define the pages of your site. Each page gets its own unique set of testimonial videos in the carousel.</p>
    </div>

    <div class="two-col">

        {{-- Left: List --}}
        <div class="panel">
            <div class="panel-header">
                <span class="panel-title">All Categories ({{ $categories->total() }})</span>
            </div>

            @if ($categories->isEmpty())
                <div class="empty-state">
                    <i class="bi bi-collection"></i>
                    <p>No categories yet. Create your first page category →</p>
                </div>
            @else
                <div class="cat-list">
                    @foreach ($categories as $cat)
                        <div class="cat-row" id="catRow{{ $cat->id }}">
                            <div class="cat-icon"><i class="bi bi-file-earmark-text"></i></div>
                            <div class="cat-info">
                                <div class="cat-name">{{ $cat->name }}</div>
                                <div class="cat-slug">/{{ $cat->slug }}</div>
                            </div>
                            <span class="cat-count">{{ $cat->testimonial_videos_count }} videos</span>
                            <div style="display:flex;align-items:center;gap:6px">
                                <label class="toggle" title="Toggle active">
                                    <input type="checkbox" {{ $cat->is_active ? 'checked' : '' }}
                                        onchange="toggleCat({{ $cat->id }}, this)" />
                                    <span class="toggle-slider"></span>
                                </label>
                            </div>
                            <div class="cat-actions">
                                <button class="cat-btn"
                                    onclick="editCat({{ $cat->id }}, '{{ addslashes($cat->name) }}', '{{ $cat->slug }}', '{{ addslashes($cat->description ?? '') }}', {{ $cat->sort_order }}, {{ $cat->is_active ? 'true' : 'false' }})"
                                    title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button class="cat-btn danger"
                                    onclick="deleteCat({{ $cat->id }}, '{{ addslashes($cat->name) }}')"
                                    title="Delete">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if ($categories->hasPages())
                    <div style="padding:14px 22px;border-top:1px solid var(--border)">
                        {{ $categories->links() }}
                    </div>
                @endif
            @endif
        </div>

        {{-- Right: Create / Edit form --}}
        <div class="panel" id="catFormPanel">
            <div class="panel-header">
                <span class="panel-title" id="catFormTitle">Create New Category</span>
            </div>
            <form id="catForm" method="POST" action="{{ route('admin.testimonials.categories.store') }}">
                @csrf
                <input type="hidden" name="_method" id="catFormMethod" value="POST" />
                <input type="hidden" name="_cat_id" id="catFormId" value="" />

                <div style="padding:20px 22px">

                    <div class="field">
                        <label for="catName">Page Name <span style="color:var(--danger)">*</span></label>
                        <input type="text" id="catName" name="name" placeholder="e.g. Acting Course"
                            oninput="autoSlug(this.value)" required />
                        @error('name')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="catSlug">
                            Slug <span style="color:var(--danger)">*</span>
                        </label>
                        <input type="text" id="catSlug" name="slug" placeholder="acting-course"
                            pattern="[a-z0-9\-]+" title="Lowercase letters, numbers and hyphens only" required />
                        <div class="hint">Used in API: <span class="slug-preview"
                                id="slugPreview">/api/testimonials/acting-course</span></div>
                        @error('slug')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="catDesc">Description</label>
                        <textarea id="catDesc" name="description" rows="3" placeholder="Optional description…"></textarea>
                    </div>

                    <div class="field">
                        <label for="catOrder">Sort Order</label>
                        <input type="number" id="catOrder" name="sort_order" value="0" min="0" />
                    </div>

                    <div style="display:flex;align-items:center;justify-content:space-between;padding-top:8px">
                        <div>
                            <div style="font-size:13.5px;font-weight:600;color:var(--text)">Active</div>
                            <div style="font-size:11.5px;color:var(--muted)">Inactive pages won't appear in API</div>
                        </div>
                        <label class="toggle">
                            <input type="checkbox" id="catActive" name="is_active" value="1" checked />
                            <span class="toggle-slider"></span>
                        </label>
                    </div>

                </div>

                <div class="form-footer">
                    <button type="submit" class="btn-primary" id="catSubmitBtn">
                        <i class="bi bi-plus-lg"></i> Create Category
                    </button>
                    <button type="button" class="btn-secondary" id="catCancelBtn" onclick="resetCatForm()"
                        style="display:none">
                        Cancel
                    </button>
                </div>
            </form>
        </div>

    </div>
@endsection

@push('scripts')
    <script>
        const CSRF = document.querySelector('meta[name="csrf-token"]').content;

        function autoSlug(val) {
            const slug = val.toLowerCase().trim()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');
            document.getElementById('catSlug').value = slug;
            document.getElementById('slugPreview').textContent = `/api/testimonials/${slug || '…'}`;
        }

        document.getElementById('catSlug').addEventListener('input', function() {
            document.getElementById('slugPreview').textContent =
                `/api/testimonials/${this.value || '…'}`;
        });

        function editCat(id, name, slug, desc, order, active) {
            document.getElementById('catFormTitle').textContent = 'Edit Category';
            document.getElementById('catFormMethod').value = 'PUT';
            document.getElementById('catFormId').value = id;
            document.getElementById('catForm').action = `/admin/page-categories/${id}`;
            document.getElementById('catName').value = name;
            document.getElementById('catSlug').value = slug;
            document.getElementById('catDesc').value = desc;
            document.getElementById('catOrder').value = order;
            document.getElementById('catActive').checked = active;
            document.getElementById('catSubmitBtn').innerHTML = '<i class="bi bi-check-lg"></i> Save Changes';
            document.getElementById('catCancelBtn').style.display = 'inline-flex';
            document.getElementById('slugPreview').textContent = `/api/testimonials/${slug}`;
            document.getElementById('catFormPanel').scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }

        function resetCatForm() {
            document.getElementById('catFormTitle').textContent = 'Create New Category';
            document.getElementById('catFormMethod').value = 'POST';
            document.getElementById('catFormId').value = '';
            document.getElementById('catForm').action = '{{ route('admin.testimonials.categories.store') }}';
            document.getElementById('catForm').reset();
            document.getElementById('catSubmitBtn').innerHTML = '<i class="bi bi-plus-lg"></i> Create Category';
            document.getElementById('catCancelBtn').style.display = 'none';
            document.getElementById('slugPreview').textContent = '/api/testimonials/…';
        }

        function toggleCat(id, checkbox) {
            fetch(`/admin/page-categories/${id}/toggle`, {
                    method: 'PATCH',
                    headers: {
                        'X-CSRF-TOKEN': CSRF,
                        'Accept': 'application/json'
                    }
                })
                .then(r => r.json())
                .catch(() => {
                    checkbox.checked = !checkbox.checked;
                });
        }

        function deleteCat(id, name) {
            if (!confirm(`Delete category "${name}"? This will also remove all its videos.`)) return;
            fetch(`/admin/page-categories/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': CSRF,
                        'Accept': 'application/json'
                    }
                })
                .then(r => r.json())
                .then(() => {
                    const row = document.getElementById(`catRow${id}`);
                    if (row) {
                        row.style.opacity = '0';
                        setTimeout(() => row.remove(), 300);
                    }
                })
                .catch(() => alert('Delete failed'));
        }
    </script>
@endpush
