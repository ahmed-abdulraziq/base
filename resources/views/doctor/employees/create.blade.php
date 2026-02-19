@extends('doctor.layouts.master')
@section('title', __('translate.create_employee'))
@section('header', __('translate.create_employee'))
@section('doctor_employees', 'active')
@section('breadcrumbs', Breadcrumbs::render('doctor.employees.create'))

@section('content')
    <div class="col-md-12">
        <x-forms.form route="doctor.employees.store" method="POST" submitText="{{ __('translate.save') }}" formClass="form-horizontal" :title="__('translate.create_employee')">
            <x-forms.input name="name" :label="__('translate.name')" required col="col-md-12" />
            <x-forms.input name="phone" :label="__('translate.phone')" required col="col-md-6" />
            <x-forms.input type="email" name="email" :label="__('translate.email')" col="col-md-6" />
            <x-forms.input type="password" name="password" :label="__('translate.password')" required col="col-md-6" />
            <x-forms.input name="job_title" :label="__('translate.job_title')" required col="col-md-6" />
            <x-forms.input type="number" name="salary" :label="__('translate.salary')" col="col-md-6" step="0.01" />
            <x-forms.input type="date" name="hire_date" :label="__('translate.hire_date')" required col="col-md-6" />
            <x-forms.checkbox name="is_active" :label="__('translate.is_active')" :checked="true" col="col-md-6">{{ __('translate.is_active') }}</x-forms.checkbox>
        </x-forms.form>
        <p class="text-muted small mt-2">@lang('translate.employee_added_pending_approval_note')</p>
    </div>
@endsection
