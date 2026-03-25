<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ── Stats counter cards ──────────────────────────────
        Schema::create('stats', function (Blueprint $table) {
            $table->id();
            $table->string('icon');                  // bootstrap icon class e.g. bi-people-fill
            $table->string('value');                 // numeric value e.g. 500
            $table->string('suffix')->default('+');  // e.g. +  %  k  x
            $table->string('label');                 // e.g. "Kids Trained"
            $table->unsignedTinyInteger('sort_order')->default(0);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        // ── About section (single record) ────────────────────
        Schema::create('about_section', function (Blueprint $table) {
            $table->id();
            $table->string('heading');
            $table->text('lead_text')->nullable();
            $table->text('body_text')->nullable();
            $table->string('image_path')->nullable();
            $table->string('badge_year')->nullable();       // e.g. "2025"
            $table->string('badge_text')->nullable();       // e.g. "Summer Camp"
            $table->string('fc_title')->nullable();         // floating card title
            $table->string('fc_subtitle')->nullable();      // floating card subtitle
            $table->string('btn1_label')->nullable();       // e.g. "Call Us Now"
            $table->string('btn1_url')->nullable();         // e.g. "tel:9119118844"
            $table->string('btn2_label')->nullable();       // e.g. "WhatsApp"
            $table->string('btn2_url')->nullable();
            $table->json('mini_stats')->nullable();         // [{num,label},{num,label},{num,label}]
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about_section');
        Schema::dropIfExists('stats');
    }
};
