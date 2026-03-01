@extends('backend.layout.app')
@section('content')
        <div class="container">
          <div class="page-inner">
            <div class="row">
              <div class="col-md-7 mx-auto">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">Edit Contact Information</div>
                  </div>
                  <form action="{{ route('admin.contact-info.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-12">
                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="phone">Phone No.</label>
                                        <span class="text-danger">*</span>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text"
                                            name="phone"
                                            value="{{ old('name', $contact->phone) }}"
                                            class="form-control"
                                            id="phone"
                                            placeholder="Enter Phone No." />
                                      <small>Enter Your Phone No. without Country Code</small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="email">Email</label>
                                        <span class="text-danger">*</span>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="email"
                                            class="form-control"
                                            name="email"
                                            id="email"
                                            value="{{ old('email', $contact->email) }}"
                                            placeholder="sam@gmail.com" />
                                        
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="whatsapp">WhatsApp No.</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text"
                                            class="form-control"
                                            name="whatsapp"
                                            value="{{ old('whatsapp', $contact->whatsapp) }}"
                                            id="whatsapp"
                                            placeholder="Enter WhatsApp No." />
                                        <small>Enter Your WhatsApp No. without Country Code</small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="address">Address</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text"
                                            class="form-control"
                                            name="address"
                                            value="{{ old('address', $contact->address) }}"
                                            id="address"
                                            placeholder="Enter Your Address" />
                                        
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="gml">Google Map Link</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="url"
                                            class="form-control"
                                            name="map_link"
                                            value="{{ old('map_link', $contact->map_link) }}"
                                            id="gml"
                                            placeholder="Paste Your Google Map Link Here.." />
                                        
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="thl">Top Header Title</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text"
                                            class="form-control"
                                            name="top_header_title"
                                            value="{{ old('top_header_title', $contact->top_header_title) }}"
                                            id="thl"
                                            placeholder="Enter Your Top Header Title.." />
                                        <marquee behavior="scroll" direction="left" class="bg-primary rounded text-white mt-2">{{ old('top_header_title', $contact->top_header_title) }}</marquee>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="fb_url">Facebook URL</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="url"
                                            class="form-control"
                                            name="fb_url"
                                            value="{{ old('fb_url', $contact->fb_url) }}"
                                            id="fb_url"
                                            placeholder="Paste Your Facebook URL Here.." />
                                        
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="insta_url">Instagram URL</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="url"
                                            class="form-control"
                                            name="insta_url"
                                            value="{{ old('insta_url', $contact->insta_url) }}"
                                            id="insta_url"
                                            placeholder="Paste Your Instagram URL Here.." />
                                        
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-md-3">
                                        <label for="linkedin_url">LinkedIn URL</label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="url"
                                            class="form-control"
                                            name="linkedin_url"
                                            value="{{ old('linkedin_url', $contact->linkedin_url) }}"
                                            id="linkedin_url"
                                            placeholder="Paste Your LinkedIn URL Here.." />
                                        
                                    </div>
                                </div>

                                

                            </div>
                        </div>
                    </div>
                    <div class="card-action text-end">
                        <button class="btn btn-success text-uppercase" type="submit">Save Changes</button>
                    </div>
                </form>

                </div>
              </div>
            </div>
          </div>
        </div>

@endsection
