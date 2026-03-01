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
                            <div class="card-title">Services Enquiries Info</div>
                            <!-- <a href="{{route('admin.about-create')}}" class="btn btn-dark ms-auto"><i class="fa fa-plus"></i> Add About</a> -->
                        </div>
                    </div>
                    <div class="card-body p-2">
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center mb-0" id="basic-datatables">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col" class="text-end">Service</th>
                                        <th scope="col" class="text-end">Email</th>
                                        <th scope="col" class="text-end">Phone No.</th>
                                        <!-- <th scope="col" class="text-end">Date</th> -->
                                        <th scope="col" class="text-end">Message</th>
                                        <th scope="col" class="text-end">Status</th>
                                        <th scope="col" class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($services_enquiries as $key => $enquiry)
                                    <tr id="record-row-{{ $enquiry->id }}">
                                        <td>{{ $key+1 }}</td>
                                      
                                        <th scope="row">
                                            {{ $enquiry->username ? $enquiry->username : '--' }}
                                        </th>

                                        <td>{{ $enquiry->service->title }}</td>

                                        <td>{{ $enquiry->email }}</td>

                                        <td>{{ $enquiry->phone }}</td>

                                        <!-- <td>{{ $enquiry->date }}</td> -->

                                        <td>{{ $enquiry->message }}</td>

                                        <td>
                                            @if($enquiry->is_read == 1)
                                            <span class="badge badge-success">Read</span>
                                            @else
                                            <span class="badge badge-danger">Unread</span>
                                            @endif
                                        </td>

                                        <td class="text-end">
                                            <div class="form-button-action">

                                                <a href="javascript:void(0)"
                                                   class="btn btn-icon btn-round btn-danger btn-lg delete-record"
                                                   data-id="{{ $enquiry->id }}"
                                                   data-url="{{ route('admin.enquiries-destroy', $enquiry->id) }}">
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






