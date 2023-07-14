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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->integer('practitioner_id');
            $table->integer('patient_id');
            $table->string('practitioner_service_id')->nullable();
            $table->string('appointment_date');
            $table->string('start_time');
            $table->string('end_time')->nullable();
            $table->string('duration')->nullable();
            $table->string('reason');
            $table->string('notes')->nullable();
            $table->integer('canceled_by')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
