<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Center extends Model
{
    use HasFactory;

    protected $fillable = [
        'state_id',
        'name',
        'address',
        'phone',
        'email',
        'map_link',
        'status'
    ];

    // Center belongs to a state
    public function state()
    {
        return $this->belongsTo(State::class);
    }

    // Center belongs to many courses
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_centers');
    }

    // Scope: only active centers
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    // Scope: filter by state
    public function scopeByState($query, $stateId)
    {
        return $query->where('state_id', $stateId);
    }
}