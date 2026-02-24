@extends('backend.layout.app')
@section('content')

<div class="container">
  <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">Youtube Categories</h3>
      <ul class="breadcrumbs mb-3">
        <li class="nav-home">
          <a href="#"><i class="icon-home"></i></a>
        </li>
        <li class="separator"><i class="icon-arrow-right"></i></li>
        <li class="nav-item"><a href="#">Youtube</a></li>
        <li class="separator"><i class="icon-arrow-right"></i></li>
        <li class="nav-item"><a href="#">Add Category</a></li>
      </ul>
    </div>

    <div class="row">
      <div class="col-md-8 mx-auto">
        <div class="card">
          <div class="card-header">
            <div class="card-title">Add Youtube Category</div>
          </div>

          <form action="{{ route('youtubeCategory.store') }}" method="POST">
            @csrf

            <div class="card-body">
              <div class="form-group row">
                <div class="col-md-3">
                  <label>Category Name</label>
                  <span class="text-danger">*</span>
                </div>

                <div class="col-md-9">
                  <input type="text"
                         name="name"
                         value="{{ old('name') }}"
                         onkeyup="makeSlug(this.value)"
                         class="form-control @error('name') is-invalid @enderror"
                         placeholder="Enter Youtube Category Name">

                  @error('name')
                    <p class="invalid-feedback">{{ $message }}</p>
                  @enderror

                  <small class="form-text text-muted">
                    This name will appear in your Youtube Category section.
                  </small>
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-3">
                  <label>Slug</label>
                </div>

                <div class="col-md-9">
                  <input type="text"
                         name="slug"
                         id="slug"
                         value="{{ old('slug') }}"
                         class="form-control"
                         placeholder="Auto Generated Slug">

                  <small class="form-text text-muted">
                    Slug will be generated automatically.
                  </small>
                </div>
              </div>

            </div>

            <div class="card-action text-center">
              <button class="btn btn-success" type="submit">Submit</button>
              <a href="{{ route('youtubeCategory.index') }}" class="btn btn-danger">Cancel</a>
            </div>

          </form>

        </div>
      </div>
    </div>
  </div>
</div>

@endsection


@section('script')
<script>
function makeSlug(val) {
    let output = val.replace(/\s+/g, '-').toLowerCase();
    $('#slug').val(output);
}
</script>
@endsection