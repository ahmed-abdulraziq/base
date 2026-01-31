@extends('dashboard.layouts.master')

@section('title', __('translate.create_category'))
@section('header', __('translate.create_category'))
@section('categories', 'active')
@section('breadcrumbs', Breadcrumbs::render('categories.create'))

@section('content')
    <div class="col-md-12">
        <x-forms.form route="categories.store" method="POST" submitText="{{ __('translate.save') }}" formClass="form-horizontal" :title="__('translate.create_category')">
            
            <div class="hr-text text-primary fs-4">{{ __('translate.basic_information') }}</div>
            
            <x-forms.input translatable name="name" label="{{ __('translate.name') }}" required placeholder="{{ __('translate.enter_name') }}" />
            <x-forms.slug name="slug" source="name_en" label="{{ __('translate.slug') }}" required col="col-md-6" placeholder="{{ __('translate.auto_generated_slug') }}" />
            <x-forms.textarea translatable name="description" label="{{ __('translate.description') }}" />
            <x-forms.tags-input translatable name="seo_meta" label="{{ __('translate.seo_meta') }}" tagsInput/>
            
            
            @if (auth()->user()->hasRole('super'))
            <div class="hr-text text-primary fs-4">{{ __('translate.settings') }}</div>

            <x-forms.select name="restaurant_id" label="{{ __('translate.restaurant') }}" model="Restaurant" required />
            @else
                <input type="hidden" name="restaurant_id" value="{{ auth()->user()->restaurant_id }}">
            @endif
            
            <div class="hr-text text-primary fs-4">{{ __('translate.status') }}</div>
            
            <x-forms.checkbox name="active" label="{{ __('translate.active') }}" value="1" checked col="col-md-6">
                {{ __('translate.if_active_category_is_visible') }}
            </x-forms.checkbox>
            <x-forms.checkbox name="featured" label="{{ __('translate.featured') }}" value="1" col="col-md-6">
                {{ __('translate.if_featured_category_is_highlighted') }}
            </x-forms.checkbox>
            
            <div class="hr-text text-primary fs-4">{{ __('translate.media') }}</div>
            
            <x-forms.input type="file" name="image" label="{{ __('translate.image') }}" accept="image/*" />
            
        </x-forms.form>
    </div>
@endsection