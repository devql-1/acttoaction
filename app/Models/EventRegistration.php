<?php
// ══════════════════════════════════════════════════════════
// app/Models/EventRegistration.php
// ══════════════════════════════════════════════════════════

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventRegistration extends Model
{
    protected $fillable = ['event_id', 'sub_event_id', 'center_id', 'city', 'state', 'tickets', 'total_amount', 'status', 'registration_number', 'notes'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($r) {
            $r->registration_number = 'REG-' . strtoupper(substr(uniqid(), -7));
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
    public function center()
    {
        return $this->belongsTo(Center::class);
    }
    public function attendees()
    {
        return $this->hasMany(EventRegistrationAttendee::class, 'registration_id')->orderBy('ticket_number');
    }
    public function primary()
    {
        return $this->hasOne(EventRegistrationAttendee::class, 'registration_id')->where('is_primary', true);
    }
}
