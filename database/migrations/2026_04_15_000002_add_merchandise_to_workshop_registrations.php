<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('workshop_registrations', function (Blueprint $table) {
            $table->json('merchandise_items')->nullable()->after('message');
            $table->decimal('merchandise_total', 10, 2)->default(0)->after('merchandise_items');
        });
    }

    public function down(): void
    {
        Schema::table('workshop_registrations', function (Blueprint $table) {
            $table->dropColumn(['merchandise_items', 'merchandise_total']);
        });
    }
};
