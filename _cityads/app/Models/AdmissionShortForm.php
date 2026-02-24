<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdmissionShortForm extends Model
{
    protected $fillable = [
        'admission_class', 'name', 'email', 'state', 'city', 'mobile'
    ];
}
