<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class CourseSession extends Model
{
    protected $fillable = ['course_id', 'session_number', 'title', 'description'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}