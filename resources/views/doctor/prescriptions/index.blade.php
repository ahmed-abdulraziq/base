@php
    $columns = [
        ['data' => 'prescription_id', 'name' => 'prescription_id', 'title' => '#', 'width' => '5%'],
        ['data' => 'prescription_date', 'name' => 'prescription_date', 'title' => __('translate.prescription_date')],
        ['data' => 'patient_name', 'name' => 'patient_id', 'title' => __('translate.patient')],
        ['data' => 'notes', 'name' => 'notes', 'title' => __('translate.notes')],
    ];
@endphp
@extends('doctor.layouts.master')
@section('title', __('translate.prescriptions'))
@section('header', __('translate.prescriptions'))
@section('doctor_prescriptions', 'active')
@section('breadcrumbs', Breadcrumbs::render('doctor.prescriptions'))

@section('content')
    <div class="col-12">
        <x-data-table
            id="doctor-prescriptions-table"
            :route="route('doctor.prescriptions.data')"
            :columns="$columns"
            :create-route="route('doctor.prescriptions.create')"
            :title="__('translate.prescriptions')"
            :header="__('translate.prescriptions')"
        >
            <x-slot:filter>
                <x-dashboard.filter table-id="doctor-prescriptions-table" :show-search="true" :show-date-range="true" :embedded="true" />
            </x-slot:filter>
        </x-data-table>
    </div>
@endsection
