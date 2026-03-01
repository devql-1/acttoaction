@extends('backend.layout.app')
@section('content')
        <div class="container">
          <div class="page-inner">
            <div class="row">
              <div class="col-md-7 mx-auto">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">Your Profile Here</div>
                  </div>
                  <form action="{{ route('admin.profile.update') }}" method="post" enctype="multipart/form-data">
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
                                        <input type="text"
                                            name="name"
                                            value="{{ old('name', $profile->name) }}"
                                            class="form-control @error('name') is-invalid @enderror"
                                            id="name"
                                            placeholder="Enter Name" />
                                        @error('name')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="email">Email</label>
                                        <span class="text-danger">*</span>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="email"
                                            class="form-control @error('email') is-invalid @enderror"
                                            name="email"
                                            id="email"
                                            value="{{ old('email', $profile->email) }}"
                                            placeholder="sam@gmail.com" />
                                        @error('email')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="old_password">Current Password</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="password"
                                            class="form-control @error('old_password') is-invalid @enderror"
                                            name="old_password"
                                            id="old_password"
                                            placeholder="Enter Your Current Password" />
                                        @error('old_password')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="new_password">Set New Password</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="password"
                                            class="form-control @error('new_password') is-invalid @enderror"
                                            name="new_password"
                                            id="new_password"
                                            placeholder="Enter Your New Password" />
                                        @error('new_password')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="new_password_confirmation">Re-enter Password</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="password"
                                            class="form-control"
                                            name="new_password_confirmation"
                                            id="new_password_confirmation"
                                            placeholder="Re-enter Your New Password" />
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="image">Profile Picture</label>
                                    </div>
                                    <div class="col-md-9">
                                        <x-file-upload name="image" label="Upload Image" :current="$profile->image"/>
                                        @error('image')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card-action text-end">
                        <button class="btn btn-success text-uppercase" type="submit">Update Profile</button>
                    </div>
                </form>

                </div>
              </div>
            </div>
          </div>
        </div>

@endsection
