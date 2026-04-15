<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('summer_partner_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('slug', 100)->unique();
            $table->unsignedTinyInteger('sort_order')->default(0);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });

        // Seed the 4 default categories
        DB::table('summer_partner_categories')->insert([
            ['name' => 'Co-host',           'slug' => 'co-host',            'sort_order' => 1, 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Supported By',      'slug' => 'supported-by',       'sort_order' => 2, 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Knowledge Partner', 'slug' => 'knowledge-partner',  'sort_order' => 3, 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Gold State Partner','slug' => 'gold-state-partner', 'sort_order' => 4, 'status' => 1, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('summer_partner_categories');
    }
};
