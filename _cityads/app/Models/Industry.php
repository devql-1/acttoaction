<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Industry extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'description',
        'subtitle',
        'subtitle2',
        'features_headings',
        'features_short_description',
        'service_headings',
        'service_short_description',
        'image',
        'status'
    ];

    public function industry()
    {
        return $this->hasMany(IndustryService::class, 'industry_id');
    }

    public function faqs()
    {
        return $this->hasMany(\App\Models\IndustryFaq::class, 'industry_id');
    }

    public function features()
    {
        return $this->hasMany(\App\Models\IndustryFeature::class, 'industry_id');
    }
}
