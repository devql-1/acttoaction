<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'age',
        'city',
        'state',
        'occupation',
        'roles',
        'availability',
        'hear_about',
        'motivation',
        'experience'
    ];
}
