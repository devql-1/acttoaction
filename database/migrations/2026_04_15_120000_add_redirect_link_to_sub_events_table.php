<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('sub_events', function (Blueprint $table) {
            $table->string('redirect_link')->nullable()->after('banner_image');
        });
    }

    public function down(): void
    {
        Schema::table('sub_events', function (Blueprint $table) {
            $table->dropColumn('redirect_link');
        });
    }
};
