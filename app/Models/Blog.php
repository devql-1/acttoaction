<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable = [
        'category_id',
        'author_id', // ← NEW
        'title',
        'slug',
        'short_description',
        'description',
        'linkedin_post',
        'instagram_post',
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
    // app/Models/Blog.php
    public function tags()
    {
        return $this->belongsToMany(BlogTag::class, 'blog_tag', 'blog_id', 'blog_tag_id');
    }
}
