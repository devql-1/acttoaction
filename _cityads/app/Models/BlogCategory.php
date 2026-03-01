<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    public function posts()
    {
        return $this->hasMany(Blog::class, 'category_id');
    }
}
