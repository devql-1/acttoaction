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
                    <div class="card-title">Update Benefits Record for Your Services</div>
                  </div>
                  <form action="{{route('admin.service-benefits-update',$service_benefits->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="id">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-12 col-lg-12">
                          <div class="form-group row">
                              <div class="col-md-3">
                                  <label for="service_id">Select Your Service</label>
                              </div>
                              <div class="col-md-9">
                                  <select name="service_id" id="service_id" class="form-select select2" style="width: 100%;">
                                      <option value="">-- Select Your Service --</option>
                                      @foreach($service_info as $service)
                                          <option value="{{ $service->id }}" {{ $service_benefits->service_id == $service->id ? 'selected' : '' }}>
                                              {{ $service->title }}
                                          </option>
                                      @endforeach
                                  </select>
                              </div>

 
                          </div>
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
                                      value="{{old('title',$service_benefits->title)}}"
                                      placeholder="Enter Title"
                                  />
                                  @error('title')
                                    <p class="invalid-feedback">{{$message}}</p>
                                  @enderror
                                  <small id="titleHelp" class="form-text text-muted"
                                          >Update Title for your selected Service.
                                  </small>
                              </div>
                          </div>

                          <div class="form-group row">
                              <div class="col-md-3">
                                  <label for="icon">Select Your Icon </label>
                              </div>
                              <div class="col-md-9">
                                  <select name="icon" id="icon" class="form-select select2" data-selected="{{ $service_benefits->icon ?? '' }}" data-live-search="true">
                                    
                                  </select>
                              </div> 
                          </div>

                          
                          
                          <div class="form-group row">
                              <div class="col-md-3">
                                  <label for="description">Description</label>
                              </div>
                              <div class="col-md-9">
                                  <textarea id="myeditor" name="description">{{ $service_benefits->description }}</textarea>
                              </div> 
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-action text-center">
                      <button class="btn btn-success" type="submit">Submit</button>
                      <a href="{{route('admin.service-benefits')}}" class="btn btn-danger">Cancel</a>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

@endsection
