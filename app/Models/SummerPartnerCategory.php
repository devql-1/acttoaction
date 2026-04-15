<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class SummerPartnerCategory extends Model
{
    use HasFactory;

    protected $table = 'summer_partner_categories';

    protected $fillable = ['name', 'slug', 'sort_order', 'status'];

    protected $casts = [
        'status'     => 'boolean',
        'sort_order' => 'integer',
    ];

    // ── Auto-generate slug from name ─────────────────────────

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($cat) {
            if (empty($cat->slug)) {
                $cat->slug = Str::slug($cat->name);
            }
        });
    }

    // ── Relationships ────────────────────────────────────────

    public function partners()
    {
        return $this->hasMany(SummerPartner::class, 'category', 'slug');
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

    // ── Static helpers ───────────────────────────────────────

    public static function getActive()
    {
        return static::active()->ordered()->get();
    }

    public static function slugList(): array
    {
        return static::active()->ordered()->pluck('slug')->toArray();
    }
}
