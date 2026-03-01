<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamMember extends Model
{
    protected $fillable = [
        'name', 'designation', 'image', 'instagram_url', 'facebook_url', 'twitter_url', 'linkedin_url', 'status'
    ];
}
