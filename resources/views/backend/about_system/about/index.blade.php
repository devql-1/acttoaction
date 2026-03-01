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
                            <div class="card-title">About Us Info</div>
                            <a href="{{route('admin.about-create')}}" class="btn btn-dark ms-auto"><i class="fa fa-plus"></i> Add About</a>
                            <!-- <button
                                class="btn btn-dark  ms-auto"
                                data-bs-toggle="modal"
                                data-bs-target="#addRowModal">
                                <i class="fa fa-plus"></i>
                                Add About
                            </button> -->
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
                                        <!-- <th scope="col" class="text-end">Category Name</th> -->
                                        <th scope="col" class="text-end">Published</th>
                                        <th scope="col" class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($aboutus as $about)
                                    <tr id="record-row-{{ $about->id }}">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <p class="demo">
                                            <div class="avatar">
                                                <img src="{{asset($about->image ? 'img/'.$about->image : '../assets/img/placeholder-image-3.jpg')}}" alt="{{ $about->title }}" class="avatar-img rounded">
                                            </div>
                                            </p>
                                        </td>
                                        <th scope="row">
                                            <button
                                                class="btn btn-icon btn-round btn-success btn-sm me-2">
                                                <i class="fa fa-check"></i>
                                            </button>
                                            {{ $about->title ? $about->title : '--' }}
                                        </th>
                                        <td class="text-center d-none">
                                            @if($about->category != null)
                                                {{ $about->category->category_name }}
                                            @else
                                                --
                                            @endif
                                        </td>

                                        <td class="text-end">
                                            <label class="switch">
                                              <input type="checkbox" class="toggle-status" data-id="{{ $about->id }}" data-url="{{ route('admin.about-status') }}" {{ $about->status == 1 ? 'checked' : '' }}>
                                              <span class="record-toggle"></span>
                                            </label>
                                             <!-- <span class="badge badge-success">Completed</span> -->
                                        </td>
                                        <td class="text-end">
                                            <div class="form-button-action">
                                                

                                                <a href="{{route('admin.about-edit',$about->id)}}"
                                                   class="btn btn-icon btn-round btn-primary btn-lg me-3">
                                                   <i class="fa fa-edit"></i>
                                                </a>

                                                <a href="javascript:void(0)"
                                                   class="btn btn-icon btn-round btn-danger btn-lg delete-record"
                                                   data-id="{{ $about->id }}"
                                                   data-url="{{ route('admin.about-destroy', $about->id) }}">
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





