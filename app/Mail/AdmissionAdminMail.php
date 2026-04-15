<?php

namespace App\Mail;

use App\Models\AdmissionFullForm;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdmissionAdminMail extends Mailable
{
    use Queueable, SerializesModels;

    public AdmissionFullForm $admission;

    public function __construct(AdmissionFullForm $admission)
    {
        $this->admission = $admission;
    }

    public function build()
    {
        return $this->subject('New Admission Application Received')
            ->markdown('emails.admission_admin');
    }
}
