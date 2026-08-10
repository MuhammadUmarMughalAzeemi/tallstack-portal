<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    public function up(): void
    {
        Schema::create('personal_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->index()->constrained()->onDelete('cascade');
            $table->string('mother_name', 200);
            $table->date('date_of_birth');
            $table->string('mobile_number', 200);
            $table->string('telephone_number', 200)->nullable();
            $table->foreignId('gender_id')->nullable();
            $table->foreignId('residence_area_id')->nullable();
            $table->string('address', 500);
            $table->foreignId('district_id')->nullable();
            $table->foreignId('nationality_id')->nullable();
            $table->string('cnic_passport', 500)->nullable();
            $table->foreignId('cnic_passport_id')->nullable();
            $table->boolean('showInput')->default(0);
            $table->string('secondary_number', 200)->nullable();
            $table->string('city', 200);
            $table->string('country', 200);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('personal_details');
    }
};
