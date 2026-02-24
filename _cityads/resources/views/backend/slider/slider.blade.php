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
                            <div class="card-title">Slider Info</div>
                            <button
                                class="btn btn-dark  ms-auto"
                                data-bs-toggle="modal"
                                data-bs-target="#addRowModal">
                                <i class="fa fa-plus"></i>
                                Add Slider
                            </button>
                        </div>
                    </div>
                    <div class="card-body p-2">
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center mb-0" id="basic-datatables">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Banner</th>
                                        <th scope="col" class="text-end">Title</th>
                                        <th scope="col" class="text-end">Short Desc</th>
                                        <th scope="col" class="text-end">Published</th>
                                        <th scope="col" class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sliders as $slider)
                                    <tr id="record-row-{{ $slider->id }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <p class="demo">
                                            <div class="avatar">
                                                <img src="{{asset($slider->banner ? 'img/'.$slider->banner : '../assets/img/placeholder-image-3.jpg')}}" alt="{{ $slider->title }}" class="avatar-img rounded">
                                            </div>
                                            </p>
                                        </td>
                                        <th scope="row">
                                            <button
                                                class="btn btn-icon btn-round btn-success btn-sm me-2">
                                                <i class="fa fa-check"></i>
                                            </button>
                                            {{ $slider->title ? $slider->title : 'N/A' }}
                                        </th>
                                        <td class="text-end">{{ $slider->short_desc }}</td>

                                        <td class="text-end">
                                            <label class="switch">
                                              <input type="checkbox" class="toggle-status" data-id="{{ $slider->id }}" data-url="{{ route('admin.slider-status') }}" {{ $slider->status == 1 ? 'checked' : '' }}>
                                              <span class="record-toggle"></span>
                                            </label>
                                             <!-- <span class="badge badge-success">Completed</span> -->
                                        </td>
                                        <td class="text-end">
                                            <div class="form-button-action">
                                                <button
                                                    type="button"
                                                    onclick='admin_slider_update(@json($slider))'
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editRowModal"
                                                    class="btn btn-primary btn-icon btn-round btn-lg me-2">
                                                    <i class="fa fa-edit"></i>
                                                </button>

                                                <a href="javascript:void(0)"
                                                   class="btn btn-icon btn-round btn-danger btn-lg delete-record"
                                                   data-id="{{ $slider->id }}"
                                                   data-url="{{ route('admin.slider-destroy', $slider->id) }}">
                                                   <i class="fa fa-trash"></i>
                                                </a>




                                                <!-- <button
                                                    type="button"
                                                    data-bs-toggle="tooltip"
                                                    title=""
                                                    class="btn btn-link btn-danger"
                                                    data-original-title="Remove">
                                                    <i class="fa fa-times"></i>
                                                </button> -->
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

<!-- Modal -->
<div
    class="modal fade"
    id="editRowModal"
    tabindex="-1"
    role="dialog"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">
                    <span class="fw-mediumbold"> Edit</span>
                    <span class="fw-light"> Slider </span>
                </h5>
                <button
                    type="button"
                    class="close"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="small">
                    Update a existing slider using this form, make sure you
                    fill them all
                </p>
                <form action="{{ route('admin.slider-update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="id" name="id">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Title</label>
                                <input
                                    id="title"
                                    type="text"
                                    name="title"
                                    class="form-control"
                                    placeholder="fill Title" />
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Short Desc</label>
                                <input
                                    id="short_desc"
                                    name="short_desc"
                                    type="text"
                                    class="form-control"
                                    placeholder="fill Short Description" />
                            </div>
                        </div>
                        <div id="banner_preview" 
                            style="position:relative; width:120px; height:120px; border:1px solid #ddd; border-radius:8px; overflow:hidden;margin-left: 14px;display: none">
                        </div>
                        
                        <input type="hidden" name="remove_image" id="remove_image" value="0">


                        <div class="col-sm-12 mt-2">
                            <div class="form-group form-group-default">
                                <label>Upload Banner</label>
                                <input
                                    id="banner_input"
                                    type="file"
                                    name="banner"
                                    class="form-control"
                                    placeholder="fill Banner" />
                            </div>
                        </div>
                    </div>
                    <button
                        type="submit"
                        class="btn btn-primary">
                        Edit
                    </button>
                </form>
            </div>
            <div class="modal-footer border-0">
                <!-- <button
                    type="button"
                    id="addRowButton"
                    class="btn btn-primary">
                    Add
                </button> -->
                <button
                    type="button"
                    class="btn btn-danger"
                    data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>



@endsection


@section('modal')

<!-- Modal -->
<div
    class="modal fade"
    id="addRowModal"
    tabindex="-1"
    role="dialog"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title">
                    <span class="fw-mediumbold"> Add</span>
                    <span class="fw-light"> Slider </span>
                </h5>
                <button
                    type="button"
                    class="close"
                    data-bs-dismiss="modal"
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="small">
                    Create a new slider using this form, make sure you
                    fill them all
                </p>
                <form action="{{ route('admin.slider-store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Title</label>
                                <input
                                    
                                    name="title"
                                    type="text"
                                    class="form-control"
                                    placeholder="fill Title" />
                            </div>
                        </div>
                        
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Short Desc</label>
                                <input
                                    name="short_desc"
                                    type="text"
                                    class="form-control"
                                    placeholder="fill Short Description" />
                            </div>
                        </div>

                        <div id="add_banner_preview" 
                            style="position:relative; width:120px; height:120px; border:1px solid #ddd; border-radius:8px; overflow:hidden;margin-left: 14px;display: none">
                        </div>
                        
                        <input type="hidden" name="add_remove_image" id="add_remove_image" value="0">
                        
                        <div class="col-sm-12">
                            <div class="form-group form-group-default">
                                <label>Upload Banner</label>
                                <input
                                    id="add_banner_input"
                                    name="banner"
                                    type="file"
                                    class="form-control"
                                    placeholder="fill office" />
                            </div>
                        </div>
                    </div>
                    <button
                    type="submit"
                    
                    class="btn btn-primary">
                    Add
                </button>
                </form>
            </div>
            <div class="modal-footer border-0">
                
                <button
                    type="button"
                    class="btn btn-danger"
                    data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

@endsection



<script src="{{asset('assets/js/core/jquery-3.7.1.min.js')}}"></script>

<script>

function admin_slider_update(dr) {
    let baseUrl = "{{ asset('img') }}/"; 
    let placeholder = "{{ asset('assets/img/placeholder-image-3.jpg') }}";

    let banner = dr.banner ? baseUrl + dr.banner : placeholder;

    // form fill
    $('#id').val(dr.id);
    $('#title').val(dr.title ?? '');
    $('#short_desc').val(dr.short_desc ?? '');

    // reset remove_image
    $('#remove_image').val(0);

    $('#add_remove_image').val(0);

    // show existing image
    showPreview(banner);
    $('#banner_input').val('');

    addshowPreview(banner);
    $('#add_banner_input').val('');
}

// file select hone par preview
$(document).on('change', '#banner_input', function(event) {
    if (event.target.files.length > 0) {
        let reader = new FileReader();
        reader.onload = function(e) {
            $('#remove_image').val(0);
            showPreview(e.target.result);
        }
        reader.readAsDataURL(event.target.files[0]);
    }
});

// remove image button
function removeImage() {
    $('#banner_preview').hide();
    $('#banner_input').val('');
    $('#remove_image').val(1);
}

// helper: show image
function showPreview(src) {
    $('#banner_preview').show().html(
        `<span onclick="removeImage()" 
                style="position:absolute; top:5px; right:5px; 
                       background:#1f1f1f; color:#fff; border-radius:50%; 
                       width:22px; height:22px; display:flex; 
                       align-items:center; justify-content:center; 
                       font-size:14px; cursor:pointer; z-index:10;">
            &times;
         </span>
         <img src="` + src + `" style="width:100%; height:100%; object-fit:cover;" class="rounded">`
    );
}


// file select hone par preview
$(document).on('change', '#add_banner_input', function(event) {
    if (event.target.files.length > 0) {
        let reader = new FileReader();
        reader.onload = function(e) {
            $('#add_remove_image').val(0);
            addshowPreview(e.target.result);
        }
        reader.readAsDataURL(event.target.files[0]);
    }
});

// remove image button
function addremoveImage() {
    $('#add_banner_preview').hide();
    $('#add_banner_input').val('');
    $('#add_remove_image').val(1);
}

// helper: show image
function addshowPreview(src) {
    $('#add_banner_preview').show().html(
        `<span onclick="addremoveImage()" 
                style="position:absolute; top:5px; right:5px; 
                       background:#1f1f1f; color:#fff; border-radius:50%; 
                       width:22px; height:22px; display:flex; 
                       align-items:center; justify-content:center; 
                       font-size:14px; cursor:pointer; z-index:10;">
            &times;
         </span>
         <img src="` + src + `" style="width:100%; height:100%; object-fit:cover;" class="rounded">`
    );

}

</script>





