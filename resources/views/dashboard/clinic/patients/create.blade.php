@extends('dashboard.layouts.master')

@section('title', __('translate.create_patient'))
@section('header', __('translate.create_patient'))
@section('clinic_patients', 'active')
@section('breadcrumbs', Breadcrumbs::render('clinic.patients.create'))

@section('content')
    <div class="col-md-12">
        <x-forms.form route="dashboard.clinic.patients.store" method="POST" submitText="{{ __('translate.save') }}" formClass="form-horizontal" :title="__('translate.create_patient')">

            <div class="hr-text text-primary fs-4">{{ __('translate.basic_information') }}</div>
            <x-forms.input name="first_name" :label="__('translate.first_name')" required col="col-md-6" />
            <x-forms.input name="last_name" :label="__('translate.last_name')" required col="col-md-6" />
            <x-forms.input type="date" name="date_of_birth" :label="__('translate.date_of_birth')" required col="col-md-6" />
            <div class="col-md-6 mb-3">
                <label class="form-label">{{ __('translate.gender') }} <span class="text-danger">*</span></label>
                <select name="gender" class="form-select" required>
                    <option value="">{{ __('translate.select_option') }}</option>
                    <option value="ذكر">ذكر</option>
                    <option value="أنثى">أنثى</option>
                </select>
            </div>
            <x-forms.input name="phone" :label="__('translate.phone')" required col="col-md-6" />
            <x-forms.input type="email" name="email" :label="__('translate.email')" col="col-md-6" />
            <x-forms.textarea name="address" :label="__('translate.address')" col="col-12" />

            <div class="hr-text text-primary fs-4">{{ __('translate.medical_info') }}</div>
            <x-forms.input name="blood_type" :label="__('translate.blood_type')" col="col-md-6" placeholder="مثال: A+" />
            <x-forms.textarea name="allergies" :label="__('translate.allergies')" col="col-md-6" />
            <x-forms.textarea name="medical_history" :label="__('translate.medical_history')" col="col-12" />

            <div class="hr-text text-primary fs-4">{{ __('translate.emergency_contact') }}</div>
            <x-forms.input name="emergency_contact_name" :label="__('translate.emergency_contact_name')" col="col-md-6" />
            <x-forms.input name="emergency_contact_phone" :label="__('translate.emergency_contact_phone')" col="col-md-6" />

        </x-forms.form>
    </div>
@endsection
