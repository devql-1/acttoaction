<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ── Gallery Categories (tabs) ─────────────────────────
        // e.g. "All", "Drama", "Dance", "Music", "Cyber AI Threat Conclave 2024"
        Schema::create('gallery_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');                              // tab label
            $table->string('slug')->unique();                    // auto-generated
            $table->unsignedTinyInteger('sort_order')->default(0);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        // ── Gallery Images ────────────────────────────────────
        Schema::create('gallery_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gallery_category_id')
                  ->constrained('gallery_categories')
                  ->cascadeOnDelete();
            $table->string('image_path');
            $table->string('alt_text')->nullable();
            $table->string('label')->nullable();                 // caption shown on hover
            // layout hint: sm | md | lg (for scroll strip sizing)
            $table->enum('size', ['sm', 'md', 'lg'])->default('md');
            // which row in the strip: 1 | 2 | 3
            $table->unsignedTinyInteger('strip_row')->default(1);
            $table->boolean('is_featured')->default(0);         // shows in featured grid
            $table->unsignedTinyInteger('sort_order')->default(0);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('gallery_images');
        Schema::dropIfExists('gallery_categories');
    }
};
