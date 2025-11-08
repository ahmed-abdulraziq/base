<?php

namespace App\Helpers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class LocalizationHelper
{
    /**
     * Get all available locales
     */
    public static function getAvailableLocales(): array
    {
        return config('localization.available_locales', []);
    }

    /**
     * Get current locale
     */
    public static function getCurrentLocale(): string
    {
        return App::getLocale();
    }

    /**
     * Get locale information
     */
    public static function getLocaleInfo(string $locale = null): ?array
    {
        $locale = $locale ?: self::getCurrentLocale();
        $locales = self::getAvailableLocales();
        
        return $locales[$locale] ?? null;
    }

    /**
     * Get locale name
     */
    public static function getLocaleName(string $locale = null): string
    {
        $info = self::getLocaleInfo($locale);
        return $info['name'] ?? $locale;
    }

    /**
     * Get locale native name
     */
    public static function getLocaleNativeName(string $locale = null): string
    {
        $info = self::getLocaleInfo($locale);
        return $info['native'] ?? $locale;
    }

    /**
     * Get locale flag
     */
    public static function getLocaleFlag(string $locale = null): string
    {
        $info = self::getLocaleInfo($locale);
        return $info['flag'] ?? '🌐';
    }

    /**
     * Get locale direction (ltr/rtl)
     */
    public static function getLocaleDirection(string $locale = null): string
    {
        $info = self::getLocaleInfo($locale);
        return $info['direction'] ?? 'ltr';
    }

    /**
     * Check if locale is RTL
     */
    public static function isRTL(string $locale = null): bool
    {
        return self::getLocaleDirection($locale) === 'rtl';
    }

    /**
     * Get locale date format
     */
    public static function getDateFormat(string $locale = null): string
    {
        $info = self::getLocaleInfo($locale);
        return $info['date_format'] ?? 'Y-m-d';
    }

    /**
     * Get locale time format
     */
    public static function getTimeFormat(string $locale = null): string
    {
        $info = self::getLocaleInfo($locale);
        return $info['time_format'] ?? 'H:i:s';
    }

    /**
     * Get locale datetime format
     */
    public static function getDateTimeFormat(string $locale = null): string
    {
        $info = self::getLocaleInfo($locale);
        return $info['datetime_format'] ?? 'Y-m-d H:i:s';
    }

    /**
     * Format date according to locale
     */
    public static function formatDate($date, string $locale = null): string
    {
        $locale = $locale ?: self::getCurrentLocale();
        $format = self::getDateFormat($locale);
        
        if (is_string($date)) {
            $date = new \DateTime($date);
        }
        
        return $date->format($format);
    }

    /**
     * Format time according to locale
     */
    public static function formatTime($time, string $locale = null): string
    {
        $locale = $locale ?: self::getCurrentLocale();
        $format = self::getTimeFormat($locale);
        
        if (is_string($time)) {
            $time = new \DateTime($time);
        }
        
        return $time->format($format);
    }

    /**
     * Format datetime according to locale
     */
    public static function formatDateTime($datetime, string $locale = null): string
    {
        $locale = $locale ?: self::getCurrentLocale();
        $format = self::getDateTimeFormat($locale);
        
        if (is_string($datetime)) {
            $datetime = new \DateTime($datetime);
        }
        
        return $datetime->format($format);
    }

    /**
     * Get all translations for a specific key
     */
    public static function getTranslations(string $key, array $replace = []): array
    {
        $translations = [];
        $locales = self::getAvailableLocales();
        
        foreach (array_keys($locales) as $locale) {
            $translations[$locale] = __($key, $replace, $locale);
        }
        
        return $translations;
    }

    /**
     * Check if translation exists
     */
    public static function hasTranslation(string $key, string $locale = null): bool
    {
        $locale = $locale ?: self::getCurrentLocale();
        $translation = __($key, [], $locale);
        
        return $translation !== $key;
    }

    /**
     * Get missing translations
     */
    public static function getMissingTranslations(string $locale = null): array
    {
        $locale = $locale ?: self::getCurrentLocale();
        $missing = [];
        
        // Get all translation files
        $translationPath = resource_path("lang/{$locale}");
        
        if (!File::exists($translationPath)) {
            return $missing;
        }
        
        $files = File::allFiles($translationPath);
        
        foreach ($files as $file) {
            $filename = $file->getFilenameWithoutExtension();
            $translations = include $file->getPathname();
            
            if (is_array($translations)) {
                $missing = array_merge($missing, self::findMissingKeys($translations, $filename));
            }
        }
        
        return $missing;
    }

    /**
     * Find missing translation keys recursively
     */
    private static function findMissingKeys(array $translations, string $prefix = ''): array
    {
        $missing = [];
        
        foreach ($translations as $key => $value) {
            $fullKey = $prefix ? "{$prefix}.{$key}" : $key;
            
            if (is_array($value)) {
                $missing = array_merge($missing, self::findMissingKeys($value, $fullKey));
            } elseif (empty($value) || $value === $fullKey) {
                $missing[] = $fullKey;
            }
        }
        
        return $missing;
    }

    /**
     * Get locale switcher data
     */
    public static function getLocaleSwitcherData(): array
    {
        $currentLocale = self::getCurrentLocale();
        $locales = self::getAvailableLocales();
        $switcherData = [];
        
        foreach ($locales as $code => $info) {
            $switcherData[] = [
                'code' => $code,
                'name' => $info['name'],
                'native' => $info['native'],
                'flag' => $info['flag'],
                'direction' => $info['direction'],
                'is_current' => $code === $currentLocale,
                'url' => self::getLocaleUrl($code),
            ];
        }
        
        return $switcherData;
    }

    /**
     * Get URL for locale switching
     */
    public static function getLocaleUrl(string $locale): string
    {
        $currentUrl = request()->url();
        $queryParams = request()->query();
        $queryParams['lang'] = $locale;
        
        return $currentUrl . '?' . http_build_query($queryParams);
    }

    /**
     * Get HTML attributes for locale
     */
    public static function getLocaleAttributes(string $locale = null): array
    {
        $locale = $locale ?: self::getCurrentLocale();
        $info = self::getLocaleInfo($locale);
        
        return [
            'lang' => $locale,
            'dir' => $info['direction'] ?? 'ltr',
            'class' => 'locale-' . $locale . ' direction-' . ($info['direction'] ?? 'ltr'),
        ];
    }

    /**
     * Get locale-specific CSS class
     */
    public static function getLocaleClass(string $locale = null): string
    {
        $locale = $locale ?: self::getCurrentLocale();
        $direction = self::getLocaleDirection($locale);
        
        return "locale-{$locale} direction-{$direction}";
    }

    /**
     * Cache translations for performance
     */
    public static function cacheTranslations(string $locale = null): void
    {
        $locale = $locale ?: self::getCurrentLocale();
        $cacheKey = config('localization.translation.cache_key', 'translations') . ":{$locale}";
        
        if (config('localization.translation.cache_translations', true)) {
            $translations = [];
            $translationPath = resource_path("lang/{$locale}");
            
            if (File::exists($translationPath)) {
                $files = File::allFiles($translationPath);
                
                foreach ($files as $file) {
                    $filename = $file->getFilenameWithoutExtension();
                    $translations[$filename] = include $file->getPathname();
                }
            }
            
            Cache::put($cacheKey, $translations, config('localization.translation.cache_ttl', 3600));
        }
    }

    /**
     * Clear translation cache
     */
    public static function clearTranslationCache(string $locale = null): void
    {
        if ($locale) {
            $cacheKey = config('localization.translation.cache_key', 'translations') . ":{$locale}";
            Cache::forget($cacheKey);
        } else {
            $locales = self::getAvailableLocales();
            foreach (array_keys($locales) as $localeCode) {
                $cacheKey = config('localization.translation.cache_key', 'translations') . ":{$localeCode}";
                Cache::forget($cacheKey);
            }
        }
    }
}

