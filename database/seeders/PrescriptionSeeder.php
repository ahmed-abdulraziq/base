<?php

namespace Database\Seeders;

use App\Models\Prescription;
use Illuminate\Database\Seeder;

class PrescriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prescriptions = [
            [
                'examination_id' => 1,
                'patient_id' => 1,
                'doctor_id' => 1,
                'prescription_date' => now()->addDays(2)->setTime(10, 30),
                'notes' => 'تناول الأدوية بعد الأكل',
                'details' => [
                    [
                        'medication_id' => 1,
                        'dosage' => '1 جم',
                        'frequency' => '3 مرات يومياً',
                        'duration' => '7 أيام',
                        'instructions' => 'بعد كل وجبة',
                    ],
                    [
                        'medication_id' => 2,
                        'dosage' => '2 قرص',
                        'frequency' => '3 مرات يومياً',
                        'duration' => '5 أيام',
                        'instructions' => 'مسكن للألم',
                    ],
                ],
            ],
            [
                'examination_id' => 2,
                'patient_id' => 2,
                'doctor_id' => 2,
                'prescription_date' => now()->addDays(1)->setTime(12, 0),
                'notes' => 'راحة تامة وشرب سوائل',
                'details' => [
                    [
                        'medication_id' => 2,
                        'dosage' => '2 قرص',
                        'frequency' => 'كل 6 ساعات',
                        'duration' => '3 أيام',
                        'instructions' => 'مسكن وخافض للحرارة',
                    ],
                    [
                        'medication_id' => 3,
                        'dosage' => 'بخختان',
                        'frequency' => 'عند الحاجة',
                        'duration' => 'أسبوع',
                        'instructions' => 'في حال ضيق التنفس',
                    ],
                ],
            ],
            [
                'examination_id' => 3,
                'patient_id' => 3,
                'doctor_id' => 1,
                'prescription_date' => now()->setTime(9, 30),
                'notes' => 'للطفل - مراقبة درجة الحرارة',
                'details' => [
                    [
                        'medication_id' => 2,
                        'dosage' => 'نصف قرص',
                        'frequency' => 'كل 8 ساعات',
                        'duration' => '3 أيام',
                        'instructions' => 'حسب وزن الطفل',
                    ],
                ],
            ],
        ];

        foreach ($prescriptions as $data) {
            $details = $data['details'];
            unset($data['details']);

            $prescription = Prescription::create($data);

            foreach ($details as $detail) {
                $prescription->details()->create($detail);
            }
        }
    }
}
