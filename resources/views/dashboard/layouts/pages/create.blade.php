@extends('dashboard.layouts.master')
@section('title', __('translate.add'))
@section('header', __('translate.add'))
@section($route, 'active')
@section('breadcrumbs', Breadcrumbs::render($route . '.create'))

@section('content')
    <div class="{{ $columnClass ?? 'col-12 col-lg-6' }}">
        <x-form 
            :action="route($route . '.store')"
            method="POST"
            :fields="$fields"
            :submitText="__('translate.add')"
        />
    </div>
@endsection
