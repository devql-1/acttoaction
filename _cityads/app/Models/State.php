<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class State extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status'
    ];

    // One state has many centers
    public function centers()
    {
        return $this->hasMany(Center::class);
    }

    // Active centers only
    public function activeCenters()
    {
        return $this->hasMany(Center::class)->where('status', 1);
    }
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}