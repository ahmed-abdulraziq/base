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
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->increments('prescription_id');
            $table->unsignedInteger('examination_id');
            $table->unsignedInteger('patient_id');
            $table->unsignedInteger('doctor_id');
            $table->dateTime('prescription_date');
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('examination_id')
                ->references('examination_id')
                ->on('medical_examinations')
                ->cascadeOnDelete();
            $table->foreign('patient_id')
                ->references('patient_id')
                ->on('patients')
                ->cascadeOnDelete();
            $table->foreign('doctor_id')
                ->references('doctor_id')
                ->on('doctors')
                ->cascadeOnDelete();

            $table->index('patient_id');
            $table->index('doctor_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescriptions');
    }
};
