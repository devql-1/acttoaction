<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class SubEvent extends Model
{
    use HasFactory;

    protected $fillable = ['event_id', 'title', 'slug', 'description', 'event_date', 'start_time', 'end_time', 'fees', 'age_group', 'mode', 'max_seats', 'status', 'banner_image', 'redirect_link', 'type'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = static::uniqueSlug(Str::slug($model->title) ?: 'sub-event');
            }
        });
        static::updating(function ($model) {
            if ($model->isDirty('title') && empty($model->getOriginal('slug'))) {
                $model->slug = static::uniqueSlug(Str::slug($model->title) ?: 'sub-event', $model->id);
            }
        });
    }

    protected static function uniqueSlug(string $base, int $excludeId = 0): string
    {
        $slug  = $base;
        $count = 1;
        while (static::where('slug', $slug)->when($excludeId, fn($q) => $q->where('id', '!=', $excludeId))->exists()) {
            $slug = $base . '-' . $count++;
        }
        return $slug;
    }

    protected $casts = [
        'event_date' => 'date',
        'fees' => 'decimal:2',
    ];

    // Sub event belongs to main event
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    // Sub event belongs to many centers
    public function centers()
    {
        return $this->belongsToMany(Center::class, 'sub_event_centers');
    }

    // Centers with state info
    public function centersWithState()
    {
        return $this->belongsToMany(Center::class, 'sub_event_centers')->with('state')->where('centers.status', 1);
    }

    // Get centers grouped by state
    public function centersByState()
    {
        return $this->centersWithState()->get()->groupBy('state.name');
    }

    // Scope: active sub events only
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    // Scope: upcoming sub events
    public function scopeUpcoming($query)
    {
        return $query->where('event_date', '>=', now());
    }

    public function getBannerUrlAttribute()
    {
        return $this->banner_image ? asset('public/' . $this->banner_image) : asset('assets/img/placeholder-image.jpg');
    }

    // Get formatted time range
    public function getTimeRangeAttribute()
    {
        if ($this->start_time && $this->end_time) {
            return date('h:i A', strtotime($this->start_time)) . ' - ' . date('h:i A', strtotime($this->end_time));
        }
        return '--';
    }

    // Check if free event
    public function getIsFreeAttribute()
    {
        return $this->fees == 0;
    }
    public function registrations()
    {
        return $this->hasMany(EventRegistration::class);
    }
}
