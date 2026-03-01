@extends('backend.layout.app')
@section('content')
        <div class="container">
          <div class="page-inner">
            <div class="row">
              <div class="col-md-7 mx-auto">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">Your Website Settings Here</div>
                  </div>
                  <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">

                                {{-- Website Name --}}
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="website_name">Website Name</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="website_name" class="form-control" 
                                               value="{{ get_setting('website_name') }}">
                                    </div>
                                </div>
            
                                {{-- Site Moto --}}
                                <div class="form-group row mt-3">
                                    <div class="col-md-3">
                                        <label for="site_motto">Site Moto</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text" name="site_motto" class="form-control" 
                                               value="{{ get_setting('site_motto') }}">
                                    </div>
                                </div>
            
                                {{-- Site Logo --}}
                                <div class="form-group row mt-3">
                                    <div class="col-md-3">
                                        <label for="site_logo">Site Logo</label>
                                    </div>
                                    <div class="col-md-9">
                                        <x-file-upload name="site_logo" label="Upload Logo" :current="get_setting('site_logo')" />
                                    </div>
                                </div>
            
                                {{-- System Logo White --}}
                                <div class="form-group row mt-3">
                                    <div class="col-md-3">
                                        <label for="system_logo_white">System Logo (White)</label>
                                    </div>
                                    <div class="col-md-9">
                                        <x-file-upload name="system_logo_white" label="Upload Logo (White)" :current="get_setting('system_logo_white')" />
                                    </div>
                                </div>
            
                                {{-- System Logo Black --}}
                                <div class="form-group row mt-3">
                                    <div class="col-md-3">
                                        <label for="system_logo_black">System Logo (Black)</label>
                                    </div>
                                    <div class="col-md-9">
                                        <x-file-upload name="system_logo_black" label="Upload Logo (Black)" :current="get_setting('system_logo_black')" />
                                    </div>
                                </div>
            
                                {{-- Login Page Image --}}
                                <div class="form-group row mt-3">
                                    <div class="col-md-3">
                                        <label for="login_page_image">Login Page Image</label>
                                    </div>
                                    <div class="col-md-9">
                                        <x-file-upload name="login_page_image" label="Upload Image" :current="get_setting('login_page_image')" />
                                    </div>
                                </div>
            
                                {{-- Login Background Image --}}
                                <div class="form-group row mt-3">
                                    <div class="col-md-3">
                                        <label for="login_background_image">Login Background Image</label>
                                    </div>
                                    <div class="col-md-9">
                                        <x-file-upload name="login_bg_image" label="Upload Background" :current="get_setting('login_bg_image')" />
                                    </div>
                                </div>
            
                                <div class="form-group row mt-4">
                                    <div class="col-md-12 text-end">
                                        <button type="submit" class="btn btn-success">Save Settings</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>


                </div>
              </div>
            </div>
          </div>
        </div>

@endsection












