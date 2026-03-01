<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FranchiseForm extends Model
{
    protected $fillable = [
        'name', 'email', 'mobile', 'address', 'state', 'city', 'query'
    ];
}
