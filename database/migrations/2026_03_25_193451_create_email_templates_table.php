<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('email_templates', function (Blueprint $table) {
            $table->id();

            $table->string('name'); // Template name
            $table->string('slug')->unique(); // unique identifier

            $table->string('subject'); // Email subject
            $table->longText('body'); // Email HTML body

            $table->string('category')->nullable(); // optional grouping
            $table->json('variables')->nullable(); // store variables like ["name","email"]

            $table->boolean('is_active')->default(true); // enable/disable template

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_templates');
    }
};
