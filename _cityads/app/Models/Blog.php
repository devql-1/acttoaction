<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{

    protected $fillable = [
        'category_id',
        'author_id',          // ← NEW
        'title',
        'slug',
        'short_description',
        'description',
        'image',
        'status',
    ];
    public function category()
    {
        return $this->belongsTo(BlogCategory::class, 'category_id');
    }
    public function author()
    {
        return $this->belongsTo(BlogAuthor::class, 'author_id');
    }

}   
