<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndustryFeature extends Model
{
    protected $fillable = [
        'industry_id',
        'title',
        'icon',
        'description',
        'status',
    ];

    public function industry() {
        return $this->belongsTo(Industry::class, 'industry_id');
    }
}
