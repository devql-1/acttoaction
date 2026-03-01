<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutCategory extends Model
{
    public function abouts()
    {
        return $this->hasMany(About::class);
    }
}
