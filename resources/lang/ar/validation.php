<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
     */
    'alpha' => 'يجب ادخال :attribute حروف .',
    'alpha_dash' => 'يجب ادخال :attribute حروف , ارقام , - فقط .',
    'alpha_num' => 'يجب ادخال :attribute حروف وارقام فقط .',
    'between' => [
        'numeric' => ' يجب ادخال :attribute  بين :min and :max.',
        'file' => 'يجب ادخال :attributeبين :min and :max kilobytes.',
        'string' => 'يجب ادخال :attribute  بين :min and :max حروف .',
        'array' => 'يجب ادخال :attribute  بين :min and :max عنصر .',
    ],
    'confirmed' => ':attribute غير متطابقة .',
    'date' => 'صيغة :attribute غير صحيحة .',
    'email' => 'يجب ادخال :attribute صحيح ',
    'image' => 'يجب اختيار :attribute صحيح',

    'integer' => 'يجب ادخال  :attributeعدد صحيح .',
    'max' => [
        'numeric' => 'يجب ان لا يزيد :attribute  عن :max.',
        'file' => 'يجب ان لا يزيد :attribute مساحة الملف عن :max kilobytes.',
        'string' => 'يجب ان لا يزيد :attribute عدد الحروف عن :max .',
        'array' => 'يجب ان لا يزيد :attribute عدد القيم  عن :max .',
    ],
    'mimes' => 'يجب ادخال  :attribute الملف بصيغة :values. ',
    'mimetypes' => 'يجب ادخال  :attribute الملف بصيغة :values. ',
    'min' => [
        'numeric' => 'يجب ادخال :attribute قيمة على الاقل :min. ',
        'file' => 'يجب ادخال :attribute على الاقل :min kilobytes. ',
        'string' => 'يجب ادخال  :attribute  على الاقل :min حرف.',
        'array' => 'يجب ادخال :attribute عدد عناصر على الاقل :min عنصر.',
    ],
    'not_in' => ' المختارة غير صحيحة :attribute .',
    'numeric' => 'يجب ادخال :attribute قيمة عددية .',
    'regex' => 'يجب ادخال :attribute صيغة صحيحة .',
    'required' => 'يجب ادخال :attribute',
    'size' => [
        'numeric' => 'يجب ادخال :attribute  يساوى :size.',
        'file' => 'يجب ادخال :attribute  يساوي :size kilobytes.',
        'string' => 'يجب ادخال :attribute  كلمة تساوي :size .',
        'array' => 'يجب ادخال :attribute  العناصر يساوي  :size عنصر .',
    ],
    'string' => 'يجب ادخال :attribute قيمة string .',
    'unique' => 'تم استخدام :attribute من قبل .',

    'required_if' => 'يجب ادخال قيمة :attribute طبقا لاختيار :other-:value.',
    'required_without_all' => 'يجب اختيار حجم واحد علي الاقل" :attribute-:values "',
    'required_with' => ' يجب ان تدخل :attribute عندما تكون :values موجوده',

    'exists' => 'القيمة المدخلة ل :attributeغير صحيحة.',
    'lte'=>[
        'numeric' => 'يجب ان لا يزيد :attribute عن :value.',
        'file' => 'يجب ان لا يزيد :attribute عن :value kilobytes.',
        'string' => 'يجب ان لا يزيد :attribute عن :value characters.',
        'array' => 'يجب ان لا يزيد :attribute عن :value items.',
    ],
    'after'=>':attribute يجب ان يكون بعد تاريخ التوقيت الحالي.',


    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attrيجب ادخال قيمةibute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
     */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
        'images.*' => [
            'required' => 'يجب عليك رفع صورة واحدة على الأقل.',
            'image' => 'يجب أن تكون الملفات المرفوعة صورًا صحيحة.',
            'mimes' => 'يجب أن تكون الصورة من نوع :values.',
            'max' => 'يجب ألا يتجاوز حجم الصورة :max كيلوبايت.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
     */

    'attributes' => [
        'name' => 'الاسم',
        'slug'=>'الاسم بالرابط',
        'flash_sale' => 'خصم فلاش ',
        'expire_date' => ' تاريخ الانتهاء',
        'government_id' => 'المحافظه',
        'merchant_price' => 'سعر تاجر الجمله',
        'merchant_quantity' => 'كميه تاجر الجمله',
        'city_id' => 'المدينه',
        'shipping_company_id' => 'شركه الشحن',
        'method' => 'طريقه الدفع',
        "logo" => "لوجو",
        'discount_type' => 'نوع الخصم',
        'discount_value' => 'قيمه الخصم',
        'quantity' => ' الكميه',
        'company' => ' الشركه',
        'estimated_time' => "الوقت المتوقع للتوصيل",
        'value' => "القيمه",
        'password' => 'كلمه المرور ',
        'phone' => 'رقم الجوال ',
        'email' => 'البريد الالكتروني ',
        'role' => 'النوع ',
        'country_id' => 'الدولة',
        'password' => 'كلمة المرور ',
        'terms' => 'اختيار موافقة الشروط ',
        'address' => 'العنوان',
        'price' => 'السعر',
        'type' => 'النوع',
        'area_id' => 'المنطقة',
        'photo' => 'الصورة',
        'name' => 'الاسم',
        'describe' => 'الوصف',
        'size' => 'الحجم',
        'delivary' => ' التوصيل ',
        'title' => 'العنوان ',
        'content' => 'المحتوى',
        'facebook' => 'رابط الفيسبوك ',
        'twitter' => 'رابط تويتر ',
        'instgram' => 'رابط انستجرام ',
        'google' => 'رابط جوجل بلس ',
        'date' => 'التاريخ ',
        'time' => 'الوقت ',
        'details' => 'التفاصيل',
        'user_id' => 'المستخدم',
        'id_num' => 'رقم الهوية',
        'gender' => 'النوع',
        'source' => 'المصدر',
        'mode' => 'الوضع',
        'icon' => 'الايقونة',
        'building_num' => 'رقم المبنى',
        'street' => 'الشارع',
        'firm' => 'اعتماد',
        'thumbnail' => 'الصورة',
        'slug' => 'slug',
        'category' => 'تصنيف',
        'tag' => 'علامة',
        'reference' => 'رقم التتبع',
        'passport' => 'جواز السفر',
        'images' => 'الصور',
        'rate' => 'التقييم',
        'comment'=>'التعليق',
        'subject_id'=>'الموضوع',
        'first_name'=>'الاسم الاول',
        'last_name'=>'الاسم الاخير',
        'ar' => [
            'content' => 'المحتوي باللغة العربية',
            'short_description' => 'المحتوي باللغة العربية',
            'meta_title' => 'عنوان ميتا باللغة العربية',
            'meta_description' => 'وصف ميتا باللغة العربية',
        ],
        'en' => [
            'content' => 'المحتوي باللغة الانجليزية',
            'short_description' => 'المحتوي باللغة الانجليزية',
            'meta_title' => 'عنوان ميتا باللغة الانجليزية',
            'meta_description' => 'وصف ميتا باللغة الانجليزية',
        ],
        'meta' => [
            'store_name' => 'اسم المتجر',
            'activity_type' => 'نوع النشاط',
            'tax_card' => 'بطاقة الضريبة',
            'commercial_record' => 'السجل التجاري',
        ],
    ],

];
