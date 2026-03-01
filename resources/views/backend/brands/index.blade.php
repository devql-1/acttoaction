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
            <div class="col-md-8">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">Brand or Partner Info</div>
                        </div>
                    </div>
                    <div class="card-body p-2">
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center mb-0" id="basic-datatables">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col" class="text-center">Brand Image</th>
                                        <th scope="col" class="text-center">Brand Name</th>
                                        <th scope="col" class="text-center">Published</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($brands as $brand)
                                    <tr id="record-row-{{ $brand->id }}">
                                        <td>{{ $loop->iteration }}</td>

                                        <td>
                                            <p class="demo">
                                            <div class="avatar">
                                                <img src="{{asset($brand->image ? 'img/'.$brand->image : '../assets/img/placeholder-image-3.jpg')}}" alt="{{ $brand->brands_name }}" class="avatar-img rounded">
                                            </div>
                                            </p>
                                        </td>
                                        

                                        <td class="text-center">{{ $brand->brand_name ? $brand->brand_name : '--' }}</td>
                                        
                                        <td class="text-center">
                                            <label class="switch">
                                              <input type="checkbox" class="toggle-status" data-id="{{ $brand->id }}" data-url="{{ route('admin.brands-status') }}" {{ $brand->status == 1 ? 'checked' : '' }}>
                                              <span class="record-toggle"></span>
                                            </label>
                                             <!-- <span class="badge badge-success">Completed</span> -->
                                        </td>

                                        <td class="text-center">
                                            <div class="form-button-action">
                                                

                                                <a href="{{route('admin.brands-edit',$brand->id)}}"
                                                   class="btn btn-link btn-primary btn-lg me-2">
                                                   <i class="fa fa-edit"></i>
                                                </a>

                                                <a href="javascript:void(0)"
                                                   class="btn btn-link btn-danger btn-lg delete-record"
                                                   data-id="{{ $brand->id }}"
                                                   data-url="{{ route('admin.brands-destroy', $brand->id) }}">
                                                   <i class="fa fa-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                  

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">Add Brand or Partner Record</div>
                  </div>
                  <form action="{{route('admin.brands-store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-12 col-lg-12">
                          <div class="form-group row">
                              <div class="col-md-12">
                                  <label for="brand_name">Brand Name</label>
                                  <span class="text-danger">*</span>
                              
                                  <input
                                      type="text"
                                      name="brand_name"
                                      class="form-control @error('brand_name') is-invalid @enderror"
                                      id="brand_name"
                                      placeholder="Enter Brand"
                                  />
                                  @error('brand_name')
                                    <p class="invalid-feedback">{{$message}}</p>
                                  @enderror
                                  <small id="brand_nameHelp2" class="form-text text-muted"
                                          >This Brand name your Partner Brands Name.
                                  </small>

                              </div>
                          </div>

                          <div class="form-group row">
                              <div class="col-md-12">
                                  <label for="image">Image</label>
                              
                                  <x-file-upload name="image" label="Upload Image" />

                                  <small id="image" class="form-text text-muted"
                                          >This Image show in your Brands Image section.
                                  </small>
                              </div> 
                          </div>
                          

                        </div>
                      </div>
                    </div>
                    <div class="card-action text-center">
                      <button class="btn btn-success" type="submit">Submit</button>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
