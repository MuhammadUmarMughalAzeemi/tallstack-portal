<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        if (Schema::hasTable('portal_settings') && ! Schema::hasColumn('portal_settings', 'allow_multiple_programs')) {
            Schema::table('portal_settings', function (Blueprint $table) {
                $table->boolean('allow_multiple_programs')->default(false);
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('portal_settings') && Schema::hasColumn('portal_settings', 'allow_multiple_programs')) {
            Schema::table('portal_settings', function (Blueprint $table) {
                $table->dropColumn('allow_multiple_programs');
            });
        }
    }
};
