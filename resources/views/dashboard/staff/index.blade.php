@php
    $columns = [
        ['data' => 'id', 'name' => 'id', 'title' => '#', 'width' => '5%'],
        ['data' => 'name', 'name' => 'name', 'title' => __('translate.name')],
        ['data' => 'email', 'name' => 'email', 'title' => __('translate.email')],
        ['data' => 'phone', 'name' => 'phone', 'title' => __('translate.phone')],
        ['data' => 'branch_id', 'name' => 'branch.name', 'title' => __('translate.branch')],
        ['data' => 'active', 'name' => 'active', 'title' => __('translate.status')],
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