@extends('dashboard.layouts.master')

@section('title', __('translate.create_doctor'))
@section('header', __('translate.create_doctor'))
@section('clinic_doctors', 'active')
@section('breadcrumbs', Breadcrumbs::render('clinic.doctors.create'))

@section('content')
    <div class="col-md-12">
        <x-forms.form route="dashboard.clinic.doctors.store" method="POST" submitText="{{ __('translate.save') }}" formClass="form-horizontal" :title="__('translate.create_doctor')">

            <div class="hr-text text-primary fs-4">{{ __('translate.basic_information') }}</div>
            <x-forms.input name="name" :label="__('translate.name')" required col="col-md-12" />
            <x-forms.input name="phone" :label="__('translate.phone')" required col="col-md-6" />
            <x-forms.input type="email" name="email" :label="__('translate.email')" col="col-md-6" />
            <x-forms.select name="specialization_id" :label="__('translate.specialization')" :options="$specializations" col="col-md-6" />
            <x-forms.input name="license_number" :label="__('translate.license_number')" required col="col-md-6" />
            <x-forms.input type="password" name="password" :label="__('translate.password')" required col="col-md-6" />
            <x-forms.input type="password" name="password_confirmation" :label="__('translate.password_confirmation')" required col="col-md-6" />

            <div class="hr-text text-primary fs-4">{{ __('translate.professional_info') }}</div>
            <x-forms.input type="number" name="years_of_experience" :label="__('translate.years_of_experience')" col="col-md-6" />
            <x-forms.input type="number" name="consultation_fee" :label="__('translate.consultation_fee')" col="col-md-6" step="0.01" />
            <x-forms.input type="date" name="hire_date" :label="__('translate.hire_date')" required col="col-md-6" />
            <x-forms.checkbox name="is_active" :label="__('translate.is_active')" :checked="true" col="col-md-6">{{ __('translate.is_active') }}</x-forms.checkbox>

        </x-forms.form>
    </div>
@endsection
