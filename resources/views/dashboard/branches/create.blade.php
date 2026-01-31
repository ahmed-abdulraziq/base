@extends('dashboard.layouts.master')

@section('title', __('translate.create_branch'))
@section('header', __('translate.create_branch'))
@section('branches', 'active')
@section('breadcrumbs', Breadcrumbs::render('branches.create'))

@section('content')
    <div class="col-md-12">
        <x-forms.form route="branches.store" method="POST" submitText="{{ __('translate.save') }}" formClass="form-horizontal" :title="__('translate.create_branch')">
            
            <div class="hr-text text-primary fs-4">{{ __('translate.basic_information') }}</div>
            
            <x-forms.input translatable name="name" label="{{ __('translate.name') }}" required placeholder="{{ __('translate.enter_name') }}" />
            <x-forms.input translatable name="address" label="{{ __('translate.address') }}" />
            <x-forms.select name="restaurant_id" label="{{ __('translate.restaurant') }}" model="Restaurant" required />
            
            <div class="hr-text text-primary fs-4">{{ __('translate.contact_information') }}</div>
            
            <x-forms.input name="phone" label="{{ __('translate.phone') }}" col="col-md-6" />
            <x-forms.input name="delivery_number" label="{{ __('translate.delivery_number') }}" col="col-md-6" />
            <x-forms.input name="whatsapp_number" label="{{ __('translate.whatsapp_number') }}" col="col-md-6" />
            <x-forms.input name="complaints_number" label="{{ __('translate.complaints_number') }}" col="col-md-6" />
            
            <div class="hr-text text-primary fs-4">{{ __('translate.services') }}</div>
            
            <x-forms.checkbox name="active" label="{{ __('translate.active') }}" value="1" checked col="col-md-12">
                {{ __('translate.if_active_branch_is_open') }}
            </x-forms.checkbox>
            
            <div class="hr-text text-primary fs-4">{{ __('translate.costs_taxes') }}</div>
            
            <x-forms.input type="number" name="delivery_cost" label="{{ __('translate.delivery_cost') }}" col="col-md-4" />
            <x-forms.input type="number" name="min_delivery" label="{{ __('translate.min_delivery') }}" col="col-md-4" />
            <x-forms.input type="number" name="tax" label="{{ __('translate.tax') }}" col="col-md-4" />
            
        </x-forms.form>
    </div>
@endsection