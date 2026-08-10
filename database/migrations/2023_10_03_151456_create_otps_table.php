<?php

use App\Enums\Otp\OtpReasons;
use App\Enums\Otp\OtpTypes;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('o_t_p_s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index()->constrained()->onDelete('cascade');
            $table->bigInteger('otp_type_id')->default(OtpTypes::EMAIL);
            $table->bigInteger('otp_reason_id')->default(OtpReasons::EDITFORM);
            $table->string('value');
            $table->timestamp('used_at')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('o_t_p_s');
    }
};
