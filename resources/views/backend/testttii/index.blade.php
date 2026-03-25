@extends('backend.layout.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Testimonial Videos</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home">
                        <a href="#">
                            <i class="icon-home"></i>
                        </a>
                    </li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="#">Content</a></li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="#">Testimonial Videos</a></li>
                </ul>
            </div>

            {{-- Stats row --}}
            <div class="row mb-3">
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-primary bubble-shadow-small">
                                        <i class="fas fa-play-circle"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Total Videos</p>
                                        <h4 class="card-title">{{ \App\Models\TestimonialVideo::count() }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-success bubble-shadow-small">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Active</p>
                                        <h4 class="card-title">
                                            {{ \App\Models\TestimonialVideo::where('is_active', true)->count() }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-info bubble-shadow-small">
                                        <i class="fas fa-layer-group"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Page Categories</p>
                                        <h4 class="card-title">{{ \App\Models\PageCategory::count() }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div class="card card-stats card-round">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-icon">
                                    <div class="icon-big text-center icon-danger bubble-shadow-small">
                                        <i class="fas fa-eye-slash"></i>
                                    </div>
                                </div>
                                <div class="col col-stats ms-3 ms-sm-0">
                                    <div class="numbers">
                                        <p class="card-category">Inactive</p>
                                        <h4 class="card-title">
                                            {{ \App\Models\TestimonialVideo::where('is_active', false)->count() }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card card-round">
                        <div class="card-header">
                            <div class="card-head-row card-tools-still-right">
                                <div class="card-title">Testimonial Videos</div>
                                <a href="{{ route('admin.testimonials.create') }}" class="btn btn-dark ms-auto">
                                    <i class="fa fa-plus"></i> Add Video
                                </a>
                            </div>

                            {{-- Filter bar --}}
                            <div class="card-tools mt-3">
                                <form method="GET" action="{{ route('admin.testimonials.index') }}"
                                    class="d-flex flex-wrap gap-2 align-items-center">
                                    <input type="text" name="search" class="form-control form-control-sm"
                                        style="max-width:220px" placeholder="Search title or video ID…"
                                        value="{{ request('search') }}" />

                                    <select name="page_category_id" class="form-select form-select-sm"
                                        style="max-width:180px">
                                        <option value="">All Pages</option>
                                        @foreach ($categories as $cat)
                                            <option value="{{ $cat->id }}"
                                                {{ request('page_category_id') == $cat->id ? 'selected' : '' }}>
                                                {{ $cat->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <select name="video_category" class="form-select form-select-sm"
                                        style="max-width:180px">
                                        <option value="">All Categories</option>
                                        <option value="parent"
                                            {{ request('video_category') === 'parent' ? 'selected' : '' }}>Parent Feedback
                                        </option>
                                        <option value="student"
                                            {{ request('video_category') === 'student' ? 'selected' : '' }}>Student Journey
                                        </option>
                                    </select>

                                    <button type="submit" class="btn btn-sm btn-primary">
                                        <i class="fa fa-filter"></i> Filter
                                    </button>

                                    @if (request()->hasAny(['search', 'page_category_id', 'video_category']))
                                        <a href="{{ route('admin.testimonials.index') }}" class="btn btn-sm btn-secondary">
                                            <i class="fa fa-times"></i> Clear
                                        </a>
                                    @endif
                                </form>
                            </div>
                        </div>

                        <div class="card-body p-2">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0" id="basic-datatables">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Thumbnail</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Page</th>
                                            <th scope="col" class="text-center">Category</th>
                                            <th scope="col" class="text-center">Duration</th>
                                            <th scope="col" class="text-center">Order</th>
                                            <th scope="col" class="text-center">Status</th>
                                            <th scope="col" class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($videos as $video)
                                            <tr id="record-row-{{ $video->id }}">

                                                <td>{{ $loop->iteration }}</td>

                                                {{-- Thumbnail --}}
                                                <td>
                                                    <div class="avatar"
                                                        style="position:relative;width:72px;height:44px;flex-shrink:0">
                                                        <img src="https://i.ytimg.com/vi/{{ $video->youtube_video_id }}/mqdefault.jpg"
                                                            alt="{{ $video->title }}"
                                                            style="width:72px;height:44px;object-fit:cover;border-radius:6px"
                                                            onerror="this.src='{{ asset('assets/img/placeholder-image-3.jpg') }}'" />
                                                        <span
                                                            style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center">
                                                            <i class="fa fa-play-circle"
                                                                style="color:rgba(255,255,255,.85);font-size:18px;text-shadow:0 1px 4px rgba(0,0,0,.5)"></i>
                                                        </span>
                                                    </div>
                                                </td>

                                                {{-- Title --}}
                                                <th scope="row">
                                                    <button class="btn btn-icon btn-round btn-success btn-sm me-2">
                                                        <i class="fa fa-check"></i>
                                                    </button>
                                                    <span style="font-size:13px;font-weight:600">
                                                        {{ Str::limit($video->title, 55) }}
                                                    </span>
                                                    <br />
                                                    <small class="text-muted" style="font-family:monospace">
                                                        {{ $video->youtube_video_id }}
                                                    </small>
                                                </th>

                                                {{-- Page category --}}
                                                <td>
                                                    <span class="badge badge-info">
                                                        {{ $video->pageCategory->name ?? '—' }}
                                                    </span>
                                                </td>

                                                {{-- Video category --}}
                                                <td class="text-center">
                                                    @if ($video->video_category === 'parent')
                                                        <span class="badge badge-primary">Parent Feedback</span>
                                                    @elseif($video->video_category === 'student')
                                                        <span class="badge badge-success">Student Journey</span>
                                                    @else
                                                        <span
                                                            class="badge badge-secondary">{{ $video->category_label }}</span>
                                                    @endif
                                                </td>

                                                {{-- Duration --}}
                                                <td class="text-center">
                                                    <small class="text-muted">{{ $video->duration ?: '—' }}</small>
                                                </td>

                                                {{-- Sort order --}}
                                                <td class="text-center">
                                                    <span class="fw-bold">{{ $video->sort_order }}</span>
                                                </td>

                                                {{-- Status toggle --}}
                                                <td class="text-center">
                                                    <label class="switch">
                                                        <input type="checkbox" class="toggle-status"
                                                            data-id="{{ $video->id }}"
                                                            data-url="{{ route('admin.testimonials.toggle', $video->id) }}"
                                                            {{ $video->is_active ? 'checked' : '' }} />
                                                        <span class="record-toggle"></span>
                                                    </label>
                                                </td>

                                                {{-- Actions --}}
                                                <td class="text-end">
                                                    <div class="form-button-action">
                                                        <a href="https://youtu.be/{{ $video->youtube_video_id }}"
                                                            target="_blank"
                                                            class="btn btn-icon btn-round btn-warning btn-sm me-1"
                                                            title="Watch on YouTube">
                                                            <i class="fab fa-youtube"></i>
                                                        </a>

                                                        <a href="{{ route('admin.testimonials.edit', $video->id) }}"
                                                            class="btn btn-icon btn-round btn-primary btn-lg me-1"
                                                            title="Edit">
                                                            <i class="fa fa-edit"></i>
                                                        </a>

                                                        <a href="javascript:void(0)"
                                                            class="btn btn-icon btn-round btn-danger btn-lg delete-record"
                                                            data-id="{{ $video->id }}"
                                                            data-url="{{ route('admin.testimonials.     destroy', $video->id) }}"
                                                            title="Delete">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </td>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9" class="text-center py-4 text-muted">
                                                    <i class="fa fa-play-circle fa-2x mb-2 d-block opacity-25"></i>
                                                    No videos found. <a
                                                        href="{{ route('admin.testimonials.create') }}">Add the first
                                                        one.</a>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>

                            {{-- Pagination --}}
                            @if ($videos->hasPages())
                                <div class="px-3 py-2">
                                    {{ $videos->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        /* ── Status toggle (same pattern as existing project) ── */
        $(document).on('change', '.toggle-status', function() {
            const id = $(this).data('id');
            const url = $(this).data('url');
            const box = $(this);

            $.ajax({
                url: url,
                type: 'PATCH',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(res) {
                    toastr.success(res.message);
                },
                error: function() {
                    box.prop('checked', !box.prop('checked')); // revert
                    toastr.error('Failed to update status.');
                }
            });
        });

        /* ── Delete (same pattern as existing project) ── */
        $(document).on('click', '.delete-record', function() {
            const id = $(this).data('id');
            const url = $(this).data('url');

            Swal.fire({
                title: 'Delete this video?',
                text: 'This action cannot be undone.',
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
                    success: function(res) {
                        $('#record-row-' + id).fadeOut(300, function() {
                            $(this).remove();
                        });
                        toastr.success(res.message ?? 'Video deleted.');
                    },
                    error: function() {
                        toastr.error('Failed to delete video.');
                    }
                });
            });
        });
    </script>
@endpush
