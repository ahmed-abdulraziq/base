@extends('dashboard.layouts.master')

@section('title', __('translate.create_order'))
@section('header', __('translate.create_order'))
@section('orders', 'active')
@section('breadcrumbs', Breadcrumbs::render('orders.create'))

@section('content')
    <div class="col-md-12">
        <x-forms.form route="orders.store" method="POST" submitText="{{ __('translate.save') }}" formClass="form-horizontal" :title="__('translate.create_order')">
            
            <div class="hr-text text-primary fs-4">{{ __('translate.basic_information') }}</div>
            
            <x-forms.select name="restaurant_id" label="{{ __('translate.restaurant') }}" model="Restaurant" required />
            <x-forms.select name="user_id" label="{{ __('translate.user') }}" model="User" />
            <x-forms.select name="branch_id" label="{{ __('translate.branch') }}" model="Branch" dependsField="restaurant_id" dependsModel="Restaurant" />
            <x-forms.select name="type" label="{{ __('translate.type') }}" :options="['delivery' => 'Delivery', 'takeaway' => 'Takeaway', 'dine_in' => 'Dine In']" col="col-md-6" />
            <x-forms.select name="status" label="{{ __('translate.status') }}" :options="['pending' => 'Pending', 'processing' => 'Processing', 'completed' => 'Completed', 'cancelled' => 'Cancelled']" col="col-md-6" />
            
            <div class="hr-text text-primary fs-4">{{ __('translate.order_details') }}</div>
            
            <x-forms.input type="number" name="subtotal" label="{{ __('translate.subtotal') }}" col="col-md-4" />
            <x-forms.input type="number" name="delivery_cost" label="{{ __('translate.delivery_cost') }}" col="col-md-4" />
            <x-forms.input type="number" name="total" label="{{ __('translate.total') }}" col="col-md-4" />
            <x-forms.input name="coupon_code" label="{{ __('translate.coupon_code') }}" col="col-md-6" />
            <x-forms.textarea name="notes" label="{{ __('translate.notes') }}" col="col-md-6" />
            
            <!-- Order Items would be added dynamically via JavaScript -->
            
        </x-forms.form>
    </div>
@endsection