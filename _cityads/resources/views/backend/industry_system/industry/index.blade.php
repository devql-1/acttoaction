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
            <div class="col-md-12">
                <div class="card card-round">
                    <div class="card-header">
                        <div class="card-head-row card-tools-still-right">
                            <div class="card-title">Industry Info</div>
                            <a href="{{route('admin.industry-create')}}" class="btn btn-dark ms-auto"><i class="fa fa-plus-square"></i> Add Industry</a>
                        </div>
                    </div>
                    <div class="card-body p-2">
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center mb-0" id="basic-datatables">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Image</th>
                                        <th scope="col" class="text-end">Title</th>
                                        <th scope="col" class="text-end">Short Desc</th>
                                        <th scope="col" class="text-end">Published</th>
                                        <th scope="col" class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($industries as $industry)
                                    <tr id="record-row-{{ $industry->id }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <p class="demo">
                                            <div class="avatar">
                                                <img src="{{asset($industry->image ? 'img/'.$industry->image : '../assets/img/placeholder-image-3.jpg')}}" alt="{{ $industry->title }}" class="avatar-img rounded">
                                            </div>
                                            </p>
                                        </td>
                                        <th scope="row">
                                            <button
                                                class="btn btn-icon btn-round btn-success btn-sm me-2">
                                                <i class="fa fa-check"></i>
                                            </button>
                                            {{ $industry->title ? $industry->title : '--' }}
                                        </th>

                                        
                                        <td class="text-end">{{ $industry->short_description ? $industry->short_description : '--' }}</td>

                                        <td class="text-end">
                                            <label class="switch">
                                              <input type="checkbox" class="toggle-status" data-id="{{ $industry->id }}" data-url="{{ route('admin.industry-status') }}" {{ $industry->status == 1 ? 'checked' : '' }}>
                                              <span class="record-toggle"></span>
                                            </label>
                                             <!-- <span class="badge badge-success">Completed</span> -->
                                        </td>
                                        <td class="text-end">
                                            <div class="form-button-action">
                                                <a href="{{route('admin.industry-edit',$industry->id)}}"
                                                   class="btn btn-icon btn-round btn-primary btn-lg me-3">
                                                   <i class="fa fa-edit"></i>
                                                </a>

                                                <a href="javascript:void(0)"
                                                   class="btn btn-icon btn-round btn-danger btn-lg delete-record"
                                                   data-id="{{ $industry->id }}"
                                                   data-url="{{ route('admin.industry-destroy', $industry->id) }}">
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
        </div>
    </div>
</div>


@endsection
