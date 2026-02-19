<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ClinicDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds for clinic tables.
     */
    public function run(): void
    {
        $this->call([
            PrescriptionOptionSettingSeeder::class,
            SpecializationSeeder::class,
            DoctorSeeder::class,
            EmployeeSeeder::class,
            PatientSeeder::class,
            MedicationSeeder::class,
            AppointmentSeeder::class,
            MedicalExaminationSeeder::class,
            PrescriptionSeeder::class,
        ]);
    }
}
