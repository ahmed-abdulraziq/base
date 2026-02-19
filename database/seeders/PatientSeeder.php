<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $patients = [
            [
                'name' => 'علي محمود',
                'date_of_birth' => '1990-05-20',
                'gender' => 'male',
                'phone' => '01078901234',
                'email' => 'ali.mahmoud@email.com',
                'address' => 'القاهرة، مصر الجديدة',
                'blood_type' => 'A+',
                'emergency_contact_name' => 'نور محمود',
                'emergency_contact_phone' => '01089012345',
            ],
            [
                'name' => 'نور خالد',
                'date_of_birth' => '1985-08-15',
                'gender' => 'female',
                'phone' => '01090123456',
                'email' => 'nour.khaled@email.com',
                'address' => 'الجيزة، المهندسين',
                'blood_type' => 'O+',
                'emergency_contact_name' => 'خالد أحمد',
                'emergency_contact_phone' => '01001234567',
            ],
            [
                'name' => 'محمد سعيد',
                'date_of_birth' => '2015-12-10',
                'gender' => 'male',
                'phone' => '01012345670',
                'email' => 'parent@email.com',
                'address' => 'القاهرة، مدينة نصر',
                'blood_type' => 'B+',
                'emergency_contact_name' => 'سعيد محمد',
                'emergency_contact_phone' => '01023456781',
            ],
        ];

        foreach ($patients as $patient) {
            Patient::create($patient);
        }
    }
}
