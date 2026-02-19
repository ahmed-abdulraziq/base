@extends('dashboard.layouts.master')

@section('title', __('translate.edit_user'))
@section('header', __('translate.edit_user'))
@section('users', 'active')
@section('breadcrumbs', Breadcrumbs::render('users.edit', $user))

@section('content')
    <div class="col-md-12">
        <x-forms.form route="dashboard.users.update" model="{{ $user->id }}" method="PUT" submitText="{{ __('translate.save') }}" formClass="form-horizontal" :title="__('translate.edit_user')">

            <div class="hr-text text-primary fs-4">{{ __('translate.basic_information') }}</div>

            <x-forms.input name="name" label="{{ __('translate.name') }}" required placeholder="{{ __('translate.enter_name') }}" :value="$user->name" />
            <x-forms.input type="email" name="email" label="{{ __('translate.email') }}" :value="$user->email" col="col-md-6" />

            <div class="hr-text text-primary fs-4">{{ __('translate.security') }}</div>

            <x-forms.input type="password" name="password" label="{{ __('translate.password') }}" placeholder="{{ __('translate.leave_blank_to_keep') }}" col="col-md-6" />

        </x-forms.form>
    </div>
@endsection
