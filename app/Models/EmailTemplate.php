<?php
// app/Models/EmailTemplate.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailTemplate extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'subject',
        'body',
        'category',
        'variables', // ← add this
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'variables' => 'array', // ← add this
    ];

    /* Find active template by slug */
    public static function findBySlug(string $slug): ?self
    {
        return static::where('slug', $slug)->where('is_active', true)->first();
    }

    /* Replace [variable] with real values */
    public function render(array $variables = []): array
    {
        $subject = $this->subject;
        $body = html_entity_decode($this->body, ENT_QUOTES, 'UTF-8');

        // Any *_section variable whose placeholder is missing from the body
        // gets appended automatically. Lets controllers inject conditional
        // HTML blocks (e.g. merchandise) without forcing the CKEditor template
        // to be re-edited every time a new block is added.
        foreach ($variables as $key => $value) {
            if (str_ends_with($key, '_section')
                && !empty($value)
                && !str_contains($body, '[' . $key . ']')) {
                $body .= $value;
            }
        }

        foreach ($variables as $key => $value) {
            $subject = str_replace('[' . $key . ']', $value, $subject);
            $body = str_replace('[' . $key . ']', $value, $body);
        }

        return [
            'subject' => $subject,
            'body' => $body,
        ];
    }
}
