<?php

// app/Models/Theme.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $fillable = ['title', 'description', 'icon', 'tag', 'bg_color', 'tag_color', 'sort_order', 'status'];
}
