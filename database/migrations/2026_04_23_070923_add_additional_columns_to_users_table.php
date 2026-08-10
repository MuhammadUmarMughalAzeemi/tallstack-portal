<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('step1_completed')->default(false)->after('password');
            $table->boolean('step2_completed')->default(false)->after('step1_completed');
            $table->boolean('step3_completed')->default(false)->after('step2_completed');
            $table->boolean('step4_completed')->default(false)->after('step3_completed');
            $table->boolean('step5_completed')->default(false)->after('step4_completed');
            $table->boolean('step6_completed')->default(false)->after('step5_completed');
            $table->boolean('step7_completed')->default(false)->after('step6_completed');
            $table->boolean('step8_completed')->default(false)->after('step7_completed');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'step1_completed',
                'step2_completed',
                'step3_completed',
                'step4_completed',
                'step5_completed',
                'step6_completed',
                'step7_completed',
                'step8_completed',
            ]);
        });
    }
};
