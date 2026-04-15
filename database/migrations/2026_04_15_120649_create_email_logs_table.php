<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('email_logs', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->index();           // template slug used
            $table->string('to_email');                // recipient email
            $table->string('subject')->nullable();     // rendered subject
            $table->enum('status', ['sent', 'failed'])->index();
            $table->text('error_message')->nullable(); // failure reason
            $table->json('variables')->nullable();     // variables passed (for debugging)
            $table->string('mailer')->nullable();      // smtp/log/etc
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('email_logs');
    }
};
