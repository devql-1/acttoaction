@extends('backend.layout.app')

@section('content')

<div class="container">
    <div class="page-inner">

        <!-- Page Header -->
        <div class="page-header">
            <h3 class="fw-bold mb-3">Youtube Videos</h3>

            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="#"><i class="icon-home"></i></a>
                </li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Youtube</a></li>
                <li class="separator"><i class="icon-arrow-right"></i></li>
                <li class="nav-item"><a href="#">Videos</a></li>
            </ul>
        </div>

        <!-- Card -->
        <div class="card card-round">
            <div class="card-header">
                <div class="card-head-row card-tools-still-right">
                    <div class="card-title">Youtube Video List</div>

                    <a href="{{ route('youtubeVideo.create') }}"
                       class="btn btn-dark ms-auto">
                        <i class="fa fa-plus"></i> Add Video
                    </a>
                </div>
            </div>

            <div class="card-body">

                <div class="table-responsive">
                    <table class="table align-items-center mb-0 table-bordered">

                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Video Title</th>
                                <th>Category</th>
                                <th>Preview</th>
                                <th>Created At</th>
                                <th class="text-end">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse($videos as $video)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>
                                    <strong>{{ $video->name }}</strong>
                                </td>

                                <td>
                                    {{ $video->youtubeCategory->name ?? 'N/A' }}
                                </td>

                                <td>
                                    <iframe width="150" height="100"
                                        src="https://www.youtube.com/embed/{{ $video->youtube_id }}"
                                        frameborder="0"
                                        allowfullscreen>
                                    </iframe>
                                </td>

                                <td>
                                    {{ $video->created_at->format('d M Y') }}
                                </td>

                                <td class="text-end">

                                    <!-- Edit -->
                                    <a href="{{ route('youtubeVideos.edit', $video->id) }}"
                                       class="btn btn-sm btn-primary me-1">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <!-- Delete -->
                                    <form action="{{ route('youtubeVideos.destroy', $video->id) }}"
                                          method="POST"
                                          style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            onclick="return confirm('Are you sure?')"
                                            class="btn btn-sm btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>

                                </td>
                            </tr>

                            @empty
                            <tr>
                                <td colspan="6" class="text-center">
                                    No Youtube Videos Found
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

@endsection