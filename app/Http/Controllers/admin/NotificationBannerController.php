<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\NotificationBanner;
use Illuminate\Http\Request;

class NotificationBannerController extends Controller
{
    public function index()
    {
        $banners = NotificationBanner::orderBy('sort_order')->orderBy('id')->get();
        return view('backend.notification_banners.index', compact('banners'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url'   => 'nullable|string|max:500',
            'image' => 'nullable|image|max:2048',
        ]);

        $banner = new NotificationBanner();
        $banner->title      = $request->title;
        $banner->url        = $request->url;
        $banner->sort_order = $request->sort_order ?? 0;
        $banner->is_active  = $request->has('is_active') ? 1 : 0;

        if ($request->hasFile('image')) {
            $filename = time() . '_notif.' . $request->image->extension();
            $request->image->move(public_path('img/notification_banners'), $filename);
            $banner->image = 'img/notification_banners/' . $filename;
        }

        $banner->save();

        return redirect()->route('admin.notification-banners.index')
                         ->with('success', 'Banner added successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'url'   => 'nullable|string|max:500',
            'image' => 'nullable|image|max:2048',
        ]);

        $banner = NotificationBanner::findOrFail($id);
        $banner->title      = $request->title;
        $banner->url        = $request->url;
        $banner->sort_order = $request->sort_order ?? 0;
        $banner->is_active  = $request->has('is_active') ? 1 : 0;

        if ($request->has('remove_image') && $request->remove_image == 1) {
            if ($banner->image && file_exists(public_path($banner->image))) {
                unlink(public_path($banner->image));
            }
            $banner->image = null;
        } elseif ($request->hasFile('image')) {
            if ($banner->image && file_exists(public_path($banner->image))) {
                unlink(public_path($banner->image));
            }
            $filename = time() . '_notif.' . $request->image->extension();
            $request->image->move(public_path('img/notification_banners'), $filename);
            $banner->image = 'img/notification_banners/' . $filename;
        }

        $banner->save();

        return redirect()->route('admin.notification-banners.index')
                         ->with('success', 'Banner updated successfully.');
    }

    public function toggleStatus(Request $request)
    {
        $banner = NotificationBanner::findOrFail($request->id);
        $banner->is_active = $request->status;
        $banner->save();
        return response()->json(['success' => true, 'is_active' => $banner->is_active]);
    }

    public function destroy($id)
    {
        $banner = NotificationBanner::findOrFail($id);
        if ($banner->image && file_exists(public_path($banner->image))) {
            unlink(public_path($banner->image));
        }
        $banner->delete();
        return response()->json(['success' => true]);
    }
}
