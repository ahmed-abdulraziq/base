@extends('dashboard.layouts.master')

@section('title', __('translate.create_table'))
@section('header', __('translate.create_table'))
@section('tables', 'active')
@section('breadcrumbs', Breadcrumbs::render('tables.create'))

@section('content')
    <div class="col-md-12">
        <x-forms.form route="tables.store" method="POST" submitText="{{ __('translate.save') }}" formClass="form-horizontal" :title="__('translate.create_table')">
            
            <div class="hr-text text-primary fs-4">{{ __('translate.basic_information') }}</div>
            
            <x-forms.select name="restaurant_id" label="{{ __('translate.restaurant') }}" model="Restaurant" required />
            <x-forms.input name="num" label="{{ __('translate.number') }}" placeholder="{{ __('translate.enter_table_number') }}" col="col-md-6" />
            <x-forms.select name="status" label="{{ __('translate.status') }}" :options="['available' => 'Available', 'occupied' => 'Occupied', 'reserved' => 'Reserved']" col="col-md-6" />
            
            <div class="hr-text text-primary fs-4">{{ __('translate.qr_code') }}</div>
            
            <x-forms.input type="file" name="qr_code" label="{{ __('translate.qr_code_image') }}" col="col-md-6" />
            
        </x-forms.form>
    </div>
@endsection