<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('subcategory_id')->nullable();
                
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('short_description')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('subtitle2')->nullable();
            $table->string('features_headings')->nullable();
            $table->longText('features_short_description')->nullable();
            $table->string('benefits_headings')->nullable();
            $table->longText('benefits_short_description')->nullable();
            $table->string('essentials_headings')->nullable();
            $table->longText('essentials_short_description')->nullable();
            $table->longText('description')->nullable();
            $table->string('image')->nullable();
            $table->json('gallery')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
                
            $table->foreign('category_id')
                  ->references('id')->on('service_categories')
                  ->onDelete('cascade');
                
            $table->foreign('subcategory_id')
                  ->references('id')->on('service_subcategories')
                  ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
