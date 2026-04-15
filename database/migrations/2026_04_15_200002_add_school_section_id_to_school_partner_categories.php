<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('school_partner_categories', function (Blueprint $table) {
            $table->foreignId('school_section_id')
                  ->nullable()
                  ->after('id')
                  ->constrained('school_sections')
                  ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('school_partner_categories', function (Blueprint $table) {
            $table->dropForeignIdFor(\App\Models\SchoolSection::class, 'school_section_id');
            $table->dropColumn('school_section_id');
        });
    }
};
