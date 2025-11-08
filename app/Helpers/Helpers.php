<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Helpers\LocalizationHelper;

if (!function_exists('generate_uuid')) {
    function generate_uuid(): string
    {
        return (string) Str::uuid();
    }
}

if (!function_exists('is_api_request')) {
    function is_api_request(): bool
    {
        return request()->is('api/*');
    }
}

if (!function_exists('success_message')) {
    function success_message($message): array
    {
        return [
            'status'  => true,
            'message' => $message,
        ];
    }
}

if (!function_exists('error_message')) {
    function error_message($message): array
    {
        return [
            'status'  => false,
            'message' => $message,
        ];
    }
}

// ==================== Validation Helpers ====================

if (!function_exists('is_valid_email')) {
    function is_valid_email($email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }
}

if (!function_exists('is_valid_phone')) {
    function is_valid_phone($phone): bool
    {
        return preg_match('/^[0-9+\-\s\(\)]+$/', $phone);
    }
}

if (!function_exists('is_valid_url')) {
    function is_valid_url($url): bool
    {
        return filter_var($url, FILTER_VALIDATE_URL) !== false;
    }
}

if (!function_exists('is_strong_password')) {
    function is_strong_password($password): bool
    {
        return strlen($password) >= 8 && 
               preg_match('/[A-Z]/', $password) && 
               preg_match('/[a-z]/', $password) && 
               preg_match('/[0-9]/', $password);
    }
}

// ==================== File Helpers ====================

if (!function_exists('upload_file')) {
    function upload_file($file, $path = 'uploads', $disk = 'public'): ?string
    {
        if (!$file || !$file->isValid()) {
            return null;
        }

        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $filePath = $file->storeAs($path, $filename, $disk);
        
        return $filePath;
    }
}

if (!function_exists('delete_file')) {
    function delete_file($filePath, $disk = 'public'): bool
    {
        if (!$filePath) {
            return false;
        }

        return Storage::disk($disk)->delete($filePath);
    }
}

if (!function_exists('get_file_url')) {
    function get_file_url($filePath, $disk = 'public'): ?string
    {
        if (!$filePath) {
            return null;
        }

        if ($disk === 'public') {
            return asset('storage/' . $filePath);
        }

        // For other disks, try to get URL or return the path
        try {
            $diskInstance = Storage::disk($disk);
            if (method_exists($diskInstance, 'url')) {
                return $diskInstance->url($filePath);
            }
            return $filePath;
        } catch (\Exception $e) {
            return $filePath;
        }
    }
}

// ==================== String Helpers ====================

if (!function_exists('slugify')) {
    function slugify($text): string
    {
        return \Illuminate\Support\Str::slug($text);
    }
}

if (!function_exists('truncate_text')) {
    function truncate_text($text, $length = 100, $suffix = '...'): string
    {
        return \Illuminate\Support\Str::limit($text, $length, $suffix);
    }
}

if (!function_exists('mask_email')) {
    function mask_email($email): string
    {
        $parts = explode('@', $email);
        if (count($parts) !== 2) {
            return $email;
        }

        $username = $parts[0];
        $domain = $parts[1];
        
        if (strlen($username) <= 2) {
            return $email;
        }

        $maskedUsername = substr($username, 0, 2) . str_repeat('*', strlen($username) - 2);
        return $maskedUsername . '@' . $domain;
    }
}

if (!function_exists('mask_phone')) {
    function mask_phone($phone): string
    {
        if (strlen($phone) <= 4) {
            return $phone;
        }

        return substr($phone, 0, 3) . str_repeat('*', strlen($phone) - 6) . substr($phone, -3);
    }
}

// ==================== Date Helpers ====================

if (!function_exists('format_date')) {
    function format_date($date, $format = 'Y-m-d H:i:s'): string
    {
        if (!$date) {
            return '';
        }

        if (is_string($date)) {
            $date = \Carbon\Carbon::parse($date);
        }

        return $date->format($format);
    }
}

if (!function_exists('time_ago')) {
    function time_ago($date): string
    {
        if (!$date) {
            return '';
        }

        if (is_string($date)) {
            $date = \Carbon\Carbon::parse($date);
        }

        return $date->diffForHumans();
    }
}

if (!function_exists('is_today')) {
    function is_today($date): bool
    {
        if (!$date) {
            return false;
        }

        if (is_string($date)) {
            $date = \Carbon\Carbon::parse($date);
        }

        return $date->isToday();
    }
}

// ==================== Array Helpers ====================

if (!function_exists('array_to_string')) {
    function array_to_string($array, $separator = ', '): string
    {
        if (!is_array($array)) {
            return '';
        }

        return implode($separator, $array);
    }
}

if (!function_exists('pluck_array')) {
    function pluck_array($array, $key): array
    {
        if (!is_array($array)) {
            return [];
        }

        return array_column($array, $key);
    }
}

if (!function_exists('array_has_keys')) {
    function array_has_keys($array, $keys): bool
    {
        if (!is_array($array) || !is_array($keys)) {
            return false;
        }

        return count(array_intersect_key(array_flip($keys), $array)) === count($keys);
    }
}

// ==================== Response Helpers ====================

if (!function_exists('api_response')) {
    function api_response($data = null, $message = '', $status = true, $code = 200): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status'  => $status,
            'message' => $message,
            'data'    => $data,
        ], $code);
    }
}

if (!function_exists('paginated_response')) {
    function paginated_response($data, $message = 'Data retrieved successfully'): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status'  => true,
            'message' => $message,
            'data'    => $data->items(),
            'pagination' => [
                'current_page' => $data->currentPage(),
                'last_page'    => $data->lastPage(),
                'per_page'     => $data->perPage(),
                'total'        => $data->total(),
                'from'         => $data->firstItem(),
                'to'           => $data->lastItem(),
            ],
        ]);
    }
}

// ==================== Security Helpers ====================

if (!function_exists('generate_random_string')) {
    function generate_random_string($length = 10): string
    {
        return \Illuminate\Support\Str::random($length);
    }
}

if (!function_exists('hash_password')) {
    function hash_password($password): string
    {
        return Hash::make($password);
    }
}

if (!function_exists('verify_password')) {
    function verify_password($password, $hash): bool
    {
        return Hash::check($password, $hash);
    }
}

// ==================== Utility Helpers ====================

if (!function_exists('get_client_ip')) {
    function get_client_ip(): string
    {
        $ipKeys = ['HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'REMOTE_ADDR'];
        
        foreach ($ipKeys as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip);
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                        return $ip;
                    }
                }
            }
        }
        
        return request()->ip();
    }
}

if (!function_exists('get_user_agent')) {
    function get_user_agent(): string
    {
        return request()->userAgent() ?? '';
    }
}

if (!function_exists('is_mobile')) {
    function is_mobile(): bool
    {
        $userAgent = get_user_agent();
        return preg_match('/Mobile|Android|iPhone|iPad/', $userAgent);
    }
}

// ==================== Localization Helpers ====================

if (!function_exists('get_current_locale')) {
    function get_current_locale(): string
    {
        return LocalizationHelper::getCurrentLocale();
    }
}

if (!function_exists('get_locale_name')) {
    function get_locale_name(string $locale = null): string
    {
        return LocalizationHelper::getLocaleName($locale);
    }
}

if (!function_exists('get_locale_flag')) {
    function get_locale_flag(string $locale = null): string
    {
        return LocalizationHelper::getLocaleFlag($locale);
    }
}

if (!function_exists('is_rtl')) {
    function is_rtl(string $locale = null): bool
    {
        return LocalizationHelper::isRTL($locale);
    }
}

if (!function_exists('get_locale_direction')) {
    function get_locale_direction(string $locale = null): string
    {
        return LocalizationHelper::getLocaleDirection($locale);
    }
}

if (!function_exists('format_date_locale')) {
    function format_date_locale($date, string $locale = null): string
    {
        return LocalizationHelper::formatDate($date, $locale);
    }
}

if (!function_exists('format_time_locale')) {
    function format_time_locale($time, string $locale = null): string
    {
        return LocalizationHelper::formatTime($time, $locale);
    }
}

if (!function_exists('format_datetime_locale')) {
    function format_datetime_locale($datetime, string $locale = null): string
    {
        return LocalizationHelper::formatDateTime($datetime, $locale);
    }
}

if (!function_exists('get_available_locales')) {
    function get_available_locales(): array
    {
        return LocalizationHelper::getAvailableLocales();
    }
}

if (!function_exists('get_locale_switcher_data')) {
    function get_locale_switcher_data(): array
    {
        return LocalizationHelper::getLocaleSwitcherData();
    }
}

if (!function_exists('get_locale_url')) {
    function get_locale_url(string $locale): string
    {
        return LocalizationHelper::getLocaleUrl($locale);
    }
}

if (!function_exists('get_locale_class')) {
    function get_locale_class(string $locale = null): string
    {
        return LocalizationHelper::getLocaleClass($locale);
    }
}

if (!function_exists('get_locale_attributes')) {
    function get_locale_attributes(string $locale = null): array
    {
        return LocalizationHelper::getLocaleAttributes($locale);
    }
}

if (!function_exists('has_translation')) {
    function has_translation(string $key, string $locale = null): bool
    {
        return LocalizationHelper::hasTranslation($key, $locale);
    }
}

if (!function_exists('get_translations')) {
    function get_translations(string $key, array $replace = []): array
    {
        return LocalizationHelper::getTranslations($key, $replace);
    }
}

if (!function_exists('trans_choice_locale')) {
    function trans_choice_locale(string $key, int $number, array $replace = [], string $locale = null): string
    {
        $locale = $locale ?: get_current_locale();
        return trans_choice($key, $number, $replace, $locale);
    }
}

if (!function_exists('__t')) {
    function __t(string $key, array $replace = [], string $locale = null): string
    {
        $locale = $locale ?: get_current_locale();
        return __($key, $replace, $locale);
    }
}