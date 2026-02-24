@extends('backend.layout.app')
@section('content')

<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">DataTables.Net</h3>
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
                    <a href="#">Tables</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Datatables</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">Update Video Gallery Record</div>
                  </div>
                  <form action="{{route('admin.video_gallery-update',$video_gallery->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="id" name="id">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-12 col-lg-12">
                          <div class="form-group row">
                              <div class="col-md-3">
                                  <label for="video_name">Video Name (Optional)</label>
                                  
                              </div>
                              <div class="col-md-9">
                                  <input
                                      type="text"
                                      name="video_name"
                                      class="form-control"
                                      id="video_name"
                                      value="{{old('video_name',$video_gallery->video_name)}}"
                                      placeholder="Enter Brand"
                                  />
                                 
                                  <small id="video_nameHelp2" class="form-text text-muted"
                                          >This Video Name show in your video box section.
                                  </small>

                              </div>
                          </div>

                          <div class="form-group row">
                              <div class="col-md-3">
                                  <label for="video_poster">Video Poster</label>
                              </div>
                              <div class="col-md-9">
                                  
                                  <x-file-upload name="video_poster" label="Upload Video Poster" :current="$video_gallery->video_poster" />

                                  <small id="video_poster" class="form-text text-muted"
                                          >This Video Poster is show in your Video Section.
                                  </small>
                              </div> 
                          </div>

                          <div class="form-group row">
                              <div class="col-md-3">
                                  <label for="video_item">Video Gallery</label>
                                  <span class="text-danger">*</span>
                              </div>
                              <div class="col-md-9">
                                <p class="@error('video_item') is-invalid @enderror">
                                    <x-file-upload name="video_item" label="Upload Video Item" :current="$video_gallery->video_item" />
                                    <small id="video_item" class="form-text text-muted"
                                          >This Video Item show in your Video Item section.
                                    </small>
                                </p>
                                  @error('video_item')
                                    <p class="invalid-feedback">{{$message}}</p>
                                  @enderror

                                  
                              </div> 
                          </div>
                          

                        </div>
                      </div>
                    </div>
                    <div class="card-action text-center">
                      <button class="btn btn-success" type="submit">Submit</button>
                      <a href="{{route('admin.video_gallery')}}" class="btn btn-danger">Cancel</a>
                    </div>
                  </form>
                </div>
              </div>
        </div>
    </div>
</div>


@endsection
