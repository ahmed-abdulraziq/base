@php
    $columns = [
        ['data' => 'id', 'name' => 'id', 'title' => '#', 'width' => '5%'],
        ['data' => 'name', 'name' => 'name', 'title' => __('translate.name')],
        ['data' => 'guard_name', 'name' => 'guard_name', 'title' => __('translate.guard')],
        ['data' => 'roles_list', 'name' => 'roles_list', 'title' => __('translate.roles'), 'orderable' => false, 'searchable' => false],
    ];
@endphp

@extends('dashboard.layouts.master')

@section('title', __('translate.permissions'))
@section('header', __('translate.permissions'))
@section('settings', 'active')
@section('breadcrumbs', Breadcrumbs::render('settings.permissions'))

@section('content')
<div class="card col-12">
    <div class="row g-0">
        @include('admin.settings.partials.sidebar')
        <div class="col-12 col-md-9">
            <div class="card-body p-0">
                <div class="card-header mb-3">
                    <h3 class="card-title">{{ __('translate.permissions') }}</h3>
                </div>
                <x-data-table
                    id="permissions-table"
                    :route="route('dashboard.settings.permissions.data')"
                    :columns="$columns"
                    :create-route="auth()->user()->can('create.permission') ? route('dashboard.settings.permissions.create') : null"
                    :title="__('translate.permissions')"
                    :header="__('translate.permissions')"
                    :no-card="true"
                >
                    <x-slot:filter>
                        <x-dashboard.filter
                            table-id="permissions-table"
                            :show-date-range="false"
                            :show-role="true"
                            :role-options="$roleOptions ?? []"
                            :embedded="true"
                        />
                    </x-slot:filter>
                </x-data-table>
            </div>
        </div>
    </div>
</div>
@endsection
