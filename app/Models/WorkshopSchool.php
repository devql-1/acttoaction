<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class WorkshopSchool extends Model
{
    use HasFactory;

    protected $table = 'workshop_schools';

    protected $fillable = ['city_id', 'age_group_id', 'name', 'description', 'timings', 'registration_url', 'image_path', 'address', 'sort_order', 'status', 'fees'];

    protected $casts = [
        'status' => 'boolean',
        'sort_order' => 'integer',
    ];

    // ── Relationships ────────────────────────────────────────

    public function city(): BelongsTo
    {
        return $this->belongsTo(WorkshopCity::class, 'city_id');
    }

    public function ageGroup(): BelongsTo
    {
        return $this->belongsTo(WorkshopAgeGroup::class, 'age_group_id');
    }

    // ── Accessor ─────────────────────────────────────────────

    public function getImageUrlAttribute(): ?string
    {
        return $this->image_path ? Storage::url($this->image_path) : null;
    }

    // ── Scopes ───────────────────────────────────────────────

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }
}
