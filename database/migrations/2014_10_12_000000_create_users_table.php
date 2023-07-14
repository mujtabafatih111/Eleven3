<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('email_verified')->default(false);
            $table->string('password');
            $table->date('dob')->nullable();
            $table->string('gender')->nullable();
            $table->string('picture')->nullable();
            $table->string('phone')->nullable();
            $table->string('phone_verification_code')->nullable();
            $table->boolean('phone_verified')->default(false);
            $table->string('address')->nullable();
            $table->string('country_code')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('city')->nullable();
            $table->string('zip_code')->nullable();
            $table->boolean('featured')->default(0);
            $table->string('state_issued_id_number',50)->nullable();
            $table->string('professional_license_numbers',50)->nullable();
            $table->string('professional_associations')->nullable();
            $table->unsignedSmallInteger('category_id')->nullable(); 
            $table->string('remote_service_offerings')->nullable();
            $table->string('on_demand_service_offerings')->nullable();
            $table->string('appointment_cancellation_policy')->nullable();
            $table->string('status');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
