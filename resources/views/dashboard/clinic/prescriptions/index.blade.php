@php
    $columns = [
        ['data' => 'id', 'name' => 'id', 'title' => '#', 'width' => '5%'],
        ['data' => 'prescription_date', 'name' => 'prescription_date', 'title' => __('translate.prescription_date')],
        ['data' => 'patient_name', 'name' => 'patient_id', 'title' => __('translate.patient')],
        ['data' => 'doctor_name', 'name' => 'doctor_id', 'title' => __('translate.doctor')],
        ['data' => 'notes', 'name' => 'notes', 'title' => __('translate.notes')],
    ];
@endphp

@extends('dashboard.layouts.master')

@section('title', __('translate.prescriptions'))
@section('header', __('translate.prescriptions'))
@section('clinic_prescriptions', 'active')
@section('breadcrumbs', Breadcrumbs::render('clinic.prescriptions'))

@section('content')
    <div class="col-12">
        <x-data-table
            id="prescriptions-table"
            :route="route('dashboard.clinic.prescriptions.data')"
            :columns="$columns"
            :create-route="route('dashboard.clinic.prescriptions.create')"
            :title="__('translate.prescriptions')"
            :header="__('translate.prescriptions')"
        >
            <x-slot:filter>
                <x-dashboard.filter table-id="prescriptions-table" :show-search="true" :show-date-range="true" :embedded="true">
                    <x-slot:extra>
                        <div class="col-auto">
                            <label for="filter-form-prescriptions-table-doctor" class="form-label text-muted mb-0">@lang('translate.doctor')</label>
                            <select class="form-select" id="filter-form-prescriptions-table-doctor" name="filter_doctor" style="min-width: 140px;">
                                <option value="">@lang('translate.all')</option>
                                @foreach($doctorOptions ?? [] as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </x-slot:extra>
                </x-dashboard.filter>
            </x-slot:filter>
        </x-data-table>
    </div>
@endsection
