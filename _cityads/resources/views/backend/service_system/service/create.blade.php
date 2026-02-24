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
    <form action="{{route('admin.service-store')}}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="row">
        <div class="col-md-8 mx-auto">
          <div class="card">
            <div class="card-header">
              <div class="card-title">Add Record for Services</div>
            </div>

            <div class="card-body">
              <div class="row">
                <div class="col-md-12 col-lg-12">
                  <div class="form-group row">
                    <div class="col-md-3">
                      <label for="title2">Title</label>
                      <span class="text-danger">*</span>
                    </div>
                    <div class="col-md-9">
                      <input
                        type="text"
                        name="title"
                        onkeyup="makeSlug(this.value)"
                        class="form-control @error('title') is-invalid @enderror"
                        id="title2"
                        placeholder="Enter Title" />
                      @error('title')
                      <p class="invalid-feedback">{{$message}}</p>
                      @enderror
                      <small id="titleHelp2" class="form-text text-muted">This title your services heading.
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
                        name="slug"
                        id="slug"
                        placeholder="slug" />
                      <small id="slug" class="form-text text-muted">creating a slug from your title.
                      </small>
                    </div>
                  </div>
                  {{-- <div class="form-group row">
                    <div class="col-md-3">
                      <label for="subtitle">Sub Title</label>
                      <span class="text-danger">*</span>
                    </div>
                    <div class="col-md-9">
                      <input
                        type="text"
                        name="subtitle"
                        class="form-control"
                        id="subtitle"
                        placeholder="Enter Sub Title" />
                      <small id="subtitleHelp" class="form-text text-muted">This sub title for your services details page heading.
                      </small>

                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-md-3">
                      <label for="subtitle2">Sub Title II</label>
                      <span class="text-danger">*</span>
                    </div>
                    <div class="col-md-9">
                      <input
                        type="text"
                        name="subtitle2"
                        class="form-control"
                        id="subtitle2"
                        placeholder="Enter Sub Title II" />
                      <small id="subtitle2Help" class="form-text text-muted">This sub title II for your services details page heading.
                      </small>

                    </div>
                  </div> --}}

                  <div class="form-group row">
                    <div class="col-md-3">
                      <label for="servicecategory_id">Select Category</label>
                    </div>
                    <div class="col-md-9">
                      <select name="category_id" id="servicecategory_id" class="form-select select2" data-live-search="true">
                        <option>-- Select Category --</option>
                        @foreach($service_categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  {{--<div class="form-group row">
                    <div class="col-md-3">
                      <label for="subcategory_id">Select Sub Category</label>
                    </div>
                    <div class="col-md-9">
                      <select name="subcategory_id" id="subcategory_id" class="form-select select2" data-live-search="true">
                        <option>-- Select Sub Category --</option>
                      </select>
                    </div>
                  </div>--}}
                  <div class="form-group row">
                    <div class="col-md-3">
                      <label for="image">Image</label>
                    </div>
                    <div class="col-md-9">

                      <x-file-upload name="image" label="Upload Image" />

                      <small id="image" class="form-text text-muted">This Image show in your service Image section.
                      </small>
                    </div>
                  </div>

                  
                     <div class="form-group row">
                              <div class="col-md-3">
                                  <label for="images">Multiple Images</label>
                              </div>
                              <div class="col-md-9">
                                  <!-- for multiple image  -->
                                  <x-multi-file-upload name="images[]" label="Upload Multiple Images" 
                                       />
                                  <small class="form-text text-muted">
                                      These images will show in your Service gallery section.
                                  </small>
                              </div>
                          </div>


                  <div class="form-group row">
                    <div class="col-md-3">
                      <label for="short_descripition">Short Description</label>
                    </div>
                    <div class="col-md-9">
                      <textarea id="short_description" class="form-control" row="4" name="short_description"></textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-md-3">
                      <label for="descripition">Description</label>
                    </div>
                    <div class="col-md-9">
                      <textarea id="myeditor" name="description"></textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-md-3">
                      <label for="advantages">Advantages <br>(Add 1 Point Per Line)</label>
                    </div>
                    <div class="col-md-9">
                      <textarea id="advantages" class="form-control" name="advantages" rows="4" placeholder="Enter advantages, each point separated by a new line"></textarea>
                      <small class="form-text text-muted">Add one point per line.</small>
                    </div>
                  </div>

                  <div class="form-group row">
                    <div class="col-md-3">
                      <label for="eligibility">Eligibility <br>(Add 1 Point Per Line)</label>
                    </div>
                    <div class="col-md-9">
                      <textarea id="eligibility" class="form-control" name="eligibility" rows="4" placeholder="Enter eligibility points, each on a new line"></textarea>
                      <small class="form-text text-muted">Add one point per line.</small>
                    </div>
                  </div>


                </div>
              </div>
            </div>
            <div class="card-action text-center">
              <button class="btn btn-success" type="submit">Submit</button>
              <a href="{{route('admin.service')}}" class="btn btn-danger">Cancel</a>
            </div>

          </div>
        </div>
        {{-- <div class="col-md-5">
          <div class="card">
            <div class="card-header">
              <div class="card-title">Add Features Headings and Short Description for Your Service Details Page</div>
            </div>

            <div class="card-body">
              <div class="row">
                <div class="col-md-12 col-lg-12">
                  <div class="form-group row">
                    <div class="col-md-12">
                      <label for="features_headings">Features Headings</label>
                      <input
                        type="text"
                        name="features_headings"
                        class="form-control"
                        id="features_headings"
                        placeholder="Enter Features Headings" />
                      <small id="features_headingsHelp" class="form-text text-muted">This Features Headings for your services details page.
                      </small>
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-md-12">
                      <label for="features_short_descripition">Features Short Description</label>
                      <textarea id="features_short_description" class="form-control" row="4" name="features_short_description"></textarea>
                    </div>
                  </div>

                </div>
              </div>
            </div>

          </div>

          <div class="card">
            <div class="card-header">
              <div class="card-title">Add Benefits Headings and Short Description for Your Service Details Page</div>
            </div>

            <div class="card-body">
              <div class="row">
                <div class="col-md-12 col-lg-12">
                  <div class="form-group row">
                    <div class="col-md-12">
                      <label for="benefits_headings">Benefits Headings</label>
                      <!-- <span class="text-danger">*</span> -->
                      <input
                        type="text"
                        name="benefits_headings"
                        class="form-control"
                        id="benefits_headings"
                        placeholder="Enter Benefits headings" />
                      <small id="benefits_headingsHelp" class="form-text text-muted">This Benefits Headings for your services details page.
                      </small>

                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-md-12">
                      <label for="benefits_short_descripition">Benefits Short Description</label>
                    
                      <textarea id="benefits_short_description" class="form-control" row="4" name="benefits_short_description"></textarea>
                    </div>
                  </div>

                </div>
              </div>
            </div>

          </div>

          <div class="card">
            <div class="card-header">
              <div class="card-title">Add Essentials Headings and Short Description for Your Service Details Page</div>
            </div>

            <div class="card-body">
              <div class="row">
                <div class="col-md-12 col-lg-12">
                  <div class="form-group row">
                    <div class="col-md-12">
                      <label for="essentials_headings">Essentials Headings</label>
                      <!-- <span class="text-danger">*</span> -->
                      <input
                        type="text"
                        name="essentials_headings"
                        class="form-control"
                        id="essentials_headings"
                        placeholder="Enter Essentials Headings" />
                      <small id="essentials_headingsHelp" class="form-text text-muted">This Essentials Headings for your services details page.
                      </small>

                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-md-12">
                      <label for="essentials_short_descripition">Essentials Short Description</label>
                      <textarea id="essentials_short_description" class="form-control" row="4" name="essentials_short_description"></textarea>
                    </div>
                  </div>

                </div>
              </div>
            </div>

          </div>
        </div> --}}
        {{--<div class="card">
          <div class="card-action text-center">
            <button class="btn btn-success" type="submit">Submit</button>
            <a href="{{route('admin.service')}}" class="btn btn-danger">Cancel</a>
          </div>
        </div> --}}
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