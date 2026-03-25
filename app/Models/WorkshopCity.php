<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorkshopCity extends Model
{
    use HasFactory;

    protected $table = 'workshop_cities';

    protected $fillable = [
        'age_group_id',
        'name',
        'sort_order',
        'status',
    ];

    protected $casts = [
        'status'     => 'boolean',
        'sort_order' => 'integer',
    ];

    // ── Relationships ────────────────────────────────────────

    public function ageGroup(): BelongsTo
    {
        return $this->belongsTo(WorkshopAgeGroup::class, 'age_group_id');
    }

    public function schools(): HasMany
    {
        return $this->hasMany(WorkshopSchool::class, 'city_id')
                    ->where('status', 1)
                    ->orderBy('sort_order')
                    ->orderBy('id');
    }

    public function allSchools(): HasMany
    {
        return $this->hasMany(WorkshopSchool::class, 'city_id');
    }

    // ── Scopes ───────────────────────────────────────────────

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    public function scopeForAgeGroup($query, int $ageGroupId)
    {
        return $query->where('age_group_id', $ageGroupId);
    }
}
