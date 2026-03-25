<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventRegistrationAttendee extends Model
{
    protected $fillable = ['registration_id', 'ticket_number', 'is_primary', 'name', 'phone', 'email', 'dob', 'age', 'gender', 'institution'];

    protected $casts = [
        'is_primary' => 'boolean',
        'dob' => 'date',
    ];
    public function registration()
    {
        return $this->belongsTo(EventRegistration::class, 'registration_id');
    }
}
