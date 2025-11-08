<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by Laravel's translation / localization methods. This option can be
    | set to any locale for which you plan to have translation strings.
    |
    */

    'default_locale' => env('APP_LOCALE', 'ar'),

    'fallback_locale' => env('APP_FALLBACK_LOCALE', 'ar'),

    /*
    |--------------------------------------------------------------------------
    | Available Locales
    |--------------------------------------------------------------------------
    |
    | List all locales that your application supports.
    |
    */

    'available_locales' => [
        'ar' => [
            'name' => 'العربية',
            'native' => 'العربية',
            'flag' => '🇸🇦',
            'direction' => 'rtl',
            'date_format' => 'Y-m-d',
            'time_format' => 'H:i:s',
            'datetime_format' => 'Y-m-d H:i:s',
        ],
        'en' => [
            'name' => 'English',
            'native' => 'English',
            'flag' => '🇺🇸',
            'direction' => 'ltr',
            'date_format' => 'm/d/Y',
            'time_format' => 'h:i:s A',
            'datetime_format' => 'm/d/Y h:i:s A',
        ],
        'es' => [
            'name' => 'Español',
            'native' => 'Español',
            'flag' => '🇪🇸',
            'direction' => 'ltr',
            'date_format' => 'd/m/Y',
            'time_format' => 'H:i:s',
            'datetime_format' => 'd/m/Y H:i:s',
        ],
        'fr' => [
            'name' => 'Français',
            'native' => 'Français',
            'flag' => '🇫🇷',
            'direction' => 'ltr',
            'date_format' => 'd/m/Y',
            'time_format' => 'H:i:s',
            'datetime_format' => 'd/m/Y H:i:s',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Locale Detection Methods
    |--------------------------------------------------------------------------
    |
    | Define the order of locale detection methods. The middleware will try
    | these methods in order until it finds a valid locale.
    |
    */

    'detection_methods' => [
        'query',      // ?lang=en
        'session',    // Stored in session
        'header',     // Accept-Language header
        'user',       // User's preferred locale
        'config',     // Default from config
    ],

    /*
    |--------------------------------------------------------------------------
    | Locale Storage
    |--------------------------------------------------------------------------
    |
    | Define how the selected locale should be stored.
    |
    */

    'storage' => [
        'session' => true,    // Store in session
        'cookie' => false,    // Store in cookie (not implemented yet)
        'database' => false,  // Store in user table (not implemented yet)
    ],

    /*
    |--------------------------------------------------------------------------
    | Translation Settings
    |--------------------------------------------------------------------------
    |
    */

    'translation' => [
        'auto_discover' => true,           // Auto-discover missing translations
        'cache_translations' => true,      // Cache translations for performance
        'cache_key' => 'translations',     // Cache key prefix
        'cache_ttl' => 3600,              // Cache time to live (seconds)
    ],

    /*
    |--------------------------------------------------------------------------
    | RTL Support
    |--------------------------------------------------------------------------
    |
    | Enable right-to-left language support.
    |
    */

    'rtl_support' => true,

    /*
    |--------------------------------------------------------------------------
    | Locale Switching
    |--------------------------------------------------------------------------
    |
    | Allow users to switch between locales.
    |
    */

    'allow_switching' => true,

    /*
    |--------------------------------------------------------------------------
    | Locale Routes
    |--------------------------------------------------------------------------
    |
    | Define locale-specific routes (not implemented yet).
    |
    */

    'routes' => [
        'enabled' => false,
        'prefix' => '{locale}',
        'middleware' => ['web', 'locale'],
    ],
];

