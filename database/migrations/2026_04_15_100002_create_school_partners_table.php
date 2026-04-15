<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('school_partners', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('school_partner_categories')->cascadeOnDelete();
            $table->string('name', 150);
            $table->string('logo_path')->nullable(); // storage path or full URL for dummy data
            $table->string('website_url', 255)->nullable();
            $table->unsignedTinyInteger('sort_order')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('school_partners');
    }
};
