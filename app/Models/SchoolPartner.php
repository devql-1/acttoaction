<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class SchoolPartner extends Model
{
    use HasFactory;

    protected $table = 'school_partners';

    protected $fillable = [
        'category_id', 'name', 'logo_path', 'website_url', 'sort_order', 'status',
    ];

    protected $casts = [
        'status'     => 'boolean',
        'sort_order' => 'integer',
    ];

    // ── Relationship ─────────────────────────────────────────

    public function category()
    {
        return $this->belongsTo(SchoolPartnerCategory::class, 'category_id');
    }

    // ── Accessor ─────────────────────────────────────────────

    public function getLogoUrlAttribute(): string
    {
        if (!$this->logo_path) {
            return 'https://placehold.co/200x120?text=' . urlencode($this->name);
        }
        // If it's already a full URL (dummy data / external), return as-is
        if (str_starts_with($this->logo_path, 'http')) {
            return $this->logo_path;
        }
        return Storage::url($this->logo_path);
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

    // ── Static helper (returns array grouped by category) ────

    public static function getByCategory(?int $sectionId = null): array
    {
        $query = SchoolPartnerCategory::active()->ordered()->with([
            'schools' => fn($q) => $q->where('status', 1)->orderBy('sort_order')->orderBy('id'),
        ]);

        if ($sectionId) {
            $query->where('school_section_id', $sectionId);
        }

        $result = [];
        foreach ($query->get() as $cat) {
            $result[$cat->slug] = [
                'label'   => $cat->name,
                'schools' => $cat->schools,
            ];
        }

        return $result;
    }
}
