@php
    $columns = [
        ['data' => 'id', 'name' => 'id', 'title' => '#', 'width' => '5%'],
        ['data' => 'name', 'name' => 'translations.name', 'title' => __('translate.name')],
        ['data' => 'restaurant_id', 'name' => 'restaurant.name', 'title' => __('translate.restaurant')],
        ['data' => 'phone', 'name' => 'phone', 'title' => __('translate.phone')],
        ['data' => 'active', 'name' => 'active', 'title' => __('translate.status')],
        ['data' => 'delivery_cost', 'name' => 'delivery_cost', 'title' => __('translate.delivery_cost')],
        ['data' => 'min_delivery', 'name' => 'min_delivery', 'title' => __('translate.min_delivery')],
        ['data' => 'tax', 'name' => 'tax', 'title' => __('translate.tax')],
        ['data' => 'delivery_number', 'name' => 'delivery_number', 'title' => __('translate.delivery_number')],
        ['data' => 'whatsapp_number', 'name' => 'whatsapp_number', 'title' => __('translate.whatsapp')],
        ['data' => 'complaints_number', 'name' => 'complaints_number', 'title' => __('translate.complaints')],
        ['data' => 'created_at', 'name' => 'created_at', 'title' => __('translate.created_at')],
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