<?php
// app/Models/PsychTest.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PsychTest extends Model
{
    use HasFactory;

    protected $table = 'psych_tests';

    protected $fillable = ['test_name', 'description', 'duration', 'status', 'age'];

    // One test has many categories
    public function categories()
    {
        return $this->hasMany(PsychCategory::class, 'test_id');
    }

    // Shortcut: all questions across all categories of this test
    public function questions()
    {
        return $this->hasManyThrough(
            PsychQuestion::class,
            PsychCategory::class,
            'test_id',      // FK on psych_categories
            'category_id'   // FK on psych_questions
        );
    }

    // Total max marks across all categories (sum of total_marks)
    public function getTotalMarksAttribute(): int
    {
        return $this->categories()->sum('total_marks');
    }
    // inside app/Models/Test.php
    public function graphConfig()
    {
        return $this->hasOne(TestGraphConfig::class, 'test_id');
    }
}
