@extends('dashboard.layouts.master')

@section('title', __('translate.edit_restaurant'))
@section('header', __('translate.edit_restaurant'))
@section('restaurants', 'active')
@section('breadcrumbs', Breadcrumbs::render('restaurants.edit', $restaurant))

@section('content')
    <div class="col-md-12">

        <x-forms.form route="restaurants.update" model="{{ $restaurant->id }}" method="PUT" submitText="{{ __('translate.save') }}" formClass="form-horizontal" :title="__('translate.edit_restaurant')" enctype="multipart/form-data">

            </ul>
            <div class="hr-text text-primary fs-4">{{ __('translate.basic_information') }}</div>

            <x-forms.input translatable name="name" label="{{ __('translate.name') }}" required placeholder="{{ __('translate.enter_name') }}" :translations="old('name', $restaurant->getTranslationsArray())" />
            <x-forms.slug name="slug" source="name_en" label="{{ __('translate.slug') }}" required col="col-md-6" placeholder="{{ __('translate.auto_generated_slug') }}" :value="old('slug', $restaurant->slug)" />
                <x-forms.input translatable name="address" label="{{ __('translate.address') }}" :translations="old('address', $restaurant->getTranslationsArray())" />
                    <x-forms.input translatable name="currency" label="{{ __('translate.currency') }}" :translations="old('currency', $restaurant->getTranslationsArray())" />
                <x-forms.textarea translatable name="description" label="{{ __('translate.description') }}" :translations="old('description', $restaurant->getTranslationsArray())" />
                {{-- <x-forms.textarea translatable name="seo_meta" label="{{ __('translate.seo_meta') }}" :translations="old('seo_meta', $restaurant->getTranslationsArray())" /> --}}
                <x-forms.tags-input translatable name="seo_meta" label="{{ __('translate.seo_meta') }}" :translations="old('seo_meta', $restaurant->getTranslationsArray())" tagsInput/>


            <div class="hr-text text-primary fs-4">{{ __('translate.location') }}</div>

            <x-forms.select name="country_id" label="{{ __('translate.country') }}" :options="$countries" required selected="{{ old('country_id', $restaurant->country_id) }}" col="col-md-6" />
            <x-forms.select name="city_id" label="{{ __('translate.city') }}" model="City" dependsField="country_id" required selected="{{ old('city_id', $restaurant->city_id) }}" col="col-md-6" />

            <div class="hr-text text-primary fs-4">{{ __('translate.contact_information') }}</div>

            <x-forms.input name="phone" label="{{ __('translate.phone') }}" :value="$restaurant->phone" col="col-md-6" />
            <x-forms.input name="delivery_number" label="{{ __('translate.delivery_number') }}" :value="$restaurant->delivery_number" col="col-md-6" />
            <x-forms.input name="whatsapp_number" label="{{ __('translate.whatsapp_number') }}" :value="$restaurant->whatsapp_number" col="col-md-6" />
            <x-forms.input name="complaints_number" label="{{ __('translate.complaints_number') }}" :value="$restaurant->complaints_number" col="col-md-6" />

            <div class="hr-text text-primary fs-4">{{ __('translate.services') }}</div>

            <x-forms.checkbox name="active" label="{{ __('translate.active') }}" value="1" :checked="$restaurant->active" col="col-md-12">
                {{ __('translate.if_active_restaurant_is_open') }}
            </x-forms.checkbox>
            <x-forms.checkbox name="takeaway" label="{{ __('translate.takeaway') }}" value="1" :checked="$restaurant->takeaway" col="col-md-6">
                {{ __('translate.if_takeaway_is_available') }}
            </x-forms.checkbox>
            <x-forms.checkbox name="delivery" label="{{ __('translate.delivery') }}" value="1" :checked="$restaurant->delivery" col="col-md-6">
                {{ __('translate.if_delivery_is_available') }}
            </x-forms.checkbox>
            <x-forms.checkbox name="order" label="{{ __('translate.order') }}" value="1" :checked="$restaurant->order" col="col-md-6">
                {{ __('translate.if_order_is_available') }}
            </x-forms.checkbox>
            <x-forms.checkbox name="table" label="{{ __('translate.table') }}" value="1" :checked="$restaurant->table" col="col-md-6">
                {{ __('translate.if_table_restaurant_is_open') }}
            </x-forms.checkbox>

            <div class="hr-text text-primary fs-4">{{ __('translate.costs_taxes') }}</div>

            <x-forms.input type="number" name="delivery_cost" label="{{ __('translate.delivery_cost') }}" :value="$restaurant->delivery_cost" col="col-md-4" />
            <x-forms.input type="number" name="min_delivery" label="{{ __('translate.min_delivery') }}" :value="$restaurant->min_delivery" col="col-md-4" />
            <x-forms.input type="number" name="tax" label="{{ __('translate.tax') }}" :value="$restaurant->tax" col="col-md-4" />

            <div class="hr-text text-primary fs-4">{{ __('translate.design') }}</div>

            <x-forms.input type="file" name="logo" label="{{ __('translate.logo') }}" col="col-md-6" />
            <x-forms.input type="file" name="qrcode" label="{{ __('translate.qrcode') }}" col="col-md-6" />
            <x-forms.color name="color" label="{{ __('translate.color') }}" :value="$restaurant->color ?? '#000'" col="col-md-4" />

            <div class="hr-text text-primary fs-4">{{ __('translate.social_links') }}</div>

            <x-forms.social-links
                name="social_links"
                :value="old('social_links', is_array($restaurant->social_links) ? $restaurant->social_links : json_decode($restaurant->social_links, true))"
                label="{{ __('translate.social_links') }}"
                col="col-md-12"
            />

            <div class="hr-text text-primary fs-4">{{ __('translate.working_days') }}</div>

            <x-forms.working-days
                name="working_days"
                :value="old('working_days', $restaurant->working_days ?? [])"
                label="{{ __('translate.working_days') }}"
                col="col-md-12"
            />

        </x-forms.form>
    </div>
@endsection