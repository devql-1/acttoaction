<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class GalleryImage extends Model
{
    use HasFactory;

    protected $table = 'gallery_images';

    protected $fillable = [
        'gallery_category_id',
        'image_path',
        'alt_text',
        'label',
        'size',
        'strip_row',
        'is_featured',
        'sort_order',
        'status',
    ];

    protected $casts = [
        'status'      => 'boolean',
        'is_featured' => 'boolean',
        'sort_order'  => 'integer',
        'strip_row'   => 'integer',
    ];

    // ── Relationships ────────────────────────────────────────

    public function category(): BelongsTo
    {
        return $this->belongsTo(GalleryCategory::class, 'gallery_category_id');
    }

    // ── Accessors ────────────────────────────────────────────

    public function getImageUrlAttribute(): string
    {
        $assetPrefix = $this->getPublicAssetPrefix();
        $normalized = ltrim($this->image_path ?? '', '/');
        
        if (!$this->image_path) {
            return '';
        }
        
        if (Str::startsWith($normalized, ['http://', 'https://', '//'])) {
            return $this->image_path;
        }
        
        if (Str::startsWith($normalized, ['public/', 'storage/', 'img/'])) {
            return asset($assetPrefix . $normalized);
        }
        
        return asset($assetPrefix . 'storage/' . $normalized);
    }

    protected function getPublicAssetPrefix(): string
    {
        $documentRoot = request()?->server('DOCUMENT_ROOT');
        $publicRoot = realpath(public_path());

        return $documentRoot && realpath($documentRoot) === $publicRoot ? '' : 'public/';
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

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', 1);
    }
}
