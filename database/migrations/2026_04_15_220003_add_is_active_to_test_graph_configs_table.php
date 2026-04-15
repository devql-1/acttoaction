<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasTable('test_graph_configs')) {
            return;
        }

        if (!Schema::hasColumn('test_graph_configs', 'is_active')) {
            Schema::table('test_graph_configs', function (Blueprint $table) {
                $table->boolean('is_active')->default(true)->after('graph_type');
            });
        }
    }

    public function down(): void
    {
        if (!Schema::hasTable('test_graph_configs')) {
            return;
        }

        if (Schema::hasColumn('test_graph_configs', 'is_active')) {
            Schema::table('test_graph_configs', function (Blueprint $table) {
                $table->dropColumn('is_active');
            });
        }
    }
};
