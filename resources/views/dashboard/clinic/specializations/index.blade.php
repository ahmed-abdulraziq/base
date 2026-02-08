@php
    $columns = [
        ['data' => 'specialization_id', 'name' => 'specialization_id', 'title' => '#', 'width' => '5%'],
        ['data' => 'specialization_name', 'name' => 'specialization_name', 'title' => __('translate.specialization_name')],
        ['data' => 'description', 'name' => 'description', 'title' => __('translate.description')],
        ['data' => 'created_at', 'name' => 'created_at', 'title' => __('translate.created_at')],
    ];
@endphp

@extends('dashboard.layouts.master')

@section('title', __('translate.specializations'))
@section('header', __('translate.specializations'))
@section('clinic_specializations', 'active')
@section('breadcrumbs', Breadcrumbs::render('clinic.specializations'))

@section('content')
    <div class="col-12">
        <x-data-table
            id="specializations-table"
            :route="route('dashboard.clinic.specializations.data')"
            :columns="$columns"
            :create-route="route('dashboard.clinic.specializations.create')"
            :title="__('translate.specializations')"
            :header="__('translate.specializations')"
        >
            <x-slot:filter>
                <x-dashboard.filter
                    table-id="specializations-table"
                    :show-search="true"
                    :show-date-range="true"
                    :embedded="true"
                />
            </x-slot:filter>
        </x-data-table>
    </div>
@endsection
