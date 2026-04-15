<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('course_categories', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('name');
        });

        // Populate slugs for existing rows
        DB::table('course_categories')->orderBy('id')->each(function ($row) {
            $base = Str::slug($row->name);
            $slug = $base ?: 'category';
            $count = 1;
            while (DB::table('course_categories')->where('slug', $slug)->where('id', '!=', $row->id)->exists()) {
                $slug = $base . '-' . $count++;
            }
            DB::table('course_categories')->where('id', $row->id)->update(['slug' => $slug]);
        });

        Schema::table('course_categories', function (Blueprint $table) {
            $table->string('slug')->nullable(false)->unique()->change();
        });
    }

    public function down(): void
    {
        Schema::table('course_categories', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
