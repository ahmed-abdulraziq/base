@php
    $columns = [
        ['data' => 'id', 'name' => 'id', 'title' => '#', 'width' => '5%'],
        ['data' => 'examination_date', 'name' => 'examination_date', 'title' => __('translate.examination_date')],
        ['data' => 'patient_name', 'name' => 'patient_id', 'title' => __('translate.patient')],
        ['data' => 'diagnosis', 'name' => 'diagnosis', 'title' => __('translate.diagnosis')],
        ['data' => 'symptoms', 'name' => 'symptoms', 'title' => __('translate.symptoms')],
    ];
@endphp
@extends('doctor.layouts.master')
@section('title', __('translate.medical_examinations'))
@section('header', __('translate.medical_examinations'))
@section('doctor_examinations', 'active')
@section('breadcrumbs', Breadcrumbs::render('doctor.examinations'))

@section('content')
    <div class="col-12">
        <x-data-table
            id="doctor-examinations-table"
            :route="route('doctor.examinations.data')"
            :columns="$columns"
            :create-route="route('doctor.examinations.create')"
            :title="__('translate.medical_examinations')"
            :header="__('translate.medical_examinations')"
        >
            <x-slot:filter>
                <x-dashboard.filter table-id="doctor-examinations-table" :show-search="true" :show-date-range="true" :embedded="true" />
            </x-slot:filter>
        </x-data-table>
    </div>
@endsection
