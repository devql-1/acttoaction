<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'galleries';

    protected $fillable = ['gallery_category_id', 'title', 'image'];

    public function galleryCategory()
    {
        return $this->belongsTo(Gallerycat::class, 'gallery_category_id');
    }
}
