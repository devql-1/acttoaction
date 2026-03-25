<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * PageCategory
 *
 * Represents a logical "page" of the website (e.g. Home, About, Acting Course).
 * Each category owns its own set of TestimonialVideos, so admins can configure
 * unique carousels per page from the backend.
 *
 * @property int         $id
 * @property string      $name
 * @property string      $slug
 * @property string|null $description
 * @property bool        $is_active
 * @property int         $sort_order
 */
class PageCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'slug', 'description', 'is_active', 'sort_order'];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    // ── Relationships ──────────────────────────────────────────

    /**
     * All testimonial videos belonging to this page category.
     */
    public function testimonialVideos()
    {
        return $this->hasMany(TestimonialVideo::class)->orderBy('sort_order');
    }

    /**
     * Only active testimonial videos.
     */
    public function activeVideos()
    {
        return $this->testimonialVideos()->where('is_active', true);
    }

    // ── Scopes ────────────────────────────────────────────────

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    // ── Helpers ───────────────────────────────────────────────

    /**
     * Find a category by its slug (used in controllers to load page-specific videos).
     */
    public static function findBySlug(string $slug): ?self
    {
        return static::active()->where('slug', $slug)->first();
    }
}
