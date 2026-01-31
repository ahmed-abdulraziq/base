@extends('dashboard.layouts.master')

@section('title', __('translate.edit_category'))
@section('header', __('translate.edit_category'))
@section('categories', 'active')
@section('breadcrumbs', Breadcrumbs::render('categories.edit', $category))

@section('content')
    <div class="col-md-12">
        <x-forms.form route="categories.update" model="{{ $category->id }}" method="PUT" submitText="{{ __('translate.save') }}" formClass="form-horizontal" :title="__('translate.edit_category')" enctype="multipart/form-data">
            
            <div class="hr-text text-primary fs-4">{{ __('translate.basic_information') }}</div>
            
            <x-forms.input translatable name="name" label="{{ __('translate.name') }}" required placeholder="{{ __('translate.enter_name') }}" :translations="old('name', $category->getTranslationsArray())" />
            <x-forms.slug name="slug" source="name_en" label="{{ __('translate.slug') }}" required col="col-md-6" placeholder="{{ __('translate.auto_generated_slug') }}" :value="old('slug', $category->slug)" />
            <x-forms.textarea translatable name="description" label="{{ __('translate.description') }}" :translations="old('description', $category->getTranslationsArray())" />
            <x-forms.tags-input translatable name="seo_meta" label="{{ __('translate.seo_meta') }}" :translations="old('seo_meta', $category->getTranslationsArray())" tagsInput/>
            
            <div class="hr-text text-primary fs-4">{{ __('translate.status') }}</div>
            
            <x-forms.checkbox name="active" label="{{ __('translate.active') }}" value="1" :checked="old('active', $category->active)" col="col-md-6">
                {{ __('translate.if_active_category_is_visible') }}
            </x-forms.checkbox>
            <x-forms.checkbox name="featured" label="{{ __('translate.featured') }}" value="1" :checked="old('featured', $category->featured)" col="col-md-6">
                {{ __('translate.if_featured_category_is_highlighted') }}
            </x-forms.checkbox>
            
            <div class="hr-text text-primary fs-4">{{ __('translate.media') }}</div>
            {{-- @dd($category->image->path) --}}

            <x-forms.input type="file" name="image" label="{{ __('translate.image') }}" accept="image/*" value="{{ old('image', $category->image) }}" />

            
        </x-forms.form>
    </div>
@endsection