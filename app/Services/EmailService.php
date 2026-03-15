<?php
// app/Services/EmailService.php

namespace App\Services;

use App\Mail\TemplateMail;
use App\Models\EmailTemplate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class EmailService
{
    /**
     * Send email using a template slug.
     *
     * Example usage anywhere in your app:
     *
     * app(EmailService::class)->send(
     *     'enrollment-confirmation',
     *     'student@email.com',
     *     [
     *         'student_name' => 'Aryan Sharma',
     *         'course_name'  => 'Screen Acting',
     *         'reference_id' => 'ATA-00001',
     *     ]
     * );
     */
    public function send(string $slug, string $toEmail, array $variables = [], ?string $toName = null): bool
    {
        try {
            $template = EmailTemplate::findBySlug($slug);

            if (!$template) {
                Log::warning("EmailService: Template not found [{$slug}]");
                return false;
            }

            ['subject' => $subject, 'body' => $body] = $template->render($variables);

            Mail::to($toEmail)->send(new TemplateMail($subject, $body));

            Log::info("EmailService: Sent [{$slug}] to [{$toEmail}]");
            return true;
        } catch (\Exception $e) {
            Log::error("EmailService: Failed [{$slug}] to [{$toEmail}]", [
                'error' => $e->getMessage(),
            ]);
            return false;
        }
    }
}
