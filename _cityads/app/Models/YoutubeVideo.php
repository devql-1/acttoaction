<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class YoutubeVideo extends Model
{
    protected $fillable = [
        'youtube_category_id',
        'name',
        'youtube_id'
    ];

    public function youtubeCategory()
    {
        return $this->belongsTo(YoutubeCategory::class);
    }
}