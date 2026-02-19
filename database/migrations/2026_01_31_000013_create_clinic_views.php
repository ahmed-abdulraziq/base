<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // عرض مواعيد اليوم
        DB::statement("
            CREATE OR REPLACE VIEW todays_appointments AS
            SELECT
                a.id AS appointment_id,
                p.name AS patient_name,
                d.name AS doctor_name,
                s.specialization_name,
                a.appointment_time,
                a.status,
                a.reason
            FROM appointments a
            JOIN patients p ON a.patient_id = p.id
            JOIN doctors d ON a.doctor_id = d.id
            JOIN specializations s ON d.specialization_id = s.id
            WHERE a.appointment_date = CURDATE()
            ORDER BY a.appointment_time
        ");

        // عرض معلومات الأطباء الكاملة
        DB::statement("
            CREATE OR REPLACE VIEW doctors_full_info AS
            SELECT
                d.id AS doctor_id,
                d.name AS doctor_name,
                d.phone,
                d.email,
                s.specialization_name,
                d.years_of_experience,
                d.consultation_fee,
                d.is_active
            FROM doctors d
            JOIN specializations s ON d.specialization_id = s.id
        ");

        // عرض الفواتير المعلقة
        DB::statement("
            CREATE OR REPLACE VIEW pending_invoices AS
            SELECT
                i.id AS invoice_id,
                p.name AS patient_name,
                i.invoice_date,
                i.total_amount,
                i.paid_amount,
                (i.total_amount - i.paid_amount) AS remaining_amount,
                i.payment_status
            FROM invoices i
            JOIN patients p ON i.patient_id = p.id
            WHERE i.payment_status != 'paid'
            ORDER BY i.invoice_date DESC
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS todays_appointments');
        DB::statement('DROP VIEW IF EXISTS doctors_full_info');
        DB::statement('DROP VIEW IF EXISTS pending_invoices');
    }
};
