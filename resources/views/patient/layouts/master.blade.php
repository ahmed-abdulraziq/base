<!DOCTYPE html>
<html class="m-0" lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"
    data-bs-theme="light" data-bs-theme-base="neutral">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/eindak.svg') }}" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/plug-ins/1.12.1/integration/bootstrap-4/dataTables.bootstrap4.min.css">
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

    @if (app()->getLocale() == 'ar')
        <link href="{{ asset('assets/dist/css/tabler.rtl.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/dist/css/tabler-flags.rtl.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/dist/css/tabler-vendors.rtl.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/dist/css/tabler-themes.rtl.css') }}" rel="stylesheet" />
    @else
        <link href="{{ asset('assets/dist/css/tabler.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/dist/css/tabler-flags.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/dist/css/tabler-vendors.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/dist/css/tabler-themes.css') }}" rel="stylesheet" />
    @endif

    <title>@lang('translate.eindak') - @yield('title')</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap');
        body { font-family: 'Cairo', sans-serif !important; }
        .page { display: flex; flex-direction: column; min-height: 100vh; }
        .content { flex: 1; }
    </style>
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
    @stack('styles')
</head>

<body>
    <script src="{{ asset('assets/dist/js/tabler-theme.min.js') }}"></script>
    <div class="page">
        @include('patient.layouts.partials.sidebar')
        <div class="page-wrapper">
            @include('patient.layouts.partials.header')

            <div class="page-header d-print-none">
                <div class="container-xl fs-3">
                    @yield('breadcrumbs')
                </div>
            </div>
            <div class="page-body">
                <div class="container-xl">
                    @include('partials.toast-alerts')
                    @yield('content')
                </div>
            </div>
            {{-- @include('doctor.layouts.partials.footer') --}}
        </div>
    </div>

    <div id="importLangLocal" data-LangLocal="{{ asset('assets/datatable-lang/' . app()->getLocale() . '.json') }}"></div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script src="{{ asset('assets/dist/js/tabler.min.js') }}" defer></script>
    @stack('scripts')
</body>

</html>
