<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * TestimonialVideo
 *
 * Represents a single YouTube testimonial card shown in the
 * carousel section of a specific page.
 *
 * @property int         $id
 * @property int         $page_category_id
 * @property string      $youtube_video_id
 * @property string      $title
 * @property string|null $description
 * @property string      $video_category        e.g. "parent" | "student"
 * @property string|null $video_category_label  e.g. "Parent Feedback"
 * @property string|null $duration              e.g. "2:30"
 * @property string|null $thumbnail_url
 * @property string      $channel_name
 * @property string|null $watch_url
 * @property bool        $is_active
 * @property int         $sort_order
 */
class TestimonialVideo extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['page_category_id', 'youtube_video_id', 'title', 'description', 'video_category', 'video_category_label', 'duration', 'thumbnail_url', 'channel_name', 'watch_url', 'is_active', 'sort_order'];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    // ── Relationships ──────────────────────────────────────────

    public function pageCategory()
    {
        return $this->belongsTo(PageCategory::class);
    }

    // ── Scopes ────────────────────────────────────────────────

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    public function scopeByCategory($query, string $cat)
    {
        return $query->where('video_category', $cat);
    }

    public function scopeForPage($query, string $slug)
    {
        return $query->whereHas('pageCategory', fn($q) => $q->where('slug', $slug)->where('is_active', true));
    }

    // ── Accessors ─────────────────────────────────────────────

    /**
     * Auto-generate YouTube thumbnail URL if none is set.
     * Priority: maxresdefault → mqdefault (fallback handled in JS).
     */
    public function getThumbnailAttribute(): string
    {
        return $this->thumbnail_url ?? "https://i.ytimg.com/vi/{$this->youtube_video_id}/maxresdefault.jpg";
    }

    /**
     * YouTube embed URL (for modal iframe).
     */
    public function getEmbedUrlAttribute(): string
    {
        return "https://www.youtube.com/embed/{$this->youtube_video_id}?autoplay=1&rel=0";
    }

    /**
     * Direct watch link.
     */
    public function getWatchLinkAttribute(): string
    {
        return $this->watch_url ?? "https://youtu.be/{$this->youtube_video_id}";
    }

    /**
     * Human-readable category label.
     */
    public function getCategoryLabelAttribute(): string
    {
        if ($this->video_category_label) {
            return $this->video_category_label;
        }
        return match ($this->video_category) {
            'parent' => 'Parent Feedback',
            'student' => 'Student Journey',
            default => ucfirst($this->video_category),
        };
    }

    // ── Helpers ───────────────────────────────────────────────

    /**
     * Return array shaped exactly as the JS VIDS[] constant
     * consumed by the carousel frontend.
     */
    public function toCarouselArray(): array
    {
        return [
            'id' => $this->youtube_video_id,
            'cat' => $this->video_category,
            'dur' => $this->duration ?? '',
            'title' => $this->title,
            'desc' => $this->description ?? '',
            'thumb' => $this->thumbnail,
            'watch' => $this->watch_link,
            'label' => $this->category_label,
        ];
    }
}
