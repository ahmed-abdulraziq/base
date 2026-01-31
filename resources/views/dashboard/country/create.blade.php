@extends('dashboard.layouts.master')

@section('title', __('translate.create_country'))
@section('header', __('translate.create_country'))
@section('countries', 'active')
@section('breadcrumbs', Breadcrumbs::render('countries.create'))

@section('content')
    <div class="col-md-6">
        <x-forms.form 
            route="countries.store" 
            method="POST" 
            submitText="{{ __('translate.save') }}"
            formClass="form-horizontal" 
            :title="__('translate.create_country')">
            <!-- Code Field -->
            <x-forms.input name="code" label="{{ __('translate.code') }}" :value="old('code')" required maxlength="3"
                col="col-md-12" placeholder="{{ __('translate.enter_code') }}" />

            <!-- Name Field (Translatable) -->
            <x-forms.input name="name" label="{{ __('translate.name') }}" required col="col-md-12" translatable="true"
                :translations="old('name', [])" placeholder="{{ __('translate.enter_name') }}" />

        </x-forms.form>
    </div>
@endsection

