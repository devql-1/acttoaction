<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailLog extends Model
{
    protected $fillable = [
        'slug',
        'to_email',
        'subject',
        'status',
        'error_message',
        'variables',
        'mailer',
    ];

    protected $casts = [
        'variables' => 'array',
    ];

    public function scopeSent($query)
    {
        return $query->where('status', 'sent');
    }

    public function scopeFailed($query)
    {
        return $query->where('status', 'failed');
    }
}
