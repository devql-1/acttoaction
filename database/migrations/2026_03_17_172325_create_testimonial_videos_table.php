<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     * Creates the testimonial_videos table for YouTube testimonials.
     * Each video belongs to a page_category, so different pages can show
     * their own unique set of videos.
     */
    public function up(): void
    {
        Schema::create('page_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g. "Home", "About Us", "Acting Course"
            $table->string('slug')->unique(); // e.g. "home", "about-us", "acting-course"
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('testimonial_videos', function (Blueprint $table) {
            $table->id();

            // ── Page category (which page this video belongs to) ──
            $table->foreignId('page_category_id')->constrained('page_categories')->onDelete('cascade');

            // ── Video identity ──
            $table->string('youtube_video_id', 20); // e.g. "jnAlL91guDI"
            $table->string('title');
            $table->text('description')->nullable();

            // ── Category / filter tab ──
            // Used for the tab pills: "parent" | "student" | custom
            $table->string('video_category', 50)->default('parent');
            // e.g. "Parent Feedback" | "Student Journey"
            $table->string('video_category_label', 100)->nullable();

            // ── Meta ──
            $table->string('duration', 10)->nullable(); // e.g. "2:30"
            $table->string('thumbnail_url')->nullable(); // override auto thumbnail
            $table->string('channel_name')->default('Act to Action');
            $table->string('watch_url')->nullable(); // direct youtu.be link override

            // ── Display control ──
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);

            $table->timestamps();
            $table->softDeletes();

            // Indexes for frequent queries
            $table->index(['page_category_id', 'is_active', 'sort_order']);
            $table->index('video_category');
            $table->index('youtube_video_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('testimonial_videos');
        Schema::dropIfExists('page_categories');
    }
};
