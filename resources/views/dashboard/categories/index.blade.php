@php
    $columns = [
        ['data' => 'id', 'name' => 'id', 'title' => '#', 'width' => '5%'],
        ['data' => 'image', 'name' => 'image', 'title' => __('translate.image')],
        ['data' => 'name', 'name' => 'translations.name', 'title' => __('translate.name')],
        ['data' => 'restaurant_id', 'name' => 'restaurant.name', 'title' => __('translate.restaurant')],
        ['data' => 'active', 'name' => 'active', 'title' => __('translate.status')],
        ['data' => 'featured', 'name' => 'featured', 'title' => __('translate.featured')],
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