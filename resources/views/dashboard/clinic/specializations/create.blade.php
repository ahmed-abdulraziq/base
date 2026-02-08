@extends('dashboard.layouts.master')

@section('title', __('translate.create_specialization'))
@section('header', __('translate.create_specialization'))
@section('clinic_specializations', 'active')
@section('breadcrumbs', Breadcrumbs::render('clinic.specializations.create'))

@section('content')
    <div class="col-md-12">
        <x-forms.form route="dashboard.clinic.specializations.store" method="POST" submitText="{{ __('translate.save') }}" formClass="form-horizontal" :title="__('translate.create_specialization')">

            <x-forms.input name="specialization_name" :label="__('translate.specialization_name')" required placeholder="{{ __('translate.specialization_name') }}" />
            <x-forms.textarea name="description" :label="__('translate.description')" col="col-12" />

        </x-forms.form>
    </div>
@endsection
