@php
    $columns = [
        ['data' => 'id', 'name' => 'id', 'title' => '#', 'width' => '5%'],
        ['data' => 'name', 'name' => 'name', 'title' => __('translate.name'), 'width' => ''],
        ['data' => 'email', 'name' => 'email', 'title' => __('translate.email'), 'width' => ''],
        ['data' => 'phone', 'name' => 'phone', 'title' => __('translate.phone'), 'width' => ''],
        ['data' => 'role', 'name' => 'role.name', 'title' => __('translate.role'), 'width' => ''],
        ['data' => 'created_at', 'name' => 'created_at', 'title' => __('translate.created_at'), 'width' => '80px'],
    ];
        // 'name', 'email', 'phone', 'role', 'created_at'];
@endphp

@include('dashboard.layouts.pages.index')