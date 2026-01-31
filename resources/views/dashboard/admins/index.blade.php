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

@section('title', __('translate.admins'))
@section('header', __('translate.admins'))
@section('admins', 'active')
@section('breadcrumbs', Breadcrumbs::render('admins'))

@section('content')
    <div class="col-12">
        <x-data-table
            id="admins-table"
            :route="route('dashboard.admins.data')"
            :columns="$columns"
            :create-route="route('dashboard.admins.create')"
            :title="__('translate.admins')"
            :header="__('translate.admins')"
        >
            <x-slot:filter>
                <x-dashboard.filter
                    table-id="admins-table"
                    :show-date-range="true"
                    :show-role="true"
                    :role-options="$roleOptions ?? []"
                    :embedded="true"
                />
            </x-slot:filter>
        </x-data-table>
    </div>
@endsection
