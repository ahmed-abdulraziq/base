@php
    $columns = [
        ['data' => 'id', 'name' => 'id', 'title' => '#', 'width' => '5%'],
        ['data' => 'num', 'name' => 'num', 'title' => __('translate.number')],
        ['data' => 'qr_code', 'name' => 'qr_code', 'title' => __('translate.qr_code')],
        ['data' => 'restaurant_id', 'name' => 'restaurant.name', 'title' => __('translate.restaurant')],
        ['data' => 'status', 'name' => 'status', 'title' => __('translate.status')],
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