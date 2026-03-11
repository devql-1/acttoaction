<?php
// app/Models/BlogAuthor.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogAuthor extends Model
{
    protected $table = 'blog_authors';

    protected $fillable = [
        'name',
        'designation',
        'bio',
        'image',
        'instagram',
        'facebook',
        'twitter',
        'linkedin',
        'status',
    ];

    // One author → many blog posts
    public function blogs()
    {
        return $this->hasMany(Blog::class, 'author_id');
    }

    // Returns full image URL, falls back to a placeholder
    public function getImageUrlAttribute(): string
    {
        return $this->image
            ? asset('img/authors/' . $this->image)
            : asset('img/default-author.png');
    }
}