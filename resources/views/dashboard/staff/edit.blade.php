@extends('dashboard.layouts.master')

@section('title', __('translate.edit_staff'))
@section('header', __('translate.edit_staff'))
@section('staff', 'active')
@section('breadcrumbs', Breadcrumbs::render('staff.edit', $staff))

@section('content')
    <div class="col-md-12">
        <x-forms.form route="staff.update" model="{{ $staff->id }}" method="PUT" submitText="{{ __('translate.save') }}" formClass="form-horizontal" :title="__('translate.edit_staff')">
            
            <div class="hr-text text-primary fs-4">{{ __('translate.basic_information') }}</div>
            
            <x-forms.input name="name" label="{{ __('translate.name') }}" required placeholder="{{ __('translate.enter_name') }}" :value="old('name', $staff->name)" col="col-md-6" />
            <x-forms.input type="email" name="email" label="{{ __('translate.email') }}" required :value="old('email', $staff->email)" col="col-md-6" />
            <x-forms.input name="phone" label="{{ __('translate.phone') }}" required :value="old('phone', $staff->phone)" col="col-md-6" />
            <x-forms.input type="password" name="password" label="{{ __('translate.password') }}" col="col-md-6" placeholder="{{ __('translate.leave_blank_to_keep') }}" />
            
            <div class="hr-text text-primary fs-4">{{ __('translate.settings') }}</div>
            
            <x-forms.select name="branch_id" label="{{ __('translate.branch') }}" :options="$branches" required selected="{{ old('branch_id', $staff->branch_id) }}" />
            
            <div class="hr-text text-primary fs-4">{{ __('translate.status') }}</div>
            
            <x-forms.checkbox name="active" label="{{ __('translate.active') }}" value="1" :checked="old('active', $staff->active)" col="col-md-12">
                {{ __('translate.if_active_staff_can_login') }}
            </x-forms.checkbox>
            
        </x-forms.form>
    </div>
@endsection