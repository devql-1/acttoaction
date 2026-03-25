<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class AboutSection extends Model
{
    use HasFactory;

    protected $table = 'about_section';

    protected $fillable = [
        'heading',
        'lead_text',
        'body_text',
        'image_path',
        'badge_year',
        'badge_text',
        'fc_title',
        'fc_subtitle',
        'btn1_label',
        'btn1_url',
        'btn2_label',
        'btn2_url',
        'mini_stats',
        'status',
    ];

    protected $casts = [
        'status'     => 'boolean',
        'mini_stats' => 'array',   // auto encode/decode JSON
    ];

    // ── Accessor ─────────────────────────────────────────────

    public function getImageUrlAttribute(): ?string
    {
        return $this->image_path
            ? Storage::url($this->image_path)
            : null;
    }

    // ── Single record helper ──────────────────────────────────

    /**
     * Always returns the one active about record.
     * If none exists returns null — blade handles gracefully.
     */
    public static function getActive(): ?self
    {
        return static::where('status', 1)->latest()->first();
    }
}
