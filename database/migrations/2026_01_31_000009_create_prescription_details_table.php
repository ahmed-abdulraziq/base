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
        Schema::create('prescription_details', function (Blueprint $table) {
            $table->increments('detail_id');
            $table->unsignedInteger('prescription_id');
            $table->unsignedInteger('medication_id');
            $table->string('dosage', 100);
            $table->string('frequency', 100);
            $table->string('duration', 50);
            $table->text('instructions')->nullable();
            $table->timestamps();

            $table->foreign('prescription_id')
                ->references('prescription_id')
                ->on('prescriptions')
                ->cascadeOnDelete();
            $table->foreign('medication_id')
                ->references('medication_id')
                ->on('medications')
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prescription_details');
    }
};
