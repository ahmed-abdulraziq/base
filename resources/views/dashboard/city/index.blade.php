@php
    $columns = [
        ['data' => 'id', 'name' => 'id', 'title' => '#', 'width' => '5%'],
        ['data' => 'name', 'name' => 'name', 'title' => __('translate.name'), 'width' => ''],
        ['data' => 'country_id', 'name' => 'country_id', 'title' => __('translate.country'), 'width' => ''],
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
            :route="route($route . '.data', ['country_id' => request('country_id')])"
            :columns="$columns"
            :create-route="route($route . '.create', ['country_id' => request('country_id')])"
            :title="__('translate.' . $route)"
            :header="__('translate.' . $route)"
        />
    </div>
@endsection