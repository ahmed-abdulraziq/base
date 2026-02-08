<?php

namespace Database\Seeders;

use App\Models\Specialization;
use Illuminate\Database\Seeder;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $specializations = [
            ['specialization_name' => 'باطنة', 'description' => 'تخصص الأمراض الباطنية'],
            ['specialization_name' => 'أطفال', 'description' => 'تخصص طب الأطفال'],
            ['specialization_name' => 'عظام', 'description' => 'تخصص جراحة العظام'],
            ['specialization_name' => 'قلب', 'description' => 'تخصص أمراض القلب والأوعية الدموية'],
            ['specialization_name' => 'جلدية', 'description' => 'تخصص الأمراض الجلدية'],
            ['specialization_name' => 'أسنان', 'description' => 'تخصص طب الأسنان'],
            ['specialization_name' => 'عيون', 'description' => 'تخصص طب العيون'],
            ['specialization_name' => 'نساء وولادة', 'description' => 'تخصص النساء والتوليد'],
        ];

        foreach ($specializations as $specialization) {
            Specialization::create($specialization);
        }
    }
}
