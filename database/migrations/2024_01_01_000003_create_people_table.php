<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->enum('section', ['mentor', 'speaker', 'guest', 'faculty']);
            $table->string('name');
            $table->string('role_badge');          // e.g. "Chief Mentor", "Keynote", "Drama Lead"
            $table->string('designation');         // e.g. "Deputy Chief Minister, Rajasthan"
            $table->text('bio')->nullable();       // short paragraph shown on card
            $table->string('photo_path');          // stored image path
            $table->string('instagram_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('press_url')->nullable();  // e.g. Dainik Bhaskar link
            $table->string('press_label')->nullable(); // e.g. "Dainik Bhaskar"
            $table->unsignedTinyInteger('sort_order')->default(0);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('people');
    }
};
