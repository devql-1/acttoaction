<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admission_full_forms', function (Blueprint $table) {
            $table->id();
            $table->string('school');
            $table->integer('fee')->nullable();
            $table->string('classname');
            $table->string('name');
            $table->string('father_name');
            $table->string('father_occupation');
            $table->string('mother_name');
            $table->string('mother_occupation');
            $table->string('gender');
            $table->string('category');
            $table->string('caste');
            $table->string('religion');
            $table->string('aadhar_card', 12);
            $table->string('mobile', 15);
            $table->string('email')->nullable();
            $table->date('dob_year');
            $table->string('place_birth');
            $table->text('address');
            $table->string('state');
            $table->string('district');
            $table->string('pin_code', 10);
            $table->string('residential')->nullable(); // NRI
            $table->string('physically')->nullable();
            $table->string('name_previous_school')->nullable();
            $table->string('medium_previous_school')->nullable();
            $table->string('income_parents')->nullable();
            $table->string('name_sibling')->nullable();
            $table->string('class_sibling')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('is_read')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admission_full_forms');
    }
};
