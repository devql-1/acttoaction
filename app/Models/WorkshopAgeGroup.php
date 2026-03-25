<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class WorkshopAgeGroup extends Model
{
    use HasFactory;

    protected $table = 'workshop_age_groups';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'sort_order',
        'status',
    ];

    protected $casts = [
        'status'     => 'boolean',
        'sort_order' => 'integer',
    ];

    // ── Auto-generate slug from name ─────────────────────────
    protected static function booted(): void
    {
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->name);
            }
        });
    }

    // ── Relationships ────────────────────────────────────────

    public function cities(): HasMany
    {
        return $this->hasMany(WorkshopCity::class, 'age_group_id')
                    ->orderBy('sort_order')
                    ->orderBy('name');
    }

    public function schools(): HasMany
    {
        return $this->hasMany(WorkshopSchool::class, 'age_group_id');
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

    // ── Static helpers ───────────────────────────────────────

    /**
     * All active age groups for navbar dropdown.
     */
    public static function forNav()
    {
        return static::active()->ordered()->get();
    }

    /**
     * Active age groups with their active cities — for the workshops page dropdowns.
     */
    public static function withActiveCities()
    {
        return static::active()
                     ->ordered()
                     ->with(['cities' => fn($q) => $q->where('status', 1)])
                     ->get();
    }
}
