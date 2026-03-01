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
                    <div class="card-title">Update Team Members Record</div>
                  </div>
                  <form action="{{route('admin.team_members-update',$team_members->id)}}" method="post" enctype="multipart/form-data">
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
                                      value="{{old('name',$team_members->name)}}"
                                      placeholder="Enter Name"
                                  />
                                  @error('name')
                                    <p class="invalid-feedback">{{$message}}</p>
                                  @enderror
                                  <small id="nameHelp2" class="form-text text-muted"
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
                                      value="{{ $team_members->designation }}"
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
                                  <x-file-upload name="image" label="Upload Image" :current="$team_members->image" />
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
                                  <input type="checkbox" id="add_social"
                                      @if(!empty($team_members->instagram_url) || !empty($team_members->facebook_url) || !empty($team_members->twitter_url) || !empty($team_members->linkedin_url)) checked @endif> <label for="add_social"> Add Social Media Links</label><br>
                                   <small id="social_urlHelp" class="form-text text-muted"
                                          >if you unchecked your checkbox so your all social media url save as null
                                  </small>   
                              </div>
                          </div>

                          <div id="social-fields" 
                               style="display: {{ (!empty($team_members->instagram_url) || !empty($team_members->facebook_url) || !empty($team_members->twitter_url) || !empty($team_members->linkedin_url)) ? 'block' : 'none' }};">

                              <div class="form-group row">
                                  <div class="col-md-3">
                                      <label for="instagram_url">Instagram Url</label>
                                  </div>
                                  <div class="col-md-9">
                                      <input type="text" name="instagram_url" class="form-control" id="instagram_url"
                                             placeholder="Paste Your Instagram Url"
                                             value="{{ old('instagram_url', $team_members->instagram_url ?? '') }}"/>
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <div class="col-md-3">
                                      <label for="facebook_url">Facebook Url</label>
                                  </div>
                                  <div class="col-md-9">
                                      <input type="text" name="facebook_url" class="form-control" id="facebook_url"
                                             placeholder="Paste Your Facebook Url"
                                             value="{{ old('facebook_url', $team_members->facebook_url ?? '') }}"/>
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <div class="col-md-3">
                                      <label for="twitter_url">Twitter-X Url</label>
                                  </div>
                                  <div class="col-md-9">
                                      <input type="text" name="twitter_url" class="form-control" id="twitter_url"
                                             placeholder="Paste Your Twitter-X Url"
                                             value="{{ old('twitter_url', $team_members->twitter_url ?? '') }}"/>
                                  </div>
                              </div>

                              <div class="form-group row">
                                  <div class="col-md-3">
                                      <label for="linkedin_url">LinkedIn Url</label>
                                  </div>
                                  <div class="col-md-9">
                                      <input type="text" name="linkedin_url" class="form-control" id="linkedin_url"
                                             placeholder="Paste Your LinkedIn Url"
                                             value="{{ old('linkedin_url', $team_members->linkedin_url ?? '') }}"/>
                                  </div>
                              </div>
                          </div>

                         
                          
                          {{--<div class="form-group row">
                              <div class="col-md-3">
                                  <label for="message">Message</label>
                              </div>
                              <div class="col-md-9">
                                  <textarea id="myeditor" name="message">{{ $team_members->message }}</textarea>
                              </div> 
                          </div> --}}
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


@section('script')
<script>
    function makeSlug(val) {
        let str = val;
        let output = str.replace(/\s+/g, '-').toLowerCase();
        $('#slug').val(output);
    }
</script>
@endsection