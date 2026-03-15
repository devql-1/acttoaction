@extends('backend.layout.app')
@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Edit Email Template</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item">
                        <a href="{{ route('email-templates.index') }}">Email Templates</a>
                    </li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="#">Edit</a></li>
                </ul>
            </div>

            <div class="row">

                {{-- Form --}}
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Editing: {{ $template->name }}</div>
                        </div>
                        <form action="{{ route('email-templates.update', $template->id) }}" method="POST">
                            @csrf @method('PUT')
                            <div class="card-body">

                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label>Name <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name', $template->name) }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="text-muted">
                                            Current slug:
                                            <code>{{ $template->slug }}</code>
                                        </small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label>Category <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-9">
                                        <select name="category" class="form-control" required>
                                            <option value="enrollment"
                                                {{ $template->category === 'enrollment' ? 'selected' : '' }}>Enrollment
                                            </option>
                                            <option value="payment"
                                                {{ $template->category === 'payment' ? 'selected' : '' }}>Payment
                                            </option>
                                            <option value="volunteer"
                                                {{ $template->category === 'volunteer' ? 'selected' : '' }}>Volunteer
                                            </option>
                                            <option value="general"
                                                {{ $template->category === 'general' ? 'selected' : '' }}>General
                                            </option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label>Subject <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="subject"
                                            class="form-control @error('subject') is-invalid @enderror"
                                            value="{{ old('subject', $template->subject) }}" required>
                                        @error('subject')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label>Body <span class="text-danger">*</span></label>
                                    </div>
                                    <div class="col-md-9">
                                        <textarea name="body" id="bodyEditor" class="form-control" rows="14">{{ old('body', $template->body) }}</textarea>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-3"><label>Status</label></div>
                                    <div class="col-md-9">
                                        <div class="form-check form-switch mt-1">
                                            <input class="form-check-input" type="checkbox" name="is_active" id="is_active"
                                                {{ $template->is_active ? 'checked' : '' }}>
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
                                    <i class="fa fa-save me-1"></i> Update Template
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Variable reference --}}
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Available Variables</div>
                        </div>
                        <div class="card-body">
                            <p class="text-muted" style="font-size:12px;">
                                Click any variable to copy it.
                            </p>
                            @php
                                $allVars = [
                                    'Enrollment / Payment' => [
                                        '{{ student_name }}',
                                        '{{ course_name }}',
                                        '{{ centre }}',
                                        '{{ reference_id }}',
                                        '{{ amount }}',
                                        '{{ payment_id }}',
                                    ],
                                    'Volunteer' => [
                                        '{{ volunteer_name }}',
                                        '{{ email }}',
                                        '{{ phone }}',
                                    ],
                                    'General' => ['{{ name }}', '{{ message }}'],
                                ];
                            @endphp
                            @foreach ($allVars as $group => $vars)
                                <div class="mb-3">
                                    <div
                                        style="font-size:11px;font-weight:700;color:#6b7a99;
                                            text-transform:uppercase;letter-spacing:.5px;
                                            margin-bottom:8px;">
                                        {{ $group }}
                                    </div>
                                    @foreach ($vars as $var)
                                        <code
                                            style="font-size:11px;cursor:pointer;display:block;
                                                 background:#f0f5ff;padding:4px 10px;
                                                 border-radius:6px;border:1px solid #dde5f4;
                                                 margin-bottom:5px;"
                                            onclick="copyVar('{{ $var }}')" title="Click to copy">
                                            {{ $var }}
                                        </code>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        ClassicEditor.create(document.querySelector('#bodyEditor'), {
            toolbar: [
                'heading', '|', 'bold', 'italic', 'underline', '|',
                'bulletedList', 'numberedList', '|',
                'link', 'blockQuote', '|', 'undo', 'redo'
            ]
        }).catch(error => console.error(error));

        function copyVar(text) {
            navigator.clipboard.writeText(text).then(() => {
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

        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Done!',
                text: '{{ session('success') }}',
                timer: 2500,
                showConfirmButton: false,
                toast: true,
                position: 'top-end',
            });
        @endif
    </script>
@endsection
