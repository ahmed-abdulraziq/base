@extends('dashboard.layouts.master')

@section('title', __('translate.edit_patient'))
@section('header', __('translate.edit_patient'))
@section('clinic_patients', 'active')
@section('breadcrumbs', Breadcrumbs::render('clinic.patients.edit', $patient))

@section('content')
    <div class="col-md-12">
        <x-forms.form route="dashboard.clinic.patients.update" :model="$patient->id" method="PUT" submitText="{{ __('translate.save') }}" formClass="form-horizontal" :title="__('translate.edit_patient')">

            <div class="hr-text text-primary fs-4">{{ __('translate.basic_information') }}</div>
            <x-forms.input name="name" :label="__('translate.name')" required :value="$patient->name" col="col-md-12" />
            <x-forms.input type="date" name="date_of_birth" :label="__('translate.date_of_birth')" required :value="$patient->date_of_birth?->format('Y-m-d')" col="col-md-6" />
            <div class="col-md-6 mb-3">
                <label class="form-label">{{ __('translate.gender') }} <span class="text-danger">*</span></label>
                <select name="gender" class="form-select" required>
                    @foreach(\App\Enums\Gender::cases() as $case)
                        <option value="{{ $case->value }}" {{ $patient->gender === $case ? 'selected' : '' }}>{{ $case->label() }}</option>
                    @endforeach
                </select>
            </div>
            <x-forms.input name="phone" :label="__('translate.phone')" required :value="$patient->phone" col="col-md-6" />
            <x-forms.input type="email" name="email" :label="__('translate.email')" :value="$patient->email" col="col-md-6" />
            <x-forms.textarea name="address" :label="__('translate.address')" :value="$patient->address" col="col-12" />

            <div class="hr-text text-primary fs-4">{{ __('translate.medical_info') }}</div>
            <x-forms.input name="blood_type" :label="__('translate.blood_type')" :value="$patient->blood_type" col="col-md-6" />
            <x-forms.textarea name="allergies" :label="__('translate.allergies')" :value="$patient->allergies" col="col-md-6" />
            <x-forms.textarea name="medical_history" :label="__('translate.medical_history')" :value="$patient->medical_history" col="col-12" />

            <div class="hr-text text-primary fs-4">{{ __('translate.emergency_contact') }}</div>
            <x-forms.input name="emergency_contact_name" :label="__('translate.emergency_contact_name')" :value="$patient->emergency_contact_name" col="col-md-6" />
            <x-forms.input name="emergency_contact_phone" :label="__('translate.emergency_contact_phone')" :value="$patient->emergency_contact_phone" col="col-md-6" />

        </x-forms.form>
    </div>
@endsection
