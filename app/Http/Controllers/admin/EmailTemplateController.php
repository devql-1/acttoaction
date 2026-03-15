<?php
// app/Http/Controllers/Admin/EmailTemplateController.php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\EmailTemplate;
use App\Services\EmailService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EmailTemplateController extends Controller
{
    /* List all templates */
    public function index()
    {
        $templates = EmailTemplate::latest()->get();
        return view('backend.email_templates.index', compact('templates'));
    }

    /* Show create form */
    public function create()
    {
        return view('backend.email_templates.create');
    }

    /* Store new template */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:150',
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
            'category' => 'required|string|max:50',
        ]);

        EmailTemplate::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'subject' => $request->subject,
            'body' => html_entity_decode($request->body), // ← fix
            'category' => $request->category,
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('email-templates.index')->with('success', 'Template created successfully.');
    }

    /* Show edit form */
    public function edit($id)
    {
        $template = EmailTemplate::findOrFail($id);
        return view('backend.email_templates.edit', compact('template'));
    }

    /* Update template */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:150',
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
            'category' => 'required|string|max:50',
        ]);

        EmailTemplate::findOrFail($id)->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'subject' => $request->subject,
            'body' => $request->body,
            'category' => $request->category,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('email-templates.index')->with('success', 'Template updated successfully.');
    }

    /* Delete template */
    public function destroy($id)
    {
        EmailTemplate::findOrFail($id)->delete();
        return back()->with('success', 'Template deleted.');
    }

    /* Send test email */
    public function sendTest(Request $request, $id)
    {
        $request->validate([
            'test_email' => 'required|email',
        ]);

        $template = EmailTemplate::findOrFail($id);

        $sent = app(EmailService::class)->send($template->slug, $request->test_email, [
            'student_name' => 'Test Student',
            'course_name' => 'Screen Acting',
            'centre' => 'Jaipur Centre',
            'reference_id' => 'ATA-TEST01',
            'amount' => '₹5,000',
            'payment_id' => 'pay_TEST123',
            'volunteer_name' => 'Test Volunteer',
            'email' => $request->test_email,
            'phone' => '9876543210',
            'name' => 'Test User',
            'message' => 'This is a test email.',
        ]);

        if ($sent) {
            return back()->with('success', 'Test email sent to ' . $request->test_email);
        }

        return back()->with('error', 'Failed to send. Check your mail config in .env');
    }
}
