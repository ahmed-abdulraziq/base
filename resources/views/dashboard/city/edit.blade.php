@extends('dashboard.layouts.master')

@section('title', __('translate.edit_city'))
@section('header', __('translate.edit_city'))
@section('countries', 'active')
@section('breadcrumbs', Breadcrumbs::render('cities.edit', $city))

@section('content')
    <div class="col-md-6">
        <x-forms.form
            route="cities.update"
            method="PUT"
            :model="$city"
            submitText="{{ __('translate.update') }}"
            formClass="form-horizontal"
            :title="__('translate.edit_city')">

            <x-forms.select name="country_id" label="{{ __('translate.country') }}" required col="col-md-12"
                :options="$countries" :selected="old('country_id', $city->country_id)" placeholder="{{ __('translate.select_country') }}" />
                
            <x-forms.input name="name" label="{{ __('translate.name') }}" required col="col-md-12" translatable="true"
                :translations="old('name', $city->getTranslationsArray())" placeholder="{{ __('translate.enter_name') }}" />

        </x-forms.form>
    </div>
@endsection