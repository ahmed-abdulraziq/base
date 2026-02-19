<?php

namespace Database\Seeders;

use App\Models\MedicalExamination;
use Illuminate\Database\Seeder;

class MedicalExaminationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $examinations = [
            [
                'appointment_id' => 1,
                'patient_id' => 1,
                'doctor_id' => 1,
                'examination_date' => now()->addDays(2)->setTime(10, 0),
                'symptoms' => 'ألم في البطن، غثيان',
                'diagnosis' => 'التهاب معدة',
                'notes' => 'إجراء تحليل براز',
            ],
            [
                'appointment_id' => 2,
                'patient_id' => 2,
                'doctor_id' => 2,
                'examination_date' => now()->addDays(1)->setTime(11, 30),
                'symptoms' => 'سخونة، سعال، رشح',
                'diagnosis' => 'نزلة برد',
                'notes' => 'راحة ومسكنات',
            ],
            [
                'appointment_id' => 3,
                'patient_id' => 3,
                'doctor_id' => 1,
                'examination_date' => now()->setTime(9, 0),
                'symptoms' => 'سخونة خفيفة',
                'diagnosis' => 'عدوى فيروسية بسيطة',
                'notes' => 'متابعة الحالة',
            ],
        ];

        foreach ($examinations as $examination) {
            MedicalExamination::create($examination);
        }
    }
}
