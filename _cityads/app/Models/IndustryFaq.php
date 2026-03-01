<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndustryFaq extends Model
{
    use HasFactory;

    protected $fillable = [
        'industry_id',
        'question',
        'answer',
        'status',
    ];

    /**
     * Relation with Industry
     */
    public function industry()
    {
        return $this->belongsTo(Industry::class, 'industry_id');
    }
}
