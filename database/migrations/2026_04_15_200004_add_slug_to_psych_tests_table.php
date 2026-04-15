<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('psych_tests', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('test_name');
        });

        DB::table('psych_tests')->orderBy('id')->each(function ($row) {
            $base = Str::slug($row->test_name);
            $slug = $base ?: 'test';
            $count = 1;
            while (DB::table('psych_tests')->where('slug', $slug)->where('id', '!=', $row->id)->exists()) {
                $slug = $base . '-' . $count++;
            }
            DB::table('psych_tests')->where('id', $row->id)->update(['slug' => $slug]);
        });

        Schema::table('psych_tests', function (Blueprint $table) {
            $table->string('slug')->nullable(false)->unique()->change();
        });
    }

    public function down(): void
    {
        Schema::table('psych_tests', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
