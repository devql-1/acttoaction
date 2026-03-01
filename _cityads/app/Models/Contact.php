<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id','username','phone','message','email','status','is_read'
    ];

    public function service()
    {
        return $this->belongsTo(\App\Models\Service::class, 'service_id');
    }

}

