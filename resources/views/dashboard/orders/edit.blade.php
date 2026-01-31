@extends('dashboard.layouts.master')

@section('title', __('translate.edit_order'))
@section('header', __('translate.edit_order'))
@section('orders', 'active')
@section('breadcrumbs', Breadcrumbs::render('orders.edit', $order))

@section('content')
    <div class="col-md-12">
        <x-forms.form route="orders.update" model="{{ $order->id }}" method="PUT" submitText="{{ __('translate.save') }}" formClass="form-horizontal" :title="__('translate.edit_order')">
            
            <div class="hr-text text-primary fs-4">{{ __('translate.basic_information') }}</div>
            
            <x-forms.select name="restaurant_id" label="{{ __('translate.restaurant') }}" :options="$restaurants" required selected="{{ old('restaurant_id', $order->restaurant_id) }}" />
            <x-forms.select name="user_id" label="{{ __('translate.user') }}" :options="$users" selected="{{ old('user_id', $order->user_id) }}" />
            <x-forms.select name="branch_id" label="{{ __('translate.branch') }}" :options="$branches" selected="{{ old('branch_id', $order->branch_id) }}" />
            <x-forms.select name="type" label="{{ __('translate.type') }}" :options="['delivery' => 'Delivery', 'takeaway' => 'Takeaway', 'dine_in' => 'Dine In']" selected="{{ old('type', $order->type) }}" col="col-md-6" />
            <x-forms.select name="status" label="{{ __('translate.status') }}" :options="['pending' => 'Pending', 'processing' => 'Processing', 'completed' => 'Completed', 'cancelled' => 'Cancelled']" selected="{{ old('status', $order->status) }}" col="col-md-6" />
            
            <div class="hr-text text-primary fs-4">{{ __('translate.order_details') }}</div>
            
            <x-forms.input type="number" name="subtotal" label="{{ __('translate.subtotal') }}" :value="old('subtotal', $order->subtotal)" col="col-md-4" />
            <x-forms.input type="number" name="delivery_cost" label="{{ __('translate.delivery_cost') }}" :value="old('delivery_cost', $order->delivery_cost)" col="col-md-4" />
            <x-forms.input type="number" name="total" label="{{ __('translate.total') }}" :value="old('total', $order->total)" col="col-md-4" />
            <x-forms.input name="coupon_code" label="{{ __('translate.coupon_code') }}" :value="old('coupon_code', $order->coupon_code)" col="col-md-6" />
            <x-forms.textarea name="notes" label="{{ __('translate.notes') }}" :value="old('notes', $order->notes)" col="col-md-6" />
            
            <!-- Order Items would be added dynamically via JavaScript -->
            
        </x-forms.form>
    </div>
@endsection