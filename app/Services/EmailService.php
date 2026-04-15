<?php

namespace App\Services;

use App\Mail\TemplateMail;
use App\Models\EmailLog;
use App\Models\EmailTemplate;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EmailService
{
    /**
     * Send email using a template slug and log the result to email_logs.
     *
     * Example:
     *   app(EmailService::class)->send(
     *       'workshop-registration-confirmation',
     *       'parent@email.com',
     *       ['parent_name' => 'Aryan', 'workshop_name' => 'Art Camp']
     *   );
     */
    public function send(string $slug, string $toEmail, array $variables = [], ?string $toName = null): bool
    {
        $subject = null;

        try {
            $template = EmailTemplate::findBySlug($slug);

            if (!$template) {
                Log::warning("EmailService: Template not found [{$slug}]");

                EmailLog::create([
                    'slug'          => $slug,
                    'to_email'      => $toEmail,
                    'subject'       => null,
                    'status'        => 'failed',
                    'error_message' => "Template not found: {$slug}",
                    'variables'     => $variables,
                    'mailer'        => config('mail.default'),
                ]);

                return false;
            }

            ['subject' => $subject, 'body' => $body] = $template->render($variables);

            // Must use Address or a string — a plain indexed array like
            // [$email, $name] is interpreted by Laravel as TWO recipients
            // and the name fails RFC 2822 validation before hitting SMTP.
            $recipient = $toName ? new Address($toEmail, $toName) : $toEmail;
            Mail::to($recipient)->send(new TemplateMail($subject, $body));

            EmailLog::create([
                'slug'      => $slug,
                'to_email'  => $toEmail,
                'subject'   => $subject,
                'status'    => 'sent',
                'variables' => $variables,
                'mailer'    => config('mail.default'),
            ]);

            Log::info("EmailService: Sent [{$slug}] to [{$toEmail}]");
            return true;

        } catch (\Exception $e) {
            EmailLog::create([
                'slug'          => $slug,
                'to_email'      => $toEmail,
                'subject'       => $subject,
                'status'        => 'failed',
                'error_message' => $e->getMessage(),
                'variables'     => $variables,
                'mailer'        => config('mail.default'),
            ]);

            Log::error("EmailService: Failed [{$slug}] to [{$toEmail}]", [
                'error' => $e->getMessage(),
            ]);

            return false;
        }
    }
}
