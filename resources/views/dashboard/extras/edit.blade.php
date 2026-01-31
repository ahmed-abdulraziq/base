@extends('dashboard.layouts.master')

@section('title', __('translate.edit_extra'))
@section('header', __('translate.edit_extra'))
@section('meals', 'active')
@section('breadcrumbs', Breadcrumbs::render('extras.edit', $extra))

@section('content')
    <div class="col-md-12">
        <x-forms.form route="extras.update" model="{{ $extra->id }}" method="PUT" submitText="{{ __('translate.save') }}" formClass="form-horizontal" :title="__('translate.edit_extra')">
            
            <div class="hr-text text-primary fs-4">{{ __('translate.basic_information') }}</div>
            
            <x-forms.input translatable name="name" label="{{ __('translate.name') }}" required placeholder="{{ __('translate.enter_name') }}" :translations="old('name', $extra->getTranslationsArray())" />
            
            <div class="hr-text text-primary fs-4">{{ __('translate.settings') }}</div>
            
            <x-forms.select name="meal_id" label="{{ __('translate.meal') }}" :options="$meals" required selected="{{ old('meal_id', $extra->meal_id) }}" />
            <x-forms.input type="number" name="price" label="{{ __('translate.price') }}" required :value="old('price', $extra->price)" col="col-md-6" />
            <x-forms.input type="number" name="order" label="{{ __('translate.order') }}" :value="old('order', $extra->order)" col="col-md-6" />
            
            <div class="hr-text text-primary fs-4">{{ __('translate.status') }}</div>
            
            <x-forms.checkbox name="active" label="{{ __('translate.active') }}" value="1" :checked="old('active', $extra->active)" col="col-md-12">
                {{ __('translate.if_active_extra_is_available') }}
            </x-forms.checkbox>
            
        </x-forms.form>
    </div>
@endsection