@extends('dashboard.layouts.master')

@section('title', __('translate.create_city'))
@section('header', __('translate.create_city'))
@section('countries', 'active')
@section('breadcrumbs', Breadcrumbs::render('cities.create'))

@section('content')
    <div class="col-md-6">
        <x-forms.form 
            route="cities.store" 
            method="POST" 
            submitText="{{ __('translate.save') }}"
            formClass="form-horizontal" 
            :title="__('translate.create_city')">
            <!-- Country Field -->
            <x-forms.select name="country_id" label="{{ __('translate.country') }}" required col="col-md-12"
                :options="$countries" :selected="old('country_id', request('country_id'))"
                 placeholder="{{ __('translate.select_country') }}" />
            <!-- Name Field (Translatable) -->
            <x-forms.input name="name" label="{{ __('translate.name') }}" required col="col-md-12" translatable="true"
                :translations="old('name', [])" placeholder="{{ __('translate.enter_name') }}" />

        </x-forms.form>
    </div>
@endsection

