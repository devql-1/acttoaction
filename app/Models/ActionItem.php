<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActionItem extends Model
{
    protected $fillable = ['title', 'icon', 'route', 'order', 'status'];
}
