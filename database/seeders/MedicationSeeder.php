<?php

namespace Database\Seeders;

use App\Models\Medication;
use Illuminate\Database\Seeder;

class MedicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $medications = [
            [
                'medication_name' => 'أوجمنتين 1 جم',
                'generic_name' => 'أموكسيسيلين + حمض الكلافولانيك',
                'manufacturer' => 'GSK',
                'type' => 'مضاد حيوي',
                'unit' => 'قرص',
                'price' => 85.00,
            ],
            [
                'medication_name' => 'كونجستال',
                'generic_name' => 'باراسيتامول مركب',
                'manufacturer' => 'فاركو',
                'type' => 'مسكن وخافض حرارة',
                'unit' => 'قرص',
                'price' => 15.00,
            ],
            [
                'medication_name' => 'فنتولين',
                'generic_name' => 'سالبيوتامول',
                'manufacturer' => 'GSK',
                'type' => 'موسع شعبي',
                'unit' => 'بخاخ',
                'price' => 45.00,
            ],
        ];

        foreach ($medications as $medication) {
            Medication::create($medication);
        }
    }
}
