@php 
    $columns = [
        ['data' => 'id', 'name' => 'id', 'title' => '#', 'width' => '5%'],
        ['data' => 'logo', 'name' => 'logo', 'title' => __('translate.logo')],
        ['data' => 'name', 'name' => 'translations.name', 'title' => __('translate.name')],
        ['data' => 'slug', 'name' => 'slug', 'title' => __('translate.slug')],
        ['data' => 'country_id', 'name' => 'country.name', 'title' => __('translate.country')],
        ['data' => 'city_id', 'name' => 'city.name', 'title' => __('translate.city')],
        // ['data' => 'governorate', 'name' => 'governorate', 'title' => __('translate.governorate')],
        ['data' => 'phone', 'name' => 'phone', 'title' => __('translate.phone'), 'width' => '120px'],
        ['data' => 'active', 'name' => 'active', 'title' => __('translate.status')],
        ['data' => 'delivery_cost', 'name' => 'delivery_cost', 'title' => __('translate.delivery_cost')],
        ['data' => 'min_delivery', 'name' => 'min_delivery', 'title' => __('translate.min_delivery')],
        ['data' => 'tax', 'name' => 'tax', 'title' => __('translate.tax')],
        // ['data' => 'start_at', 'name' => 'start_at', 'title' => __('translate.start_time')],
        // ['data' => 'end_at', 'name' => 'end_at', 'title' => __('translate.end_time')],
        // ['data' => 'working_days', 'name' => 'working_days', 'title' => __('translate.working_days')],
        ['data' => 'views', 'name' => 'views', 'title' => __('translate.views')],
        ['data' => 'color', 'name' => 'color', 'title' => __('translate.color')],
        ['data' => 'delivery_number', 'name' => 'delivery_number', 'title' => __('translate.delivery_number')],
        ['data' => 'whatsapp_number', 'name' => 'whatsapp_number', 'title' => __('translate.whatsapp')],
        ['data' => 'complaints_number', 'name' => 'complaints_number', 'title' => __('translate.complaints')],
        ['data' => 'takeaway', 'name' => 'takeaway', 'title' => __('translate.takeaway')],
        ['data' => 'delivery', 'name' => 'delivery', 'title' => __('translate.delivery')],
        ['data' => 'order', 'name' => 'order', 'title' => __('translate.order')],
        ['data' => 'created_at', 'name' => 'created_at', 'title' => __('translate.created_at'), 'width' => '80px'],
    ];
@endphp


@extends('dashboard.layouts.master')

@section('title', __('translate.' . $route))
@section('header', __('translate.' . $route))
@section($route, 'active')
@section('breadcrumbs', Breadcrumbs::render($route))

@section('content')
    <div class="col-12">
        <x-data-table 
            id="{{ $route }}-table"
            :route="route($route . '.data')"
            :columns="$columns"
            :create-route="route($route . '.create')"
            :title="__('translate.' . $route)"
            :header="__('translate.' . $route)"
        />
    </div>
@endsection