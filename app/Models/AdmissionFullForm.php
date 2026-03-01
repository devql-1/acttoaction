<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdmissionFullForm extends Model
{
    protected $fillable = [
        'school',
        'fee',
        'classname',
        'name',
        'father_name',
        'father_occupation',
        'mother_name',
        'mother_occupation',
        'gender',
        'category',
        'caste',
        'religion',
        'aadhar_card',
        'mobile',
        'email',
        'dob_year',
        'place_birth',
        'address',
        'state',
        'district',
        'pin_code',
        'residential',
        'physically',
        'name_previous_school',
        'medium_previous_school',
        'income_parents',
        'name_sibling',
        'class_sibling',
        'status',
        'is_read'
    ];
}
