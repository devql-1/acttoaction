<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    public function category() {
        return $this->belongsTo(AboutCategory::class, 'category_id');
    }

}
