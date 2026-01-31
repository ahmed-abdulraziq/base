@extends('dashboard.layouts.master')

@section('title', __('translate.edit_variation'))
@section('header', __('translate.edit_variation'))
@section('breadcrumbs', Breadcrumbs::render('variations.edit', $variation))

@section('content')
    <div class="col-md-12">
        <x-forms.form route="variations.update" model="{{ $variation->id }}" method="PUT" submitText="{{ __('translate.save') }}" formClass="form-horizontal" :title="__('translate.edit_variation')">
            
            <div class="hr-text text-primary fs-4">{{ __('translate.basic_information') }}</div>
            
            <x-forms.input translatable name="name" label="{{ __('translate.name') }}" required placeholder="{{ __('translate.enter_name') }}" :translations="old('name', $variation->getTranslationsArray())" />
            <x-forms.select name="meal_id" label="{{ __('translate.meal') }}" :options="$meals" required selected="{{ old('meal_id', $variation->meal_id) }}" />
            
            <div class="hr-text text-primary fs-4">{{ __('translate.settings') }}</div>
            
            <x-forms.input type="number" name="order" label="{{ __('translate.order') }}" :value="old('order', $variation->order)" col="col-md-6" />
            
            <div class="hr-text text-primary fs-4">{{ __('translate.status') }}</div>
            
            <x-forms.checkbox name="active" label="{{ __('translate.active') }}" value="1" :checked="old('active', $variation->active)" col="col-md-12">
                {{ __('translate.if_active_variation_is_available') }}
            </x-forms.checkbox>
            
        </x-forms.form>
    </div>
@endsection