@extends('dashboard.layouts.master')

@section('title', __('translate.edit_table'))
@section('header', __('translate.edit_table'))
@section('tables', 'active')
@section('breadcrumbs', Breadcrumbs::render('tables.edit', $table))

@section('content')
    <div class="col-md-12">
        <x-forms.form route="tables.update" model="{{ $table->id }}" method="PUT" submitText="{{ __('translate.save') }}" formClass="form-horizontal" :title="__('translate.edit_table')" enctype="multipart/form-data">
            
            <div class="hr-text text-primary fs-4">{{ __('translate.basic_information') }}</div>
            
            <x-forms.select name="restaurant_id" label="{{ __('translate.restaurant') }}" :options="$restaurants" required selected="{{ old('restaurant_id', $table->restaurant_id) }}" />
            <x-forms.input name="num" label="{{ __('translate.number') }}" placeholder="{{ __('translate.enter_table_number') }}" :value="old('num', $table->num)" col="col-md-6" />
            <x-forms.select name="status" label="{{ __('translate.status') }}" :options="['available' => 'Available', 'occupied' => 'Occupied', 'reserved' => 'Reserved']" selected="{{ old('status', $table->status) }}" col="col-md-6" />
            
            <div class="hr-text text-primary fs-4">{{ __('translate.qr_code') }}</div>
            
            <x-forms.input type="file" name="qr_code" label="{{ __('translate.qr_code_image') }}" col="col-md-6" />
            @if($table->qr_code)
                <div class="form-group">
                    <label>{{ __('translate.current_qr_code') }}</label>
                    <div>
                        <img src="{{ $table->qr_code->url }}" alt="Table QR Code" class="img-thumbnail" style="max-height: 100px;">
                    </div>
                </div>
            @endif
            
        </x-forms.form>
    </div>
@endsection