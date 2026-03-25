<?php
// database/migrations/2024_01_01_create_event_registrations_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::dropIfExists('event_registration_attendees');
        Schema::dropIfExists('event_registrations');

        // One booking = one order (may have many attendees)
        Schema::create('event_registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained('events')->onDelete('cascade');
            $table->foreignId('sub_event_id')->constrained('sub_events')->onDelete('cascade');
            $table->foreignId('center_id')->nullable()->constrained('centers')->nullOnDelete(); // chosen centre
            $table->string('city')->nullable(); // auto-filled from centre
            $table->string('state')->nullable(); // auto-filled from centre
            $table->unsignedInteger('tickets')->default(1);
            $table->decimal('total_amount', 10, 2)->default(0);
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
            $table->string('registration_number')->unique()->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index(['event_id', 'sub_event_id']);
        });

        // One row per attendee/ticket
        Schema::create('event_registration_attendees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('registration_id')->constrained('event_registrations')->onDelete('cascade');
            $table->unsignedInteger('ticket_number'); // 1, 2, 3…
            $table->boolean('is_primary')->default(false); // primary contact
            $table->string('name');
            $table->string('phone', 15)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('event_registration_attendees');
        Schema::dropIfExists('event_registrations');
    }
};
