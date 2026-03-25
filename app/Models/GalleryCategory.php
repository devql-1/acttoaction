<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class GalleryCategory extends Model
{
    use HasFactory;

    protected $table = 'gallery_categories';

    protected $fillable = ['name', 'slug', 'sort_order', 'status'];

    protected $casts = [
        'status'     => 'boolean',
        'sort_order' => 'integer',
    ];

    // ── Auto-generate slug ───────────────────────────────────

    protected static function booted(): void
    {
        static::creating(function ($cat) {
            $cat->slug = $cat->slug ?: Str::slug($cat->name);
        });
    }

    // ── Relationships ────────────────────────────────────────

    public function images(): HasMany
    {
        return $this->hasMany(GalleryImage::class, 'gallery_category_id');
    }

    public function activeImages(): HasMany
    {
        return $this->images()->where('status', 1)->orderBy('sort_order')->orderBy('id');
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

    /**
     * Returns all active categories with their active images eager-loaded.
     * Used by HomeController and GalleryController.
     */
    public static function getForFrontend()
    {
        return static::active()
            ->ordered()
            ->with(['activeImages'])
            ->get();
    }
}
