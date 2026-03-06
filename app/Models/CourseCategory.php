<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourseCategory extends Model
{
    protected $fillable = ['name', 'image', 'status', 'description'];

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
}