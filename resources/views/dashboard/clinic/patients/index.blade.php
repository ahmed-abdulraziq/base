@php
    $columns = [
        ['data' => 'id', 'name' => 'id', 'title' => '#', 'width' => '5%'],
        ['data' => 'full_name', 'name' => 'name', 'title' => __('translate.patient_name')],
        ['data' => 'phone', 'name' => 'phone', 'title' => __('translate.phone')],
        ['data' => 'gender', 'name' => 'gender', 'title' => __('translate.gender')],
        ['data' => 'blood_type', 'name' => 'blood_type', 'title' => __('translate.blood_type')],
        ['data' => 'created_at', 'name' => 'created_at', 'title' => __('translate.created_at')],
    ];
@endphp

@extends('dashboard.layouts.master')

@section('title', __('translate.patients'))
@section('header', __('translate.patients'))
@section('clinic_patients', 'active')
@section('breadcrumbs', Breadcrumbs::render('clinic.patients'))

@section('content')
    <div class="col-12">
        <x-data-table
            id="patients-table"
            :route="route('dashboard.clinic.patients.data')"
            :columns="$columns"
            :create-route="route('dashboard.clinic.patients.create')"
            :title="__('translate.patients')"
            :header="__('translate.patients')"
        >
            <x-slot:filter>
                <x-dashboard.filter table-id="patients-table" :show-search="true" :show-date-range="true" :embedded="true" />
            </x-slot:filter>
        </x-data-table>
    </div>
@endsection
