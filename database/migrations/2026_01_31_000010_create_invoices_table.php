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
        Schema::create('invoices', function (Blueprint $table) {
            $table->increments('invoice_id');
            $table->unsignedInteger('patient_id');
            $table->unsignedInteger('appointment_id')->nullable();
            $table->dateTime('invoice_date');
            $table->decimal('total_amount', 10, 2);
            $table->decimal('paid_amount', 10, 2)->default(0);
            $table->enum('payment_status', ['غير مدفوع', 'مدفوع جزئياً', 'مدفوع بالكامل'])->default('غير مدفوع');
            $table->enum('payment_method', ['نقدي', 'بطاقة', 'تحويل بنكي'])->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('patient_id')
                ->references('patient_id')
                ->on('patients')
                ->cascadeOnDelete();
            $table->foreign('appointment_id')
                ->references('appointment_id')
                ->on('appointments')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
