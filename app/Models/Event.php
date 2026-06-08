<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'description', 'event_date', 'event_end_date', 'banner_image', 'instagram_link', 'highlights_link', 'status', 'type'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = static::uniqueSlug(Str::slug($model->title) ?: 'event');
            }
        });
        static::updating(function ($model) {
            if ($model->isDirty('title') && empty($model->getOriginal('slug'))) {
                $model->slug = static::uniqueSlug(Str::slug($model->title) ?: 'event', $model->id);
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
        if (!$this->banner_image) {
            return asset('public/assets/img/placeholder-image-1.webp');
        }

        if (Str::startsWith($this->banner_image, ['http://', 'https://', '//'])) {
            return $this->banner_image;
        }

        $normalizedPath = ltrim($this->banner_image, '/');
        $assetPrefix = $this->getPublicAssetPrefix();

        if (Str::startsWith($normalizedPath, 'public/')) {
            return asset($assetPrefix . Str::after($normalizedPath, 'public/'));
        }

        if (Str::startsWith($normalizedPath, 'img/')) {
            return asset($assetPrefix . $normalizedPath);
        }

        if (Str::startsWith($normalizedPath, 'storage/')) {
            return asset($assetPrefix . $normalizedPath);
        }

        return asset($assetPrefix . 'storage/' . $normalizedPath);
    }

    protected function getPublicAssetPrefix(): string
    {
        $documentRoot = request()?->server('DOCUMENT_ROOT');
        $publicRoot = realpath(public_path());

        return $documentRoot && realpath($documentRoot) === $publicRoot ? '' : 'public/';
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
    public function registrations()
    {
        return $this->hasMany(EventRegistration::class);
    }
}
