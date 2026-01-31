@extends('dashboard.layouts.master')

@section('title', __('translate.edit_permission'))
@section('header', __('translate.edit_permission'))
@section('settings', 'active')
@section('breadcrumbs', Breadcrumbs::render('settings.permissions.edit', $permission))

@section('content')
<div class="card col-12">
    <div class="row g-0">
        @include('dashboard.settings.partials.sidebar')
        <div class="col-12 col-md-9">
            <div class="card-body p-0">
                <x-forms.form route="dashboard.settings.permissions.update" model="{{ $permission->id }}" method="PUT" submitText="{{ __('translate.save') }}" formClass="form-horizontal" :title="__('translate.edit_permission')" :no-card="true">

                    <div class="hr-text text-primary fs-4">{{ __('translate.basic_information') }}</div>

                    <x-forms.input name="name" label="{{ __('translate.name') }}" required :value="$permission->name" col="col-md-6" />
                    <div class="col-md-6 mb-3">
                        <label for="guard_name" class="form-label required">{{ __('translate.guard') }}</label>
                        <select name="guard_name" id="guard_name" class="form-select" required>
                            <option value="admin" {{ old('guard_name', $permission->guard_name) == 'admin' ? 'selected' : '' }}>admin</option>
                            <option value="web" {{ old('guard_name', $permission->guard_name) == 'web' ? 'selected' : '' }}>web</option>
                        </select>
                        @error('guard_name')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                </x-forms.form>
            </div>
        </div>
    </div>
</div>
@endsection
