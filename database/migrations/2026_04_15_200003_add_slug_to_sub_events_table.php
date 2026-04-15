<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('sub_events', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('title');
        });

        DB::table('sub_events')->orderBy('id')->each(function ($row) {
            $base = Str::slug($row->title);
            $slug = $base ?: 'sub-event';
            $count = 1;
            while (DB::table('sub_events')->where('slug', $slug)->where('id', '!=', $row->id)->exists()) {
                $slug = $base . '-' . $count++;
            }
            DB::table('sub_events')->where('id', $row->id)->update(['slug' => $slug]);
        });

        Schema::table('sub_events', function (Blueprint $table) {
            $table->string('slug')->nullable(false)->unique()->change();
        });
    }

    public function down(): void
    {
        Schema::table('sub_events', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
