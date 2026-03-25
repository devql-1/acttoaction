<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ── 1. Age Groups ────────────────────────────────────
        Schema::create('workshop_age_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');              // e.g. "Ages 3-6", "Ages 7-10"
            $table->string('slug')->unique();    // e.g. "ages-3-6"  (used in URL/filter)
            $table->text('description')->nullable();
            $table->unsignedTinyInteger('sort_order')->default(0);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        // ── 2. Cities (belong to an age group) ──────────────
        Schema::create('workshop_cities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('age_group_id')
                  ->constrained('workshop_age_groups')
                  ->cascadeOnDelete();
            $table->string('name');              // e.g. "Jaipur", "Delhi"
            $table->unsignedTinyInteger('sort_order')->default(0);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });

        // ── 3. Schools (belong to a city + age group) ────────
        Schema::create('workshop_schools', function (Blueprint $table) {
            $table->id();
            $table->foreignId('city_id')
                  ->constrained('workshop_cities')
                  ->cascadeOnDelete();
            $table->foreignId('age_group_id')
                  ->constrained('workshop_age_groups')
                  ->cascadeOnDelete();
            $table->string('name');                    // school name
            $table->text('description')->nullable();   // short description
            $table->string('timings')->nullable();     // e.g. "10:00 AM - 12:00 PM"
            $table->string('registration_url')->nullable(); // link or WhatsApp
            $table->string('image_path')->nullable();  // school/venue photo
            $table->string('address')->nullable();
            $table->unsignedTinyInteger('sort_order')->default(0);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('workshop_schools');
        Schema::dropIfExists('workshop_cities');
        Schema::dropIfExists('workshop_age_groups');
    }
};
