<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('payments')) {
            return;
        }

        if (Schema::hasColumn('payments', 'razorpay_payment_id')) {
            Schema::table('payments', function (Blueprint $table) {
                $table->unique('razorpay_payment_id', 'payments_razorpay_payment_id_unique');
            });
        }
    }

    public function down(): void
    {
        if (!Schema::hasTable('payments')) {
            return;
        }

        Schema::table('payments', function (Blueprint $table) {
            $table->dropUnique('payments_razorpay_payment_id_unique');
        });
    }
};
