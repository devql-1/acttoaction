<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceSubcategory extends Model
{
    protected $fillable = ['category_id','subcategory_name','slug','status'];

    public function category()
    {
        return $this->belongsTo(ServiceCategory::class, 'category_id');
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'subcategory_id');
    }
}

