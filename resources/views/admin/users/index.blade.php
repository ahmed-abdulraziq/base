@php
    $columns = [
        ['data' => 'id', 'name' => 'id', 'title' => '#', 'width' => '5%'],
        ['data' => 'name', 'name' => 'name', 'title' => __('translate.name')],
        ['data' => 'email', 'name' => 'email', 'title' => __('translate.email')],
        ['data' => 'role', 'name' => 'role', 'title' => __('translate.role')],
        ['data' => 'created_at', 'name' => 'created_at', 'title' => __('translate.created_at')],
    ];
@endphp

@extends('dashboard.layouts.master')

@section('title', __('translate.users'))
@section('header', __('translate.users'))
@section('users', 'active')
@section('breadcrumbs', Breadcrumbs::render('users'))

@section('content')
    <div class="col-12">
        <x-data-table
            id="users-table"
            :route="route('dashboard.users.data')"
            :columns="$columns"
            :create-route="route('dashboard.users.create')"
            :title="__('translate.users')"
            :header="__('translate.users')"
        >
            <x-slot:filter>
                <x-dashboard.filter
                    table-id="users-table"
                    :show-date-range="true"
                    :show-role="true"
                    :role-options="$roleOptions ?? []"
                    :embedded="true"
                />
            </x-slot:filter>
        </x-data-table>
    </div>
@endsection
