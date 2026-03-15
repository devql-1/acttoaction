{{-- resources/views/backend/psych/questions/edit.blade.php --}}
@extends('backend.layout.app')
@section('title', 'Edit Question')

@push('styles')
    <style>
        .psych-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.07);
        }

        .psych-card .card-header {
            background: linear-gradient(135deg, #6f42c1, #8b5cf6);
            color: white;
            border-radius: 10px 10px 0 0 !important;
            padding: 14px 20px;
        }

        .psych-card .card-header h5 {
            margin: 0;
            font-weight: 600;
        }

        .btn-purple {
            background: #6f42c1;
            color: white;
            border-color: #6f42c1;
        }

        .btn-purple:hover {
            background: #5a32a3;
            color: white;
        }

        .form-label {
            font-weight: 600;
            font-size: 14px;
        }

        .breadcrumb-psych {
            background: #f8f9fc;
            border-left: 4px solid #6f42c1;
            padding: 10px 16px;
            border-radius: 4px;
            margin-bottom: 20px;
            font-size: 13px;
        }

        .breadcrumb-psych a {
            color: #6f42c1;
            text-decoration: none;
        }

        .scale-preview {
            display: flex;
            gap: 8px;
            margin-top: 10px;
        }

        .scale-option {
            flex: 1;
            border: 2px solid #e5e7eb;
            border-radius: 8px;
            padding: 10px 6px;
            text-align: center;
        }

        .scale-option .num {
            font-size: 1.3rem;
            font-weight: 700;
            color: #6f42c1;
        }

        .scale-option .lbl {
            font-size: 10px;
            color: #6c757d;
            margin-top: 2px;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">

        <div class="breadcrumb-psych">
            <a href="{{ route('quiz-tests.index') }}"><i class="fas fa-brain me-1"></i>Tests</a>
            <span class="mx-2">/</span>
            <a href="{{ route('quiz-tests.show', $test->id) }}">{{ $test->test_name }}</a>
            <span class="mx-2">/</span>
            <a href="{{ route('quiz-questions.index', [$test->id, $category->id]) }}">{{ $category->category_name }}</a>
            <span class="mx-2">/</span><span>Edit Question</span>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card psych-card">
                    <div class="card-header">
                        <h5><i class="fas fa-edit me-2"></i>Edit Question</h5>
                    </div>
                    <div class="card-body p-4">

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                            </div>
                        @endif

                        <form action="{{ route('quiz-questions.update', [$test->id, $category->id, $question->id]) }}"
                            method="POST">
                            @csrf @method('PUT')

                            <div class="mb-3">
                                <label class="form-label">Category <span class="text-danger">*</span></label>
                                <select name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ old('category_id', $question->category_id) == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <small class="text-muted">Changing category auto-updates marks for both categories.</small>
                                @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Question Text <span class="text-danger">*</span></label>
                                <textarea name="question_text" rows="3"
                                    class="form-control @error('question_text') is-invalid @enderror"
                                    required>{{ old('question_text', $question->question_text) }}</textarea>
                                @error('question_text')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Rating Scale <small class="text-muted fw-normal">(fixed
                                        1–5)</small></label>
                                <div class="scale-preview">
                                    @foreach(['Strongly Disagree', 'Disagree', 'Neutral', 'Agree', 'Strongly Agree'] as $si => $sl)
                                        <div class="scale-option">
                                            <div class="num">{{ $si + 1 }}</div>
                                            <div class="lbl">{{ $sl }}</div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-purple px-4">
                                    <i class="fas fa-save me-1"></i>Update Question
                                </button>
                                <a href="{{ route('quiz-questions.index', [$test->id, $category->id]) }}"
                                    class="btn btn-outline-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection