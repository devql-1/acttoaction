<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'event_date',
        'event_end_date',
        'banner_image',
        'instagram_link',
        'highlights_link',
        'status'
    ];

    protected $casts = [
        'event_date' => 'date',
        'event_end_date' => 'date',
    ];

    // Event has many sub events
    public function subEvents()
    {
        return $this->hasMany(SubEvent::class);
    }

    // Active sub events only
    public function activeSubEvents()
    {
        return $this->hasMany(SubEvent::class)->where('status', 1);
    }

    // Get banner image full URL
    public function getBannerUrlAttribute()
    {
        return $this->banner_image
            ? asset('storage/' . $this->banner_image)
            : asset('assets/img/placeholder-image.jpg');
    }

    // Scope: active events only
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    // Scope: upcoming events
    public function scopeUpcoming($query)
    {
        return $query->where('event_date', '>=', now());
    }

    // Scope: past events
    public function scopePast($query)
    {
        return $query->where('event_date', '<', now());
    }
}