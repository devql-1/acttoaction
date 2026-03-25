<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('workshop_registrations', function (Blueprint $table) {
            $table->id();

            // --- Booking context ---
            $table->foreignId('workshop_school_id')->constrained('workshop_schools')->cascadeOnDelete();
            $table->foreignId('age_group_id')->constrained('workshop_age_groups')->cascadeOnDelete();
            $table->foreignId('city_id')->constrained('workshop_cities')->cascadeOnDelete();

            // --- Participant ---
            $table->string('participant_name');
            $table->string('participant_email');
            $table->string('participant_phone', 20);
            $table->string('school_name')->nullable();          // school the child attends
            $table->string('grade')->nullable();
            $table->date('dob')->nullable();

            // --- Parent / Guardian ---
            $table->string('parent_name')->nullable();
            $table->string('parent_phone', 20)->nullable();

            // --- Booking ---
            $table->unsignedSmallInteger('tickets')->default(1);
            $table->decimal('amount_per_ticket', 10, 2)->default(0);
            $table->decimal('total_amount', 10, 2)->default(0);

            // --- Status ---
            $table->enum('status', ['pending', 'confirmed', 'failed', 'cancelled'])->default('pending');

            // --- Razorpay ---
            $table->string('razorpay_order_id')->nullable()->index();
            $table->string('razorpay_payment_id')->nullable()->index();
            $table->string('razorpay_signature')->nullable();

            // --- Meta ---
            $table->string('coupon_code')->nullable();
            $table->text('notes')->nullable();
            $table->ipAddress('ip_address')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('workshop_registrations');
    }
};
