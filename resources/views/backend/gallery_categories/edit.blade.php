@extends('backend.layout.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Edit Gallery Category</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home">
                        <a href="#"><i class="icon-home"></i></a>
                    </li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="{{ route('galleryCategories.index') }}">Gallery Categories</a></li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="#">Edit Gallery Category</a></li>
                </ul>
            </div>

            <!-- Success and Error Messages -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="card card-round">
                        <div class="card-header">
                            <div class="card-head-row card-tools-still-right">
                                <div class="card-title">Edit Gallery Category</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('galleryCategories.update', $category->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <!-- Category Name -->
                                <div class="mb-3">
                                    <label class="form-label">Category Name <span class="text-danger">*</span></label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name', $category->name) }}" required />
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Slug -->
                                <div class="mb-3">
                                    <label class="form-label text-muted">Slug (auto-generated)</label>
                                    <input type="text" class="form-control" value="{{ $category->slug }}" disabled />
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-success">Update Category</button>
                                <a href="{{ route('galleryCategories.index') }}" class="btn btn-secondary">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
