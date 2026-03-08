<?php
// app/Models/PsychQuestion.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PsychQuestion extends Model
{
    use HasFactory;

    protected $table = 'psych_questions';

    protected $fillable = ['category_id', 'question_text', 'scale_min', 'scale_max'];

    public function category()
    {
        return $this->belongsTo(PsychCategory::class, 'category_id');
    }

    // After saving a question → update parent category total_marks
    protected static function booted(): void
    {
        // When a question is created
        static::created(function ($question) {
            $question->category()->increment('total_marks', 5);
        });

        // When a question is deleted
        static::deleted(function ($question) {
            $question->category()->decrement('total_marks', 5);
        });

        // When a question is moved to a different category
        static::updated(function ($question) {
            if ($question->wasChanged('category_id')) {
                // Subtract from old category
                PsychCategory::where('id', $question->getOriginal('category_id'))
                    ->decrement('total_marks', 5);
                // Add to new category
                $question->category()->increment('total_marks', 5);
            }
        });
    }
}
