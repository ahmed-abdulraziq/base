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
            $table->increments('appointment_id');
            $table->unsignedInteger('patient_id');
            $table->unsignedInteger('doctor_id');
            $table->date('appointment_date');
            $table->time('appointment_time');
            $table->enum('status', ['محجوز', 'مؤكد', 'منتهي', 'ملغي'])->default('محجوز');
            $table->text('reason')->nullable();
            $table->text('notes')->nullable();
            $table->unsignedInteger('created_by')->nullable();
            $table->timestamps();

            $table->foreign('patient_id')
                ->references('patient_id')
                ->on('patients')
                ->cascadeOnDelete();
            $table->foreign('doctor_id')
                ->references('doctor_id')
                ->on('doctors')
                ->cascadeOnDelete();
            $table->foreign('created_by')
                ->references('employee_id')
                ->on('employees')
                ->nullOnDelete();

            $table->index('appointment_date');
            $table->index('doctor_id');
            $table->index('patient_id');
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
