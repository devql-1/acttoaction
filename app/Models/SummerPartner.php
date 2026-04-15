<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class SummerPartner extends Model
{
    use HasFactory;

    protected $table = 'summer_partners';

    protected $fillable = ['category', 'name', 'logo_path', 'website_url', 'sort_order', 'status'];

    protected $casts = [
        'status'     => 'boolean',
        'sort_order' => 'integer',
    ];

    // ── Relationship ─────────────────────────────────────────

    public function categoryModel()
    {
        return $this->belongsTo(SummerPartnerCategory::class, 'category', 'slug');
    }

    // ── Accessor ─────────────────────────────────────────────

    public function getLogoUrlAttribute(): string
    {
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

    // ── Static helper (used in SummerController) ─────────────

    public static function getByCategory(): array
    {
        $categories = SummerPartnerCategory::active()->ordered()->get();
        $all        = static::active()->ordered()->get();

        $grouped = [];
        foreach ($categories as $cat) {
            $grouped[$cat->slug] = [
                'label'    => $cat->name,
                'partners' => $all->where('category', $cat->slug)->values(),
            ];
        }

        return $grouped;
    }
}
