@extends('backend.layout.app')
@section('content')

<div class="container">
  <div class="page-inner">
    <div class="row">
      <div class="col-md-8 mx-auto">
        <div class="card">
          <div class="card-header">
            <div class="card-title">Edit Youtube Category</div>
          </div>

          <form action="{{ route('youtubeCategory.update', $youtubeCategory->id) }}" method="POST">
            @csrf

            <div class="card-body">
              <div class="form-group">
                <label>Category Name</label>
                <input type="text"
                       name="name"
                       value="{{ $youtubeCategory->name }}"
                       onkeyup="makeSlug(this.value)"
                       class="form-control">
              </div>

              <div class="form-group mt-3">
                <label>Slug</label>
                <input type="text"
                       name="slug"
                       id="slug"
                       value="{{ $youtubeCategory->slug }}"
                       class="form-control">
              </div>
            </div>

            <div class="card-action text-center">
              <button class="btn btn-success" type="submit">Update</button>
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