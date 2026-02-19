@php
    $columns = [
        ['data' => 'id', 'name' => 'id', 'title' => '#', 'width' => '5%'],
        ['data' => 'medication_name', 'name' => 'medication_name', 'title' => __('translate.medication_name')],
        ['data' => 'generic_name', 'name' => 'generic_name', 'title' => __('translate.generic_name')],
        ['data' => 'type', 'name' => 'type', 'title' => __('translate.medication_type')],
        ['data' => 'unit', 'name' => 'unit', 'title' => __('translate.unit')],
        ['data' => 'price', 'name' => 'price', 'title' => __('translate.price')],
        ['data' => 'created_at', 'name' => 'created_at', 'title' => __('translate.created_at')],
    ];
@endphp

@extends('dashboard.layouts.master')

@section('title', __('translate.medications'))
@section('header', __('translate.medications'))
@section('clinic_medications', 'active')
@section('breadcrumbs', Breadcrumbs::render('clinic.medications'))

@section('content')
    <div class="col-12">
        <x-data-table
            id="medications-table"
            :route="route('dashboard.clinic.medications.data')"
            :columns="$columns"
            :create-route="route('dashboard.clinic.medications.create')"
            :title="__('translate.medications')"
            :header="__('translate.medications')"
        >
            <x-slot:filter>
                <x-dashboard.filter table-id="medications-table" :show-search="true" :show-date-range="true" :embedded="true" />
            </x-slot:filter>
        </x-data-table>
    </div>
@endsection
