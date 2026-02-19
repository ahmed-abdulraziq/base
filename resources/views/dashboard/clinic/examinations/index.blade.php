@php
    $columns = [
        ['data' => 'id', 'name' => 'id', 'title' => '#', 'width' => '5%'],
        ['data' => 'examination_date', 'name' => 'examination_date', 'title' => __('translate.examination_date')],
        ['data' => 'patient_name', 'name' => 'patient_id', 'title' => __('translate.patient')],
        ['data' => 'doctor_name', 'name' => 'doctor_id', 'title' => __('translate.doctor')],
        ['data' => 'diagnosis', 'name' => 'diagnosis', 'title' => __('translate.diagnosis')],
    ];
@endphp

@extends('dashboard.layouts.master')

@section('title', __('translate.medical_examinations'))
@section('header', __('translate.medical_examinations'))
@section('clinic_examinations', 'active')
@section('breadcrumbs', Breadcrumbs::render('clinic.examinations'))

@section('content')
    <div class="col-12">
        <x-data-table
            id="examinations-table"
            :route="route('dashboard.clinic.examinations.data')"
            :columns="$columns"
            :create-route="route('dashboard.clinic.examinations.create')"
            :title="__('translate.medical_examinations')"
            :header="__('translate.medical_examinations')"
        >
            <x-slot:filter>
                <x-dashboard.filter table-id="examinations-table" :show-search="true" :show-date-range="true" :embedded="true">
                    <x-slot:extra>
                        <div class="col-auto">
                            <label for="filter-form-examinations-table-doctor" class="form-label text-muted mb-0">@lang('translate.doctor')</label>
                            <select class="form-select" id="filter-form-examinations-table-doctor" name="filter_doctor" style="min-width: 140px;">
                                <option value="">@lang('translate.all')</option>
                                @foreach($doctorOptions ?? [] as $value => $label)
                                    <option value="{{ $value }}">{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-auto">
                            <label for="filter-form-examinations-table-patient" class="form-label text-muted mb-0">@lang('translate.patient')</label>
                            <select class="form-select" id="filter-form-examinations-table-patient" name="filter_patient" style="min-width: 140px;">
                                <option value="">@lang('translate.all')</option>
                                @foreach($patientOptions ?? [] as $value => $label)
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
