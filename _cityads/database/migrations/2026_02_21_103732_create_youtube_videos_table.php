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
       Schema::create('youtube_videos', function (Blueprint $table) {
    $table->id();
    $table->foreignId('youtube_category_id')->constrained('youtube_categories')->onDelete('cascade');
    $table->string('name'); // youtube video name
    $table->string('youtube_id'); // only store video ID
    $table->timestamps();

});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('youtube_videos');
    }
};
