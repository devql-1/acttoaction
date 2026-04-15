<?php
// app/Models/PsychTest.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PsychTest extends Model
{
    use HasFactory;

    protected $table = 'psych_tests';

    protected $fillable = ['test_name', 'slug', 'description', 'duration', 'status', 'age'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = static::uniqueSlug(\Illuminate\Support\Str::slug($model->test_name) ?: 'test');
            }
        });
        static::updating(function ($model) {
            if ($model->isDirty('test_name') && empty($model->getOriginal('slug'))) {
                $model->slug = static::uniqueSlug(\Illuminate\Support\Str::slug($model->test_name) ?: 'test', $model->id);
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
    public function resultRanges()
    {
        return $this->hasMany(TestResultRange::class, 'test_id')->orderBy('min_percent');
    }
}
