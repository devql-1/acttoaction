@extends('backend.layout.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Page Categories</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home">
                        <a href="#"><i class="icon-home"></i></a>
                    </li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item">
                        <a href="#">Testimonial Videos</a>
                    </li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="#">Page Categories</a></li>
                </ul>
            </div>

            <div class="row">

                {{-- LEFT: Table --}}
                <div class="col-md-7">
                    <div class="card card-round">
                        <div class="card-header">
                            <div class="card-head-row card-tools-still-right">
                                <div class="card-title">
                                    All Categories
                                    <span class="badge badge-secondary ms-2">{{ $categories->total() }}</span>
                                </div>
                                <a href="{{ route('admin.testimonials.index') }}" class="btn btn-sm btn-secondary ms-auto">
                                    <i class="fa fa-arrow-left me-1"></i> Back to Videos
                                </a>
                            </div>
                        </div>
                        <div class="card-body p-2">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0" id="basic-datatables">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Slug</th>
                                            <th scope="col" class="text-center">Videos</th>
                                            <th scope="col" class="text-center">Status</th>
                                            <th scope="col" class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($categories as $cat)
                                            <tr id="cat-row-{{ $cat->id }}">
                                                <td>{{ $loop->iteration }}</td>

                                                <th scope="row">
                                                    <button class="btn btn-icon btn-round btn-success btn-sm me-2">
                                                        <i class="fa fa-check"></i>
                                                    </button>
                                                    {{ $cat->name }}
                                                </th>

                                                <td>
                                                    <code class="text-muted"
                                                        style="font-size:12px">/{{ $cat->slug }}</code>
                                                </td>

                                                <td class="text-center">
                                                    <span class="badge badge-info">
                                                        {{ $cat->testimonial_videos_count }} videos
                                                    </span>
                                                </td>

                                                <td class="text-center">
                                                    <label class="switch">
                                                        <input type="checkbox" class="cat-toggle-status"
                                                            data-id="{{ $cat->id }}" data-url="#"
                                                            {{ $cat->is_active ? 'checked' : '' }} />
                                                        <span class="record-toggle"></span>
                                                    </label>
                                                </td>

                                                <td class="text-end">
                                                    <div class="form-button-action">
                                                        <button type="button"
                                                            class="btn btn-icon btn-round btn-primary btn-lg me-1 btn-edit-cat"
                                                            data-id="{{ $cat->id }}" data-name="{{ $cat->name }}"
                                                            data-slug="{{ $cat->slug }}"
                                                            data-desc="{{ $cat->description }}"
                                                            data-order="{{ $cat->sort_order }}"
                                                            data-active="{{ $cat->is_active ? '1' : '0' }}" title="Edit">
                                                            <i class="fa fa-edit"></i>
                                                        </button>

                                                        <a href="javascript:void(0)"
                                                            class="btn btn-icon btn-round btn-danger btn-lg delete-cat"
                                                            data-id="{{ $cat->id }}"
                                                            data-url="{{ route('admin.testimonials.categories.destroy', $cat->id) }}"
                                                            title="Delete">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center py-4 text-muted">
                                                    <i class="fa fa-layer-group fa-2x mb-2 d-block opacity-25"></i>
                                                    No categories yet. Create one using the form →
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            @if ($categories->hasPages())
                                <div class="px-3 py-2">
                                    {{ $categories->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- RIGHT: Create / Edit form --}}
                <div class="col-md-5">
                    <div class="card card-round" id="catFormCard">
                        <div class="card-header">
                            <div class="card-head-row card-tools-still-right">
                                <div class="card-title" id="catFormTitle">
                                    <i class="fa fa-plus me-2"></i> Create Category
                                </div>
                                <button type="button" id="btnCancelEdit" class="btn btn-sm btn-secondary ms-auto"
                                    style="display:none" onclick="resetCatForm()">
                                    <i class="fa fa-times me-1"></i> Cancel Edit
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <form id="catForm" method="POST"
                                action="{{ route('admin.testimonials.categories.store') }}">
                                @csrf
                                <input type="hidden" name="_method" id="catMethod" value="POST" />
                                <input type="hidden" name="_cat_id" id="catId" value="" />

                                <div class="form-group mb-3">
                                    <label class="form-label fw-bold">
                                        Page Name <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" id="catName" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        value="{{ old('name') }}" placeholder="e.g. Acting Course"
                                        oninput="autoSlug(this.value)" required />
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label fw-bold">
                                        Slug <span class="text-danger">*</span>
                                        <small class="text-muted fw-normal d-block">
                                            Lowercase, hyphens only — used to match the page
                                        </small>
                                    </label>
                                    <input type="text" id="catSlug" name="slug"
                                        class="form-control @error('slug') is-invalid @enderror"
                                        value="{{ old('slug') }}" placeholder="acting-course" pattern="[a-z0-9\-]+"
                                        required />
                                    <small class="text-muted">
                                        Used in controller:
                                        <code id="slugPreview">PageCategory::where('slug', 'acting-course')</code>
                                    </small>
                                    @error('slug')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label fw-bold">Description</label>
                                    <textarea id="catDesc" name="description" class="form-control" rows="2"
                                        placeholder="Optional description…">{{ old('description') }}</textarea>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label fw-bold">Sort Order</label>
                                            <input type="number" id="catOrder" name="sort_order" class="form-control"
                                                value="{{ old('sort_order', 0) }}" min="0" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label fw-bold">Status</label>
                                            <div class="d-flex align-items-center gap-2 mt-1">
                                                <label class="switch mb-0">
                                                    <input type="checkbox" id="catActive" name="is_active"
                                                        value="1" checked />
                                                    <span class="record-toggle"></span>
                                                </label>
                                                <span class="text-muted small">Active</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary" id="catSubmitBtn">
                                        <i class="fa fa-plus me-1"></i> Create Category
                                    </button>
                                </div>

                            </form>
                        </div>
                    </div>

                    {{-- Info card --}}
                    <div class="card card-round mt-3">
                        <div class="card-body">
                            <h6 class="fw-bold mb-2"><i class="fa fa-info-circle text-info me-2"></i> How it works</h6>
                            <p class="text-muted small mb-2">
                                Each page category maps to a page in your website. The controller queries
                                videos by this slug and passes them to the Blade view.
                            </p>
                            <pre class="bg-light p-2 rounded small mb-0" style="font-size:11px">// HomeController
$category = PageCategory
  ::where('slug', 'home')
  ->firstOrFail();

$videos = $category
  ->activeVideos()
  ->ordered()->get();

return view('home',
  compact('videos', 'tabs'));</pre>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        /* ── Auto-slug from name ── */
        function autoSlug(val) {
            const slug = val.toLowerCase().trim()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');
            document.getElementById('catSlug').value = slug;
            document.getElementById('slugPreview').textContent = "PageCategory::where('slug', '" + (slug || '…') + "')";
        }

        document.getElementById('catSlug').addEventListener('input', function() {
            document.getElementById('slugPreview').textContent = "PageCategory::where('slug', '" + (this.value ||
                '…') + "')";
        });

        /* ── Edit mode ── */
        $(document).on('click', '.btn-edit-cat', function() {
            const id = $(this).data('id');
            const name = $(this).data('name');
            const slug = $(this).data('slug');
            const desc = $(this).data('desc');
            const order = $(this).data('order');
            const active = $(this).data('active');

            document.getElementById('catFormTitle').innerHTML = '<i class="fa fa-edit me-2"></i> Edit Category';
            document.getElementById('catMethod').value = 'PUT';
            document.getElementById('catId').value = id;
            document.getElementById('catForm').action = '/admin/page-categories/' + id;
            document.getElementById('catName').value = name;
            document.getElementById('catSlug').value = slug;
            document.getElementById('catDesc').value = desc || '';
            document.getElementById('catOrder').value = order;
            document.getElementById('catActive').checked = active == '1';
            document.getElementById('catSubmitBtn').innerHTML = '<i class="fa fa-save me-1"></i> Save Changes';
            document.getElementById('btnCancelEdit').style.display = 'inline-flex';
            document.getElementById('slugPreview').textContent = "PageCategory::where('slug', '" + slug + "')";

            document.getElementById('catFormCard').scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        });

        function resetCatForm() {
            document.getElementById('catFormTitle').innerHTML = '<i class="fa fa-plus me-2"></i> Create Category';
            document.getElementById('catMethod').value = 'POST';
            document.getElementById('catId').value = '';
            document.getElementById('catForm').action = '{{ route('admin.testimonials.categories.store') }}';
            document.getElementById('catForm').reset();
            document.getElementById('catSubmitBtn').innerHTML = '<i class="fa fa-plus me-1"></i> Create Category';
            document.getElementById('btnCancelEdit').style.display = 'none';
            document.getElementById('slugPreview').textContent = "PageCategory::where('slug', '…')";
        }

        /* ── Status toggle ── */
        $(document).on('change', '.cat-toggle-status', function() {
            const url = $(this).data('url');
            const box = $(this);
            $.ajax({
                url: url,
                type: 'PATCH',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: res => toastr.success(res.message),
                error: () => {
                    box.prop('checked', !box.prop('checked'));
                    toastr.error('Failed.');
                }
            });
        });

        /* ── Delete ── */
        $(document).on('click', '.delete-cat', function() {
            const id = $(this).data('id');
            const url = $(this).data('url');

            Swal.fire({
                title: 'Delete this category?',
                text: 'All videos assigned to it will also be deleted.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!'
            }).then(result => {
                if (!result.isConfirmed) return;
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: res => {
                        $('#cat-row-' + id).fadeOut(300, function() {
                            $(this).remove();
                        });
                        toastr.success(res.message ?? 'Deleted.');
                    },
                    error: () => toastr.error('Failed to delete.')
                });
            });
        });
    </script>
@endpush
