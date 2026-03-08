{{-- resources/views/backend/psych/categories/edit.blade.php --}}
@extends('backend.layout.app')
@section('title', 'Edit Category')

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

        .test-badge {
            background: #ede9fe;
            color: #6f42c1;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            display: inline-block;
            margin-bottom: 20px;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid">

        <div class="breadcrumb-psych">
            <a href="{{ route('quiz-tests.index') }}"><i class="fas fa-brain me-1"></i>Tests</a>
            <span class="mx-2">/</span>
            <a href="{{ route('quiz-categories.index', $test->id) }}">{{ $test->test_name }}</a>
            <span class="mx-2">/</span><span>Edit: {{ $category->category_name }}</span>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card psych-card">
                    <div class="card-header">
                        <h5><i class="fas fa-edit me-2"></i>Edit Category</h5>
                    </div>
                    <div class="card-body p-4">

                        <div class="test-badge"><i class="fas fa-brain me-1"></i>{{ $test->test_name }}</div>

                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                            </div>
                        @endif

                        <form action="{{ route('quiz-categories.update', [$test->id, $category->id]) }}" method="POST">
                            @csrf @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">Category Name <span class="text-danger">*</span></label>
                                <input type="text" name="category_name"
                                    class="form-control @error('category_name') is-invalid @enderror"
                                    value="{{ old('category_name', $category->category_name) }}" required>
                                @error('category_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label">Description</label>
                                <textarea name="description" rows="3"
                                    class="form-control @error('description') is-invalid @enderror">{{ old('description', $category->description) }}</textarea>
                                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-purple px-4">
                                    <i class="fas fa-save me-1"></i> Update
                                </button>
                                <a href="{{ route('quiz-categories.index', $test->id) }}"
                                    class="btn btn-outline-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection