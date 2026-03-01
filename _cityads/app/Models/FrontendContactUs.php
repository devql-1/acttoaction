<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FrontendContactUs extends Model
{
    protected $fillable = [
        'name','mobile','email','subject','message'
    ];
}
