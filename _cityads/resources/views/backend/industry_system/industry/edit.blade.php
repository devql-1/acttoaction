@extends('backend.layout.app')
@section('content')
<div class="container">
  <div class="page-inner">
    <div class="page-header">
      <h3 class="fw-bold mb-3">Forms</h3>
      <ul class="breadcrumbs mb-3">
        <li class="nav-home">
          <a href="#">
            <i class="icon-home"></i>
          </a>
        </li>
        <li class="separator">
          <i class="icon-arrow-right"></i>
        </li>
        <li class="nav-item">
          <a href="#">Forms</a>
        </li>
        <li class="separator">
          <i class="icon-arrow-right"></i>
        </li>
        <li class="nav-item">
          <a href="#">Basic Form</a>
        </li>
      </ul>
    </div>
    <form action="{{route('admin.industry-update',$industry->id)}}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="row">
        <div class="col-md-7">
          <div class="card">
            <div class="card-header">
              <div class="card-title">Update Industry Record</div>
            </div>

            <input type="hidden" name="id" value="id">
            <div class="card-body">
              <div class="row">
                <div class="col-md-12 col-lg-12">
                  <div class="form-group row">
                    <div class="col-md-3">
                      <label for="title">Title</label>
                      <span class="text-danger">*</span>
                    </div>
                    <div class="col-md-9">
                      <input
                        type="text"
                        class="form-control @error('title') is-invalid @enderror"
                        id="title"
                        name="title"
                        onkeyup="makeSlug(this.value)"
                        value="{{old('title',$industry->title)}}"
                        placeholder="Enter Title" />
                      @error('title')
                      <p class="invalid-feedback">{{$message}}</p>
                      @enderror
                      <small id="titleHelp2" class="form-text text-muted">This title your industry heading.
                      </small>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-md-3">
                      <label for="slug">Slug</label>
                      <span class="text-danger">*</span>
                    </div>
                    <div class="col-md-9">
                      <input
                        type="text"
                        class="form-control"
                        id="slug"
                        name="slug"
                        value="{{$industry->slug}}"
                        placeholder="slug" />

                      <small id="slug" class="form-text text-muted">create a slug from your title.
                      </small>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-md-3">
                      <label for="subtitle">Sub Title</label>
                      <!-- <span class="text-danger">*</span> -->
                    </div>
                    <div class="col-md-9">
                      <input
                        type="text"
                        name="subtitle"
                        class="form-control"
                        value="{{ $industry->subtitle }}"
                        id="subtitle"
                        placeholder="Enter Sub Title" />

                      <small id="subtitle" class="form-text text-muted">This sub title for your industry details page heading.
                      </small>

                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-md-3">
                      <label for="subtitle2">Sub Title II</label>
                      <!-- <span class="text-danger">*</span> -->
                    </div>
                    <div class="col-md-9">
                      <input
                        type="text"
                        name="subtitle2"
                        class="form-control"
                        value="{{ $industry->subtitle2 }}"
                        id="subtitle2"
                        placeholder="Enter Sub Title II" />

                      <small id="subtitle2" class="form-text text-muted">This sub title II for your industry details page heading.
                      </small>

                    </div>
                  </div>


                  <div class="form-group row">
                    <div class="col-md-3">
                      <label for="image">Image</label>
                    </div>
                    <div class="col-md-9">
                      <x-file-upload name="image" label="Upload Image" :current="$industry->image" />
                      <small id="image" class="form-text text-muted">This Image show in your Industry Image section.
                      </small>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-md-3">
                      <label for="short_descripition">Short Description</label>
                    </div>
                    <div class="col-md-9">
                      <textarea id="short_description" class="form-control" row="4" name="short_description">{{ $industry->short_description }}</textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-md-3">
                      <label for="descripition">Description</label>
                    </div>
                    <div class="col-md-9">
                      <textarea id="myeditor" name="description">{{ $industry->description }}</textarea>
                    </div>
                  </div>

                </div>
              </div>
            </div>

          </div>
        </div>

        <div class="col-md-5">
          <div class="card">
            <div class="card-header">
              <div class="card-title">Update Industry Features Headings and Short Description for Your Industry Details Page</div>
            </div>

            <div class="card-body">
              <div class="row">
                <div class="col-md-12 col-lg-12">

                  <div class="form-group row">
                    <div class="col-md-12">
                      <label for="features_headings">Industry Features Headings</label>
                      <!-- <span class="text-danger">*</span> -->

                      <input
                        type="text"
                        name="features_headings"
                        class="form-control"
                        id="features_headings"
                        value="{{$industry->features_headings}}"
                        placeholder="Enter Industry Features Headings" />

                      <small id="features_headings" class="form-text text-muted">This features headings for your industry details page heading.
                      </small>

                    </div>
                  </div>




                  <div class="form-group row">
                    <div class="col-md-12">
                      <label for="features_short_descripition">Industry Features Short Description</label>

                      <textarea id="features_short_description" class="form-control" row="4" name="features_short_description">{{$industry->features_short_description}}</textarea>
                    </div>
                  </div>


                </div>
              </div>
            </div>

          </div>

          <div class="card">
            <div class="card-header">
              <div class="card-title">Update Industry Service Headings and Short Description for Your Industry Details Page</div>
            </div>

            <div class="card-body">
              <div class="row">
                <div class="col-md-12 col-lg-12">

                  <div class="form-group row">
                    <div class="col-md-12">
                      <label for="service_headings">Industry Service Headings</label>
                      <!-- <span class="text-danger">*</span> -->

                      <input
                        type="text"
                        name="service_headings"
                        class="form-control"
                        id="service_headings"
                        value="{{$industry->service_headings}}"
                        placeholder="Enter Industry Service Headings" />

                      <small id="service_headings" class="form-text text-muted">This service headings for your industry details page heading.
                      </small>

                    </div>
                  </div>




                  <div class="form-group row">
                    <div class="col-md-12">
                      <label for="service_short_descripition">Industry Service Short Description</label>

                      <textarea id="service_short_description" class="form-control" row="4" name="service_short_description">{{$industry->service_short_description}}</textarea>
                    </div>
                  </div>


                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-action text-center">
          <button class="btn btn-success" type="submit">Submit</button>
          <a href="{{route('admin.industry')}}" class="btn btn-danger">Cancel</a>
        </div>
      </div>
    </form>
  </div>
</div>


@endsection


@section('script')
<script>
  function makeSlug(val) {
    let str = val;
    let output = str.replace(/\s+/g, '-').toLowerCase();
    $('#slug').val(output);
  }
</script>

@endsection