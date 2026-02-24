@props([
    'name' => 'images[]',
    'label' => 'Upload Images',
    'current' => [], // array of already uploaded images
])

<div class="multi-file-upload">
    <input type="file" name="{{ $name }}" class="multi-file-input form-control"
           accept="image/*" multiple>

    <div class="multi-preview d-flex flex-wrap mt-2">
        {{-- Already uploaded images --}}
        @foreach($current as $img)
            <div class="preview-box" data-existing="{{ $img }}">
                <img src="{{ asset('img/'.$img) }}" class="preview-img" alt="Preview">
                <button type="button" class="remove-btn" data-remove="{{ $img }}">&times;</button>
                <input type="hidden" name="keep_images[]" value="{{ $img }}">
            </div>
        @endforeach
    </div>
</div>
