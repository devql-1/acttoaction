<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Person extends Model
{
    use HasFactory;

    protected $table = 'people';

    protected $fillable = ['section', 'name', 'role_badge', 'designation', 'bio', 'photo_path', 'instagram_url', 'youtube_url', 'press_url', 'press_label', 'sort_order', 'status'];

    protected $casts = [
        'status' => 'boolean',
        'sort_order' => 'integer',
    ];

    // ── Section constants ────────────────────────────────────

    const SECTIONS = [
        'mentor' => 'Mentors',
        'speaker' => 'Speakers',
        'guest' => 'Guests',
        'faculty' => 'Faculty',
    ];

    // ── Accessor ─────────────────────────────────────────────

    public function getPhotoUrlAttribute(): string
    {
        return Storage::url($this->photo_path);
    }

    // ── Scopes ───────────────────────────────────────────────

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeSection($query, string $section)
    {
        return $query->where('section', $section);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('id');
    }

    // ── Static helpers (used in HomeController) ──────────────

    public static function getBySection(): array
    {
        $all = static::active()->ordered()->get();

        return [
            'mentors' => $all->where('section', 'mentor')->values(),
            'speakers' => $all->where('section', 'speaker')->values(),
            'guests' => $all->where('section', 'guest')->values(),
            'faculty' => $all->where('section', 'faculty')->values(),
        ];
    }
}
