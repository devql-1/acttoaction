<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stat extends Model
{
    use HasFactory;

    protected $table = 'stats';

    protected $fillable = [
        'icon',
        'value',
        'suffix',
        'label',
        'sort_order',
        'status',
    ];

    protected $casts = [
        'status'     => 'boolean',
        'sort_order' => 'integer',
    ];

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

    public static function getActive()
    {
        return static::active()->ordered()->get();
    }
}
