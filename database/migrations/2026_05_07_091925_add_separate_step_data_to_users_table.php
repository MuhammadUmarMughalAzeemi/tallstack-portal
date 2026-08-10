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
            $table->json('step1_data')->nullable();
            $table->json('step2_data')->nullable();
            $table->json('step3_data')->nullable();
            $table->json('step4_data')->nullable();
            $table->json('step5_data')->nullable();
            $table->json('step6_data')->nullable();
            $table->json('step7_data')->nullable();
            $table->json('step8_data')->nullable();
            $table->json('form_data')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'step1_data', 'step2_data', 'step3_data', 'step4_data',
                'step5_data', 'step6_data', 'step7_data', 'step8_data',
                'form_data'
            ]);
        });
    }
};
