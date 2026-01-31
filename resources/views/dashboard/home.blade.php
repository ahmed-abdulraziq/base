@extends('dashboard.layouts.master')
@section('title', __('translate.home'))
@section('header', __('translate.home'))
@section('home', 'active')
@section('breadcrumbs', Breadcrumbs::render('home'))
@section('content')
    <div class="col-12">
        {{-- إحصائيات Users & Admins --}}
        <div class="row mb-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h4 class="card-title mb-0">@lang('translate.welcome') {{ auth('admin')->user()->name }}</h4>
                </div>
                <div class="card-body">
                    <p class="mb-0">@lang('translate.welcome_message')</p>
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
