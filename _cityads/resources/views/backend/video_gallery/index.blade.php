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
                            <div class="card-title">Video Gallery Info</div>
                        </div>
                    </div>
                    <div class="card-body p-2">
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center mb-0" id="basic-datatables">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <!-- <th scope="col" class="text-center">Video Poster</th> -->
                                        <th scope="col" class="text-center">Video Gallery</th>
                                        <th scope="col" class="text-center">Video Name</th>
                                        <th scope="col" class="text-center">Published</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($video_gallery as $video)
                                    <tr id="record-row-{{ $video->id }}">
                                        <td>{{ $loop->iteration }}</td>

                                        <!-- <td>
                                            <p class="demo">
                                            <div class="avatar">
                                                <img src="{{asset($video->video_poster ? 'img/'.$video->video_poster : '../assets/img/placeholder-image-3.jpg')}}" alt="{{ $video->video_name }}" class="avatar-img rounded">
                                            </div>
                                            </p>
                                        </td> -->

                                        <td>
                                            <p class="demo">
                                            <div class="avatar">
                                                <video muted controls src="{{asset($video->video_item ? 'img/'.$video->video_item : '../assets/img/placeholder-image-3.jpg')}}" alt="{{ $video->video_name }}" class="avatar-img rounded">
                                            </div>
                                            </p>
                                        </td>
                                        

                                        <td class="text-center">{{ $video->video_name ? $video->video_name : '--' }}</td>
                                        
                                        <td class="text-center">
                                            <label class="switch">
                                              <input type="checkbox" class="toggle-status" data-id="{{ $video->id }}" data-url="{{ route('admin.video_gallery-status') }}" {{ $video->status == 1 ? 'checked' : '' }}>
                                              <span class="record-toggle"></span>
                                            </label>
                                             <!-- <span class="badge badge-success">Completed</span> -->
                                        </td>

                                        <td class="text-center">
                                            <div class="form-button-action">
                                                

                                                <a href="{{route('admin.video_gallery-edit',$video->id)}}"
                                                   class="btn btn-link btn-primary btn-lg me-2">
                                                   <i class="fa fa-edit"></i>
                                                </a>

                                                <a href="javascript:void(0)"
                                                   class="btn btn-link btn-danger btn-lg delete-record"
                                                   data-id="{{ $video->id }}"
                                                   data-url="{{ route('admin.video_gallery-destroy', $video->id) }}">
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
                    <div class="card-title">Add Video Gallery Record</div>
                  </div>
                  <form action="{{route('admin.video_gallery-store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-12 col-lg-12">
                          <div class="form-group row">
                              <div class="col-md-12">
                                  <label for="video_name">Video Name (Optional)</label>
                                  <!-- <span class="text-danger">*</span> -->
                              
                                  <input
                                      type="text"
                                      name="video_name"
                                      class="form-control"
                                      id="video_name"
                                      placeholder="Enter Video Gallery Name"
                                  />
                                  
                                  <small id="video_nameHelp2" class="form-text text-muted"
                                          >This Video name your Video Gallery Name.
                                  </small>

                              </div>
                          </div>

                          <div class="form-group row">
                              <div class="col-md-12">
                                  <label for="video_poster">Video Poster</label>

                                  <x-file-upload name="video_poster" label="Upload Video Poster" />

                                  <small id="video_poster" class="form-text text-muted"
                                          >This Video Poster is show in your Video Section.
                                  </small>
                              </div> 
                          </div>

                          <div class="form-group row">
                              <div class="col-md-12">
                                <p class="@error('video_item') is-invalid @enderror">
                                  <label for="video_item">Video Gallery</label>
                                  <span class="text-danger">*</span>
                                  <x-file-upload name="video_item" label="Upload Video Item" />
                                </p>
                                  @error('video_item')
                                    <p class="invalid-feedback">{{$message}}</p>
                                  @enderror

                                  <small id="video_item" class="form-text text-muted"
                                          >This Video show in your Videos Gallery section.
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
