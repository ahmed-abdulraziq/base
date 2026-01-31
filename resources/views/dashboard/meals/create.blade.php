@extends('dashboard.layouts.master')

@section('title', __('translate.create_meal'))
@section('header', __('translate.create_meal'))
@section('meals', 'active')
@section('breadcrumbs', Breadcrumbs::render('meals.create'))

@section('content')
    <div class="col-md-12">
        <x-forms.form route="meals.store" method="POST" submitText="{{ __('translate.save') }}" formClass="form-horizontal" :title="__('translate.create_meal')">
            
            <div class="hr-text text-primary fs-4">{{ __('translate.basic_information') }}</div>
            
            <x-forms.input translatable name="name" label="{{ __('translate.name') }}" required placeholder="{{ __('translate.enter_name') }}" />
            <x-forms.slug name="slug" source="name_en" label="{{ __('translate.slug') }}" required col="col-md-6" placeholder="{{ __('translate.auto_generated_slug') }}" />
            <x-forms.textarea translatable name="description" label="{{ __('translate.description') }}" />
            <x-forms.textarea translatable name="ingredients" label="{{ __('translate.ingredients') }}" />
            <x-forms.tags-input translatable name="tags" label="{{ __('translate.tags') }}" tagsInput/>
            <x-forms.tags-input translatable name="seo_meta" label="{{ __('translate.seo_meta') }}" tagsInput/>
            
            <div class="hr-text text-primary fs-4">{{ __('translate.settings') }}</div>
            
            @if (auth()->user()->hasRole('super'))            
                <x-forms.select name="restaurant_id" label="{{ __('translate.restaurant') }}" model="Restaurant" required />
            @else
                <input type="hidden" name="restaurant_id" value="{{ auth()->user()->restaurant_id }}">
            @endif
            <x-forms.select name="category_id" label="{{ __('translate.category') }}" model="Category" required dependsModel="Category" />
            <x-forms.select name="type" label="{{ __('translate.type') }}" :options="['single' => __('translate.single'), 'grouped' => __('translate.grouped')]" required col="col-md-6" />
            <x-forms.input type="number" name="price" label="{{ __('translate.price') }}" required col="col-md-6" />
            <x-forms.input type="number" name="discount_price" label="{{ __('translate.discount_price') }}" col="col-md-6" />
            <x-forms.input type="number" name="preparation_time" label="{{ __('translate.preparation_time') }}" col="col-md-6" suffix="minutes" />
            <x-forms.input type="number" name="calories" label="{{ __('translate.calories') }}" col="col-md-6" />
            
            <div class="hr-text text-primary fs-4">{{ __('translate.status') }}</div>
            
            <x-forms.checkbox name="active" label="{{ __('translate.active') }}" value="1" checked col="col-md-4">
                {{ __('translate.if_active_meal_is_visible') }}
            </x-forms.checkbox>
            <x-forms.checkbox name="recommended" label="{{ __('translate.recommended') }}" value="1" col="col-md-4">
                {{ __('translate.if_recommended_meal_is_highlighted') }}
            </x-forms.checkbox>
            <x-forms.checkbox name="featured" label="{{ __('translate.featured') }}" value="1" col="col-md-4">
                {{ __('translate.if_featured_meal_is_promoted') }}
            </x-forms.checkbox>
            <x-forms.checkbox name="available" label="{{ __('translate.available') }}" value="1" checked col="col-md-12">
                {{ __('translate.if_meal_is_available_for_order') }}
            </x-forms.checkbox>
            
            <div class="hr-text text-primary fs-4">{{ __('translate.media') }}</div>
            
            <x-forms.input type="file" name="images[]" label="{{ __('translate.images') }}" multiple />
            
        </x-forms.form>
    </div>
@endsection