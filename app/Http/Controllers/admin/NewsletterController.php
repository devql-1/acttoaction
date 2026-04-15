<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function index(Request $request)
    {
        $query = Newsletter::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('source')) {
            $query->where('source', $request->source);
        }

        if ($request->filled('search')) {
            $query->where('email', 'like', '%' . $request->search . '%');
        }

        $subscribers = $query->latest()->paginate(25)->withQueryString();
        $total       = Newsletter::count();
        $active      = Newsletter::where('status', 'active')->count();
        $sources     = Newsletter::select('source')->distinct()->pluck('source');

        return view('backend.newsletters.index', compact('subscribers', 'total', 'active', 'sources'));
    }

    public function exportCsv(Request $request)
    {
        $query = Newsletter::query();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('source')) {
            $query->where('source', $request->source);
        }

        $subscribers = $query->latest()->get();

        $filename = 'newsletter_subscribers_' . now()->format('Y-m-d_His') . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($subscribers) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['#', 'Email', 'Source', 'Status', 'IP Address', 'Subscribed At']);

            foreach ($subscribers as $i => $sub) {
                fputcsv($handle, [
                    $i + 1,
                    $sub->email,
                    $sub->source,
                    $sub->status,
                    $sub->ip_address,
                    $sub->created_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function destroy($id)
    {
        Newsletter::findOrFail($id)->delete();

        return response()->json(['status' => 200, 'message' => 'Subscriber deleted.']);
    }
}
