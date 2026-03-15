<?php
// app/Models/PsychCategory.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PsychCategory extends Model
{
    use HasFactory;

    protected $table = 'psych_categories';

    protected $fillable = ['test_id', 'category_name', 'description', 'total_marks'];

    public function test()
    {
        return $this->belongsTo(PsychTest::class, 'test_id');
    }

    public function questions()
    {
        return $this->hasMany(PsychQuestion::class, 'category_id');
    }

    // Recalculate total_marks based on actual questions × 5
    // Call this any time you want to resync (e.g. after bulk import)
    public function recalculateMarks(): void
    {
        $this->update([
            'total_marks' => $this->questions()->count() * 5
        ]);
    }
}
