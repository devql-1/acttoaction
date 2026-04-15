<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('enrollments', function (Blueprint $table) {
            $table->string('parent_phone', 20)->nullable()->change();
            $table->string('phone', 20)->change();
        });
    }

    public function down(): void
    {
        Schema::table('enrollments', function (Blueprint $table) {
            $table->string('parent_phone', 15)->nullable()->change();
            $table->string('phone', 15)->change();
        });
    }
};
