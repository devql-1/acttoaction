<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnnouncementBar extends Model
{
    protected $fillable = ['message', 'cta_text', 'cta_url', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
