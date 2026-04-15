<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CourseCategory extends Model
{
    protected $fillable = ['name', 'slug', 'image', 'status', 'description'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = static::uniqueSlug(Str::slug($model->name) ?: 'category');
            }
        });
        static::updating(function ($model) {
            if ($model->isDirty('name') && empty($model->slug)) {
                $model->slug = static::uniqueSlug(Str::slug($model->name) ?: 'category', $model->id);
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

    public function courses()
    {
        return $this->hasMany(Course::class, 'category_id');
    }

    public function getImageUrlAttribute()
    {
        return $this->image
            ? asset('storage/' . $this->image)
            : asset('frontendassets/img/cat-1.jpg');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }
    public function getCoursesCountAttribute()
    {
        return $this->courses()->count();
    }
}