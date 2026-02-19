@extends('dashboard.layouts.master')

@section('title', __('translate.edit_specialization'))
@section('header', __('translate.edit_specialization'))
@section('clinic_specializations', 'active')
@section('breadcrumbs', Breadcrumbs::render('clinic.specializations.edit', $specialization))

@section('content')
    <div class="col-md-12">
        <x-forms.form route="dashboard.clinic.specializations.update" :model="$specialization" method="PUT" submitText="{{ __('translate.save') }}" formClass="form-horizontal" :title="__('translate.edit_specialization')">

            <x-forms.input name="specialization_name" :label="__('translate.specialization_name')" required :value="$specialization->specialization_name" />
            <x-forms.textarea name="description" :label="__('translate.description')" :value="$specialization->description" col="col-12" />

        </x-forms.form>
    </div>
@endsection
