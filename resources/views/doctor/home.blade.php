@extends('doctor.layouts.master')
@section('title', __('translate.home'))
@section('header', __('translate.home'))
@section('doctor_home', 'active')
@section('breadcrumbs', Breadcrumbs::render('doctor.home'))

@section('content')
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header">
                <h4 class="card-title mb-0">@lang('translate.welcome') {{ $doctor->full_name ?? $doctor->name }}</h4>
            </div>
            <div class="card-body">
                <p class="mb-0">@lang('translate.welcome_message')</p>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-4 mb-3">
                <div class="card h-100">
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex align-items-center mb-2">
                            <span class="bg-primary text-white rounded p-2 me-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="icon"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z"/><path d="M16 3l0 4"/><path d="M8 3l0 4"/><path d="M4 11l16 0"/></svg>
                            </span>
                            <div>
                                <h3 class="mb-0">{{ number_format($appointmentsToday ?? 0) }}</h3>
                                <span class="text-muted">@lang('translate.appointments_today')</span>
                            </div>
                        </div>
                        <a href="{{ route('doctor.appointments.index') }}" class="btn btn-sm btn-link text-primary p-0 mt-3 align-self-start border-0">@lang('translate.view_all')</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card h-100">
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex align-items-center mb-2">
                            <span class="bg-azure text-white rounded p-2 me-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="icon"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z"/><path d="M16 3l0 4"/><path d="M8 3l0 4"/><path d="M4 11l16 0"/></svg>
                            </span>
                            <div>
                                <h3 class="mb-0">{{ number_format($appointmentsTotal ?? 0) }}</h3>
                                <span class="text-muted">@lang('translate.appointments')</span>
                            </div>
                        </div>
                        <a href="{{ route('doctor.appointments.index') }}" class="btn btn-sm btn-link text-primary p-0 mt-3 align-self-start border-0">@lang('translate.view_all')</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card h-100">
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex align-items-center mb-2">
                            <span class="bg-green text-white rounded p-2 me-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="icon"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"/><path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"/><path d="M17 17h-11v-14h-2"/><path d="M6 5l7.999 .571m5.43 4.43l-.429 3h-13"/></svg>
                            </span>
                            <div>
                                <h3 class="mb-0">{{ number_format($prescriptionsTotal ?? 0) }}</h3>
                                <span class="text-muted">@lang('translate.prescriptions')</span>
                            </div>
                        </div>
                        <a href="{{ route('doctor.prescriptions.index') }}" class="btn btn-sm btn-link text-success p-0 mt-3 align-self-start border-0">@lang('translate.view_all')</a>
                    </div>
                </div>
            </div>
        </div>

        @if(isset($todayAppointments) && $todayAppointments->isNotEmpty())
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">@lang('translate.today_appointments')</h4>
            </div>
            <div class="table-responsive">
                <table class="table table-vcenter card-table table-striped">
                    <thead>
                        <tr>
                            <th>@lang('translate.time')</th>
                            <th>@lang('translate.patient')</th>
                            <th>@lang('translate.status')</th>
                            <th>@lang('translate.reason')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($todayAppointments as $apt)
                        <tr>
                            <td>{{ $apt->appointment_time ?? '-' }}</td>
                            <td>{{ $apt->patient?->full_name ?? '-' }}</td>
                            <td><span class="badge bg-{{ $apt->status === \App\Enums\AppointmentStatus::Confirmed ? 'success' : ($apt->status === \App\Enums\AppointmentStatus::Cancelled ? 'danger' : 'secondary') }}">{{ $apt->status?->label() ?? '-' }}</span></td>
                            <td>{{ Str::limit($apt->reason ?? '-', 40) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>
@endsection
