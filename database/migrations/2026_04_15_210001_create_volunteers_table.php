<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('volunteers')) {
            Schema::create('volunteers', function (Blueprint $table) {
                $table->id();
                $table->string('first_name');
                $table->string('last_name');
                $table->string('email');
                $table->string('phone');
                $table->string('age')->nullable();
                $table->string('city')->nullable();
                $table->string('state')->nullable();
                $table->string('occupation')->nullable();
                $table->text('roles')->nullable();
                $table->string('availability')->nullable();
                $table->string('hear_about')->nullable();
                $table->text('motivation')->nullable();
                $table->text('experience')->nullable();
                $table->enum('status', ['pending', 'hired', 'rejected', 'cancelled'])->default('pending');
                $table->timestamps();
            });
        } else {
            // Table already exists — just add status if missing
            if (!Schema::hasColumn('volunteers', 'status')) {
                Schema::table('volunteers', function (Blueprint $table) {
                    $table->enum('status', ['pending', 'hired', 'rejected', 'cancelled'])->default('pending')->after('experience');
                });
            }
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('volunteers');
    }
};
