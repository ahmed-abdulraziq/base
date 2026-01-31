@php
    $columns = [
        ['data' => 'id', 'name' => 'id', 'title' => '#', 'width' => '5%'],
        ['data' => 'session_id', 'name' => 'session_id', 'title' => __('translate.session_id')],
        ['data' => 'user_id', 'name' => 'user.name', 'title' => __('translate.user')],
        ['data' => 'subtotal', 'name' => 'subtotal', 'title' => __('translate.subtotal')],
        ['data' => 'delivery_cost', 'name' => 'delivery_cost', 'title' => __('translate.delivery_cost')],
        ['data' => 'total', 'name' => 'total', 'title' => __('translate.total')],
        ['data' => 'status', 'name' => 'status', 'title' => __('translate.status')],
        ['data' => 'branch_id', 'name' => 'branch.name', 'title' => __('translate.branch')],
        ['data' => 'type', 'name' => 'type', 'title' => __('translate.type')],
        ['data' => 'coupon_code', 'name' => 'coupon_code', 'title' => __('translate.coupon_code')],
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
            :title="__('translate.' . $route)"
            :header="__('translate.' . $route)"
        />
    </div>
@endsection