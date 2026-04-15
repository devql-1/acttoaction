<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('workshop_schools', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('name');
        });

        DB::table('workshop_schools')->orderBy('id')->each(function ($row) {
            $base = Str::slug($row->name) ?: 'workshop';
            $slug = $base;
            $count = 1;
            while (DB::table('workshop_schools')->where('slug', $slug)->where('id', '!=', $row->id)->exists()) {
                $slug = $base . '-' . $count++;
            }
            DB::table('workshop_schools')->where('id', $row->id)->update(['slug' => $slug]);
        });

        Schema::table('workshop_schools', function (Blueprint $table) {
            $table->string('slug')->nullable(false)->unique()->change();
        });
    }

    public function down(): void
    {
        Schema::table('workshop_schools', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
