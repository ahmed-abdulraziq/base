@extends('dashboard.layouts.master')

@section('title', __('translate.create_user'))
@section('header', __('translate.create_user'))
@section('users', 'active')
@section('breadcrumbs', Breadcrumbs::render('users.create'))

@section('content')
    <div class="col-md-12">
        <x-forms.form route="dashboard.users.store" method="POST" submitText="{{ __('translate.save') }}" formClass="form-horizontal" :title="__('translate.create_user')">

            <div class="hr-text text-primary fs-4">{{ __('translate.basic_information') }}</div>

            <x-forms.input name="name" label="{{ __('translate.name') }}" required placeholder="{{ __('translate.enter_name') }}" />
            <x-forms.input type="email" name="email" label="{{ __('translate.email') }}" col="col-md-6" />

            <div class="hr-text text-primary fs-4">{{ __('translate.security') }}</div>

            <x-forms.input type="password" name="password" label="{{ __('translate.password') }}" required col="col-md-6" />

        </x-forms.form>
    </div>
@endsection
