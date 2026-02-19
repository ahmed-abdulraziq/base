<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class PrescriptionOptionSetting extends Model
{
    protected $fillable = ['type', 'value', 'sort_order'];

    public const TYPES = ['dosage', 'frequency', 'duration'];

    /**
     * Get options for a given type, ordered by sort_order.
     */
    public static function getOptions(string $type): array
    {
        $cacheKey = "prescription_options_{$type}";

        return Cache::remember($cacheKey, 3600, function () use ($type) {
            return static::where('type', $type)
                ->orderBy('sort_order')
                ->orderBy('value')
                ->pluck('value')
                ->values()
                ->toArray();
        });
    }

    /**
     * Get all options grouped by type.
     */
    public static function getAllOptions(): array
    {
        return [
            'dosage' => static::getOptions('dosage'),
            'frequency' => static::getOptions('frequency'),
            'duration' => static::getOptions('duration'),
        ];
    }

    /**
     * Clear cache when model is saved or deleted.
     */
    protected static function booted(): void
    {
        static::saved(fn () => static::clearCache());
        static::deleted(fn () => static::clearCache());
    }

    public static function clearCache(): void
    {
        foreach (self::TYPES as $type) {
            Cache::forget("prescription_options_{$type}");
        }
    }
}
