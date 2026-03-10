<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestGraphConfig extends Model
{
    protected $table = 'test_graph_configs';

    protected $fillable = ['test_id', 'graph_type', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];
    public function test()
    {
        return $this->belongsTo(PsychTest::class, 'test_id');
    }
}