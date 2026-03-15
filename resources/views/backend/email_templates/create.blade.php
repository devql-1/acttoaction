@extends('backend.layout.app')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Create Email Template</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item">
                        <a href="{{ route('email-templates.index') }}">Email Templates</a>
                    </li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="#">Create</a></li>
                </ul>
            </div>

            <div class="row">

                {{-- ── Form ── --}}
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Template Details</div>
                        </div>

                        <form action="{{ route('email-templates.store') }}" method="POST" id="templateForm">
                            @csrf

                            {{-- Hidden variables JSON --}}
                            <input type="hidden" name="variables" id="variablesInput">

                            <div class="card-body">

                                {{-- Name --}}
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label>Name <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            placeholder="e.g. Enrollment Confirmation" value="{{ old('name') }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">
                                            Slug auto-generates from name — used in code to call this template.
                                        </small>
                                    </div>
                                </div>

                                {{-- Category --}}
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label>Category <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-9">
                                        <select name="category" class="form-control @error('category') is-invalid @enderror"
                                            required>
                                            <option value="">-- Select Category --</option>
                                            <option value="enrollment"
                                                {{ old('category') === 'enrollment' ? 'selected' : '' }}>Enrollment</option>
                                            <option value="payment" {{ old('category') === 'payment' ? 'selected' : '' }}>
                                                Payment</option>
                                            <option value="volunteer"
                                                {{ old('category') === 'volunteer' ? 'selected' : '' }}>Volunteer</option>
                                            <option value="event" {{ old('category') === 'event' ? 'selected' : '' }}>
                                                Event</option>
                                            <option value="general" {{ old('category') === 'general' ? 'selected' : '' }}>
                                                General</option>
                                        </select>
                                        @error('category')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Subject --}}
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label>Subject <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="subject"
                                            class="form-control @error('subject') is-invalid @enderror"
                                            placeholder="e.g. Your enrollment is confirmed — @{{ course_name }}"
                                            value="{{ old('subject') }}" required>

                                        {{-- Also fix the alert info box --}}
                                        <small class="text-muted">
                                            You can use <code>@{{ variable_key }}</code> in subject too.
                                        </small>
                                    </div>
                                </div>

                                {{-- Body --}}
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label>Body <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-9">
                                        <textarea name="body" id="bodyEditor" class="form-control @error('body') is-invalid @enderror" rows="14">{{ old('body') }}</textarea>
                                        @error('body')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Status --}}
                                <div class="form-group row">
                                    <div class="col-md-3"><label>Status</label></div>
                                    <div class="col-md-9">
                                        <div class="form-check form-switch mt-1">
                                            <input class="form-check-input" type="checkbox" name="is_active" id="is_active"
                                                checked>
                                            <label class="form-check-label" for="is_active">
                                                Active
                                            </label>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="card-action d-flex justify-content-between">
                                <a href="{{ route('email-templates.index') }}" class="btn btn-secondary">
                                    <i class="fa fa-arrow-left me-1"></i> Back
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="fa fa-save me-1"></i> Save Template
                                </button>
                            </div>

                        </form>
                    </div>
                </div>

                {{-- ── Variables panel ── --}}
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Template Variables</div>
                        </div>
                        <div class="card-body">

                            <p class="text-muted" style="font-size:12px;">
                                Define the variables you will use inside the subject or body.
                                e.g. add key <code>student_name</code> then write
                                <code>@{{ student_name }}</code> in the body.
                            </p>

                            {{-- Variable rows --}}
                            <div id="variablesContainer"></div>

                            <button type="button" class="btn btn-outline-primary btn-sm w-100 mt-1"
                                onclick="addVariableRow()">
                                <i class="fa fa-plus me-1"></i> Add Variable
                            </button>

                            {{-- Live preview --}}
                            <div id="variablePreview" class="mt-3" style="display:none;">
                                <div
                                    style="font-size:11px;font-weight:700;color:#6b7a99;
                                        text-transform:uppercase;letter-spacing:.5px;
                                        margin-bottom:8px;">
                                    Defined Variables
                                    <small class="text-muted fw-normal ms-1">(click to copy)</small>
                                </div>
                                <div id="previewList"></div>
                            </div>

                            <div class="alert alert-info p-2 mt-3" style="font-size:12px;">
                                <i class="fa fa-info-circle me-1"></i>
                                Pass real values in code like:
                                <pre
                                    style="font-size:10px;margin:6px 0 0;background:#e8f0fe;
                                        padding:6px;border-radius:4px;overflow-x:auto;">app(EmailService::class)
  ->send('slug', $email, [
    'key' => 'value',
  ]);</pre>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- CKEditor --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    {{-- SweetAlert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        /* ── CKEditor ── */
        let editor; // ← capture the instance

        ClassicEditor.create(document.querySelector('#bodyEditor'), {
                toolbar: [
                    'heading', '|', 'bold', 'italic', 'underline', '|',
                    'bulletedList', 'numberedList', '|',
                    'link', 'blockQuote', '|', 'undo', 'redo'
                ]
            })
            .then(instance => {
                editor = instance; // ← store it
            })
            .catch(error => console.error(error));

        /* ── Form submit — sync CKEditor + variables ── */
        document.getElementById('templateForm').addEventListener('submit', function() {
            // Push CKEditor HTML into the textarea before POST
            if (editor) {
                document.querySelector('#bodyEditor').value = editor.getData();
            }
            updatePreview();
        });
        /* ── Variables system ── */
        var rowCount = 0;

        function addVariableRow(key, description) {
            key = key || '';
            description = description || '';
            rowCount++;
            var id = 'varRow_' + rowCount;

            var html =
                '<div class="d-flex gap-2 mb-2 align-items-start" id="' + id + '">' +
                '<div style="flex:1;">' +
                '<input type="text"' +
                ' class="form-control form-control-sm var-key"' +
                ' placeholder="key e.g. student_name"' +
                ' value="' + key + '"' +
                ' oninput="updatePreview()">' +
                '<small class="text-muted" style="font-size:10px;">' +
                'Use as <code>@{{ key }}</code> in body' +
                '</small>' +
                '</div>' +
                '<div style="flex:1.2;">' +
                '<input type="text"' +
                ' class="form-control form-control-sm var-desc"' +
                ' placeholder="Description e.g. Full name"' +
                ' value="' + description + '"' +
                ' oninput="updatePreview()">' +
                '</div>' +
                '<button type="button"' +
                ' class="btn btn-sm btn-icon btn-danger btn-round mt-1"' +
                ' onclick="removeVarRow(\'' + id + '\')">' +
                '<i class="fa fa-times"></i>' +
                '</button>' +
                '</div>';

            document.getElementById('variablesContainer').insertAdjacentHTML('beforeend', html);
            updatePreview();
        }

        function removeVarRow(id) {
            document.getElementById(id).remove();
            updatePreview();
        }

        function updatePreview() {
            var keyEls = document.querySelectorAll('.var-key');
            var descEls = document.querySelectorAll('.var-desc');

            var variables = [];
            var previewHtml = '';

            keyEls.forEach(function(keyEl, i) {
                var key = keyEl.value.trim().replace(/\s+/g, '_');
                var desc = descEls[i] ? descEls[i].value.trim() : '';

                if (key) {
                    variables.push({
                        key: key,
                        description: desc
                    });

                    previewHtml +=
                        '<div class="d-flex align-items-center justify-content-between mb-2">' +
                        '<code style="font-size:11px;cursor:pointer;' +
                        'background:#f0f5ff;padding:3px 8px;' +
                        'border-radius:6px;border:1px solid #dde5f4;"' +
                        ' onclick="copyVar(\'{{ ' + key + ' }}\')"' +
                        ' title="Click to copy">' +
                        '{{ ' + key + ' }}' +
                        '</code>' +
                        '<span class="text-muted ms-2" style="font-size:11px;">' +
                        (desc || '—') +
                        '</span>' +
                        '</div>';
                }
            });

            /* Update hidden input */
            document.getElementById('variablesInput').value = JSON.stringify(variables);

            /* Show/hide preview */
            var preview = document.getElementById('variablePreview');
            var list = document.getElementById('previewList');

            if (variables.length > 0) {
                list.innerHTML = previewHtml;
                preview.style.display = 'block';
            } else {
                preview.style.display = 'none';
            }
        }

        function copyVar(text) {
            navigator.clipboard.writeText(text).then(function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Copied!',
                    text: text,
                    timer: 1200,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end',
                });
            });
        }

        /* Make sure variablesInput is updated before submit */
        document.getElementById('templateForm').addEventListener('submit', function() {
            updatePreview();
        });

        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Done!',
                text: "{{ session('success') }}",
                timer: 2500,
                showConfirmButton: false,
                toast: true,
                position: 'top-end',
            });
        @endif
    </script>
@endsection
