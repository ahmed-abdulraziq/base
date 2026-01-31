@extends('dashboard.layouts.master')

@section('title', __('translate.create_staff'))
@section('header', __('translate.create_staff'))
@section('staff', 'active')
@section('breadcrumbs', Breadcrumbs::render('staff.create'))

@section('content')
    <div class="col-md-12">
        <x-forms.form route="staff.store" method="POST" submitText="{{ __('translate.save') }}" formClass="form-horizontal" :title="__('translate.create_staff')">
            
            <div class="hr-text text-primary fs-4">{{ __('translate.basic_information') }}</div>
            
            <x-forms.input name="name" label="{{ __('translate.name') }}" required placeholder="{{ __('translate.enter_name') }}" col="col-md-6" />
            <x-forms.input type="email" name="email" label="{{ __('translate.email') }}" required col="col-md-6" />
            <x-forms.input name="phone" label="{{ __('translate.phone') }}" required col="col-md-6" />
            <x-forms.input type="password" name="password" label="{{ __('translate.password') }}" required col="col-md-6" />
            
            <div class="hr-text text-primary fs-4">{{ __('translate.settings') }}</div>
            
            <x-forms.select name="branch_id" label="{{ __('translate.branch') }}" model="Branch" required />
            
            <div class="hr-text text-primary fs-4">{{ __('translate.status') }}</div>
            
            <x-forms.checkbox name="active" label="{{ __('translate.active') }}" value="1" checked col="col-md-12">
                {{ __('translate.if_active_staff_can_login') }}
            </x-forms.checkbox>
            
        </x-forms.form>
    </div>
@endsection