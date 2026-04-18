<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('event_registrations')) {
            return;
        }

        if (!Schema::hasColumn('event_registrations', 'razorpay_order_id')) {
            Schema::table('event_registrations', function (Blueprint $table) {
                $table->string('razorpay_order_id')->nullable()->after('status');
                $table->index('razorpay_order_id', 'event_registrations_razorpay_order_id_index');
            });
        }
    }

    public function down(): void
    {
        if (!Schema::hasTable('event_registrations')) {
            return;
        }

        Schema::table('event_registrations', function (Blueprint $table) {
            $table->dropIndex('event_registrations_razorpay_order_id_index');
            $table->dropColumn('razorpay_order_id');
        });
    }
};
