<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\EmailLog;
use Illuminate\Http\Request;

class EmailLogController extends Controller
{
    public function index(Request $request)
    {
        $query = EmailLog::latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('slug')) {
            $query->where('slug', 'like', '%' . $request->slug . '%');
        }

        if ($request->filled('email')) {
            $query->where('to_email', 'like', '%' . $request->email . '%');
        }

        $logs  = $query->paginate(50)->withQueryString();
        $slugs = EmailLog::select('slug')->distinct()->orderBy('slug')->pluck('slug');

        return view('backend.email_logs.index', compact('logs', 'slugs'));
    }

    public function destroy($id)
    {
        EmailLog::findOrFail($id)->delete();
        return back()->with('success', 'Log entry deleted.');
    }

    public function clearAll(Request $request)
    {
        $query = EmailLog::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $count = $query->count();
        $query->delete();

        return back()->with('success', "Cleared {$count} log entries.");
    }
}
