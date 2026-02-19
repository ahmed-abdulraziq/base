<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = [
            [
                'doctor_id' => 1,
                'name' => 'سارة أحمد',
                'phone' => '01045678901',
                'email' => 'sara.ahmed@clinic.com',
                'job_title' => 'مسؤول استقبال',
                'salary' => 3500.00,
                'hire_date' => '2022-01-10',
                'approved_at' => now(),
            ],
            [
                'doctor_id' => 2,
                'name' => 'خالد عبدالله',
                'phone' => '01056789012',
                'email' => 'khaled.abdullah@clinic.com',
                'job_title' => 'محاسب',
                'salary' => 5000.00,
                'hire_date' => '2021-05-15',
                'approved_at' => now(),
            ],
            [
                'doctor_id' => 1,
                'name' => 'منى إبراهيم',
                'phone' => '01067890123',
                'email' => 'mona.ibrahim@clinic.com',
                'job_title' => 'ممرضة',
                'salary' => 4000.00,
                'hire_date' => '2022-03-01',
                'approved_at' => now(),
            ],
        ];

        foreach ($employees as $employee) {
            Employee::create($employee);
        }
    }
}
