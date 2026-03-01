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
                            <div class="card-title">Essentials Info</div>
                            <a href="{{route('admin.service-essentials-create')}}" class="btn btn-dark ms-auto"><i class="fa fa-plus"></i> Add Essentials</a>
                        </div>
                    </div>
                    <div class="card-body p-2">
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center mb-0" id="basic-datatables">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <!-- <th scope="col">Image</th> -->
                                        <th scope="col" class="text-center">Title</th>
                                        <th scope="col" class="text-center">Service Name</th>
                                        <th scope="col" class="text-center">Icon</th>
                                        <th scope="col" class="text-center">Published</th>
                                        <th scope="col" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($service_essentials as $essentials)
                                    <tr id="record-row-{{ $essentials->id }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <!-- <td>
                                           
                                        </td> -->
                                        <th scope="row">
                                            <button
                                                class="btn btn-icon btn-round btn-success btn-sm me-2">
                                                <i class="fa fa-check"></i>
                                            </button>
                                            {{ $essentials->title ? $essentials->title : '--' }}
                                        </th>
                                        <td class="text-center">
                                            @if($essentials->service != null)
                                                {{ $essentials->service->title }}
                                            @else
                                                --
                                            @endif
                                        </td>

                                        <td class="text-center">
                                            <!-- <button
                                                class="btn btn-icon btn-round btn-success btn-sm me-2">
                                                <i class="fa fa-check"></i>
                                            </button> -->
                                            <i class="fa {{ $essentials->icon }} me-2"></i>{{ $essentials->icon }}
                                        </td>

                                        <td class="text-center">
                                            <label class="switch">
                                              <input type="checkbox" class="toggle-status" data-id="{{ $essentials->id }}" data-url="{{ route('admin.service-essentials-status') }}" {{ $essentials->status == 1 ? 'checked' : '' }}>
                                              <span class="record-toggle"></span>
                                            </label>
                                             <!-- <span class="badge badge-success">Completed</span> -->
                                        </td>
                                        <td class="text-center">
                                            <div class="form-button-action">
                                                

                                                <a href="{{route('admin.service-essentials-edit',$essentials->id)}}"
                                                   class="btn btn-link btn-primary btn-lg me-3">
                                                   <i class="fa fa-edit"></i>
                                                </a>

                                                <a href="javascript:void(0)"
                                                   class="btn btn-link btn-danger btn-lg delete-record"
                                                   data-id="{{ $essentials->id }}"
                                                   data-url="{{ route('admin.service-essentials-destroy', $essentials->id) }}">
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
