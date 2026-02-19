<?php

namespace Database\Seeders;

use App\Models\Doctor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doctors = [
            [
                'name' => 'أحمد محمد',
                'phone' => '01012345678',
                'email' => 'ahmed.mohamed@clinic.com',
                'password' => Hash::make('password'),
                'specialization_id' => 1,
                'license_number' => 'DOC001',
                'years_of_experience' => 15,
                'consultation_fee' => 200.00,
                'hire_date' => '2020-01-15',
                'approved_at' => now(),
            ],
            [
                'name' => 'فاطمة علي',
                'phone' => '01023456789',
                'email' => 'fatma.ali@clinic.com',
                'password' => Hash::make('password'),
                'specialization_id' => 2,
                'license_number' => 'DOC002',
                'years_of_experience' => 10,
                'consultation_fee' => 180.00,
                'hire_date' => '2021-03-20',
                'approved_at' => now(),
            ],
            [
                'name' => 'محمود حسن',
                'phone' => '01034567890',
                'email' => 'mahmoud.hassan@clinic.com',
                'password' => Hash::make('password'),
                'specialization_id' => 3,
                'license_number' => 'DOC003',
                'years_of_experience' => 12,
                'consultation_fee' => 250.00,
                'hire_date' => '2019-06-10',
                'approved_at' => now(),
            ],
        ];

        foreach ($doctors as $doctor) {
            Doctor::create($doctor);
        }
    }
}
