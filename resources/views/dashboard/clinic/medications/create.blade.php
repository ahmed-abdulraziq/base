@extends('dashboard.layouts.master')

@section('title', __('translate.create_medication'))
@section('header', __('translate.create_medication'))
@section('clinic_medications', 'active')
@section('breadcrumbs', Breadcrumbs::render('clinic.medications.create'))

@section('content')
    <div class="col-md-12">
        <x-forms.form route="dashboard.clinic.medications.store" method="POST" submitText="{{ __('translate.save') }}" formClass="form-horizontal" :title="__('translate.create_medication')">

            <x-forms.input name="medication_name" :label="__('translate.medication_name')" required col="col-md-6" />
            <x-forms.input name="generic_name" :label="__('translate.generic_name')" col="col-md-6" />
            <x-forms.input name="manufacturer" :label="__('translate.manufacturer')" col="col-md-6" />
            <x-forms.input name="type" :label="__('translate.medication_type')" col="col-md-6" placeholder="مثال: مضاد حيوي، مسكن" />
            <x-forms.input name="unit" :label="__('translate.unit')" col="col-md-6" placeholder="مثال: قرص، شراب" />
            <x-forms.input type="number" name="price" :label="__('translate.price')" col="col-md-6" step="0.01" />

        </x-forms.form>
    </div>
@endsection
