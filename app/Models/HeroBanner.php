<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class HeroBanner extends Model
{
    use HasFactory;

    protected $fillable = ['image_path', 'alt_text', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // ── Accessors ──────────────────────────────────────────

    /**
     * Full public URL of the banner image.
     */
    public function getImageUrlAttribute(): string
    {
        return Storage::url($this->image_path);
    }

    // ── Scopes ─────────────────────────────────────────────

    /**
     * Only the active banner.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // ── Static helper ───────────────────────────────────────

    /**
     * Get the single active banner (used in frontend controller).
     */
    public static function getActive(): ?self
    {
        return static::active()->latest()->first();
    }
}
