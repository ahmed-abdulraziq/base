<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocaleMiddleware
{
    /**
     * Available locales in the application
     */
    private array $availableLocales;

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $this->availableLocales = array_keys(config('localization.available_locales', []));
        
        $locale = $this->determineLocale($request);
        
        if ($locale && $this->isValidLocale($locale)) {
            App::setLocale($locale);
            
            if (config('localization.storage.session', true)) {
                Session::put('locale', $locale);
            }
        }

        return $next($request);
    }

    /**
     * Determine the locale from various sources
     */
    private function determineLocale(Request $request): ?string
    {
        // 1️⃣ Check query parameter first (highest priority)
        if ($request->has('lang')) {
            return $request->query('lang');
        }

        // 2️⃣ Check session
        if (Session::has('locale')) {
            return Session::get('locale');
        }

        // 3️⃣ Check Accept-Language header
        $acceptLanguage = $request->header('Accept-Language');
        if ($acceptLanguage) {
            return $this->parseAcceptLanguage($acceptLanguage);
        }

        // 4️⃣ Check user's preferred locale (if authenticated)
        if ($request->user() && $request->user()->locale) {
            return $request->user()->locale;
        }

        // 5️⃣ Use default locale from config
        return config('localization.default_locale', config('app.locale', 'ar'));
    }

    /**
     * Parse Accept-Language header to get preferred locale
     */
    private function parseAcceptLanguage(string $acceptLanguage): ?string
    {
        $locales = [];
        
        // Parse the Accept-Language header
        foreach (explode(',', $acceptLanguage) as $locale) {
            $parts = explode(';', trim($locale));
            $localeCode = trim($parts[0]);
            $quality = 1.0;
            
            if (isset($parts[1]) && strpos($parts[1], 'q=') === 0) {
                $quality = (float) substr($parts[1], 2);
            }
            
            $locales[$localeCode] = $quality;
        }
        
        // Sort by quality (highest first)
        arsort($locales);
        
        // Find the first supported locale
        foreach (array_keys($locales) as $locale) {
            // Handle full locale codes like 'en-US' -> 'en'
            $shortLocale = substr($locale, 0, 2);
            
            if ($this->isValidLocale($shortLocale)) {
                return $shortLocale;
            }
        }
        
        return null;
    }

    /**
     * Check if the locale is valid and supported
     */
    private function isValidLocale(string $locale): bool
    {
        return in_array($locale, $this->availableLocales);
    }
}
