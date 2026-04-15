<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\AnnouncementBar;
use Illuminate\Http\Request;

class AnnouncementBarController extends Controller
{
    public function index()
    {
        $bars = AnnouncementBar::latest()->get();
        return view('backend.announcement_bar.index', compact('bars'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'message'  => 'required|string|max:500',
            'cta_text' => 'nullable|string|max:100',
            'cta_url'  => 'nullable|string|max:500',
        ]);

        AnnouncementBar::create([
            'message'   => $request->message,
            'cta_text'  => $request->cta_text,
            'cta_url'   => $request->cta_url,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->route('admin.announcement-bar.index')
                         ->with('success', 'Announcement created successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'message'  => 'required|string|max:500',
            'cta_text' => 'nullable|string|max:100',
            'cta_url'  => 'nullable|string|max:500',
        ]);

        $bar = AnnouncementBar::findOrFail($id);
        $bar->update([
            'message'   => $request->message,
            'cta_text'  => $request->cta_text,
            'cta_url'   => $request->cta_url,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);

        return redirect()->route('admin.announcement-bar.index')
                         ->with('success', 'Announcement updated successfully.');
    }

    public function toggleStatus(Request $request)
    {
        $bar = AnnouncementBar::findOrFail($request->id);
        $bar->is_active = $request->status;
        $bar->save();
        return response()->json(['success' => true, 'is_active' => $bar->is_active]);
    }

    public function destroy($id)
    {
        AnnouncementBar::findOrFail($id)->delete();
        return response()->json(['success' => true]);
    }
}
