<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Course extends Model
{
    protected $fillable = [
        'title',
        'description',
        'duration',
        'sessions',
        'mode',
        'age_group',
        'fees',
        'instagram_link',
        'highlights_link',
        'category_id',
    ];

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
}