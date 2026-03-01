<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class CourseDocument extends Model
{
    protected $fillable = ['course_id', 'document_name', 'document_file'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}