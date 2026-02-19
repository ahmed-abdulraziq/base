<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"
    data-bs-theme="light" data-bs-theme-base="neutral">
<head>
    {{-- نفس ثيم الداشبورد: من localStorage أو ?theme= --}}
    <script src="{{ asset('assets/dist/js/tabler-theme.min.js') }}"></script>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>@yield('title', __('translate.login'))</title>
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
        <link href="{{ asset('assets/preview/css/demo.rtl.min.css') }}" rel="stylesheet" />
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

        main {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .content {
            flex: 1;
        }

        .btn,
        .form-control {
            font-family: 'Cairo', sans-serif !important;
            /* font-family: "Alexandria", sans-serif !important; */
        }

        [dir="rtl"] .form-control::placeholder {
            text-align: right;
        }
    </style>

    <!-- BEGIN CUSTOM FONT -->
    <style>
        @import url("https://rsms.me/inter/inter.css");
    </style>
    <!-- END CUSTOM FONT -->
</head>

<body>
    {{-- تبديل الثيم + اللغة (نفس الداشبورد: ?theme= يحفظ في localStorage) --}}
    <div class="position-fixed top-0 end-0 m-3" style="z-index: 1030;">
        <div class="d-flex align-items-center gap-2 small">
            <a href="{{ request()->fullUrlWithQuery(['theme' => 'dark']) }}" class="text-decoration-none text-muted hide-theme-dark" title="Dark mode" aria-label="Dark">🌙</a>
            <a href="{{ request()->fullUrlWithQuery(['theme' => 'light']) }}" class="text-decoration-none text-muted hide-theme-light" title="Light mode" aria-label="Light">☀️</a>
            <span class="text-muted">|</span>
            @foreach (get_available_locales() as $localeCode => $properties)
                <a href="{{ get_locale_url($localeCode) }}"
                   class="text-decoration-none fw-semibold
                   {{ get_current_locale() === $localeCode 
                        ? 'text-primary border-bottom border-2 border-primary pb-1' 
                        : 'text-muted' }}">
                    {{ strtoupper($localeCode) }}
                </a>
            @endforeach
        </div>
    </div>
    <style>
        .hide-theme-dark { display: inline !important; }
        .hide-theme-light { display: none !important; }
        [data-bs-theme=dark] .hide-theme-dark { display: none !important; }
        [data-bs-theme=dark] .hide-theme-light { display: inline !important; }
    </style>
    
    <div class="page page-center">
        @yield('content')
        {{-- <div class="container container-tight py-4">
            <div class="text-center mb-4">
                <!-- BEGIN NAVBAR LOGO -->
                <a href="." class="navbar-brand navbar-brand-autodark">
                    <svg width="141" height="35" viewBox="0 0 141 35" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10.3867 28.3711C10.6159 28.4427 10.8451 28.4928 11.0742 28.5215C11.3034 28.5358 11.5326 28.543 11.7617 28.543C12.3346 28.543 12.8861 28.4642 13.416 28.3066C13.946 28.1491 14.4401 27.9271 14.8984 27.6406C15.3711 27.3398 15.7865 26.9818 16.1445 26.5664C16.5169 26.1367 16.8177 25.6641 17.0469 25.1484L21.3438 29.4668C20.7995 30.2402 20.1693 30.9349 19.4531 31.5508C18.7513 32.1667 17.985 32.6895 17.1543 33.1191C16.3379 33.5488 15.4714 33.8711 14.5547 34.0859C13.6523 34.3151 12.7214 34.4297 11.7617 34.4297C10.1432 34.4297 8.61784 34.1289 7.18555 33.5273C5.76758 32.9258 4.52148 32.0879 3.44727 31.0137C2.38737 29.9395 1.54948 28.6647 0.933594 27.1895C0.317708 25.6999 0.00976562 24.0671 0.00976562 22.291C0.00976562 20.472 0.317708 18.8105 0.933594 17.3066C1.54948 15.8027 2.38737 14.5208 3.44727 13.4609C4.52148 12.401 5.76758 11.5775 7.18555 10.9902C8.61784 10.403 10.1432 10.1094 11.7617 10.1094C12.7214 10.1094 13.6595 10.224 14.5762 10.4531C15.4928 10.6823 16.3594 11.0117 17.1758 11.4414C18.0065 11.8711 18.7799 12.401 19.4961 13.0312C20.2122 13.6471 20.8424 14.3418 21.3867 15.1152L10.3867 28.3711ZM13.3945 16.2754C13.1224 16.1751 12.8503 16.1107 12.5781 16.082C12.3203 16.0534 12.0482 16.0391 11.7617 16.0391C10.9596 16.0391 10.2005 16.1895 9.48438 16.4902C8.78255 16.7767 8.16667 17.1921 7.63672 17.7363C7.12109 18.2806 6.71289 18.9395 6.41211 19.7129C6.11133 20.472 5.96094 21.3314 5.96094 22.291C5.96094 22.5059 5.9681 22.7493 5.98242 23.0215C6.01107 23.2936 6.04688 23.5729 6.08984 23.8594C6.14714 24.1315 6.21159 24.3965 6.2832 24.6543C6.35482 24.9121 6.44792 25.1413 6.5625 25.3418L13.3945 16.2754ZM32.5895 4.73828C32.5895 5.28255 32.4821 5.79102 32.2673 6.26367C32.0667 6.73633 31.7874 7.15169 31.4294 7.50977C31.0713 7.85352 30.6488 8.13281 30.1618 8.34766C29.6891 8.54818 29.1807 8.64844 28.6364 8.64844C28.0921 8.64844 27.5765 8.54818 27.0895 8.34766C26.6169 8.13281 26.2015 7.85352 25.8434 7.50977C25.4997 7.15169 25.2204 6.73633 25.0055 6.26367C24.805 5.79102 24.7048 5.28255 24.7048 4.73828C24.7048 4.20833 24.805 3.70703 25.0055 3.23438C25.2204 2.7474 25.4997 2.33203 25.8434 1.98828C26.2015 1.63021 26.6169 1.35091 27.0895 1.15039C27.5765 0.935547 28.0921 0.828125 28.6364 0.828125C29.1807 0.828125 29.6891 0.935547 30.1618 1.15039C30.6488 1.35091 31.0713 1.63021 31.4294 1.98828C31.7874 2.33203 32.0667 2.7474 32.2673 3.23438C32.4821 3.70703 32.5895 4.20833 32.5895 4.73828ZM31.5798 34H25.6716V10.9902H31.5798V34ZM43.2552 34H37.39V10.9902H38.808L40.7416 13.2246C41.6869 12.3652 42.7539 11.7064 43.9427 11.248C45.1459 10.7754 46.3991 10.5391 47.7025 10.5391C49.1061 10.5391 50.431 10.8112 51.6771 11.3555C52.9232 11.8854 54.0117 12.623 54.9427 13.5684C55.8737 14.4993 56.6042 15.5951 57.1341 16.8555C57.6784 18.1016 57.9505 19.4336 57.9505 20.8516V34H52.0853V20.8516C52.0853 20.25 51.9707 19.6842 51.7416 19.1543C51.5124 18.61 51.1973 18.1374 50.7962 17.7363C50.3952 17.3353 49.9297 17.0202 49.3998 16.791C48.8698 16.5618 48.3041 16.4473 47.7025 16.4473C47.0866 16.4473 46.5065 16.5618 45.9623 16.791C45.418 17.0202 44.9453 17.3353 44.5443 17.7363C44.1433 18.1374 43.8282 18.61 43.599 19.1543C43.3698 19.6842 43.2552 20.25 43.2552 20.8516V34ZM85.6963 34H84.2784L82.001 30.8418C81.4424 31.3431 80.848 31.8158 80.2178 32.2598C79.6019 32.6895 78.9502 33.069 78.2627 33.3984C77.5752 33.7135 76.8662 33.9642 76.1358 34.1504C75.4196 34.3366 74.6892 34.4297 73.9444 34.4297C72.3259 34.4297 70.8005 34.1289 69.3682 33.5273C67.9502 32.9115 66.7041 32.0664 65.6299 30.9922C64.57 29.9036 63.7321 28.6217 63.1162 27.1465C62.5004 25.6569 62.1924 24.0384 62.1924 22.291C62.1924 20.5579 62.5004 18.9466 63.1162 17.457C63.7321 15.9674 64.57 14.6784 65.6299 13.5898C66.7041 12.5013 67.9502 11.6491 69.3682 11.0332C70.8005 10.4173 72.3259 10.1094 73.9444 10.1094C74.46 10.1094 74.9899 10.1523 75.5342 10.2383C76.0928 10.3242 76.6299 10.4674 77.1455 10.668C77.6755 10.8542 78.1696 11.1048 78.628 11.4199C79.0863 11.735 79.473 12.1217 79.7881 12.5801V1.83789H85.6963V34ZM79.7881 22.291C79.7881 21.4889 79.6306 20.7155 79.3155 19.9707C79.0147 19.2116 78.5993 18.5456 78.0694 17.9727C77.5394 17.3854 76.9164 16.9199 76.2002 16.5762C75.4984 16.2181 74.7465 16.0391 73.9444 16.0391C73.1423 16.0391 72.3832 16.1823 71.667 16.4688C70.9652 16.7552 70.3493 17.1706 69.8194 17.7148C69.3037 18.2448 68.8955 18.8965 68.5948 19.6699C68.294 20.4434 68.1436 21.3171 68.1436 22.291C68.1436 23.1361 68.294 23.9382 68.5948 24.6973C68.8955 25.4564 69.3037 26.1224 69.8194 26.6953C70.3493 27.2682 70.9652 27.7194 71.667 28.0488C72.3832 28.3783 73.1423 28.543 73.9444 28.543C74.7465 28.543 75.4984 28.3711 76.2002 28.0273C76.9164 27.6693 77.5394 27.2038 78.0694 26.6309C78.5993 26.0436 79.0147 25.3776 79.3155 24.6328C79.6306 23.8737 79.7881 23.0931 79.7881 22.291ZM113.786 34H112.368L110.091 30.8418C109.532 31.3431 108.938 31.8158 108.307 32.2598C107.691 32.6895 107.04 33.069 106.352 33.3984C105.665 33.7135 104.956 33.9642 104.225 34.1504C103.509 34.3366 102.779 34.4297 102.034 34.4297C100.415 34.4297 98.89 34.1576 97.4577 33.6133C96.0398 33.069 94.7937 32.2812 93.7195 31.25C92.6596 30.2044 91.8217 28.9297 91.2058 27.4258C90.5899 25.9219 90.282 24.2103 90.282 22.291C90.282 20.5007 90.5899 18.8607 91.2058 17.3711C91.8217 15.8672 92.6596 14.5781 93.7195 13.5039C94.7937 12.4297 96.0398 11.599 97.4577 11.0117C98.89 10.4102 100.415 10.1094 102.034 10.1094C102.779 10.1094 103.516 10.2025 104.247 10.3887C104.977 10.5749 105.686 10.8327 106.374 11.1621C107.061 11.4915 107.713 11.8783 108.329 12.3223C108.959 12.7663 109.546 13.2461 110.091 13.7617L112.368 11.0332H113.786V34ZM107.878 22.291C107.878 21.4889 107.72 20.7155 107.405 19.9707C107.104 19.2116 106.689 18.5456 106.159 17.9727C105.629 17.3854 105.006 16.9199 104.29 16.5762C103.588 16.2181 102.836 16.0391 102.034 16.0391C101.232 16.0391 100.473 16.1751 99.7566 16.4473C99.0547 16.7194 98.4389 17.1204 97.9089 17.6504C97.3933 18.1803 96.9851 18.8392 96.6843 19.627C96.3835 20.4004 96.2331 21.2884 96.2331 22.291C96.2331 23.2936 96.3835 24.1888 96.6843 24.9766C96.9851 25.75 97.3933 26.4017 97.9089 26.9316C98.4389 27.4616 99.0547 27.8626 99.7566 28.1348C100.473 28.4069 101.232 28.543 102.034 28.543C102.836 28.543 103.588 28.3711 104.29 28.0273C105.006 27.6693 105.629 27.2038 106.159 26.6309C106.689 26.0436 107.104 25.3776 107.405 24.6328C107.72 23.8737 107.878 23.0931 107.878 22.291ZM125.504 34H119.596V1.83789H125.504V22.1191L134.248 11.0332H140.995L133.368 20.6152L140.995 34H134.248L129.586 25.6426L125.504 31.0566V34Z"
                            fill="#3654D0" />
                    </svg>

                </a>
                <!-- END NAVBAR LOGO -->
            </div>
            <div class="card card-md">
                <div class="card-body">
                    <h2 class="h2 text-center mb-4">
                        {{ __('translate.login') }}
                    </h2>
                    <form action="./" method="get" autocomplete="off" novalidate>
                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input type="email" class="form-control" placeholder="your@email.com"
                                autocomplete="off" />
                        </div>
                        <div class="mb-2">
                            <label class="form-label">
                                Password
                                <span class="form-label-description">
                                    <a href="./forgot-password.html">I forgot password</a>
                                </span>
                            </label>
                            <div class="input-group input-group-flat">
                                <input type="password" class="form-control" placeholder="Your password"
                                    autocomplete="off" />
                                <span class="input-group-text">
                                    <a href="#" class="link-secondary" title="Show password"
                                        data-bs-toggle="tooltip">
                                        <!-- Download SVG icon from http://tabler.io/icons/icon/eye -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="icon icon-1">
                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                            <path
                                                d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                        </svg>
                                    </a>
                                </span>
                            </div>
                        </div>
                        <div class="mb-2">
                            <label class="form-check">
                                <input type="checkbox" class="form-check-input" />
                                <span class="form-check-label">Remember me on this device</span>
                            </label>
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary w-100">Sign in</button>
                        </div>
                    </form>
                </div>
                <div class="hr-text">or</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <a href="#" class="btn btn-4 w-100">
                                <!-- Download SVG icon from http://tabler.io/icons/icon/brand-github -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="icon text-github icon-2">
                                    <path
                                        d="M9 19c-4.3 1.4 -4.3 -2.5 -6 -3m12 5v-3.5c0 -1 .1 -1.4 -.5 -2c2.8 -.3 5.5 -1.4 5.5 -6a4.6 4.6 0 0 0 -1.3 -3.2a4.2 4.2 0 0 0 -.1 -3.2s-1.1 -.3 -3.5 1.3a12.3 12.3 0 0 0 -6.2 0c-2.4 -1.6 -3.5 -1.3 -3.5 -1.3a4.2 4.2 0 0 0 -.1 3.2a4.6 4.6 0 0 0 -1.3 3.2c0 4.6 2.7 5.7 5.5 6c-.6 .6 -.6 1.2 -.5 2v3.5" />
                                </svg>
                                Login with Github
                            </a>
                        </div>
                        <div class="col">
                            <a href="#" class="btn btn-4 w-100">
                                <!-- Download SVG icon from http://tabler.io/icons/icon/brand-x -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="icon text-x icon-2">
                                    <path d="M4 4l11.733 16h4.267l-11.733 -16z" />
                                    <path d="M4 20l6.768 -6.768m2.46 -2.46l6.772 -6.772" />
                                </svg>
                                Login with X
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center text-secondary mt-3">Don't have account yet? <a href="./sign-up.html"
                    tabindex="-1">Sign up</a></div>
        </div> --}}
    </div>
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('assets/dist/js/tabler.min.js') }}" defer></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <!-- BEGIN DEMO SCRIPTS -->
    <script src="{{ asset('assets/preview/js/demo.min.js') }}" defer></script>
    <!-- END DEMO SCRIPTS -->
</body>

</html>
