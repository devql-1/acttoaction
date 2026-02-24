<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'category_id',
        'subcategory_id',
        'title',
        'slug',
        'short_description',
        'description',
        'subtitle',
        'subtitle2',
        'features_headings',
        'features_short_description',
        'benefits_headings',
        'benefits_short_description',
        'essentials_headings',
        'essentials_short_description',
        'advantages',
        'eligibility',
        'image',
        'multiple_image',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(ServiceCategory::class, 'category_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(ServiceSubcategory::class, 'subcategory_id');
    }

    public function faqs()
    {
        return $this->hasMany(\App\Models\ServiceFaq::class, 'service_id');
    }
    
    public function benefits()
    {
        return $this->hasMany(ServiceBenefit::class, 'service_id');
    }

    public function features()
    {
        return $this->hasMany(ServiceFeature::class, 'service_id');
    }
    public function essentials()
    {
        return $this->hasMany(ServiceEssential::class, 'service_id');
    }

    public function contact()
    {
        return $this->hasMany(Contact::class);
    }

}

