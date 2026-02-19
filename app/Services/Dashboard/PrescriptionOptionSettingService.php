<?php

namespace App\Services\Dashboard;

use App\Models\PrescriptionOptionSetting;

class PrescriptionOptionSettingService
{
    public function getOptionsByType(): array
    {
        return [
            'dosage' => PrescriptionOptionSetting::where('type', 'dosage')->orderBy('sort_order')->orderBy('value')->get(),
            'frequency' => PrescriptionOptionSetting::where('type', 'frequency')->orderBy('sort_order')->orderBy('value')->get(),
            'duration' => PrescriptionOptionSetting::where('type', 'duration')->orderBy('sort_order')->orderBy('value')->get(),
        ];
    }

    public function addOption(string $type, string $value): PrescriptionOptionSetting
    {
        $maxOrder = PrescriptionOptionSetting::where('type', $type)->max('sort_order') ?? 0;
        return PrescriptionOptionSetting::firstOrCreate(
            [
                'type' => $type,
                'value' => trim($value),
            ],
            ['sort_order' => $maxOrder + 1]
        );
    }

    public function delete(PrescriptionOptionSetting $option): bool
    {
        return $option->delete();
    }
}
