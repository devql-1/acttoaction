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
                    <div class="card-title">Update Record for Blogs Posts Category</div>
                  </div>
                  <form action="{{route('admin.blog-category-update',$edit->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="id" name="id">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-12 col-lg-12">
                          <div class="form-group row">
                              <div class="col-md-3">
                                  <label for="category_name">Category Name</label>
                                  <span class="text-danger">*</span>
                              </div>
                              <div class="col-md-9">
                                  <input
                                      type="text"
                                      name="category_name"
                                      onkeyup="makeSlug(this.value)"
                                      class="form-control @error('category_name') is-invalid @enderror"
                                      id="cat_name"
                                      value="{{old('category_name',$edit->category_name)}}"
                                      placeholder="Enter Category"
                                  />
                                  @error('category_name')
                                    <p class="invalid-feedback">{{$message}}</p>
                                  @enderror
                                  <small id="cat_nameHelp2" class="form-text text-muted"
                                          >This Category name your Blogs Category Name.
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
                                          >creating a slug from your category name.
                                  </small>
                              </div>
                          </div>

                        </div>
                      </div>
                    </div>
                    <div class="card-action text-center">
                      <button class="btn btn-success" type="submit">Add Blogs</button>
                      <a href="{{route('admin.blog-category')}}" class="btn btn-danger">Cancel</a>
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