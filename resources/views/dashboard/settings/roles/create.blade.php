@extends('dashboard.layouts.master')

@section('title', __('translate.create_role'))
@section('header', __('translate.create_role'))
@section('settings', 'active')
@section('breadcrumbs', Breadcrumbs::render('settings.roles.create'))

@section('content')
<div class="card col-12">
    <div class="row g-0">
        @include('dashboard.settings.partials.sidebar')
        <div class="col-12 col-md-9">
            <div class="card-body p-0">
                <x-forms.form route="dashboard.settings.roles.store" method="POST" submitText="{{ __('translate.save') }}" formClass="form-horizontal" :title="__('translate.create_role')" :no-card="true">

                    <div class="hr-text text-primary fs-4">{{ __('translate.basic_information') }}</div>

                    <x-forms.input name="name" label="{{ __('translate.name') }}" required placeholder="{{ __('translate.enter_name') }}" col="col-md-6" />
                    <x-forms.input name="guard_name" label="{{ __('translate.guard') }}" :value="'admin'" col="col-md-6" />

                    <div class="hr-text text-primary fs-4">{{ __('translate.permissions') }}</div>

                    <div class="col-12 mb-3">
                        <div class="row">
                            @foreach($permissions as $group => $groupPermissions)
                                <div class="col-12 col-md-6 col-lg-4 mb-3">
                                    <div class="card card-border">
                                        <div class="card-header py-2">
                                            <strong class="text-capitalize">{{ $group }}</strong>
                                        </div>
                                        <div class="card-body py-2">
                                            @foreach($groupPermissions as $permission)
                                                <label class="form-check mb-1">
                                                    <input type="checkbox" class="form-check-input" name="permissions[]" value="{{ $permission->name }}">
                                                    <span class="form-check-label small">{{ $permission->name }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </x-forms.form>
            </div>
        </div>
    </div>
</div>
@endsection
