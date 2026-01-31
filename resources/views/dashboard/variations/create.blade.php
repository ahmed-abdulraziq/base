@extends('dashboard.layouts.master')

@section('title', __('translate.create_variation'))
@section('header', __('translate.create_variation'))
@section('breadcrumbs', Breadcrumbs::render('variations.create'))

@section('content')
    <div class="col-md-12">
        <x-forms.form route="variations.store" method="POST" submitText="{{ __('translate.save') }}" formClass="form-horizontal" :title="__('translate.create_variation')">
            
            <div class="hr-text text-primary fs-4">{{ __('translate.basic_information') }}</div>
            
            <x-forms.input translatable name="name" label="{{ __('translate.name') }}" required placeholder="{{ __('translate.enter_name') }}" />
            
            <div class="hr-text text-primary fs-4">{{ __('translate.settings') }}</div>

            <x-forms.select name="meal_id" label="{{ __('translate.meal') }}" model="Meal" required />
            
            <div class="hr-text text-primary fs-4">{{ __('translate.status') }}</div>
            
            <x-forms.checkbox name="active" label="{{ __('translate.active') }}" value="1" checked col="col-md-12">
                {{ __('translate.if_active_variation_is_available') }}
            </x-forms.checkbox>
            
        </x-forms.form>
    </div>
@endsection