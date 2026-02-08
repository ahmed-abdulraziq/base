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
                'first_name' => 'علي',
                'last_name' => 'محمود',
                'date_of_birth' => '1990-05-20',
                'gender' => 'ذكر',
                'phone' => '01078901234',
                'email' => 'ali.mahmoud@email.com',
                'address' => 'القاهرة، مصر الجديدة',
                'blood_type' => 'A+',
                'emergency_contact_name' => 'نور محمود',
                'emergency_contact_phone' => '01089012345',
            ],
            [
                'first_name' => 'نور',
                'last_name' => 'خالد',
                'date_of_birth' => '1985-08-15',
                'gender' => 'أنثى',
                'phone' => '01090123456',
                'email' => 'nour.khaled@email.com',
                'address' => 'الجيزة، المهندسين',
                'blood_type' => 'O+',
                'emergency_contact_name' => 'خالد أحمد',
                'emergency_contact_phone' => '01001234567',
            ],
            [
                'first_name' => 'محمد',
                'last_name' => 'سعيد',
                'date_of_birth' => '2015-12-10',
                'gender' => 'ذكر',
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
