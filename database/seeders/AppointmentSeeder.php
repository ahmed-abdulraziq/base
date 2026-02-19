<?php

namespace Database\Seeders;

use App\Models\Appointment;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $appointments = [
            [
                'patient_id' => 1,
                'doctor_id' => 1,
                'appointment_date' => now()->addDays(2)->format('Y-m-d'),
                'appointment_time' => '10:00:00',
                'status' => 'booked',
                'reason' => 'كشف دوري',
                'created_by' => 1,
            ],
            [
                'patient_id' => 2,
                'doctor_id' => 2,
                'appointment_date' => now()->addDays(1),
                'appointment_time' => '11:30:00',
                'status' => 'confirmed',
                'reason' => 'أعراض برد',
                'created_by' => 1,
            ],
            [
                'patient_id' => 3,
                'doctor_id' => 1,
                'appointment_date' => now()->format('Y-m-d'),
                'appointment_time' => '09:00:00',
                'status' => 'completed',
                'reason' => 'كشف أطفال',
                'created_by' => 1,
            ],
        ];

        foreach ($appointments as $appointment) {
            Appointment::create($appointment);
        }
    }
}
