<?php

/**
 * أمثلة على استخدام نظام الترجمة
 * Localization System Usage Examples
 */

// ==================== Basic Usage ====================

// الحصول على اللغة الحالية
$currentLocale = get_current_locale();
echo "Current locale: {$currentLocale}\n";

// الحصول على اسم اللغة
$localeName = get_locale_name('ar');
echo "Arabic name: {$localeName}\n";

// الحصول على علم اللغة
$flag = get_locale_flag('ar');
echo "Arabic flag: {$flag}\n";

// التحقق من اتجاه اللغة
$isRTL = is_rtl('ar');
echo "Is Arabic RTL: " . ($isRTL ? 'Yes' : 'No') . "\n";

// ==================== Date/Time Formatting ====================

$date = new DateTime('2024-01-15 14:30:00');

// تنسيق التاريخ حسب اللغة
$arabicDate = format_date_locale($date, 'ar');
echo "Arabic date: {$arabicDate}\n";

$englishDate = format_date_locale($date, 'en');
echo "English date: {$englishDate}\n";

// تنسيق الوقت حسب اللغة
$arabicTime = format_time_locale($date, 'ar');
echo "Arabic time: {$arabicTime}\n";

$englishTime = format_time_locale($date, 'en');
echo "English time: {$englishTime}\n";

// ==================== Translation Functions ====================

// التحقق من وجود ترجمة
$hasTranslation = has_translation('welcome.message');
echo "Has welcome message: " . ($hasTranslation ? 'Yes' : 'No') . "\n";

// الحصول على جميع الترجمات لمفتاح معين
$translations = get_translations('welcome.message');
echo "All translations for welcome.message:\n";
foreach ($translations as $locale => $translation) {
    echo "  {$locale}: {$translation}\n";
}

// ==================== Locale Information ====================

// الحصول على جميع اللغات المتاحة
$availableLocales = get_available_locales();
echo "Available locales:\n";
foreach ($availableLocales as $code => $info) {
    echo "  {$code}: {$info['name']} ({$info['flag']}) - {$info['direction']}\n";
}

// الحصول على بيانات مبدل اللغات
$switcherData = get_locale_switcher_data();
echo "Locale switcher data:\n";
foreach ($switcherData as $locale) {
    $current = $locale['is_current'] ? ' (current)' : '';
    echo "  {$locale['code']}: {$locale['name']} {$locale['flag']}{$current}\n";
}

// ==================== URL Generation ====================

// إنشاء رابط للتبديل إلى لغة معينة
$englishUrl = get_locale_url('en');
echo "Switch to English: {$englishUrl}\n";

$arabicUrl = get_locale_url('ar');
echo "Switch to Arabic: {$arabicUrl}\n";

// ==================== CSS Classes and Attributes ====================

// الحصول على CSS class للغة
$localeClass = get_locale_class('ar');
echo "Arabic CSS class: {$localeClass}\n";

// الحصول على HTML attributes للغة
$attributes = get_locale_attributes('ar');
echo "Arabic HTML attributes:\n";
foreach ($attributes as $key => $value) {
    echo "  {$key}=\"{$value}\"\n";
}

// ==================== Advanced Usage ====================

use App\Helpers\LocalizationHelper;

// الحصول على معلومات مفصلة عن اللغة
$localeInfo = LocalizationHelper::getLocaleInfo('ar');
echo "Arabic locale info:\n";
foreach ($localeInfo as $key => $value) {
    echo "  {$key}: {$value}\n";
}

// التحقق من الترجمات المفقودة
$missingTranslations = LocalizationHelper::getMissingTranslations('ar');
echo "Missing Arabic translations: " . count($missingTranslations) . "\n";

// تخزين الترجمات في الكاش
LocalizationHelper::cacheTranslations('ar');
echo "Cached Arabic translations\n";

// مسح كاش الترجمات
LocalizationHelper::clearTranslationCache('ar');
echo "Cleared Arabic translation cache\n";

// ==================== Blade Template Examples ====================

/*
في Blade templates:

{{-- إضافة attributes للغة --}}
<html {!! implode(' ', array_map(function($key, $value) {
    return $key . '="' . $value . '"';
}, array_keys(get_locale_attributes()), get_locale_attributes())) !!}>

{{-- تنسيق التاريخ --}}
<p>{{ format_date_locale($post->created_at) }}</p>

{{-- مبدل اللغات --}}
<x-locale-switcher />

{{-- التحقق من اتجاه اللغة --}}
@if(is_rtl())
    <div class="rtl-styles">
        {{-- محتوى RTL --}}
    </div>
@else
    <div class="ltr-styles">
        {{-- محتوى LTR --}}
    </div>
@endif

{{-- استخدام الترجمة مع locale محدد --}}
<p>{{ __t('welcome.message', [], 'ar') }}</p>

{{-- استخدام trans_choice مع locale محدد --}}
<p>{{ trans_choice_locale('items', $count, [], 'ar') }}</p>
*/

// ==================== JavaScript Integration ====================

/*
في JavaScript:

// الحصول على اللغة الحالية
const currentLocale = '{{ get_current_locale() }}';

// التحقق من اتجاه اللغة
const isRTL = {{ is_rtl() ? 'true' : 'false' }};

// تطبيق CSS class
document.body.className = '{{ get_locale_class() }}';

// إضافة HTML attributes
const attributes = @json(get_locale_attributes());
Object.keys(attributes).forEach(key => {
    document.documentElement.setAttribute(key, attributes[key]);
});
*/

// ==================== Artisan Commands ====================

/*
تشغيل الأوامر:

# عرض جميع اللغات المتاحة
php artisan localization list

# تخزين الترجمات في الكاش
php artisan localization cache

# مسح كاش الترجمات
php artisan localization clear

# عرض الترجمات المفقودة
php artisan localization missing

# العمل مع لغة محددة
php artisan localization cache --locale=ar
php artisan localization missing --locale=en
*/

echo "\n=== Localization System Examples Completed ===\n";







