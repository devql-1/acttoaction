<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IndustryService extends Model
{
    protected $fillable = [
        'industry_id',
        'title',
        'short_description',
        'icon',
        'status',
    ];

    public function industry() {
        return $this->belongsTo(Industry::class, 'industry_id');
    }
}
