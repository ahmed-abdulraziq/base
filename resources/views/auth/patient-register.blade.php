@extends('dashboard.auth.layouts.master')

@section('title', __('translate.patient_registration'))

@section('content')
<div class="container-tight py-4">
    <div class="text-center mb-4">
        <a href="{{ url('/') }}" class="navbar-brand navbar-brand-autodark">
            <img src="{{ asset('assets/eindak.svg') }}" height="36" alt="">
        </a>
    </div>
    <form class="card card-md" action="{{ route('patient.register.store') }}" method="POST" autocomplete="off">
        @csrf
        <input type="hidden" name="type" value="patient">
        <div class="card-body">
            <h2 class="card-title text-center mb-4">@lang('translate.patient_registration')</h2>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">@lang('translate.first_name')</label>
                    <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" placeholder="@lang('translate.first_name')" value="{{ old('first_name') }}" required>
                    @error('first_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">@lang('translate.last_name')</label>
                    <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" placeholder="@lang('translate.last_name')" value="{{ old('last_name') }}" required>
                    @error('last_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">@lang('translate.phone')</label>
                    <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="@lang('translate.enter_phone')" value="{{ old('phone') }}" required>
                    @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">@lang('translate.email')</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="name@example.com" value="{{ old('email') }}" required>
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">@lang('translate.date_of_birth')</label>
                    <input type="date" name="date_of_birth" class="form-control @error('date_of_birth') is-invalid @enderror" value="{{ old('date_of_birth') }}" required>
                    @error('date_of_birth') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">@lang('translate.gender')</label>
                    <select name="gender" class="form-select @error('gender') is-invalid @enderror" required>
                        <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>@lang('translate.male')</option>
                        <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>@lang('translate.female')</option>
                    </select>
                    @error('gender') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">@lang('translate.password')</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="@lang('translate.password')" required>
                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">@lang('translate.password_confirmation')</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="@lang('translate.password_confirmation')" required>
            </div>

            <div class="hr-text">@lang('translate.medical_info') (@lang('translate.optional'))</div>

            <div class="mb-3">
                <label class="form-label">@lang('translate.address')</label>
                <textarea name="address" class="form-control" rows="2">{{ old('address') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">@lang('translate.medical_history')</label>
                <textarea name="medical_history" class="form-control" rows="3" placeholder="@lang('translate.medical_history_placeholder')">{{ old('medical_history') }}</textarea>
            </div>

            <div class="form-footer">
                <button type="submit" class="btn btn-primary w-100">@lang('translate.register')</button>
            </div>
        </div>
    </form>
    <div class="text-center text-secondary mt-3">
        @lang('translate.already_have_account') <a href="{{ route('dashboard.login') }}" tabindex="-1">@lang('translate.login')</a>
    </div>
</div>
@endsection
