@extends('dashboard.layouts.master')

@section('title', __('translate.edit_medication'))
@section('header', __('translate.edit_medication'))
@section('clinic_medications', 'active')
@section('breadcrumbs', Breadcrumbs::render('clinic.medications.edit', $medication))

@section('content')
    <div class="col-md-12">
        <x-forms.form route="dashboard.clinic.medications.update" :model="$medication->medication_id" method="PUT" submitText="{{ __('translate.save') }}" formClass="form-horizontal" :title="__('translate.edit_medication')">

            <x-forms.input name="medication_name" :label="__('translate.medication_name')" required :value="$medication->medication_name" col="col-md-6" />
            <x-forms.input name="generic_name" :label="__('translate.generic_name')" :value="$medication->generic_name" col="col-md-6" />
            <x-forms.input name="manufacturer" :label="__('translate.manufacturer')" :value="$medication->manufacturer" col="col-md-6" />
            <x-forms.input name="type" :label="__('translate.medication_type')" :value="$medication->type" col="col-md-6" />
            <x-forms.input name="unit" :label="__('translate.unit')" :value="$medication->unit" col="col-md-6" />
            <x-forms.input type="number" name="price" :label="__('translate.price')" :value="$medication->price" col="col-md-6" step="0.01" />

        </x-forms.form>
    </div>
@endsection
