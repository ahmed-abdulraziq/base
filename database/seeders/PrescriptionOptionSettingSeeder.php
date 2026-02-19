<?php

namespace Database\Seeders;

use App\Models\PrescriptionOptionSetting;
use Illuminate\Database\Seeder;

class PrescriptionOptionSettingSeeder extends Seeder
{
    public function run(): void
    {
        $defaults = [
            'dosage' => [
                '250 مجم', '500 مجم', '1 جم', 'نصف قرص', 'قرص', 'قرصين', '3 أقراص',
                'ملعقة صغيرة', 'ملعقة كبيرة', 'بخختان', '3 بخخات', 'نقطة', '5 نقط', '10 مل', 'ملعقة شراب',
            ],
            'frequency' => [
                'مرة يومياً', 'مرتين يومياً', '3 مرات يومياً', '4 مرات يومياً',
                'كل 6 ساعات', 'كل 8 ساعات', 'كل 12 ساعة', 'عند الحاجة',
                'صباحاً ومساءً', 'قبل النوم', 'بعد الأكل', 'قبل الأكل', 'على معدة فارغة',
            ],
            'duration' => [
                '3 أيام', '5 أيام', '7 أيام', 'أسبوع', 'أسبوعين', '10 أيام', 'شهر',
                'حسب الحاجة', 'حتى نفاد الدواء', '5-7 أيام', 'أسبوع إلى أسبوعين',
            ],
        ];

        foreach ($defaults as $type => $values) {
            foreach ($values as $i => $value) {
                PrescriptionOptionSetting::firstOrCreate(
                    ['type' => $type, 'value' => $value],
                    ['sort_order' => $i]
                );
            }
        }
    }
}
