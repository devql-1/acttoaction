<h2>{{ $youtubeCategory->name }}</h2>

@if($youtubeCategory->youtubeVideos->count() > 0)

    @foreach($youtubeCategory->youtubeVideos as $video)
        <div style="margin-bottom:20px;">
            <h4>{{ $video->name }}</h4>

            <iframe 
                width="300" 
                height="200"
                src="https://www.youtube.com/embed/{{ $video->youtube_id }}"
                title="{{ $video->name }}"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen>
            </iframe>
        </div>
    @endforeach

@else
    <p>No Youtube Videos Found In This Category.</p>
@endif