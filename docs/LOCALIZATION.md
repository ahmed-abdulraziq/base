# نظام الترجمة (Localization System)

## نظرة عامة

تم تطوير نظام ترجمة شامل ومتقدم لتطبيق Laravel يدعم عدة لغات مع ميزات متقدمة مثل:

- دعم اللغات من اليمين إلى اليسار (RTL)
- تبديل سلس بين اللغات
- تخزين تفضيلات اللغة
- تنسيق التواريخ والأوقات حسب اللغة
- أدوات إدارة الترجمة

## الميزات

### 1. اللغات المدعومة

- **العربية (ar)** - RTL
- **الإنجليزية (en)** - LTR  
- **الإسبانية (es)** - LTR
- **الفرنسية (fr)** - LTR

### 2. طرق اكتشاف اللغة

يتم اكتشاف اللغة بالترتيب التالي:

1. **Query Parameter** - `?lang=en`
2. **Session** - اللغة المحفوظة في الجلسة
3. **Accept-Language Header** - تفضيلات المتصفح
4. **User Preference** - تفضيلات المستخدم المسجل
5. **Default Config** - اللغة الافتراضية

### 3. Helper Functions

```php
// الحصول على اللغة الحالية
$currentLocale = get_current_locale();

// الحصول على اسم اللغة
$localeName = get_locale_name('ar'); // العربية

// الحصول على علم اللغة
$flag = get_locale_flag('ar'); // 🇸🇦

// التحقق من اتجاه اللغة
$isRTL = is_rtl('ar'); // true

// تنسيق التاريخ حسب اللغة
$formattedDate = format_date_locale(now(), 'ar');

// الحصول على جميع اللغات المتاحة
$locales = get_available_locales();

// التحقق من وجود ترجمة
$hasTranslation = has_translation('welcome.message');

// الحصول على جميع الترجمات لمفتاح معين
$translations = get_translations('welcome.message');
```

### 4. Blade Components

#### مبدل اللغات

```blade
{{-- مبدل بسيط --}}
<x-locale-switcher />

{{-- مبدل مع خيارات مخصصة --}}
<x-locale-switcher 
    :show-flags="true"
    :show-names="true"
    :show-native-names="false"
    :dropdown="true"
    class="my-custom-class" />
```

### 5. Artisan Commands

```bash
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
```

## الإعداد

### 1. ملف التكوين

تم إنشاء ملف `config/localization.php` يحتوي على جميع إعدادات الترجمة:

```php
return [
    'default_locale' => 'ar',
    'fallback_locale' => 'ar',
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
        // ... لغات أخرى
    ],
    // ... إعدادات أخرى
];
```

### 2. Middleware

تم تحسين `SetLocaleMiddleware` ليدعم:

- اكتشاف متقدم للغة
- دعم Accept-Language header
- تخزين في الجلسة
- دعم تفضيلات المستخدم

### 3. Helper Class

تم إنشاء `LocalizationHelper` class يحتوي على جميع الوظائف المتقدمة للترجمة.

## الاستخدام

### في Controllers

```php
use App\Helpers\LocalizationHelper;

class HomeController extends Controller
{
    public function index()
    {
        $currentLocale = LocalizationHelper::getCurrentLocale();
        $isRTL = LocalizationHelper::isRTL();
        
        return view('home', compact('currentLocale', 'isRTL'));
    }
}
```

### في Blade Templates

```blade
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
```

### في JavaScript

```javascript
// الحصول على اللغة الحالية
const currentLocale = '{{ get_current_locale() }}';

// التحقق من اتجاه اللغة
const isRTL = {{ is_rtl() ? 'true' : 'false' }};

// تطبيق CSS class
document.body.className = '{{ get_locale_class() }}';
```

## إضافة لغات جديدة

### 1. إضافة اللغة في التكوين

```php
// config/localization.php
'available_locales' => [
    // ... اللغات الموجودة
    'de' => [
        'name' => 'German',
        'native' => 'Deutsch',
        'flag' => '🇩🇪',
        'direction' => 'ltr',
        'date_format' => 'd.m.Y',
        'time_format' => 'H:i:s',
        'datetime_format' => 'd.m.Y H:i:s',
    ],
],
```

### 2. إنشاء ملفات الترجمة

```bash
# إنشاء مجلد اللغة
mkdir resources/lang/de

# نسخ ملفات الترجمة من لغة أخرى
cp resources/lang/en/* resources/lang/de/
```

### 3. تحديث Middleware

```php
// app/Http/Middleware/SetLocaleMiddleware.php
private array $availableLocales = ['en', 'ar', 'es', 'fr', 'de'];
```

## أفضل الممارسات

### 1. تنظيم ملفات الترجمة

```
resources/lang/
├── ar/
│   ├── auth.php
│   ├── validation.php
│   ├── messages.php
│   └── translate.php
├── en/
│   ├── auth.php
│   ├── validation.php
│   ├── messages.php
│   └── translate.php
└── ...
```

### 2. استخدام مفاتيح منظمة

```php
// جيد
'user.profile.updated' => 'تم تحديث الملف الشخصي بنجاح'

// سيء
'user_profile_updated_successfully' => 'تم تحديث الملف الشخصي بنجاح'
```

### 3. استخدام المتغيرات

```php
'welcome' => 'مرحباً :name، مرحباً بك في :app',
```

### 4. دعم الجمع

```php
'items' => '{0} لا توجد عناصر|{1} عنصر واحد|[2,*] :count عناصر',
```

## استكشاف الأخطاء

### 1. التحقق من وجود الترجمة

```php
if (!has_translation('welcome.message')) {
    // إضافة الترجمة المفقودة
}
```

### 2. عرض الترجمات المفقودة

```bash
php artisan localization missing
```

### 3. مسح الكاش

```bash
php artisan localization clear
```

## الأداء

### 1. تخزين الترجمات

```bash
# في الإنتاج
php artisan localization cache
```

### 2. تحسين الاستعلامات

```php
// استخدام الكاش
$translations = Cache::remember("translations.{$locale}", 3600, function() use ($locale) {
    return include resource_path("lang/{$locale}/messages.php");
});
```

## الأمان

### 1. التحقق من صحة اللغة

```php
// Middleware يتحقق من صحة اللغة تلقائياً
if (!$this->isValidLocale($locale)) {
    // استخدام اللغة الافتراضية
}
```

### 2. تنظيف المدخلات

```php
// تنظيف locale من query parameter
$locale = filter_var($request->query('lang'), FILTER_SANITIZE_STRING);
```

## الدعم

للمساعدة أو الإبلاغ عن مشاكل، يرجى:

1. التحقق من ملفات الترجمة
2. تشغيل `php artisan localization missing`
3. مسح الكاش: `php artisan localization clear`
4. التحقق من إعدادات `config/localization.php`

