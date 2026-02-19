@php
    $columns = [
        ['data' => 'id', 'name' => 'id', 'title' => '#', 'width' => '5%'],
        ['data' => 'full_name', 'name' => 'name', 'title' => __('translate.patient_name')],
        ['data' => 'phone', 'name' => 'phone', 'title' => __('translate.phone')],
        ['data' => 'gender', 'name' => 'gender', 'title' => __('translate.gender')],
        ['data' => 'created_at', 'name' => 'created_at', 'title' => __('translate.created_at')],
        ['data' => 'actions', 'name' => 'actions', 'title' => __('translate.actions'), 'orderable' => false, 'searchable' => false],
    ];
@endphp
@extends('doctor.layouts.master')

@section('breadcrumbs', Breadcrumbs::render('doctor.patients'))
@section('title', __('translate.patients'))
@section('header', __('translate.patients'))
@section('doctor_patients', 'active')

@section('content')
    <div class="col-12">
        <x-data-table
            id="doctor-patients-table"
            :route="route('doctor.patients.data')"
            :columns="$columns"
            :title="__('translate.patients')"
            :header="__('translate.patients')"
        >
             <x-slot:filter>
                <x-dashboard.filter table-id="doctor-patients-table" :show-search="true" :embedded="true" />
            </x-slot:filter>
        </x-data-table>
    </div>
@endsection
