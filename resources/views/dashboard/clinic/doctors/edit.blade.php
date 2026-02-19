@extends('dashboard.layouts.master')

@section('title', __('translate.edit_doctor'))
@section('header', __('translate.edit_doctor'))
@section('clinic_doctors', 'active')
@section('breadcrumbs', Breadcrumbs::render('clinic.doctors.edit', $doctor))

@section('content')
    <div class="col-md-12">
        @if (!$doctor->approved_at)
            <div class="alert alert-warning mb-3">
                @lang('translate.doctor_pending_approval')
                <form action="{{ route('dashboard.clinic.doctors.approve', $doctor->id) }}" method="POST" class="d-inline ms-2">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-success">@lang('translate.approve')</button>
                </form>
            </div>
        @endif
        <x-forms.form route="dashboard.clinic.doctors.update" :model="$doctor->id" method="PUT" submitText="{{ __('translate.save') }}" formClass="form-horizontal" :title="__('translate.edit_doctor')">

            <div class="hr-text text-primary fs-4">{{ __('translate.basic_information') }}</div>
            <x-forms.input name="name" :label="__('translate.name')" required :value="$doctor->name" col="col-md-12" />
            <x-forms.input name="phone" :label="__('translate.phone')" required :value="$doctor->phone" col="col-md-6" />
            <x-forms.input type="email" name="email" :label="__('translate.email')" :value="$doctor->email" col="col-md-6" />
            <x-forms.select name="specialization_id" :label="__('translate.specialization')" :options="$specializations" :selected="$doctor->specialization_id" col="col-md-6" />
            <x-forms.input name="license_number" :label="__('translate.license_number')" required :value="$doctor->license_number" col="col-md-6" />
            <div class="col-md-6">
                <x-forms.input type="password" name="password" :label="__('translate.password')" col="col-md-12" />
                <small class="form-hint text-muted">{{ __('translate.leave_blank_to_keep') }}</small>
            </div>
            <div class="col-md-6">
                <x-forms.input type="password" name="password_confirmation" :label="__('translate.password_confirmation')" col="col-md-12" />
            </div>

            <div class="hr-text text-primary fs-4">{{ __('translate.professional_info') }}</div>
            <x-forms.input type="number" name="years_of_experience" :label="__('translate.years_of_experience')" :value="$doctor->years_of_experience" col="col-md-6" />
            <x-forms.input type="number" name="consultation_fee" :label="__('translate.consultation_fee')" :value="$doctor->consultation_fee" col="col-md-6" step="0.01" />
            <x-forms.input type="date" name="hire_date" :label="__('translate.hire_date')" required :value="$doctor->hire_date?->format('Y-m-d')" col="col-md-6" />
            <x-forms.checkbox name="is_active" :label="__('translate.is_active')" :checked="$doctor->is_active" col="col-md-6">{{ __('translate.is_active') }}</x-forms.checkbox>

        </x-forms.form>
    </div>
@endsection
