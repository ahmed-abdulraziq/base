<!DOCTYPE html>
<html class="m-0" lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"
    data-bs-theme="light" data-bs-theme-base="neutral">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/eindak.svg') }}" />

    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- jQuery Validate -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

    <!-- Select2 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" />
    <link rel="stylesheet"
        href="https://cdn.datatables.net/plug-ins/1.12.1/integration/bootstrap-4/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

    @if (app()->getLocale() == 'ar')
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="{{ asset('assets/dist/css/tabler.rtl.min.css') }}" rel="stylesheet" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PLUGINS STYLES -->
        <link href="{{ asset('assets/dist/css/tabler-flags.rtl.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/dist/css/tabler-socials.rtl.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/dist/css/tabler-payments.rtl.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/dist/css/tabler-vendors.rtl.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/dist/css/tabler-marketing.rtl.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/dist/css/tabler-themes.rtl.css') }}" rel="stylesheet" />
        <!-- END PLUGINS STYLES -->
        <!-- BEGIN DEMO STYLES -->
        <link href="{{ asset('assets/preview/css/demo.min.css') }}" rel="stylesheet" />
        <!-- END DEMO STYLES -->
    @else
        <link href="{{ asset('assets/dist/css/tabler.min.css') }}" rel="stylesheet" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PLUGINS STYLES -->
        <link href="{{ asset('assets/dist/css/tabler-flags.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/dist/css/tabler-socials.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/dist/css/tabler-payments.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/dist/css/tabler-vendors.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/dist/css/tabler-marketing.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/dist/css/tabler-themes.css') }}" rel="stylesheet" />
        <!-- END PLUGINS STYLES -->
        <!-- BEGIN DEMO STYLES -->
        <link href="{{ asset('assets/preview/css/demo.min.css') }}" rel="stylesheet" />
        <!-- END DEMO STYLES -->
    @endif

    <!-- BEGIN FANCYBOX STYLES -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css"/>

    <title>@lang('translate.eindak') - @yield('title')</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap');
        /* @import url('https://fonts.googleapis.com/css2?family=Alexandria:wght@100..900&display=swap'); */

        :root {
            --tblr-font-sans-serif: "Inter";
        }

        body {
            font-family: 'Cairo', sans-serif !important;
            /* font-family: "Alexandria", sans-serif !important; */
        }

        .page {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .content {
            flex: 1;
        }

        .btn,
        select,
        input,
        textarea {
            font-family: 'Cairo', sans-serif !important;
            /* font-family: "Alexandria", sans-serif !important; */
        }
    </style>
    <!-- BEGIN CUSTOM FONT -->
    <style>
        @import url("https://rsms.me/inter/inter.css");
    </style>
    <!-- END CUSTOM FONT -->
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
    <!-- END GLOBAL MANDATORY STYLES -->
    @stack('styles')
</head>

<body>
    {{-- <!-- BEGIN DEMO THEME SCRIPT -->
    <script src="{{ asset('assets/preview/js/demo-theme.min.js') }}"></script>
    <!-- END DEMO THEME SCRIPT --> --}}
    <!-- BEGIN GLOBAL THEME SCRIPT -->
    <script src="{{ asset('assets/dist/js/tabler-theme.min.js') }}"></script>
    <!-- END GLOBAL THEME SCRIPT -->
    <div class="page">
        @include('dashboard.layouts.partials.sidebar')
        <div class="page-wrapper">
            @include('dashboard.layouts.partials.header')

            <!-- BEGIN PAGE HEADER -->
            <div class="page-header d-print-none">
                <div class="container-xl fs-3">
                    @yield('breadcrumbs')
                </div>
            </div>
            <!-- END PAGE HEADER -->

            <!-- BEGIN STATUS BARS -->
            <div class="container-xl">
                <div class="col-12">
                    @include('partials.toast-alerts')
                </div>
            </div>
            <!-- END STATUS BARS -->

            <!-- BEGIN PAGE BODY -->
            <div class="page-body">
                <div class="container-xl d-flex justify-content-center">
                    @yield('content')
                </div>
            </div>
            <!-- END PAGE BODY -->

            <!--  BEGIN FOOTER  -->
            @include('dashboard.layouts.partials.footer')
            <!--  END FOOTER  -->
        </div>
    </div>


    @include('dashboard.layouts.components.theme-builder')

    <div id="importLangLocal" data-LangLocal="{{ asset('assets/datatable-lang/' . app()->getLocale() . '.json') }}">
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/35.4.0/classic/ckeditor.js"></script>

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <!-- BEGIN PAGE LIBRARIES -->
    <script src="{{ asset('assets/libs/apexcharts/dist/apexcharts.min.js') }}" defer></script>
    <script src="{{ asset('assets/libs/jsvectormap/dist/jsvectormap.min.js') }}" defer></script>
    <script src="{{ asset('assets/libs/jsvectormap/dist/maps/world.js') }}" defer></script>
    <script src="{{ asset('assets/libs/jsvectormap/dist/maps/world-merc.js') }}" defer></script>
    <!-- END PAGE LIBRARIES -->
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('assets/dist/js/tabler.min.js') }}" defer></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <!-- BEGIN DEMO SCRIPTS -->
    <script src="{{ asset('assets/preview/js/demo.min.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- END DEMO SCRIPTS -->
    @include('dashboard.layouts.components.delete-modal')
    {{-- <script>
        window.translations = {
            are_you_sure: "{{ __('translate.are_you_sure') }}",
            cannot_restore: "{{ __('translate.cannot_restore') }}",
            yes_delete: "{{ __('translate.yes_delete') }}",
            cancel: "{{ __('translate.cancel') }}",
            deleted: "{{ __('translate.deleted') }}",
            deleted_successfully: "{{ __('translate.deleted_successfully') }}",
            error: "{{ __('translate.error') }}",
            something_went_wrong: "{{ __('translate.something_went_wrong') }}",
            server_error: "{{ __('translate.server_error') }}"
        };
    </script>
    
    <script src="{{ asset('assets/js/delete-handler.js') }}"></script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.delete-btn', function() {
                const url = $(this).data('url');
                const table = $('#datatable').DataTable();
                sweetAlertDelete(url, table, window.translations);
            });
        });
    </script> --}}
    <script defer src="//unpkg.com/alpinejs"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/selectize/dist/css/selectize.bootstrap4.css">
    <script src="https://cdn.jsdelivr.net/npm/selectize/dist/js/standalone/selectize.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
    @stack('scripts')
</body>

</html>
