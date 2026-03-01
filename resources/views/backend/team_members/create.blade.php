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
                    <div class="card-title">Add Team Members Record</div>
                  </div>
                  <form action="{{route('admin.team_members-store')}}" method="post" enctype="multipart/form-data">
                    @csrf
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
                                      name="name"
                                      class="form-control @error('name') is-invalid @enderror"
                                      id="name"
                                      placeholder="Enter Name"
                                  />
                                  @error('name')
                                    <p class="invalid-feedback">{{$message}}</p>
                                  @enderror
                                  <small id="nameHelp" class="form-text text-muted"
                                          >This name your Team Members Person.
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
                                      placeholder="Enter Designation"
                                  />
                                 
                                  <small id="designationHelp" class="form-text text-muted"
                                          >This designation your Team Members Person.
                                  </small>

                              </div>
                          </div>

                          <div class="form-group row">
                              <div class="col-md-3">
                                  <label for="image">Image</label>
                              </div>
                              <div class="col-md-9">
                                  
                                  <x-file-upload name="image" label="Upload Image" />

                                  <small id="image" class="form-text text-muted"
                                          >This Image is Team Members Image.
                                  </small>
                              </div> 
                          </div>

                          <div class="form-group row">
                              <div class="col-md-3">
                                  <label>Social Media URL</label>
                              </div>
                              <div class="col-md-9">
                                  <input type="checkbox" id="add_social"> <label for="add_social">Add Social Media Links</label>
                              </div>
                          </div>

                          <div id="social-fields" style="display:none;">
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label for="instagram_url">Instagram Url</label>
                                    <!-- <span class="text-danger">*</span> -->
                                </div>
                                <div class="col-md-9">
                                    <input
                                        type="text"
                                        name="instagram_url"
                                        class="form-control"
                                        id="instagram_url"
                                        placeholder="Paste Your Instagram Url"
                                    />

                                    <small id="instagram_urlHelp" class="form-text text-muted"
                                            >This Instagram Url your Team Members Person.
                                    </small>

                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label for="facebook_url">Facebook Url</label>
                                    <!-- <span class="text-danger">*</span> -->
                                </div>
                                <div class="col-md-9">
                                    <input
                                        type="text"
                                        name="facebook_url"
                                        class="form-control"
                                        id="facebook_url"
                                        placeholder="Paste Your Facebook Url"
                                    />

                                    <small id="facebook_urlHelp" class="form-text text-muted"
                                            >This Facebook Url your Team Members Person.
                                    </small>

                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label for="twitter_url">Twitter-X Url</label>
                                    <!-- <span class="text-danger">*</span> -->
                                </div>
                                <div class="col-md-9">
                                    <input
                                        type="text"
                                        name="twitter_url"
                                        class="form-control"
                                        id="twitter_url"
                                        placeholder="Paste Your Twitter-X Url"
                                    />

                                    <small id="twitter_urlHelp" class="form-text text-muted"
                                            >This Twitter-X Url your Team Members Person.
                                    </small>

                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label for="linkedin_url">LinkedIn Url</label>
                                    <!-- <span class="text-danger">*</span> -->
                                </div>
                                <div class="col-md-9">
                                    <input
                                        type="text"
                                        name="linkedin_url"
                                        class="form-control"
                                        id="linkedin_url"
                                        placeholder="Paste Your LinkedIn Url"
                                    />

                                    <small id="linkedin_urlHelp" class="form-text text-muted"
                                            >This LinkedIn Url your Team Members Person.
                                    </small>

                                </div>
                            </div>
                          </div>

                          {{--<div class="form-group row">
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
                                      placeholder="Enter Rating"
                                  />
                                  
                                 
                                  <small id="rating-message" style="font-weight:bold; color:#f39c12;"
                                          >
                                  </small>

                              </div>
                          </div>--}}
                          
                          
                          
                          {{--<div class="form-group row">
                              <div class="col-md-3">
                                  <label for="message">Message</label>
                              </div>
                              <div class="col-md-9">
                                  <textarea id="myeditor" name="message"></textarea>
                              </div> 
                          </div>--}}

                          
                        </div>
                      </div>
                    </div>
                    <div class="card-action text-center">
                      <button class="btn btn-success" type="submit">Submit</button>
                      <a href="{{route('admin.team_members')}}" class="btn btn-danger">Cancel</a>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

@endsection