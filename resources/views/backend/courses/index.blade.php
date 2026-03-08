@extends('backend.layout.app')

@section('content')

<div class="container">

```
<div class="page-inner">

    <!-- Page Header -->
    <div class="page-header">
        <h3 class="fw-bold mb-3">Courses</h3>

        <ul class="breadcrumbs mb-3">
            <li class="nav-home">
                <a href="#"><i class="icon-home"></i></a>
            </li>
            <li class="separator"><i class="icon-arrow-right"></i></li>
            <li class="nav-item"><a href="#">Courses</a></li>
            <li class="separator"><i class="icon-arrow-right"></i></li>
            <li class="nav-item"><a href="#">All Courses</a></li>
        </ul>
    </div>


    <div class="row">
        <div class="col-md-12">

            <div class="card card-round">

                <!-- Card Header -->
                <div class="card-header">
                    <div class="card-head-row card-tools-still-right">

                        <div class="card-title">All Courses</div>

                        <div class="card-tools">
                            <a href="{{ route('courses.create') }}" class="btn btn-success btn-sm">
                                <i class="fa fa-plus me-1"></i> Add Course
                            </a>
                        </div>

                    </div>
                </div>


                <!-- Card Body -->
                <div class="card-body p-2">

                    <div class="table-responsive">

                        <table class="table table-hover table-striped align-middle mb-0">

                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th class="text-center">Duration</th>
                                    <th class="text-center">Sessions</th>
                                    <th class="text-center">Mode</th>
                                    <th class="text-center">Age Group</th>
                                    <th class="text-center">Fees</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>

                            <tbody>

                            @forelse($courses as $course)

                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                <td><strong>{{ $course->title }}</strong></td>

                                <td class="text-center">
                                    {{ $course->duration ?? '--' }}
                                </td>

                                <td class="text-center">
                                    {{ $course->sessions ?? '--' }}
                                </td>

                                <td class="text-center">
                                    @if($course->mode == 'online')
                                        <span class="badge bg-info">Online</span>
                                    @elseif($course->mode == 'offline')
                                        <span class="badge bg-warning text-dark">Offline</span>
                                    @else
                                        <span class="badge bg-secondary">Both</span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    {{ $course->age_group ?? '--' }}
                                </td>

                                <td class="text-center">
                                    ₹{{ number_format($course->fees,2) }}
                                </td>


                                <!-- Status Toggle -->
                                <td class="text-center">

                                    <label class="switch">
                                        <input
                                            type="checkbox"
                                            class="toggle-status"
                                            data-id="{{ $course->id }}"
                                            data-url="{{ route('courses.status-update',$course->id) }}"
                                            {{ $course->status == 1 ? 'checked' : '' }}>
                                        <span class="record-toggle"></span>
                                    </label>

                                </td>


                                <!-- Action Buttons -->
                                <td class="text-center">

                                    <div class="d-flex justify-content-center gap-2">

                                        <a href="{{ route('courses.show',$course->id) }}"
                                           class="btn btn-sm btn-info">
                                            <i class="fa fa-eye"></i>
                                        </a>

                                        <a href="{{ route('courses.edit',$course->id) }}"
                                           class="btn btn-sm btn-primary">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <!-- Hidden Delete Form -->
                                        <form id="delete-form-{{ $course->id }}"
                                              action="{{ route('courses.delete',$course->id) }}"
                                              method="POST"
                                              style="display:none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                        <!-- Delete Button -->
                                        <button
                                            type="button"
                                            class="btn btn-sm btn-danger"
                                            onclick="confirmDelete({{ $course->id }}, '{{ addslashes($course->title) }}')">

                                            <i class="fa fa-trash"></i>

                                        </button>

                                    </div>

                                </td>

                            </tr>

                            @empty

                            <tr>
                                <td colspan="9" class="text-center text-muted py-4">
                                    No courses found.
                                </td>
                            </tr>

                            @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>
    </div>

</div>
```

</div>

<!-- SweetAlert2 -->

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

function confirmDelete(id,name){

    Swal.fire({
        title:'Are you sure?',
        text:'You are about to delete "'+name+'". This cannot be undone!',
        icon:'warning',
        showCancelButton:true,
        confirmButtonColor:'#d33',
        cancelButtonColor:'#6c757d',
        confirmButtonText:'Yes, delete it!'
    }).then((result)=>{

        if(result.isConfirmed){
            document.getElementById('delete-form-'+id).submit();
        }

    });

}


/* STATUS TOGGLE */

$(document).on('change','.toggle-status',function(){

    let id=$(this).data('id');
    let url=$(this).data('url');
    let status=$(this).is(':checked')?1:0;

    $.ajax({
        url:url,
        type:"POST",
        data:{
            _token:'{{ csrf_token() }}',
            id:id,
            status:status
        },
        success:function(){
            Swal.fire({
                icon:'success',
                title:'Status Updated',
                timer:1200,
                showConfirmButton:false
            });
        }
    });

});

</script>

<style>

.switch{
position:relative;
display:inline-block;
width:45px;
height:22px;
}

.switch input{
display:none;
}

.record-toggle{
position:absolute;
cursor:pointer;
top:0;
left:0;
right:0;
bottom:0;
background:#ccc;
border-radius:22px;
transition:.4s;
}

.record-toggle:before{
position:absolute;
content:"";
height:18px;
width:18px;
left:2px;
bottom:2px;
background:white;
border-radius:50%;
transition:.4s;
}

input:checked + .record-toggle{
background:#28a745;
}

input:checked + .record-toggle:before{
transform:translateX(22px);
}

</style>

@endsection
