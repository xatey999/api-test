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
        Schema::create('appointment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id');
            $table->foreign('patient_id')->references('id')->on('patient')->onDelete('cascade');
            $table->foreignId('doctor_id');
            $table->foreign('doctor_id')->references('id')->on('doctor')->onDelete('cascade');
            $table->date('appointment_date');
            $table->time('appointment_time');
            $table->text('appointment_reason');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointment');
    }
};
