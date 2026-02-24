<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactInfo extends Model
{
    protected $fillable = [
        'phone', 'email', 'whatsapp', 'address', 'map_link', 'top_header_title', 'fb_url', 'insta_url', 'linkedin_url'
    ];
}
