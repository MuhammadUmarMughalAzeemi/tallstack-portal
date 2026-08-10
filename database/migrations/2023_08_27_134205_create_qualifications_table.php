<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('qualifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index()->constrained()->onDelete('cascade');
            $table->string('ssc_science_subjects', 200)->nullable();
            $table->string('ssc_passing_year', 200)->nullable();
            $table->integer('ssc_marks_obtained')->nullable();
            $table->integer('ssc_total_marks')->nullable();
            $table->string('hssc_science_subjects', 200)->nullable();
            $table->string('hssc_passing_year', 200)->nullable();
            $table->integer('hssc_marks_obtained')->nullable();
            $table->integer('hssc_total_marks')->nullable();
            $table->foreignId('ssc_board_id')->nullable();
            $table->foreignId('ssc_exam_passeds_id')->nullable();
            $table->foreignId('hssc_exam_passeds_id')->nullable();
            $table->foreignId('hssc_board_id')->nullable();
            $table->foreignId('ssc_institution_id')->nullable();
            $table->foreignId('hssc_institution_id')->nullable();

            $table->string('mbbs_science_subjects', 200)->nullable();
            $table->string('mbbs_passing_year', 200)->nullable();
            $table->string('mbbs_marks_obtained', 200)->nullable();
            $table->string('mbbs_total_marks', 200)->nullable();
            $table->string('mbbs_board_id', 200)->nullable();
            $table->foreignId('mbbs_exam_passeds_id')->nullable();
            $table->foreignId('mbbs_institution_id')->nullable();

            $table->string('mphil_science_subjects', 200)->nullable();
            $table->string('mphil_passing_year', 200)->nullable();
            $table->string('mphil_marks_obtained', 200)->nullable();
            $table->string('mphil_total_marks', 200)->nullable();
            $table->string('mphil_board_id', 200)->nullable();
            $table->string('mphil_exam_passeds_id', 200)->nullable();
            $table->foreignId('mphil_institution_id')->nullable();
            $table->boolean('is_experience')->default(false);
            $table->text('experiences')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('qualifications');
    }
};
