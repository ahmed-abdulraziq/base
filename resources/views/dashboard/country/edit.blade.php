@extends('dashboard.layouts.master')

@section('title', __('translate.edit_country'))
@section('header', __('translate.edit_country'))
@section('countries', 'active')
@section('breadcrumbs', Breadcrumbs::render('countries.edit', $country))

@section('content')
    <div class="col-md-6">
        <x-forms.form
            route="countries.update"
            method="PUT"
            :model="$country"
            submitText="{{ __('translate.update') }}"
            formClass="form-horizontal"
            :title="__('translate.edit_country')">

            <x-forms.input name="code" label="{{ __('translate.code') }}" :value="old('code', $country->code)" required maxlength="3"
                col="col-md-12" placeholder="{{ __('translate.enter_code') }}" />
            <x-forms.input name="name" label="{{ __('translate.name') }}" required col="col-md-12" translatable="true"
                :translations="old('name', $country->getTranslationsArray())" placeholder="{{ __('translate.enter_name') }}" />

        </x-forms.form>
    </div>
@endsection