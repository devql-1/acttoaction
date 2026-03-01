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
                    <div class="card-title">Update Record for Service Sub Category</div>
                  </div>
                  <form action="{{route('admin.service-subcategory-update',$edit->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="id" name="id">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-12 col-lg-12">
                          <div class="form-group row">
                              <div class="col-md-3">
                                  <label for="subcategory_name">Sub Category Name</label>
                                  <span class="text-danger">*</span>
                              </div>
                              <div class="col-md-9">
                                  <input
                                      type="text"
                                      name="subcategory_name"
                                      onkeyup="makeSlug(this.value)"
                                      class="form-control @error('subcategory_name') is-invalid @enderror"
                                      id="cat_name"
                                      value="{{old('subcategory_name',$edit->subcategory_name)}}"
                                      placeholder="Enter Sub Category"
                                  />
                                  @error('subcategory_name')
                                    <p class="invalid-feedback">{{$message}}</p>
                                  @enderror
                                  <small id="cat_nameHelp2" class="form-text text-muted"
                                          >This Category name your Service Sub Category Name.
                                  </small>

                              </div>
                          </div>
                          <div class="form-group row">
                              <div class="col-md-3">
                                  <label for="slug">Slug</label>
                                  <span class="text-danger">*</span>
                              </div>
                              <div class="col-md-9">
                                  <input
                                      type="text"
                                      class="form-control"
                                      name="slug"
                                      id="slug"
                                      value="{{$edit->slug}}"
                                      placeholder="slug"
                                      
                                  />
                                  <small id="slug" class="form-text text-muted"
                                          >creating a slug from your sub category name.
                                  </small>
                              </div>
                          </div>

                          <div class="form-group row">
                              <div class="col-md-3">
                                  <label for="select_category">Select Category</label>
                              </div>
                              <div class="col-md-9">
                                  <select name="category_id" id="category_id" class="form-select select2" style="width: 100%;">
                                      <option value="">-- Select Category --</option>
                                      @foreach($service_categories as $category)
                                          <option value="{{ $category->id }}" {{ $edit->category_id == $category->id ? 'selected' : '' }}>
                                              {{ $category->category_name }}
                                          </option>
                                      @endforeach
                                  </select>
                              </div>

 
                          </div>

                        </div>
                      </div>
                    </div>
                    <div class="card-action text-center">
                      <button class="btn btn-success" type="submit">Submit</button>
                      <a href="{{route('admin.service-subcategory')}}" class="btn btn-danger">Cancel</a>
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