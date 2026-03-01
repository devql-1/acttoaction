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
                            <div class="card-title">Team Members Info</div>
                            <a href="{{route('admin.team_members-create')}}" class="btn btn-dark ms-auto"><i class="fa fa-plus"></i> Add Team Members</a>
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
                                        <th scope="col" class="text-end">Name</th>
                                        <th scope="col" class="text-end">Designation</th>
                                        <!-- <th scope="col" class="text-center">Rating</th> -->
                                        <th scope="col" class="text-end">Published</th>
                                        <th scope="col" class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($team_members as $team)
                                    <tr id="record-row-{{ $team->id }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <p class="demo">
                                            <div class="avatar">
                                                <img src="{{asset($team->image ? 'img/'.$team->image : '../assets/img/placeholder-image-3.jpg')}}" alt="{{ $team->title }}" class="avatar-img rounded">
                                            </div>
                                            </p>
                                        </td>
                                        <th scope="row">
                                            <button
                                                class="btn btn-icon btn-round btn-success btn-sm me-2">
                                                <i class="fa fa-check"></i>
                                            </button>
                                            {{ $team->name ? $team->name : '--' }}
                                        </th>
                                        <th scope="row">
                                            <!-- <button
                                                class="btn btn-icon btn-round btn-success btn-sm me-2">
                                                <i class="fa fa-check"></i>
                                            </button> -->
                                            {{ $team->designation ? $team->designation : '--' }}
                                        </th>
                                       {{-- <td class="text-center">
                                            <div class="star-display" data-rating="{{ $team->rating }}"></div>
                                        </td> --}}

                                        <td class="text-end">
                                            <label class="switch">
                                              <input type="checkbox" class="toggle-status" data-id="{{ $team->id }}" data-url="{{ route('admin.team_members-status') }}" {{ $team->status == 1 ? 'checked' : '' }}>
                                              <span class="record-toggle"></span>
                                            </label>
                                             <!-- <span class="badge badge-success">Completed</span> -->
                                        </td>
                                        <td class="text-end">
                                            <div class="form-button-action">
                                                

                                                <a href="{{route('admin.team_members-edit',$team->id)}}"
                                                   class="btn btn-icon btn-round btn-primary btn-lg me-3">
                                                   <i class="fa fa-edit"></i>
                                                </a>

                                                <a href="javascript:void(0)"
                                                   class="btn btn-icon btn-round btn-danger btn-lg delete-record"
                                                   data-id="{{ $team->id }}"
                                                   data-url="{{ route('admin.team_members-destroy', $team->id) }}">
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


