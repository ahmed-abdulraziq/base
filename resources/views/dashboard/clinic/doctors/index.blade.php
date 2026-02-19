@php
    $columns = [
        ['data' => 'id', 'name' => 'id', 'title' => '#', 'width' => '5%'],
        ['data' => 'full_name', 'name' => 'name', 'title' => __('translate.doctor_name')],
        ['data' => 'specialization_name', 'name' => 'specialization_id', 'title' => __('translate.specialization')],
        ['data' => 'phone', 'name' => 'phone', 'title' => __('translate.phone')],
        ['data' => 'consultation_fee', 'name' => 'consultation_fee', 'title' => __('translate.consultation_fee')],
        ['data' => 'created_at', 'name' => 'created_at', 'title' => __('translate.created_at')],
    ];
@endphp

@extends('dashboard.layouts.master')

@section('title', __('translate.doctors'))
@section('header', __('translate.doctors'))
@section('clinic_doctors', 'active')
@section('breadcrumbs', Breadcrumbs::render('clinic.doctors'))

@section('content')
    <div class="col-12">
        <x-data-table
            id="doctors-table"
            :route="route('dashboard.clinic.doctors.data')"
            :columns="$columns"
            :create-route="route('dashboard.clinic.doctors.create')"
            :title="__('translate.doctors')"
            :header="__('translate.doctors')"
        >
            <x-slot:filter>
                <x-dashboard.filter
                    table-id="doctors-table"
                    :show-search="true"
                    :show-date-range="true"
                    :embedded="true"
                >
                    <x-slot:extra>
                        <div class="col-auto">
                            <label for="filter-form-doctors-table-specialization" class="form-label text-muted mb-0">@lang('translate.specialization')</label>
                            <select class="form-select" id="filter-form-doctors-table-specialization" name="filter_specialization" style="min-width: 140px;">
                                <option value="">@lang('translate.all')</option>
                                @foreach($specializationOptions ?? [] as $value => $label)
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
