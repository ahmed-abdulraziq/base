@extends('dashboard.layouts.master')
@section('title', __('translate.edit'))
@section('header', __('translate.edit'))
@section($route, 'active')
@section('breadcrumbs', Breadcrumbs::render($route . '.edit', $model))

@section('content')
    <div class="{{ $columnClass ?? 'col-12 col-lg-6' }}">
        <x-form 
            :action="route($route . '.update', $model->id)"
            method="PUT"
            :fields="$fields"
            :submitText="__('translate.update')"
            :model="$model"
        />
    </div>
@endsection
