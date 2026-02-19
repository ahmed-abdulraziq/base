@php
    $columns = [
        ['data' => 'id', 'name' => 'id', 'title' => '#', 'width' => '5%'],
        ['data' => 'appointment_date', 'name' => 'appointment_date', 'title' => __('translate.appointment_date')],
        ['data' => 'patient_name', 'name' => 'patient_id', 'title' => __('translate.patient')],
        ['data' => 'status', 'name' => 'status', 'title' => __('translate.status')],
        ['data' => 'reason', 'name' => 'reason', 'title' => __('translate.reason')],
    ];
@endphp
@extends('doctor.layouts.master')
@section('title', __('translate.appointments'))
@section('header', __('translate.appointments'))
@section('doctor_appointments', 'active')
@section('breadcrumbs', Breadcrumbs::render('doctor.appointments'))

@section('content')
    <div class="col-12">
        <x-data-table
            id="doctor-appointments-table"
            :route="route('doctor.appointments.data')"
            :columns="$columns"
            :create-route="route('doctor.appointments.create')"
            :title="__('translate.appointments')"
            :header="__('translate.appointments')"
        >
            <x-slot:filter>
                <x-dashboard.filter table-id="doctor-appointments-table" :show-search="true" :show-date-range="true" :embedded="true">
                    <x-slot:extra>
                        <div class="col-auto">
                            <label for="filter-form-doctor-appointments-table-status" class="form-label text-muted mb-0">@lang('translate.status')</label>
                            <select class="form-select" id="filter-form-doctor-appointments-table-status" name="filter_status" style="min-width: 120px;">
                                <option value="">@lang('translate.all')</option>
                                @foreach(\App\Enums\AppointmentStatus::cases() as $case)
                                    <option value="{{ $case->value }}">{{ $case->label() }}</option>
                                @endforeach
                            </select>
                        </div>
                    </x-slot:extra>
                </x-dashboard.filter>
            </x-slot:filter>
        </x-data-table>
    </div>
@endsection
