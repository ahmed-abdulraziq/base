@extends('dashboard.layouts.master')

@section('title', __('translate.edit_meal'))
@section('header', __('translate.edit_meal'))
@section('meals', 'active')
@section('breadcrumbs', Breadcrumbs::render('meals.edit', $meal))

@section('content')
    <div class="col-md-12">
        <x-forms.form route="meals.update" model="{{ $meal->id }}" method="PUT" submitText="{{ __('translate.save') }}" formClass="form-horizontal" :title="__('translate.edit_meal')" enctype="multipart/form-data">
            
            <div class="hr-text text-primary fs-4">{{ __('translate.basic_information') }}</div>
            
            <x-forms.input translatable name="name" label="{{ __('translate.name') }}" required placeholder="{{ __('translate.enter_name') }}" :translations="old('name', $meal->getTranslationsArray())" />
            <x-forms.slug name="slug" source="name_en" label="{{ __('translate.slug') }}" required col="col-md-6" placeholder="{{ __('translate.auto_generated_slug') }}" :value="old('slug', $meal->slug)" />
            <x-forms.textarea translatable name="description" label="{{ __('translate.description') }}" :translations="old('description', $meal->getTranslationsArray())" />
            <x-forms.textarea translatable name="ingredients" label="{{ __('translate.ingredients') }}" :translations="old('ingredients', $meal->getTranslationsArray())" />
            <x-forms.tags-input translatable name="tags" label="{{ __('translate.tags') }}" :translations="old('tags', $meal->getTranslationsArray())" tagsInput/>
            <x-forms.tags-input translatable name="seo_meta" label="{{ __('translate.seo_meta') }}" :translations="old('seo_meta', $meal->getTranslationsArray())" tagsInput/>
            
            <div class="hr-text text-primary fs-4">{{ __('translate.settings') }}</div>
            
            <x-forms.select name="restaurant_id" label="{{ __('translate.restaurant') }}" :options="$restaurants" required selected="{{ old('restaurant_id', $meal->restaurant_id) }}" />
            <x-forms.select name="category_id" label="{{ __('translate.category') }}" model="Category" dependsField="restaurant_id" dependsModel="Restaurant" required selected="{{ old('category_id', $meal->category_id) }}" />
            <x-forms.select name="type" label="{{ __('translate.type') }}" :options="['single' => 'Single', 'grouped' => 'Grouped']" required selected="{{ old('type', $meal->type) }}" col="col-md-6" />
            <x-forms.input type="number" name="price" label="{{ __('translate.price') }}" required :value="old('price', $meal->price)" col="col-md-6" />
            <x-forms.input type="number" name="discount_price" label="{{ __('translate.discount_price') }}" :value="old('discount_price', $meal->discount_price)" col="col-md-6" />
            <x-forms.input type="number" name="preparation_time" label="{{ __('translate.preparation_time') }}" :value="old('preparation_time', $meal->preparation_time)" col="col-md-6" suffix="minutes" />
            <x-forms.input type="number" name="calories" label="{{ __('translate.calories') }}" :value="old('calories', $meal->calories)" col="col-md-6" />
            
            <div class="hr-text text-primary fs-4">{{ __('translate.status') }}</div>
            
            <x-forms.checkbox name="active" label="{{ __('translate.active') }}" value="1" :checked="old('active', $meal->active)" col="col-md-4">
                {{ __('translate.if_active_meal_is_visible') }}
            </x-forms.checkbox>
            <x-forms.checkbox name="recommended" label="{{ __('translate.recommended') }}" value="1" :checked="old('recommended', $meal->recommended)" col="col-md-4">
                {{ __('translate.if_recommended_meal_is_highlighted') }}
            </x-forms.checkbox>
            <x-forms.checkbox name="featured" label="{{ __('translate.featured') }}" value="1" :checked="old('featured', $meal->featured)" col="col-md-4">
                {{ __('translate.if_featured_meal_is_promoted') }}
            </x-forms.checkbox>
            <x-forms.checkbox name="available" label="{{ __('translate.available') }}" value="1" :checked="old('available', $meal->available)" col="col-md-12">
                {{ __('translate.if_meal_is_available_for_order') }}
            </x-forms.checkbox>
            
            <div class="hr-text text-primary fs-4">{{ __('translate.media') }}</div>
            
            <x-forms.input type="file" name="images[]" label="{{ __('translate.images') }}" multiple />
            @if($meal->images && count($meal->images) > 0)
                <div class="form-group">
                    <label>{{ __('translate.current_images') }}</label>
                    <div class="d-flex flex-wrap">
                        @foreach($meal->images as $image)
                            <img src="{{ $image->url }}" alt="Meal Image" class="img-thumbnail mr-2 mb-2" style="max-height: 100px;">
                        @endforeach
                    </div>
                </div>
            @endif
            
        </x-forms.form>
    </div>
@endsection