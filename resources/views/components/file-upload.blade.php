@props([
    'name' => 'image',
    'label' => 'Upload File',
    'current' => null,
])

@php
    $fileName = $current ? pathinfo($current, PATHINFO_BASENAME) : '';
    $extension = $current ? strtolower(pathinfo($current, PATHINFO_EXTENSION)) : '';
    $isVideo = in_array($extension, ['mp4','webm','ogg']);
@endphp

<div class="file-upload">
    <input type="file" name="{{ $name }}" class="file-input form-control" accept="image/*,video/*">

    <div class="file-preview @if(!$current) d-none @endif">
        @if($isVideo)
            <video src="{{ asset('img/'.$current) }}" controls muted class="preview-img" style="max-height:200px;"></video>
        @else
            <img src="{{ $current ? asset('img/'.$current) : '' }}" class="preview-img" style="max-height:200px;" alt="Preview">
        @endif

        <div class="file-info">
            <span class="file-name">{{ $fileName }}</span>
            <span class="file-size">{{ $current ? 'Existing' : '' }}</span>
        </div>
        <button type="button" class="remove-btn">&times;</button>
    </div>

    <input type="hidden" name="remove_{{ $name }}" class="remove-flag" value="0">
</div>


