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
                    <div class="card-title">Update Brand or Partner Record</div>
                  </div>
                  <form action="{{route('admin.brands-update',$brands->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="id" name="id">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-12 col-lg-12">
                          <div class="form-group row">
                              <div class="col-md-3">
                                  <label for="brand_name">Brand Name</label>
                                  <span class="text-danger">*</span>
                              </div>
                              <div class="col-md-9">
                                  <input
                                      type="text"
                                      name="brand_name"
                                      class="form-control @error('brand_name') is-invalid @enderror"
                                      id="brand_name"
                                      value="{{old('brand_name',$brands->brand_name)}}"
                                      placeholder="Enter Brand"
                                  />
                                  @error('brand_name')
                                    <p class="invalid-feedback">{{$message}}</p>
                                  @enderror
                                  <small id="brand_nameHelp2" class="form-text text-muted"
                                          >This Brand name your Business Partner Brand Name.
                                  </small>

                              </div>
                          </div>

                          <div class="form-group row">
                              <div class="col-md-3">
                                  <label for="image">Image</label>
                              </div>
                              <div class="col-md-9">
                                  <x-file-upload name="image" label="Upload Image" :current="$brands->image" />
                                  <small id="image" class="form-text text-muted"
                                          >This Image show in your Brand Image section.
                                  </small>
                              </div> 
                          </div>
                          

                        </div>
                      </div>
                    </div>
                    <div class="card-action text-center">
                      <button class="btn btn-success" type="submit">Submit</button>
                      <a href="{{route('admin.brands')}}" class="btn btn-danger">Cancel</a>
                    </div>
                  </form>
                </div>
              </div>
        </div>
    </div>
</div>


@endsection
