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
        Schema::create('doctors', function (Blueprint $table) {
            $table->increments('doctor_id');
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('phone', 20);
            $table->string('email', 100)->nullable()->unique();
            $table->unsignedInteger('specialization_id')->nullable();
            $table->string('license_number', 50)->unique();
            $table->unsignedInteger('years_of_experience')->nullable();
            $table->decimal('consultation_fee', 10, 2)->nullable();
            $table->date('hire_date');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('specialization_id')
                ->references('specialization_id')
                ->on('specializations')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
