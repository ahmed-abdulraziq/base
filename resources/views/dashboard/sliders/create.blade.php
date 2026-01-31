@extends('dashboard.layouts.master')

@section('title', __('translate.create_slider'))
@section('header', __('translate.create_slider'))
@section('sliders', 'active')
@section('breadcrumbs', Breadcrumbs::render('sliders.create'))

@section('content')
    <div class="col-md-12">
        <x-forms.form route="sliders.store" method="POST" submitText="{{ __('translate.save') }}" formClass="form-horizontal" :title="__('translate.create_slider')">
            
            <div class="hr-text text-primary fs-4">{{ __('translate.basic_information') }}</div>
            
            <x-forms.input translatable name="title" label="{{ __('translate.title') }}" required placeholder="{{ __('translate.enter_title') }}" />
            <x-forms.input translatable name="link" label="{{ __('translate.link') }}" placeholder="{{ __('translate.enter_link') }}" />
            
            @if (auth()->user()->hasRole('super'))
                <div class="hr-text text-primary fs-4">{{ __('translate.settings') }}</div>

                <x-forms.select name="restaurant_id" label="{{ __('translate.restaurant') }}" model="Restaurant" required />
            @else
                <input type="hidden" name="restaurant_id" value="{{ auth()->user()->restaurant_id }}">
            @endif
            
            <div class="hr-text text-primary fs-4">{{ __('translate.media') }}</div>   
               
            <x-forms.input translatable type="file" name="image" label="{{ __('translate.image') }}" required accept="image/*"/>
        </x-forms.form>
    </div>
@endsection