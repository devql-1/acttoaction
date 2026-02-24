<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\YoutubeVideo;
use App\Models\YoutubeCategory;
use Illuminate\Http\Request;

class YoutubeVideoController extends Controller
{
public function create()
{
    $categories = YoutubeCategory::all();
    return view('backend.youtube_videos.create', compact('categories'));
}

   public function store(Request $request){

    $request->validate([
        'youtube_category_id' => 'required',
        'name' => 'required',
        'youtube_link' => 'required'
    ]);

    preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&]+)/',
        $request->youtube_link,
        $matches
    );

    $youtubeId = $matches[1] ?? null;

    if (!$youtubeId) {
        return back()->with('error', 'Invalid YouTube Link');
    }

    YoutubeVideo::create([
        'youtube_category_id' => $request->youtube_category_id,
        'name' => $request->name,
        'youtube_id' => $youtubeId
    ]);

   return redirect()->route('youtubeVideos.index')->with('success', 'Category Created Successfully');
}

public function index(){
    $videos = YoutubeVideo::with('youtubeCategory')->latest()->get();

    return view('backend.youtube_videos.index', compact('videos'));
}


public function edit($id){

    $video = YoutubeVideo::findOrFail($id);
    $categories = YoutubeCategory::all();

    return view('backend.youtube_videos.edit',compact('video', 'categories'));
}


public function update(Request $request, $id)
{
    $request->validate([
        'youtube_category_id' => 'required',
        'name' => 'required',
        'youtube_link' => 'required'
    ]);

    $video = YoutubeVideo::findOrFail($id);

    preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([^&]+)/',
        $request->youtube_link,
        $matches
    );

    $youtubeId = $matches[1] ?? null;

    $video->update([
        'youtube_category_id' => $request->youtube_category_id,
        'name' => $request->name,
        'youtube_id' => $youtubeId
    ]);

    return redirect()->route('youtubeVideos.index')->with('success', 'Video Updated Successfully');
}

public function destroy($id)
{
    YoutubeVideo::findOrFail($id)->delete();

    return redirect()->route('youtubeVideos.index')
        ->with('success', 'Video Deleted Successfully');
}
}
