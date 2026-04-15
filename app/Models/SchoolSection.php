<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class SchoolSection extends Model
{
    use HasFactory;

    protected $table = 'school_sections';

    protected $fillable = ['name', 'slug', 'description', 'sort_order', 'status'];

    protected $casts = [
        'status'     => 'boolean',
        'sort_order' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($s) {
            if (empty($s->slug)) {
                $s->slug = Str::slug($s->name);
            }
        });
    }

    // ── Relationships ─────────────────────────────────────────

    public function categories()
    {
        return $this->hasMany(SchoolPartnerCategory::class, 'school_section_id');
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

    // ── Static helper ────────────────────────────────────────

    public static function getActive()
    {
        return static::active()->ordered()->get();
    }
}
