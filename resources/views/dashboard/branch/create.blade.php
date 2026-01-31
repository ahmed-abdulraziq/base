@php
    $fields = [
        [
            'name' => 'restaurant_id',
            'label' => __('translate.restaurant'),
            'type' => 'select',
            'model' => \App\Models\Restaurant::class,
            'required' => true,
            'columnClass' => 'col-12 col-lg-6',
        ],
        [
            'name' => 'phone',
            'label' => __('translate.phone'),
            'type' => 'text',
            'required' => true,
            'columnClass' => 'col-12 col-lg-6',
        ],
        [
            'name' => 'country_id',
            'label' => __('translate.country'),
            'type' => 'select',
            'model' => \App\Models\Country::class,
            'required' => true,
            'columnClass' => 'col-12 col-lg-6',
        ],
        [
            'name' => 'city_id',
            'label' => __('translate.city'),
            'type' => 'select',
            'model' => \App\Models\City::class,
            'required' => true,
            'columnClass' => 'col-12 col-lg-6',
        ],
        [
            'name' => 'link',
            'label' => __('translate.link'),
            'type' => 'text',
            'required' => true,
            'columnClass' => 'col-12',
        ],
        [
            'name' => 'latitude',
            'label' => __('translate.latitude'),
            'type' => 'text',
            'required' => false,
            'columnClass' => 'col-12 col-lg-6',
        ],
        [
            'name' => 'longitude',
            'label' => __('translate.longitude'),
            'type' => 'text',
            'required' => false,
            'columnClass' => 'col-12 col-lg-6',
        ],
    ];
    $columnClass = 'col-12 col-lg-9';
@endphp

@include('dashboard.layouts.pages.create')
