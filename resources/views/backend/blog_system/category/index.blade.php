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
            <div class="col-md-7">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">Blogs Category Info</div>
                        </div>
                    </div>
                    <div class="card-body p-2">
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center mb-0" id="basic-datatables">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col" class="text-center">Category Name</th>
                                        <th scope="col" class="text-center">Published</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($blogs_category as $blog)
                                    <tr id="record-row-{{ $blog->id }}">
                                        <td>{{ $loop->iteration }}</td>
                                        

                                        <td class="text-center">{{ $blog->category_name ? $blog->category_name : '--' }}</td>
                                        
                                        <td class="text-center">
                                            <label class="switch">
                                              <input type="checkbox" class="toggle-status" data-id="{{ $blog->id }}" data-url="{{ route('admin.blog-category-status') }}" {{ $blog->status == 1 ? 'checked' : '' }}>
                                              <span class="record-toggle"></span>
                                            </label>
                                             <!-- <span class="badge badge-success">Completed</span> -->
                                        </td>

                                        <td class="text-center">
                                            <div class="form-button-action">
                                                

                                                <a href="{{route('admin.blog-category-edit',$blog->id)}}"
                                                   class="btn btn-link btn-primary btn-lg me-2">
                                                   <i class="fa fa-edit"></i>
                                                </a>

                                                <a href="javascript:void(0)"
                                                   class="btn btn-link btn-danger btn-lg delete-record"
                                                   data-id="{{ $blog->id }}"
                                                   data-url="{{ route('admin.blog-category-destroy', $blog->id) }}">
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
            <div class="col-md-5">
                <div class="card">
                  <div class="card-header">
                    <div class="card-title">Add Record for Blogs Posts Category</div>
                  </div>
                  <form action="{{route('admin.blog-category-store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-12 col-lg-12">
                          <div class="form-group row">
                              <div class="col-md-3">
                                  <label for="cat_name">Category Name</label>
                                  <span class="text-danger">*</span>
                              </div>
                              <div class="col-md-9">
                                  <input
                                      type="text"
                                      name="category_name"
                                      onkeyup="makeSlug(this.value)"
                                      class="form-control @error('category_name') is-invalid @enderror"
                                      id="cat_name"
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