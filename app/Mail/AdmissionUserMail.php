<?php

namespace App\Mail;

use App\Models\AdmissionFullForm;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdmissionUserMail extends Mailable
{
    use Queueable, SerializesModels;

    public AdmissionFullForm $admission;

    public function __construct(AdmissionFullForm $admission)
    {
        $this->admission = $admission;
    }

    public function build()
    {
        return $this->subject('Thanks for your admission application — ' . config('app.name'))
            ->markdown('emails.admission_user');
    }
}
