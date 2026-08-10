<?php

use App\Enums\Status\Status;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('plain_password')->nullable();
            $table->string('pmdc_pnmc')->nullable();
            $table->string('training_program_id')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('branch_code')->nullable();
            $table->string('branch_name')->nullable();
            $table->integer('challan_id')->nullable();
            $table->boolean('is_paid')->default(false);
            $table->integer('amount')->nullable();
            $table->integer('challan_amount')->nullable();
            $table->string('transaction_id')->nullable();
            $table->text('cnic_passport')->nullable();
            $table->bigInteger('cnic_passport_id')->nullable();
            $table->foreignId('program_id')->nullable();
            $table->integer('program_priority')->nullable();
            $table->integer('affirmation')->nullable();
            $table->boolean('accepted_terms_and_conditions')->default(false);
            $table->integer('status')->default(Status::REJECTED);
            $table->decimal('aggregate', 8, 4)->nullable();
            $table->decimal('aggregate_overseas', 8, 4)->nullable();
            $table->text('comments')->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->integer('foreigner')->nullable();
            $table->integer('is_completed')->default(0);
            $table->integer('is_completed_email')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
