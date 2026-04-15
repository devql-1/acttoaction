<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\EmailLog;
use App\Models\EmailTemplate;
use Illuminate\Http\Request;

class EmailLogController extends Controller
{
    /**
     * Return a rendered preview of a logged email as JSON, for the "View"
     * modal on the logs page. Re-renders the template with the variables
     * that were captured at send-time, so the admin sees exactly what was
     * placed into the envelope (even if the template was edited since).
     */
    public function show($id)
    {
        $log = EmailLog::findOrFail($id);

        $variables = is_array($log->variables) ? $log->variables : (array) ($log->variables ?? []);

        $subject     = $log->subject;
        $bodyHtml    = null;
        $templateFound = false;

        $template = EmailTemplate::where('slug', $log->slug)->first();
        if ($template) {
            $templateFound = true;
            $rendered = $template->render($variables);
            $subject  = $rendered['subject'] ?? $subject;
            $bodyHtml = $rendered['body'] ?? null;
        }

        return response()->json([
            'id'              => $log->id,
            'slug'            => $log->slug,
            'to_email'        => $log->to_email,
            'subject'         => $subject,
            'status'          => $log->status,
            'mailer'          => $log->mailer,
            'error_message'   => $log->error_message,
            'variables'       => $variables,
            'body_html'       => $bodyHtml,
            'template_found'  => $templateFound,
            'created_at'      => $log->created_at?->format('d M Y, h:i A'),
        ]);
    }

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
