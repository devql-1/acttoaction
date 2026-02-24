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
                    <div class="card-title">Update Testimonial Record</div>
                  </div>
                  <form action="{{route('admin.testimonial-update',$testimonials->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="id">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-12 col-lg-12">
                          <div class="form-group row">
                              <div class="col-md-3">
                                  <label for="name">Name</label>
                                  <span class="text-danger">*</span>
                              </div>
                              <div class="col-md-9">
                                  <input
                                      type="text"
                                      class="form-control @error('name') is-invalid @enderror"
                                      id="name"
                                      name="name"
                                      value="{{old('name',$testimonials->name)}}"
                                      placeholder="Enter Name"
                                  />
                                  @error('name')
                                    <p class="invalid-feedback">{{$message}}</p>
                                  @enderror
                                  <small id="nameHelp2" class="form-text text-muted"
                                          >This name your Testimonial Person.
                                  </small>
                              </div>
                          </div>
                          <div class="form-group row">
                              <div class="col-md-3">
                                  <label for="designation">Designation</label>
                                  <!-- <span class="text-danger">*</span> -->
                              </div>
                              <div class="col-md-9">
                                  <input
                                      type="text"
                                      name="designation"
                                      class="form-control"
                                      id="designation"
                                      value="{{ $testimonials->designation }}"
                                      placeholder="Enter Designation"
                                  />
                                 
                                  <small id="designationHelp" class="form-text text-muted"
                                          >This designation your Testimonial Person.
                                  </small>

                              </div>
                          </div>
                         <div class="form-group row">
                              <div class="col-md-3">
                                  <label for="rating">Rating</label>
                                  <!-- <span class="text-danger">*</span> -->
                              </div>
                              <div class="col-md-9">
                                <div id="rateYo" class="mb-3"></div>
                                  <input
                                      type="hidden"
                                      name="rating"
                                      id="rating"
                                      value="{{ old('rating', $testimonials->rating ?? 0) }}"
                                      placeholder="Enter Rating"
                                  />
                                  <small id="rating-message" style="font-weight:bold; color:#f39c12;"
                                          >
                                  </small>

                              </div>
                          </div>
                          <div class="form-group row">
                              <div class="col-md-3">
                                  <label for="image">Image</label>
                              </div>
                              <div class="col-md-9">
                                  <x-file-upload name="image" label="Upload Image" :current="$testimonials->image" />
                                  <small id="image" class="form-text text-muted"
                                          >This Image is Testimonial Clients Image.
                                  </small>
                              </div> 
                          </div>
                          <div class="form-group row">
                              <div class="col-md-3">
                                  <label for="message">Message</label>
                              </div>
                              <div class="col-md-9">
                                  <textarea id="myeditor" name="message">{{ $testimonials->message }}</textarea>
                              </div> 
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-action text-center">
                      <button class="btn btn-success" type="submit">Submit</button>
                      <a href="{{route('admin.testimonial')}}" class="btn btn-danger">Cancel</a>
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