{{-- resources/views/backend/blog_system/author/create.blade.php --}}
@extends('backend.layout.app')
@section('content')

  <div class="container">
    <div class="page-inner">
      <div class="page-header">
        <h3 class="fw-bold mb-3">Add Author</h3>
        <ul class="breadcrumbs mb-3">
          <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
          <li class="separator"><i class="icon-arrow-right"></i></li>
          <li class="nav-item"><a href="{{ route('admin.blog-author.index') }}">Authors</a></li>
          <li class="separator"><i class="icon-arrow-right"></i></li>
          <li class="nav-item">Add</li>
        </ul>
      </div>

      <div class="row">
        <div class="col-md-8 mx-auto">
          <div class="card">
            <div class="card-header">
              <div class="card-title">Add New Blog Author</div>
            </div>

            <form action="{{ route('admin.blog-author.store') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <div class="card-body">

                {{-- Name --}}
                <div class="form-group row">
                  <div class="col-md-3">
                    <label>Name <span class="text-danger">*</span></label>
                  </div>
                  <div class="col-md-9">
                    <input type="text" name="name" value="{{ old('name') }}"
                      class="form-control @error('name') is-invalid @enderror" placeholder="Full name">
                    @error('name')<p class="invalid-feedback">{{ $message }}</p>@enderror
                  </div>
                </div>

                {{-- Designation --}}
                <div class="form-group row">
                  <div class="col-md-3"><label>Designation</label></div>
                  <div class="col-md-9">
                    <input type="text" name="designation" value="{{ old('designation') }}" class="form-control"
                      placeholder="e.g. Senior Writer, Health Expert">
                  </div>
                </div>

                {{-- Bio --}}
                <div class="form-group row">
                  <div class="col-md-3"><label>Bio</label></div>
                  <div class="col-md-9">
                    <textarea name="bio" class="form-control" rows="4"
                      placeholder="Short bio shown on blog posts">{{ old('bio') }}</textarea>
                  </div>
                </div>

                {{-- Photo --}}
                <div class="form-group row">
                  <div class="col-md-3"><label>Profile Photo</label></div>
                  <div class="col-md-9">
                    <x-file-upload name="image" label="Upload Photo" />
                    <small class="form-text text-muted">JPG/PNG/WEBP, max 2MB. Square image recommended.</small>
                  </div>
                </div>

                <hr class="my-4">
                <p class="text-uppercase text-muted fw-bold mb-3" style="font-size:11px;letter-spacing:1px;">
                  Social Links (paste full URL)
                </p>

                {{-- Instagram --}}
                <div class="form-group row">
                  <div class="col-md-3">
                    <label><i class="fab fa-instagram text-danger me-1"></i>Instagram</label>
                  </div>
                  <div class="col-md-9">
                    <input type="url" name="instagram" value="{{ old('instagram') }}"
                      class="form-control @error('instagram') is-invalid @enderror"
                      placeholder="https://instagram.com/username">
                    @error('instagram')<p class="invalid-feedback">{{ $message }}</p>@enderror
                  </div>
                </div>

                {{-- Facebook --}}
                <div class="form-group row">
                  <div class="col-md-3">
                    <label><i class="fab fa-facebook me-1" style="color:#1877f2;"></i>Facebook</label>
                  </div>
                  <div class="col-md-9">
                    <input type="url" name="facebook" value="{{ old('facebook') }}"
                      class="form-control @error('facebook') is-invalid @enderror"
                      placeholder="https://facebook.com/username">
                    @error('facebook')<p class="invalid-feedback">{{ $message }}</p>@enderror
                  </div>
                </div>

                {{-- Twitter / X --}}
                <div class="form-group row">
                  <div class="col-md-3">
                    <label><i class="fab fa-x-twitter me-1"></i>Twitter / X</label>
                  </div>
                  <div class="col-md-9">
                    <input type="url" name="twitter" value="{{ old('twitter') }}"
                      class="form-control @error('twitter') is-invalid @enderror" placeholder="https://x.com/username">
                    @error('twitter')<p class="invalid-feedback">{{ $message }}</p>@enderror
                  </div>
                </div>

                {{-- LinkedIn --}}
                <div class="form-group row">
                  <div class="col-md-3">
                    <label><i class="fab fa-linkedin me-1" style="color:#0a66c2;"></i>LinkedIn</label>
                  </div>
                  <div class="col-md-9">
                    <input type="url" name="linkedin" value="{{ old('linkedin') }}"
                      class="form-control @error('linkedin') is-invalid @enderror"
                      placeholder="https://linkedin.com/in/username">
                    @error('linkedin')<p class="invalid-feedback">{{ $message }}</p>@enderror
                  </div>
                </div>

              </div>{{-- /card-body --}}

              <div class="card-action text-center">
                <button class="btn btn-success" type="submit">
                  <i class="fas fa-save me-1"></i> Save Author
                </button>
                <a href="{{ route('admin.blog-author.index') }}" class="btn btn-danger">Cancel</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection