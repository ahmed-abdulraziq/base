@extends('dashboard.layouts.master')

@section('title', __('translate.edit_slider'))
@section('header', __('translate.edit_slider'))
@section('sliders', 'active')
@section('breadcrumbs', Breadcrumbs::render('sliders.edit', $slider))

@section('content')
    <div class="col-md-12">
        <x-forms.form route="sliders.update" model="{{ $slider->id }}" method="PUT" submitText="{{ __('translate.save') }}" formClass="form-horizontal" :title="__('translate.edit_slider')" enctype="multipart/form-data">
            
            <div class="hr-text text-primary fs-4">{{ __('translate.basic_information') }}</div>
            
            <x-forms.input translatable name="title" label="{{ __('translate.title') }}" required placeholder="{{ __('translate.enter_title') }}" :translations="old('title', $slider->getTranslationsArray())" />
            <x-forms.input translatable name="link" label="{{ __('translate.link') }}" placeholder="{{ __('translate.enter_link') }}" :translations="old('link', $slider->getTranslationsArray())" />

            <div class="hr-text text-primary fs-4">{{ __('translate.media') }}</div>
            
            <x-forms.input translatable type="file" name="image" label="{{ __('translate.image') }}" accept="image/*" :value="old('image', $slider->getTranslationsArray())" />
            
        </x-forms.form>
    </div>
@endsection