@extends('dashboard.layouts.master')

@section('title', __('translate.edit_employee'))
@section('header', __('translate.edit_employee'))
@section('clinic_employees', 'active')
@section('breadcrumbs', Breadcrumbs::render('clinic.employees.edit', $employee))

@section('content')
    <div class="col-md-12">
        <x-forms.form route="dashboard.clinic.employees.update" :model="$employee" method="PUT" submitText="{{ __('translate.save') }}" formClass="form-horizontal" :title="__('translate.edit_employee')">

            <x-forms.input name="name" :label="__('translate.name')" required :value="$employee->name" col="col-md-12" />
            <x-forms.input name="phone" :label="__('translate.phone')" required :value="$employee->phone" col="col-md-6" />
            <x-forms.input type="email" name="email" :label="__('translate.email')" :value="$employee->email" col="col-md-6" />
            <x-forms.input type="password" name="password" :label="__('translate.password')" col="col-md-6" />
            <x-forms.input name="job_title" :label="__('translate.job_title')" required :value="$employee->job_title" col="col-md-6" />
            <x-forms.input type="number" name="salary" :label="__('translate.salary')" :value="$employee->salary" col="col-md-6" step="0.01" />
            <x-forms.input type="date" name="hire_date" :label="__('translate.hire_date')" required :value="$employee->hire_date?->format('Y-m-d')" col="col-md-6" />
            <x-forms.checkbox name="is_active" :label="__('translate.is_active')" :checked="$employee->is_active" col="col-md-6">{{ __('translate.is_active') }}</x-forms.checkbox>

        </x-forms.form>
    </div>
@endsection
