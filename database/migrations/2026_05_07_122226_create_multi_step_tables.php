<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        // Step 1: Personal Info
        Schema::create('user_personal_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->timestamps();
        });

        // Step 2: Address
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('address');
            $table->string('city');
            $table->string('postal_code');
            $table->timestamps();
        });

        // Step 3: Education
        Schema::create('user_educations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('degree');
            $table->string('institution');
            $table->string('graduation_year');
            $table->string('cgpa');
            $table->timestamps();
        });

        // Step 4: Experience
        Schema::create('user_experiences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('job_title');
            $table->string('company');
            $table->string('years_experience');
            $table->timestamps();
        });

        // Step 5: Documents
        Schema::create('user_documents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('id_proof_path')->nullable();
            $table->string('transcript_path')->nullable();
            $table->string('id_metadata')->nullable();
            $table->string('transcript_metadata')->nullable();
            $table->timestamps();
        });

        // Step 6: Preferences
        Schema::create('user_preferences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('program');
            $table->string('study_mode');
            $table->string('campus');
            $table->timestamps();
        });

        // Step 8: Final Submissions
        Schema::create('user_submissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->boolean('declaration')->default(false);
            $table->timestamp('submitted_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_submissions');
        Schema::dropIfExists('user_preferences');
        Schema::dropIfExists('user_documents');
        Schema::dropIfExists('user_experiences');
        Schema::dropIfExists('user_educations');
        Schema::dropIfExists('user_addresses');
        Schema::dropIfExists('user_personal_infos');
    }
};
