@extends('dashboard.layouts.master')
@section('title', __('translate.home'))
@section('header', __('translate.home'))
@section('home', 'active')
@section('breadcrumbs', Breadcrumbs::render('home'))
@section('content')
    <div class="col-12">
        {{-- إحصائيات Users & Admins --}}
        <div class="row mb-4">
            <div class="col-md-12 mb-3 mb-md-0">
                <div class="card mb-4">
                    <div class="card-header">
                        <h4 class="card-title mb-0">@lang('translate.welcome') {{ $dashboardUser->name ?? $dashboardUser->full_name }}</h4>
                    </div>
                    <div class="card-body">
                        <p class="mb-0">@lang('translate.welcome_message')</p>
                    </div>
                </div>
            </div>
            @can('view.users')
            <div class="col-md-6 mb-3 mb-md-0">
                <div class="card h-100">
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex align-items-center mb-2">
                            <span class="bg-primary text-white rounded p-2 me-3">
                                <i class="fa-solid fa-users fa-lg"></i>
                            </span>
                            <div>
                                <h3 class="mb-0">{{ number_format($usersCount ?? 0) }}</h3>
                                <span class="text-muted">@lang('translate.users')</span>
                            </div>
                        </div>
                        @if(isset($usersThisMonth) && $usersThisMonth > 0)
                            <small class="text-success">+{{ $usersThisMonth }} @lang('translate.this_month')</small>
                        @endif
                        <a href="{{ route('dashboard.users.index') }}" class="btn btn-sm btn-link text-primary p-0 mt-3 align-self-start border-0">@lang('translate.view_all')</a>
                    </div>
                </div>
            </div>
            @endcan
            @can('view.admins')
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex align-items-center mb-2">
                            <span class="bg-success text-white rounded p-2 me-3">
                                <i class="fa-solid fa-user-shield fa-lg"></i>
                            </span>
                            <div>
                                <h3 class="mb-0">{{ number_format($adminsCount ?? 0) }}</h3>
                                <span class="text-muted">@lang('translate.admins')</span>
                            </div>
                        </div>
                        @if(isset($adminsThisMonth) && $adminsThisMonth > 0)
                            <small class="text-success">+{{ $adminsThisMonth }} @lang('translate.this_month')</small>
                        @endif
                        <a href="{{ route('dashboard.admins.index') }}" class="btn btn-sm btn-link text-success p-0 mt-3 align-self-start border-0">@lang('translate.view_all')</a>
                    </div>
                </div>
            </div>
        </div>
        @endcan

        {{-- إحصائيات العيادة --}}
        @php
            $dashboardUser = $dashboardUser ?? (auth('admin')->user() ?? auth('doctor')->user());
            $showClinicStats = $dashboardUser && method_exists($dashboardUser, 'can') && ($dashboardUser->can('view.patients') || $dashboardUser->can('view.doctors') || $dashboardUser->can('view.appointments') || $dashboardUser->can('view.prescriptions') || $dashboardUser->can('view.medications'));
        @endphp
        @if($showClinicStats)
        <div class="row mb-4">
            <div class="col-12">
                <h4 class="mb-3">@lang('translate.clinic_statistics')</h4>
            </div>
            @can('view.patients')
            <div class="col-6 col-lg-4 mb-3">
                <div class="card h-100">
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex align-items-center mb-2">
                            <span class="bg-blue text-white rounded p-2 me-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-wheelchair"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 16a5 5 0 1 0 10 0a5 5 0 1 0 -10 0" /><path d="M17 19a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M19 17a3 3 0 0 0 -3 -3h-3.4" /><path d="M3 3h1a2 2 0 0 1 2 2v6" /><path d="M6 8h11" /><path d="M15 8v6" /></svg>                            </span>
                            <div>
                                <h3 class="mb-0">{{ number_format($patientsCount ?? 0) }}</h3>
                                <span class="text-muted">@lang('translate.patients')</span>
                            </div>
                        </div>
                        <a href="{{ route('dashboard.clinic.patients.index') }}" class="btn btn-sm btn-link text-primary p-0 mt-auto align-self-start border-0">@lang('translate.view_all')</a>
                    </div>
                </div>
            </div>
            @endcan
            @can('view.doctors')
            <div class="col-6 col-lg-4 mb-3">
                <div class="card h-100">
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex align-items-center mb-2">
                            <span class="bg-azure text-white rounded p-2 me-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 12l2 2l4 -4"/><path d="M12 3a12 12 0 0 0 8.5 3a12 12 0 0 1 -8.5 15a12 12 0 0 1 -8.5 -15a12 12 0 0 0 8.5 -3"/></svg>
                            </span>
                            <div>
                                <h3 class="mb-0">{{ number_format($doctorsCount ?? 0) }}</h3>
                                <span class="text-muted">@lang('translate.doctors')</span>
                            </div>
                        </div>
                        <a href="{{ route('dashboard.clinic.doctors.index') }}" class="btn btn-sm btn-link text-azure p-0 mt-auto align-self-start border-0">@lang('translate.view_all')</a>
                    </div>
                </div>
            </div>
            @endcan
            @can('view.appointments')
            <div class="col-6 col-lg-4 mb-3">
                <div class="card h-100">
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex align-items-center mb-2">
                            <span class="bg-orange text-white rounded p-2 me-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z"/><path d="M16 3v4"/><path d="M8 3v4"/><path d="M4 11h16"/></svg>
                            </span>
                            <div>
                                <h3 class="mb-0">{{ number_format($appointmentsCount ?? 0) }}</h3>
                                <span class="text-muted">@lang('translate.appointments')</span>
                            </div>
                        </div>
                        @if(($appointmentsToday ?? 0) > 0)
                            <small class="text-success">@lang('translate.today'): {{ $appointmentsToday }}</small>
                        @endif
                        <a href="{{ route('dashboard.clinic.appointments.index') }}" class="btn btn-sm btn-link text-orange p-0 mt-auto align-self-start border-0">@lang('translate.view_all')</a>
                    </div>
                </div>
            </div>
            @endcan
            @can('view.prescriptions')
            <div class="col-6 col-lg-4 mb-3">
                <div class="card h-100">
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex align-items-center mb-2">
                            <span class="bg-green text-white rounded p-2 me-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-file-description"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2" /><path d="M9 17h6" /><path d="M9 13h6" /></svg>                            </span>
                            <div>
                                <h3 class="mb-0">{{ number_format($prescriptionsCount ?? 0) }}</h3>
                                <span class="text-muted">@lang('translate.prescriptions')</span>
                            </div>
                        </div>
                        <a href="{{ route('dashboard.clinic.prescriptions.index') }}" class="btn btn-sm btn-link text-green p-0 mt-auto align-self-start border-0">@lang('translate.view_all')</a>
                    </div>
                </div>
            </div>
            @endcan
            @can('view.medications')
            <div class="col-6 col-lg-4 mb-3">
                <div class="card h-100">
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex align-items-center mb-2">
                            <span class="bg-purple text-white rounded p-2 me-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-pill"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4.5 12.5l8 -8a4.94 4.94 0 0 1 7 7l-8 8a4.94 4.94 0 0 1 -7 -7" /><path d="M8.5 8.5l7 7" /></svg>                            </span>
                            <div>
                                <h3 class="mb-0">{{ number_format($medicationsCount ?? 0) }}</h3>
                                <span class="text-muted">@lang('translate.medications')</span>
                            </div>
                        </div>
                        <a href="{{ route('dashboard.clinic.medications.index') }}" class="btn btn-sm btn-link text-purple p-0 mt-auto align-self-start border-0">@lang('translate.view_all')</a>
                    </div>
                </div>
            </div>
            @endcan
        </div>
        @endif

        {{-- رسم بياني: المستخدمون والمدراء خلال آخر 6 أشهر --}}
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">@lang('translate.users') & @lang('translate.admins') — @lang('translate.last_6_months')</h4>
                    </div>
                    <div class="card-body">
                        <div id="chart-users-admins" style="min-height: 300px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="upgradeModal" tabindex="-1">
        <div class="modal-dialog  modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header py-4 px-10" >
                    {{-- <h5 class="modal-title">Modal title</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                    <img src="{{ asset('assets/imgs/logo.png.webp') }}" alt="">
                </div>
                <div class="modal-body">
                    
                    <div class="text-center">
                        <h2>@lang('translate.upgrade_your_plan')</h2>
                        <p>@lang('translate.upgrade_your_plan_message')</p>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <a href="" class="btn btn-primary" style="background-color: #95BF54">@lang('translate.upgrade_now')</a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        @lang('translate.close')
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var chartMonths = @json($chartMonths ?? []),
        chartUsers = @json($chartUsers ?? []),
        chartAdmins = @json($chartAdmins ?? []);

    if (typeof ApexCharts === 'undefined') return;

    var options = {
        series: [
            { name: '{{ __("translate.users") }}', data: chartUsers },
            { name: '{{ __("translate.admins") }}', data: chartAdmins }
        ],
        chart: {
            type: 'area',
            height: 300,
            toolbar: { show: false },
            zoom: { enabled: false }
        },
        colors: ['#206bc4', '#2fb344'],
        dataLabels: { enabled: false },
        stroke: { curve: 'smooth', width: 2 },
        fill: {
            type: 'gradient',
            gradient: { opacityFrom: 0.4, opacityTo: 0.1 }
        },
        xaxis: { categories: chartMonths },
        yaxis: {
            min: 0,
            labels: { formatter: function(v) { return Math.round(v); } }
        },
        legend: {
            position: 'top',
            horizontalAlign: '{{ app()->getLocale() == "ar" ? "left" : "right" }}'
        },
        grid: {
            borderColor: '#e6e6e6',
            strokeDashArray: 4,
            xaxis: { lines: { show: false } }
        }
    };

    var chart = new ApexCharts(document.querySelector('#chart-users-admins'), options);
    chart.render();
});
</script>
@endpush
