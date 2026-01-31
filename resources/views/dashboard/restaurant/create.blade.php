@extends('dashboard.layouts.master')

@section('title', __('translate.create_restaurant'))
@section('header', __('translate.create_restaurant'))
@section('restaurants', 'active')
@section('breadcrumbs', Breadcrumbs::render('restaurants.create'))

@section('content')
    <div class="col-md-12">
        <x-forms.form route="restaurants.store" method="POST" submitText="{{ __('translate.save') }}" formClass="form-horizontal" :title="__('translate.create_restaurant')">
            <div class="hr-text text-primary fs-4">{{ __('translate.basic_information') }}</div>

            {{-- <h3 class="mb-3">{{ __('translate.basic_information') }}</h3> --}}
            <x-forms.input translatable name="name" label="{{ __('translate.name') }}" required placeholder="{{ __('translate.enter_name') }}" />
            <x-forms.slug name="slug" source="name_en" label="{{ __('translate.slug') }}" required col="col-md-6" placeholder="{{ __('translate.auto_generated_slug') }}" />
            <x-forms.input translatable name="address" label="{{ __('translate.address') }}" />
            <x-forms.input translatable name="currency" label="{{ __('translate.currency') }}" />
            <x-forms.textarea translatable name="description" label="{{ __('translate.description') }}" />
            <x-forms.tags-input translatable name="seo_meta" label="{{ __('translate.seo_meta') }}" tagsInput/>

            <div class="hr-text text-primary fs-4">{{ __('translate.location') }}</div>

            <x-forms.select name="country_id" label="{{ __('translate.country') }}" model="Country" required selected="{{ old('country_id', $restaurant->country_id ?? null) }}" col="col-md-6" />
            <x-forms.select name="city_id" label="{{ __('translate.city') }}" model="City" dependsField="country_id" required selected="{{ old('city_id', $restaurant->city_id ?? null) }}" col="col-md-6" />

            <div class="hr-text text-primary fs-4">{{ __('translate.contact_information') }}</div>

            <x-forms.input name="phone" label="{{ __('translate.phone') }}" col="col-md-6" />
            <x-forms.input name="delivery_number" label="{{ __('translate.delivery_number') }}" col="col-md-6" />
            <x-forms.input name="whatsapp_number" label="{{ __('translate.whatsapp_number') }}" col="col-md-6" />
            <x-forms.input name="complaints_number" label="{{ __('translate.complaints_number') }}" col="col-md-6" />

            <div class="hr-text text-primary fs-4">{{ __('translate.services') }}</div>

            <x-forms.checkbox name="active" label="{{ __('translate.active') }}" value="1" checked col="col-md-12">
                {{ __('translate.if_active_restaurant_is_open') }}
            </x-forms.checkbox>
            <x-forms.checkbox name="takeaway" label="{{ __('translate.takeaway') }}" value="1" :checked="old('takeaway', $restaurant->takeaway ?? 1)" col="col-md-6">
                {{ __('translate.if_takeaway_is_available') }}
            </x-forms.checkbox>
            <x-forms.checkbox name="delivery" label="{{ __('translate.delivery') }}" value="1" :checked="old('delivery', $restaurant->delivery ?? 1)" col="col-md-6">
                {{ __('translate.if_delivery_is_available') }}
            </x-forms.checkbox>
            <x-forms.checkbox name="order" label="{{ __('translate.order') }}" value="1" :checked="old('order', $restaurant->order ?? 1)" col="col-md-6">
                {{ __('translate.if_order_is_available') }}
            </x-forms.checkbox>
            <x-forms.checkbox name="table" label="{{ __('translate.table') }}" value="1" :checked="old('table', $restaurant->table ?? 1)" col="col-md-6">
                {{ __('translate.if_table_restaurant_is_open') }}
            </x-forms.checkbox>

            <div class="hr-text text-primary fs-4">{{ __('translate.costs_taxes') }}</div>

            <x-forms.input type="number" name="delivery_cost" label="{{ __('translate.delivery_cost') }}" col="col-md-4" />
            <x-forms.input type="number" name="min_delivery" label="{{ __('translate.min_delivery') }}" col="col-md-4" />
            <x-forms.input type="number" name="tax" label="{{ __('translate.tax') }}" col="col-md-4" />

            <div class="hr-text text-primary fs-4">{{ __('translate.design') }}</div>

            <x-forms.input type="file" name="logo" label="{{ __('translate.logo') }}" col="col-md-6" />
            <x-forms.input type="file" name="qrcode" label="{{ __('translate.qrcode') }}" col="col-md-6" />
            <x-forms.color name="color" label="{{ __('translate.color') }}" value="#000" col="col-md-4" />

            <div class="hr-text text-primary fs-4">{{ __('translate.social_links') }}</div>

            <x-forms.social-links

                name="social_links"
                :value="old('social_links', $restaurant->social_links ?? [])"
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

        
            {{-- <x-forms.input type="text" name="social_links" label="{{ __('translate.social_links') }}" col="col-md-12" placeholder="{{ __('translate.social_links_placeholder') }}" /> --}}
            {{-- <x-forms.input name="code" label="{{ __('translate.code') }}" col="col-md-6" /> --}}
            {{-- <x-forms.input type="text" name="working_days" label="{{ __('translate.working_days') }}" col="col-md-12" placeholder="{{ __('translate.working_days_placeholder') }}" /> --}}
            {{-- <x-forms.input name="governorate" label="{{ __('translate.governorate') }}" col="col-md-6" /> --}}
        </x-forms.form>
    </div>
@endsection

