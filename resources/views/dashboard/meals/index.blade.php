@php
    $columns = [
        ['data' => 'id', 'name' => 'id', 'title' => '#', 'width' => '5%'],
        ['data' => 'images', 'name' => 'images', 'title' => __('translate.images')],
        ['data' => 'name', 'name' => 'translations.name', 'title' => __('translate.name')],
        ['data' => 'restaurant_id', 'name' => 'restaurant.name', 'title' => __('translate.restaurant')],
        ['data' => 'category_id', 'name' => 'category.name', 'title' => __('translate.category')],
        ['data' => 'price', 'name' => 'price', 'title' => __('translate.price')],
        ['data' => 'discount_price', 'name' => 'discount_price', 'title' => __('translate.discount_price')],
        ['data' => 'active', 'name' => 'active', 'title' => __('translate.status')],
        ['data' => 'recommended', 'name' => 'recommended', 'title' => __('translate.recommended')],
        ['data' => 'featured', 'name' => 'featured', 'title' => __('translate.featured')],
        ['data' => 'available', 'name' => 'available', 'title' => __('translate.available')],
        ['data' => 'type', 'name' => 'type', 'title' => __('translate.type')],
        ['data' => 'preparation_time', 'name' => 'preparation_time', 'title' => __('translate.preparation_time')],
        ['data' => 'calories', 'name' => 'calories', 'title' => __('translate.calories')],
        ['data' => 'views', 'name' => 'views', 'title' => __('translate.views')],

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