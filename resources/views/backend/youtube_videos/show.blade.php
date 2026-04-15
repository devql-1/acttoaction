@extends('backend.layout.app')

@section('content')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">{{ $youtubeCategory->name }}</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home">
                        <a href="#"><i class="icon-home"></i></a>
                    </li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="#">Youtube</a></li>
                    <li class="separator"><i class="icon-arrow-right"></i></li>
                    <li class="nav-item"><a href="#">Category Videos</a></li>
                </ul>
            </div>

            <div class="card card-round">
                <div class="card-header">
                    <div class="card-title">Videos in {{ $youtubeCategory->name }}</div>
                </div>
                <div class="card-body">
                    @if ($youtubeCategory->youtubeVideos->count() > 0)
                        <div class="row g-4">
                            @foreach ($youtubeCategory->youtubeVideos as $video)
                                <div class="col-md-6 col-lg-4">
                                    <div class="card h-100 border">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $video->name }}</h5>
                                            <div class="ratio ratio-16x9">
                                                <iframe
                                                    src="https://www.youtube.com/embed/{{ $video->youtube_id }}"
                                                    title="{{ $video->name }}"
                                                    frameborder="0"
                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                    allowfullscreen>
                                                </iframe>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="mb-0">No Youtube Videos Found In This Category.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
