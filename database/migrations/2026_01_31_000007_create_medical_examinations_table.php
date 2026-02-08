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
        Schema::create('medical_examinations', function (Blueprint $table) {
            $table->increments('examination_id');
            $table->unsignedInteger('appointment_id');
            $table->unsignedInteger('patient_id');
            $table->unsignedInteger('doctor_id');
            $table->dateTime('examination_date');
            $table->text('symptoms')->nullable();
            $table->text('diagnosis')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('appointment_id')
                ->references('appointment_id')
                ->on('appointments')
                ->cascadeOnDelete();
            $table->foreign('patient_id')
                ->references('patient_id')
                ->on('patients')
                ->cascadeOnDelete();
            $table->foreign('doctor_id')
                ->references('doctor_id')
                ->on('doctors')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_examinations');
    }
};
