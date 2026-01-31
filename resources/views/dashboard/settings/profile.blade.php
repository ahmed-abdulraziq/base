@extends('dashboard.layouts.master')
@section('title', __('translate.edit_profile'))
@section('header', __('translate.edit_profile'))
@section('settings', 'active')
@section('breadcrumbs', Breadcrumbs::render('settings.profile'))
@section('content')
<div class="card col-12">
    <div class="row g-0">
        @include('dashboard.settings.partials.sidebar')
        <div class="col-12 col-md-9">
            <div class="card-body p-0">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @include('dashboard.settings.partials.profile-form', ['user' => $user])
            </div>
        </div>
    </div>
</div>
@endsection
