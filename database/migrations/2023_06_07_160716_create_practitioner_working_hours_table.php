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
        Schema::create('practitioner_working_hours', function (Blueprint $table) {
            $table->id();
            $table->integer('practitioner_id');
            $table->integer('category_id')->nullable();
            $table->integer('sub_category_id')->nullable();
            $table->time('hour_start')->nullable();
            $table->time('hour_end')->nullable();
            $table->time('general_hour_start')->nullable();
            $table->time('general_hour_end')->nullable();
            $table->time('exceptional_hour_start')->nullable();
            $table->time('exceptional_hour_end')->nullable();
            $table->time('specific_service_hour_start')->nullable();
            $table->time('specific_service_hour_end')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('practitioner_working_hours');
    }
};
