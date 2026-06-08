<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug', 'description', 'duration', 'sessions', 'mode', 'age_group', 'category_id', 'banner_image', 'instagram_link', 'highlights_link'];

    /**
     * Boot method - runs when model is created/updated
     */
    protected static function boot()
    {
        parent::boot();

        // Generate slug when title is set
        static::creating(function ($model) {
            if ($model->title && !$model->slug) {
                $model->slug = Str::slug($model->title);
            }
        });

        // Update slug if title is changed
        static::updating(function ($model) {
            if ($model->isDirty('title')) {
                $model->slug = Str::slug($model->title);
            }
        });
    }

    /**
     * Route model binding by slug instead of id
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sessions()
    {
        return $this->hasMany(CourseSession::class);
    }

    public function documents()
    {
        return $this->hasMany(CourseDocument::class);
    }

    public function category()
    {
        return $this->belongsTo(CourseCategory::class, 'category_id');
    }

    public function centers()
    {
        return $this->belongsToMany(Center::class, 'course_center', 'course_id', 'center_id')->withPivot('fees')->withTimestamps();
    }

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
}
