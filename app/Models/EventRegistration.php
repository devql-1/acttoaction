<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventRegistration extends Model
{
    use HasFactory;

    protected $fillable = ['event_id', 'sub_event_id', 'name', 'phone', 'city', 'state', 'tickets', 'total_amount', 'status', 'registration_number', 'notes'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($registration) {
            $registration->registration_number = 'REG-' . strtoupper(uniqid());
        });
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function subEvent()
    {
        return $this->belongsTo(SubEvent::class);
    }
}
