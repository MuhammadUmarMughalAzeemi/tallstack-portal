<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        if (Schema::hasTable('portal_settings') && ! Schema::hasColumn('portal_settings', 'admin_theme')) {
            Schema::table('portal_settings', function (Blueprint $table) {
                $table->string('admin_theme')->default('frost-sapphire')->after('active_theme');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('portal_settings') && Schema::hasColumn('portal_settings', 'admin_theme')) {
            Schema::table('portal_settings', function (Blueprint $table) {
                $table->dropColumn('admin_theme');
            });
        }
    }
};
