<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestResultRange extends Model
{
    protected $table = 'test_result_ranges';

    protected $fillable = [
        'test_id',
        'min_percent',
        'max_percent',
        'label',
        'emoji',
        'tagline',
        'description',
        'recommended_course',
        'tags',
        'color',
    ];

    protected $casts = [
        'tags' => 'array',
    ];

    public function test()
    {
        return $this->belongsTo(PsychTest::class, 'test_id');
    }
}