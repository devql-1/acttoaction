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
                            <div class="card-title">Admission Enquiries Info</div>
                            <!-- <a href="{{route('admin.about-create')}}" class="btn btn-dark ms-auto"><i class="fa fa-plus"></i> Add About</a> -->
                        </div>
                    </div>
                    <div class="card-body p-2">
                        <div class="table-responsive">
                            <table class="table align-items-center mb-0" id="basic-datatables">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Full Details</th>
                                        <th>ID</th>
                                        <th>Student Name</th>
                                        <th>Email</th>
                                        <th>School</th>
                                        <th>Class</th>
                                        <th>Phone</th>
                                        <th>DOB</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($admission_enquiries as $key => $enquiry)
                                        <tr id="record-row-{{ $enquiry->id }}">
                                            <td class="text-center">
                                                <button class="btn btn-icon btn-round btn-outline-success toggle-details" data-id="{{ $enquiry->id }}">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </td>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $enquiry->name ?? '--' }}</td>
                                            <td>{{ $enquiry->email ?? '--' }}</td>
                                            <td>{{ $enquiry->school ?? '--' }}</td>
                                            <td>{{ $enquiry->classname ?? '--' }}</td>
                                            <td>{{ $enquiry->mobile ?? '--' }}</td>
                                            <td>{{ $enquiry->dob_year ?? '--' }}</td>
    
                                            <td>
                                                @if($enquiry->is_read == 1)
                                                    <span class="badge bg-success">Read</span>
                                                @else
                                                    <span class="badge bg-danger">Unread</span>
                                                @endif
                                            </td>
                                            <td class="text-end"> 
                                                <div class="form-button-action"> 
                                                    <a href="javascript:void(0)" class="btn btn-icon btn-round btn-danger btn-lg delete-record" data-id="{{ $enquiry->id }}" data-url="{{ route('admin.enquiries-destroy', $enquiry->id) }}"> 
                                                        <i class="fa fa-trash"></i> 
                                                    </a> 
                                                </div> 
                                            </td>
    
    
    
                                        </tr>
    
                                        {{-- Hidden details row --}}
                                        <tr id="details-{{ $enquiry->id }}" class="details-row" style="display:none; background: #f9f9f9;">
                                            <td colspan="10">
                                                <div class="p-3">
                                                    <div class="row">
                                                        <div class="col-md-4"><strong>Birth Place:</strong> {{ $enquiry->place_birth ?? '--' }}</div>
                                                        <div class="col-md-4"><strong>Fee:</strong> {{ $enquiry->fee ?? '--' }}</div>
                                                        <div class="col-md-4"><strong>Father Name:</strong> {{ $enquiry->father_name ?? '--' }}</div>
                                                        <div class="col-md-4"><strong>Father Occupation:</strong> {{ $enquiry->father_occupation ?? '--' }}</div>
                                                        <div class="col-md-4"><strong>Mother Name:</strong> {{ $enquiry->mother_name ?? '--' }}</div>
                                                        <div class="col-md-4"><strong>Mother Occupation:</strong> {{ $enquiry->mother_occupation ?? '--' }}</div>
                                                        <div class="col-md-4"><strong>Gender:</strong> {{ $enquiry->gender ?? '--' }}</div>
                                                        <div class="col-md-4"><strong>Category:</strong> {{ $enquiry->category ?? '--' }}</div>
                                                        <div class="col-md-4"><strong>Caste:</strong> {{ $enquiry->caste ?? '--' }}</div>
                                                        <div class="col-md-4"><strong>Religion:</strong> {{ $enquiry->religion ?? '--' }}</div>
                                                        <div class="col-md-4"><strong>Aadhar Card:</strong> {{ $enquiry->aadhar_card ?? '--' }}</div>
                                                        <div class="col-md-4"><strong>Address:</strong> {{ $enquiry->address ?? '--' }}</div>
                                                        <div class="col-md-4"><strong>Pincode:</strong> {{ $enquiry->pin_code ?? '--' }}</div>
                                                        <div class="col-md-4"><strong>State:</strong> {{ $enquiry->state ?? '--' }}</div>
                                                        <div class="col-md-4"><strong>District:</strong> {{ $enquiry->district ?? '--' }}</div>
                                                        <div class="col-md-4"><strong>Non Residential Indian:</strong> {{ $enquiry->residential ?? '--' }}</div>
                                                        <div class="col-md-4"><strong>Physically Handicapped:</strong> {{ $enquiry->physically ?? '--' }}</div>
                                                        <div class="col-md-4"><strong>Previous School:</strong> {{ $enquiry->name_previous_school ?? '--' }}</div>
                                                        <div class="col-md-4"><strong>Medium:</strong> {{ $enquiry->medium_previous_school ?? '--' }}</div>
                                                        <div class="col-md-4"><strong>Parents Income:</strong> {{ $enquiry->income_parents ?? '--' }}</div>
                                                        <div class="col-md-4"><strong>Sibling Name:</strong> {{ $enquiry->name_sibling ?? '--' }}</div>
                                                        <div class="col-md-4"><strong>Sibling Class:</strong> {{ $enquiry->class_sibling ?? '--' }}</div>
                                                    </div>
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









