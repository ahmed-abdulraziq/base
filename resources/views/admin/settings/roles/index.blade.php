@php
    $columns = [
        ['data' => 'id', 'name' => 'id', 'title' => '#', 'width' => '5%'],
        ['data' => 'name', 'name' => 'name', 'title' => __('translate.name')],
        ['data' => 'guard_name', 'name' => 'guard_name', 'title' => __('translate.guard')],
        ['data' => 'permissions_count', 'name' => 'permissions_count', 'title' => __('translate.permissions')],
        ['data' => 'created_at', 'name' => 'created_at', 'title' => __('translate.created_at')],
    ];
@endphp

@extends('dashboard.layouts.master')

@section('title', __('translate.roles'))
@section('header', __('translate.roles'))
@section('settings', 'active')
@section('breadcrumbs', Breadcrumbs::render('settings.roles'))

@section('content')
<div class="card col-12">
    <div class="row g-0">
        @include('admin.settings.partials.sidebar')
        <div class="col-12 col-md-9">
            <div class="card-body p-0">
                <div class="card-header mb-3">
                    <h3 class="card-title">{{ __('translate.roles') }}</h3>
                </div>
                <x-data-table
                    id="roles-table"
                    :route="route('dashboard.settings.roles.data')"
                    :columns="$columns"
                    :create-route="auth()->user()->can('create.role') ? route('dashboard.settings.roles.create') : null"
                    :title="__('translate.roles')"
                    :header="__('translate.roles')"
                    :no-card="true"
                >
                    <x-slot:filter>
                        <x-dashboard.filter
                            table-id="roles-table"
                            :show-date-range="false"
                            :show-role="false"
                            :embedded="true"
                        />
                    </x-slot:filter>
                </x-data-table>
            </div>
        </div>
    </div>
</div>
@endsection
