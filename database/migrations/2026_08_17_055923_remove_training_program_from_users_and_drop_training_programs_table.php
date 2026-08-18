<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        // Drop training_program_id column from users table
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('training_program_id');
        });

        // Drop the training_programs table entirely
        Schema::dropIfExists('training_programs');
    }

    public function down(): void
    {
        // Recreate training_programs table
        Schema::create('training_programs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('program_name')->nullable();
            $table->timestamps();
        });

        // Restore training_program_id column on users
        Schema::table('users', function (Blueprint $table) {
            $table->string('training_program_id')->nullable()->after('pmdc_pnmc');
        });
    }
};
