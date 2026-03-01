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
            <div class="row">
              <div class="col-md-10 mx-auto">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">Add Record for About Us</div>
                  </div>
                  <form action="{{route('admin.about-store')}}" method="post" enctype="multipart/form-data">
                    @csrf
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
                                      placeholder="Enter Title"
                                  />
                                  @error('title')
                                    <p class="invalid-feedback">{{$message}}</p>
                                  @enderror
                                  <small id="titleHelp2" class="form-text text-muted"
                                          >This title your about-us heading.
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
                                      placeholder="slug"
                                      
                                  />
                                  <small id="slug" class="form-text text-muted"
                                          >creating a slug from your title.
                                  </small>
                              </div>
                          </div>
                          <div class="form-group row d-none">
                              <div class="col-md-3">
                                  <label for="category_name">Select Category</label>
                              </div>
                              <div class="col-md-9">
                                  <select name="category_id" id="category_id" class="form-select select2" data-live-search="true">
                                    <option value="">-- Select Category --</option>
                                    @foreach($about_categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                    @endforeach
                                  </select>
                              </div> 
                          </div>
                          <div class="form-group row">
                              <div class="col-md-3">
                                  <label for="image">Image</label>
                              </div>
                              <div class="col-md-9">
                                  
                                  <x-file-upload name="image" class="@error('image') is-invalid @enderror" label="Upload Image" />

                                  @error('image')
                                    <p class="invalid-feedback">{{$message}}</p>
                                  @enderror

                                  <small id="image" class="form-text text-muted"
                                          >This Image show in your about-us Image section.
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
                                      These images will show in your About Us gallery section.
                                  </small>
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

                          <div class="form-group row d-none">
                              <div class="col-md-3">
                                  <label for="description2">Description 2</label>
                              </div>
                              <div class="col-md-9">
                                  <textarea id="myeditor" name="description2"></textarea>
                              </div> 
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-action text-center">
                      <button class="btn btn-success" type="submit">Submit</button>
                      <a href="{{route('admin.about')}}" class="btn btn-danger">Cancel</a>
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
        let str = val;
        let output = str.replace(/\s+/g, '-').toLowerCase();
        $('#slug').val(output);
    }
</script>
@endsection