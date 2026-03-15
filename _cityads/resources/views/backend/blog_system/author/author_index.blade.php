{{-- resources/views/backend/blog_system/author/index.blade.php --}}
@extends('backend.layout.app')

@section('content')

<div class="container">
  <div class="page-inner">

```
{{-- Page Header --}}
<div class="page-header">
  <h3 class="fw-bold mb-3">Blog Authors</h3>

  <ul class="breadcrumbs mb-3">
    <li class="nav-home">
      <a href="#"><i class="icon-home"></i></a>
    </li>

    <li class="separator"><i class="icon-arrow-right"></i></li>

    <li class="nav-item">
      <a href="#">Blog System</a>
    </li>

    <li class="separator"><i class="icon-arrow-right"></i></li>

    <li class="nav-item">Authors</li>
  </ul>
</div>


{{-- Success Message --}}
@if(session('success'))
  <div class="alert alert-success alert-dismissible fade show">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
@endif


<div class="row">
  <div class="col-md-12">

    <div class="card">

      {{-- Card Header --}}
      <div class="card-header d-flex justify-content-between align-items-center">

        <div class="card-title mb-0">
          All Authors
        </div>

        <a href="{{ route('admin.blog-author.create') }}"
           class="btn btn-primary btn-sm">

          <i class="fas fa-plus me-1"></i>
          Add Author

        </a>
      </div>


      {{-- Card Body --}}
      <div class="card-body">

        <div class="table-responsive">

          <table class="table table-hover table-bordered align-middle">

            {{-- Table Head --}}
            <thead class="thead-light">
              <tr>
                <th>#</th>
                <th>Photo</th>
                <th>Name & Designation</th>
                <th>Social Links</th>
                <th>Posts</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>


            {{-- Table Body --}}
            <tbody>

              @forelse($authors as $author)

              <tr>

                {{-- Index --}}
                <td>{{ $loop->iteration }}</td>


                {{-- Photo --}}
                <td>
                  <img
                    src="{{ $author->image ? asset('img/authors/'.$author->image) : asset('img/default-author.png') }}"
                    class="rounded-circle"
                    style="width:48px;height:48px;object-fit:cover;">
                </td>


                {{-- Name + Designation --}}
                <td>
                  <strong>{{ $author->name }}</strong>

                  @if($author->designation)
                    <br>
                    <small class="text-muted">
                      {{ $author->designation }}
                    </small>
                  @endif
                </td>


                {{-- Social Links --}}
                <td>
                  <div class="d-flex gap-2 align-items-center flex-wrap">

                    @if($author->instagram)
                      <a href="{{ $author->instagram }}" target="_blank">
                        <i class="fab fa-instagram fa-lg text-danger"></i>
                      </a>
                    @endif

                    @if($author->facebook)
                      <a href="{{ $author->facebook }}" target="_blank">
                        <i class="fab fa-facebook fa-lg" style="color:#1877f2;"></i>
                      </a>
                    @endif

                    @if($author->twitter)
                      <a href="{{ $author->twitter }}" target="_blank">
                        <i class="fab fa-x-twitter fa-lg text-dark"></i>
                      </a>
                    @endif

                    @if($author->linkedin)
                      <a href="{{ $author->linkedin }}" target="_blank">
                        <i class="fab fa-linkedin fa-lg" style="color:#0a66c2;"></i>
                      </a>
                    @endif

                    @if(!$author->instagram && !$author->facebook && !$author->twitter && !$author->linkedin)
                      <span class="text-muted small">—</span>
                    @endif

                  </div>
                </td>


                {{-- Blog Posts Count --}}
                <td>
                  <span class="badge bg-secondary">
                    {{ $author->blogs_count }} posts
                  </span>
                </td>


                {{-- Status Toggle --}}
                <td>
                  <div class="form-check form-switch">

                    <input
                      class="form-check-input toggle-status"
                      type="checkbox"
                      data-id="{{ $author->id }}"
                      {{ $author->status ? 'checked' : '' }}>

                  </div>
                </td>


                {{-- Actions --}}
              <td>

<a href="{{ route('admin.blog-author.edit',$author->id) }}"
   class="btn btn-sm btn-warning me-1">
    <i class="fas fa-edit"></i>
</a>

<form id="delete-form-{{ $author->id }}"
      action="{{ route('admin.blog-author.destroy',$author->id) }}"
      method="POST"
      style="display:inline">

    @csrf
    @method('DELETE')

    <button type="button"
            onclick="confirmDelete({{ $author->id }}, '{{ $author->name }}')"
            class="btn btn-sm btn-danger">

        <i class="fas fa-trash"></i>

    </button>

</form>

</td>

              </tr>

              @empty

              <tr>
                <td colspan="7" class="text-center text-muted py-4">
                  No authors yet.
                  <a href="{{ route('admin.blog-author.create') }}">
                    Add one now.
                  </a>
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
```

  </div>
</div>

@endsection

@section('script')

{{-- Toastr CSS --}}

<link rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>

{{-- Toastr JS --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>

toastr.options = {
    "closeButton": true,
    "progressBar": true,
    "positionClass": "toast-top-right",
    "timeOut": "3000"
};

@if(session('success'))
    toastr.success("{{ session('success') }}");
@endif


// Toggle status
$(document).on('change','.toggle-status',function(){

    $.post('{{ route("admin.blog-author.toggle-status") }}',{
        _token:'{{ csrf_token() }}',
        id:$(this).data('id'),
        status:$(this).is(':checked')?1:0
    });

    toastr.info('Status updated');

});


// Delete Author
$(document).on('click','.btn-delete',function(){

    if(!confirm('Delete this author? Blog posts will remain but lose the author link.')){
        return;
    }

    const btn=$(this);

    $.ajax({
        url:'{{ url("admin/blog-authors/destroy") }}/'+btn.data('id'),
        type:'DELETE',
        data:{ _token:'{{ csrf_token() }}' },

        success:function(res){

            if(res.success){

                btn.closest('tr').fadeOut(300,function(){
                    $(this).remove();
                });

                toastr.success('Author deleted successfully');

            }

        }

    });

});

</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function confirmDelete(id, name) {
        Swal.fire({
            title: 'Are you sure?',
            text: `You are about to delete "${name}". This cannot be undone!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`delete-form-${id}`).submit();
            }
        });
    }

    // SweetAlert for session success/error (auto popup)
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
            timer: 2500,
            showConfirmButton: false,
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: '{{ session('error') }}',
        });
    @endif
</script>
@endsection


<script>
// Toggle active/inactive
$(document).on('change', '.toggle-status', function () {
    $.post('{{ route("admin.blog-author.toggle-status") }}', {
        _token: '{{ csrf_token() }}',
        id:     $(this).data('id'),
        status: $(this).is(':checked') ? 1 : 0,
    });
});

// Delete
$(document).on('click', '.btn-delete', function () {
    if (!confirm('Delete this author? Blog posts will remain but lose the author link.')) return;
    const btn = $(this);
    $.ajax({
        url:  '{{ url("admin/blog-authors/destroy") }}/' + btn.data('id'),
        type: 'DELETE',
        data: { _token: '{{ csrf_token() }}' },
        success: res => { if (res.success) btn.closest('tr').fadeOut(300, function(){ $(this).remove(); }); }
    });
});
</script>

