@extends('layouts.admin')

@section('title', 'Edit Video')

@section('breadcrumb')
    <a href="{{ route('admin.testimonials.index') }}">Testimonial Videos</a>
    <span class="crumb-sep">/</span>
    <span class="crumb-current">Edit</span>
@endsection

@section('topbar-actions')
    <a href="https://youtu.be/{{ $video->youtube_video_id }}" target="_blank" class="topbar-btn">
        <i class="bi bi-youtube" style="color:#ff0000"></i> Watch Video
    </a>
@endsection

@section('content')

    <div class="page-header" style="margin-bottom:24px">
        <h1 style="font-size:22px;font-weight:800;color:var(--text);margin-bottom:4px">Edit Video</h1>
        <p style="font-size:13.5px;color:var(--muted)">
            Editing: <strong style="color:var(--text)">{{ Str::limit($video->title, 60) }}</strong>
        </p>
    </div>

    @include('admin.testimonials._form', [
        'video' => $video,
        'categories' => $categories,
        'action' => route('admin.testimonials.update', $video),
        'method' => 'PUT',
    ])

@endsection
