<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class SchoolPartnerCategory extends Model
{
    use HasFactory;

    protected $table = 'school_partner_categories';

    protected $fillable = ['school_section_id', 'name', 'slug', 'sort_order', 'status'];

    protected $casts = [
        'status'     => 'boolean',
        'sort_order' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($cat) {
            if (empty($cat->slug)) {
                $cat->slug = Str::slug($cat->name);
            }
        });
    }

    // ── Relationships ─────────────────────────────────────────

    public function section()
    {
        return $this->belongsTo(SchoolSection::class, 'school_section_id');
    }

    public function schools()
    {
        return $this->hasMany(SchoolPartner::class, 'category_id');
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

    public function scopeForSection($query, $sectionId)
    {
        return $query->where('school_section_id', $sectionId);
    }

    // ── Static helpers ───────────────────────────────────────

    public static function getActive(?int $sectionId = null)
    {
        $q = static::active()->ordered();
        if ($sectionId) {
            $q->where('school_section_id', $sectionId);
        }
        return $q->get();
    }
}
