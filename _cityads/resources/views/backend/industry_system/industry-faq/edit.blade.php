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
                    <div class="card-title">Update Industry FAQ Record for Your Industries</div>
                  </div>
                  <form action="{{route('admin.industry-faq-update',$industry_faq->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="id">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-12 col-lg-12">
                          <div class="form-group row">
                              <div class="col-md-3">
                                  <label for="industry_id">Select Your Industry</label>
                              </div>
                              <div class="col-md-9">
                                  <select name="industry_id" id="industry_id" class="form-select select2" style="width: 100%;">
                                      <option value="">-- Select Your Industry --</option>
                                      @foreach($industry_info as $industry)
                                          <option value="{{ $industry->id }}" {{ $industry_faq->industry_id == $industry->id ? 'selected' : '' }}>
                                              {{ $industry->title }}
                                          </option>
                                      @endforeach
                                  </select>
                              </div>

 
                          </div>
                          <div class="form-group row">
                              <div class="col-md-3">
                                  <label for="question">Questions</label>
                                  <span class="text-danger">*</span>
                              </div>
                              <div class="col-md-9">
                                  <input
                                      type="text"
                                      class="form-control @error('question') is-invalid @enderror"
                                      id="question"
                                      name="question"
                                      value="{{old('question',$industry_faq->question)}}"
                                      placeholder="Enter Question"
                                  />
                                  @error('question')
                                    <p class="invalid-feedback">{{$message}}</p>
                                  @enderror
                                  <small id="questionHelp" class="form-text text-muted"
                                          >Update Question for your selected Industry.
                                  </small>
                              </div>
                          </div>
                          
                          <div class="form-group row">
                              <div class="col-md-3">
                                  <label for="answer">Answer</label>
                              </div>
                              <div class="col-md-9">
                                  <textarea id="myeditor" name="answer">{{ $industry_faq->answer }}</textarea>
                              </div> 
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-action text-center">
                      <button class="btn btn-success" type="submit">Submit</button>
                      <a href="{{route('admin.industry-faq')}}" class="btn btn-danger">Cancel</a>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

@endsection
