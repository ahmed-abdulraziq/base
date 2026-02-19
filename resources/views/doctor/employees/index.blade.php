@php
    $columns = [
        ['data' => 'id', 'name' => 'id', 'title' => '#', 'width' => '5%'],
        ['data' => 'full_name', 'name' => 'name', 'title' => __('translate.employee_name')],
        ['data' => 'job_title', 'name' => 'job_title', 'title' => __('translate.job_title')],
        ['data' => 'phone', 'name' => 'phone', 'title' => __('translate.phone')],
        ['data' => 'approval_status', 'name' => 'approved_at', 'title' => __('translate.status')],
        ['data' => 'created_at', 'name' => 'created_at', 'title' => __('translate.created_at')],
    ];
@endphp
@extends('doctor.layouts.master')
@section('title', __('translate.employees'))
@section('header', __('translate.employees'))
@section('doctor_employees', 'active')
@section('breadcrumbs', Breadcrumbs::render('doctor.employees'))

@section('content')
    <div class="col-12">
        <x-data-table
            id="doctor-employees-table"
            :route="route('doctor.employees.data')"
            :columns="$columns"
            :create-route="route('doctor.employees.create')"
            :title="__('translate.employees')"
            :header="__('translate.employees')"
        >
            <x-slot:filter>
                <x-dashboard.filter table-id="doctor-employees-table" :show-search="true" :show-date-range="true" :embedded="true" />
            </x-slot:filter>
        </x-data-table>
    </div>
@endsection
