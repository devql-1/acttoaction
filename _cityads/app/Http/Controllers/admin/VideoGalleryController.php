<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\VideoGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VideoGalleryController extends Controller
{
    //This method will show listing for video-gallery
    public function index()
    {
        $video_gallery = VideoGallery::get();
        return view('backend.video_gallery.index', compact('video_gallery'));
    }

    //This method will store a record of video gallery
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'video_item' => 'required|file|mimes:mp4,avi,mov,wmv|max:51200', // max 50MB
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $create = new VideoGallery();
        $create->video_name = $request->video_name;

        if ($request->hasFile('video_poster')) {
            $filename = time() . '.' . $request->video_poster->extension();
            $request->video_poster->move(public_path('img'), $filename);
            $create->video_poster = $filename;
        }

        if ($request->hasFile('video_item')) {
            $file = $request->file('video_item');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img'), $filename);
            $create->video_item = $filename;
        }

        $create->save();

        return redirect()->back()->with('success', 'Video Gallery Data Added Successfully');
    }

    //This method will show video gallery form for updating a listing
    public function edit($id)
    {
        $video_gallery = VideoGallery::find($id);
        return view('backend.video_gallery.edit', compact('video_gallery'));
    }

    //This method will update a existing listing of video gallery
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'video_item' => 'nullable|file|mimes:mp4,avi,mov,wmv|max:51200'
        ]);

        if ($validator->passes()) {
            $update = VideoGallery::find($id);
            $update->video_name = $request->video_name;

            if ($request->input('remove_image') == "1") {
                if ($update->video_poster && file_exists(public_path('img/' . $update->video_poster))) {
                    unlink(public_path('img/' . $update->video_poster));
                }
                $update->video_poster = null;
            }

            if ($request->hasFile('video_poster')) {
                if ($update->video_poster && file_exists(public_path('img/' . $update->video_poster))) {
                    unlink(public_path('img/' . $update->video_poster));
                }
                $file = $request->file('video_poster');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('img'), $filename);
                $update->video_poster = $filename;
            }

            if ($request->input('remove_video_item') == "1") {
                if ($update->video_item && file_exists(public_path('img/' . $update->video_item))) {
                    unlink(public_path('img/' . $update->video_item));
                }
                $update->video_item = null;
            }

            if ($request->hasFile('video_item')) {
                if ($update->video_item && file_exists(public_path('img/' . $update->video_item))) {
                    unlink(public_path('img/' . $update->video_item));
                }
                $file = $request->file('video_item');
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('img'), $filename);
                $update->video_item = $filename;
            }

            $update->save();

            return redirect()->route('admin.video_gallery')->with('success', 'Video Gallery Data Updated Successfully');
        } else {
            return redirect()->back()->withInput()->withErrors($validator);
        }
    }

    //This method will destroy a particular listing
    public function destroy($id)
    {
        VideoGallery::find($id)->delete();
        return response()->json(['success' => true]);
    }

    // This method will show for published unpublished notification
    public function video_gallery_toggleStatus(Request $request)
    {
        $toggle = VideoGallery::find($request->id);
        if ($toggle) {
            $toggle->status = $request->status; // 1 ya 0
            $toggle->save();

            return response()->json(['success' => true, 'status' => $toggle->status]);
        }
        return response()->json(['success' => false]);
    }
}
