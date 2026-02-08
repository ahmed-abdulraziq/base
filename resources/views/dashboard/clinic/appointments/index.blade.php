@php
    $columns = [
        ['data' => 'appointment_id', 'name' => 'appointment_id', 'title' => '#', 'width' => '5%'],
        ['data' => 'appointment_date', 'name' => 'appointment_date', 'title' => __('translate.appointment_date')],
        ['data' => 'patient_name', 'name' => 'patient_id', 'title' => __('translate.patient')],
        ['data' => 'doctor_name', 'name' => 'doctor_id', 'title' => __('translate.doctor')],
        ['data' => 'status', 'name' => 'status', 'title' => __('translate.status')],
        ['data' => 'reason', 'name' => 'reason', 'title' => __('translate.reason')],
    ];
@endphp

@extends('dashboard.layouts.master')

@section('title', __('translate.appointments'))
@section('header', __('translate.appointments'))
@section('clinic_appointments', 'active')
@section('breadcrumbs', Breadcrumbs::render('clinic.appointments'))

@section('content')
    <div class="col-12">
        <x-data-table
            id="appointments-table"
            :route="route('dashboard.clinic.appointments.data')"
            :columns="$columns"
            :create-route="route('dashboard.clinic.appointments.create')"
            :title="__('translate.appointments')"
            :header="__('translate.appointments')"
        >
            <x-slot:filter>
                <x-dashboard.filter table-id="appointments-table" :show-search="true" :show-date-range="true" :embedded="true">
                    <x-slot:extra>
                        <div class="col-auto">
                            <label for="filter-form-appointments-table-doctor" class="form-label text-muted mb-0">@lang('translate.doctor')</label>
                            <select class="form-select" id="filter-form-appointments-table-doctor" name="filter_doctor" style="min-width: 140px;">
                                <option value="">@lang('translate.all')</option>
                                @foreach($doctorOptions ?? [] as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-auto">
                            <label for="filter-form-appointments-table-status" class="form-label text-muted mb-0">@lang('translate.status')</label>
                            <select class="form-select" id="filter-form-appointments-table-status" name="filter_status" style="min-width: 120px;">
                                <option value="">@lang('translate.all')</option>
                                <option value="محجوز">محجوز</option>
                                <option value="مؤكد">مؤكد</option>
                                <option value="منتهي">منتهي</option>
                                <option value="ملغي">ملغي</option>
                            </select>
                        </div>
                    </x-slot:extra>
                </x-dashboard.filter>
            </x-slot:filter>
        </x-data-table>
    </div>
@endsection
