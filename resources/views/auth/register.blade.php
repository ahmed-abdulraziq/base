@extends('auth.layouts.app')
@section('title', __('translate.register'))
@section('content')
    @php
        $errors = $errors ?? new \Illuminate\Support\ViewErrorBag;
    @endphp
    <div class="container container-tight py-4">
        <div class="text-center mb-4">
            <a href="{{ url('/') }}" class="navbar-brand navbar-brand-autodark d-inline-block">
                <img src="{{ asset('assets/static/logo.svg') }}" alt="{{ config('app.name') }}" class="img-fluid" style="height: 42px" onerror="this.style.display='none'; this.nextElementSibling.style.display='inline';">
                <span class="fs-3 fw-bold text-primary" style="display: none;">{{ config('app.name') }}</span>
            </a>
        </div>
        @if (session('success'))
            <div class="alert alert-success mb-3">{{ session('success') }}</div>
        @endif
        <div class="mb-3">
            @if ($errors->any())
                @foreach ($errors->all() as $error)
                    <span class="text-danger fw-bold">{{ $error }}</span><br>
                @endforeach
            @endif
        </div>
        <form class="card card-md" method="POST" action="{{ route('dashboard.register') }}" autocomplete="off" novalidate id="register-form">
            @csrf
            <div class="card-body">
                <h2 class="card-title text-center mb-4">@lang('translate.register')</h2>

                {{-- نوع التسجيل --}}
                <div class="mb-4">
                    <label class="form-label">@lang('translate.register')</label>
                    <div class="form-selectgroup form-selectgroup-boxes d-flex flex-column gap-2">
                        <label class="form-selectgroup-item flex-fill">
                            <input type="radio" name="type" value="doctor" class="form-selectgroup-input" {{ old('type', 'doctor') === 'doctor' ? 'checked' : '' }}>
                            <span class="form-selectgroup-label d-flex align-items-center p-3">
                                <span class="me-2">🩺</span>
                                <span>@lang('translate.register_as_doctor')</span>
                            </span>
                        </label>
                        <label class="form-selectgroup-item flex-fill">
                            <input type="radio" name="type" value="patient" class="form-selectgroup-input" {{ old('type') === 'patient' ? 'checked' : '' }}>
                            <span class="form-selectgroup-label d-flex align-items-center p-3">
                                <span class="me-2">👤</span>
                                <span>@lang('translate.register_as_patient')</span>
                            </span>
                        </label>
                    </div>
                </div>

                {{-- حقول مشتركة --}}
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">@lang('translate.first_name')</label>
                        <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required placeholder="@lang('translate.first_name')">
                        @error('first_name')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">@lang('translate.last_name')</label>
                        <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required placeholder="@lang('translate.last_name')">
                        @error('last_name')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">@lang('translate.phone')</label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required placeholder="@lang('translate.phone')">
                    @error('phone')
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">@lang('translate.email')</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required placeholder="@lang('translate.email')">
                    @error('email')
                        <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                {{-- حقول الطبيب فقط --}}
                <div id="doctor-fields">
                    <div class="mb-3">
                        <label class="form-label">@lang('translate.license_number')</label>
                        <input type="text" class="form-control @error('license_number') is-invalid @enderror" name="license_number" value="{{ old('license_number') }}" placeholder="@lang('translate.license_number')">
                        @error('license_number')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">@lang('translate.specialization')</label>
                        <select class="form-select @error('specialization_id') is-invalid @enderror" name="specialization_id">
                            <option value="">— @lang('translate.ignore') —</option>
                            @foreach ($specializations ?? [] as $spec)
                                <option value="{{ $spec->specialization_id }}" {{ old('specialization_id') == $spec->specialization_id ? 'selected' : '' }}>{{ $spec->specialization_name }}</option>
                            @endforeach
                        </select>
                        @error('specialization_id')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">@lang('translate.years_of_experience')</label>
                        <input type="number" class="form-control @error('years_of_experience') is-invalid @enderror" name="years_of_experience" value="{{ old('years_of_experience') }}" min="0" max="70" placeholder="0">
                        @error('years_of_experience')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">@lang('translate.password')</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="@lang('translate.password')" autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">@lang('translate.password_confirmation')</label>
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="@lang('translate.password_confirmation')" autocomplete="new-password">
                        @error('password_confirmation')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                {{-- حقول المريض فقط --}}
                <div id="patient-fields" style="display: none;">
                    <div class="mb-3">
                        <label class="form-label">@lang('translate.date_of_birth')</label>
                        <input type="date" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" value="{{ old('date_of_birth') }}" max="{{ date('Y-m-d') }}">
                        @error('date_of_birth')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">@lang('translate.gender')</label>
                        <select class="form-select @error('gender') is-invalid @enderror" name="gender">
                            @foreach(\App\Enums\Gender::cases() as $case)
                                <option value="{{ $case->value }}" {{ old('gender') === $case->value ? 'selected' : '' }}>{{ $case->label() }}</option>
                            @endforeach
                        </select>
                        @error('gender')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">@lang('translate.address')</label>
                        <textarea class="form-control @error('address') is-invalid @enderror" name="address" rows="2" placeholder="@lang('translate.address')">{{ old('address') }}</textarea>
                        @error('address')
                            <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="form-footer">
                    <button type="submit" class="btn btn-primary w-100">@lang('translate.register')</button>
                </div>
            </div>
        </form>
        <div class="text-center text-secondary mt-3">
            @lang('translate.already_have_an_account')
            <a href="{{ route('dashboard.login') }}" tabindex="-1">@lang('translate.login')</a>
        </div>
    </div>

    <script>
        document.getElementById('register-form').querySelectorAll('input[name="type"]').forEach(function(radio) {
            radio.addEventListener('change', function() {
                var isDoctor = this.value === 'doctor';
                document.getElementById('doctor-fields').style.display = isDoctor ? 'block' : 'none';
                document.getElementById('patient-fields').style.display = isDoctor ? 'none' : 'block';
                document.getElementById('doctor-fields').querySelectorAll('input, select').forEach(function(el) {
                    el.required = isDoctor && (el.name === 'license_number' || el.name === 'password');
                });
                document.getElementById('patient-fields').querySelectorAll('input, select, textarea').forEach(function(el) {
                    el.required = !isDoctor && (el.name === 'date_of_birth' || el.name === 'gender');
                });
            });
        });
        document.querySelector('input[name="type"]:checked').dispatchEvent(new Event('change'));
    </script>
@endsection
