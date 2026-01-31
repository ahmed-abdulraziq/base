@php
    $columns = [
        ['data' => 'id', 'name' => 'id', 'title' => '#', 'width' => '5%'],
        ['data' => 'code', 'name' => 'code', 'title' => __('translate.code'), 'width' => ''],
        ['data' => 'name', 'name' => 'translations.name', 'title' => __('translate.name'), 'width' => ''],
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