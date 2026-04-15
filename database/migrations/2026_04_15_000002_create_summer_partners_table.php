<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('summer_partners', function (Blueprint $table) {
            $table->id();
            $table->string('category', 60); // co-host, supported-by, knowledge-partner, gold-state-partner
            $table->string('name', 150);
            $table->string('logo_path');
            $table->string('website_url', 255)->nullable();
            $table->unsignedTinyInteger('sort_order')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('summer_partners');
    }
};
