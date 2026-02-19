<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"
    data-bs-theme="{{ request()->get('theme', 'light') }}" style="margin: 0;">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'HMS') }} — {{ __('translate.welcome') }}</title>

    {{-- Tabler Theme Script --}}
    <script src="{{ asset('assets/dist/js/tabler-theme.min.js') }}"></script>

    {{-- Fonts --}}
    <style>@import url('https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&family=Outfit:wght@100..900&display=swap');</style>
    
    {{-- Tabler CSS --}}
    @if (app()->getLocale() == 'ar')
        <link href="{{ asset('assets/dist/css/tabler-themes.rtl.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/dist/css/tabler.rtl.min.css') }}" rel="stylesheet" />
    @else
        <link href="{{ asset('assets/dist/css/tabler-themes.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/dist/css/tabler.min.css') }}" rel="stylesheet" />
    @endif
    
    <style>
        :root {
            --hms-primary: #066fd1;
            --hms-primary-shade: #0559a7;
            --hms-bg-glass: rgba(255, 255, 255, 0.85);
            --font-family: 'Cairo', 'Outfit', sans-serif;
        }

        [data-bs-theme=dark] {
            --hms-bg-glass: rgba(17, 24, 39, 0.85);
            --tblr-body-bg: #111827;
            --tblr-body-color: #e5e7eb;
        }

        body {
            font-family: var(--font-family);
            background: var(--tblr-body-bg);
            color: var(--tblr-body-color);
            transition: background-color 0.3s, color 0.3s;
            overflow-x: hidden;
        }

        /* Navbar Styling */
        .navbar-landing {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            transition: all 0.3s ease;
            backdrop-filter: blur(8px);
            background: transparent;
            border-bottom: 1px solid transparent;
            padding: 1rem 0;
        }

        .navbar-landing.scrolled {
            background: var(--hms-bg-glass);
            border-bottom: 1px solid var(--tblr-border-color);
            padding: 0.5rem 0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .logo-hms {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--hms-primary);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-link-custom {
            font-weight: 600;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            transition: all 0.2s;
        }

        .nav-link-custom:hover {
            background: rgba(var(--tblr-primary-rgb), 0.1);
            color: var(--hms-primary) !important;
        }

        /* Hero Section */
        .hero-section {
            position: relative;
            padding: 10rem 0 6rem;
            min-height: 80vh;
            display: flex;
            align-items: center;
            background: linear-gradient(135deg, rgba(6, 111, 209, 0.05) 0%, rgba(6, 111, 209, 0.1) 100%);
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: -10%;
            right: -10%;
            width: 50%;
            height: 50%;
            background: radial-gradient(circle, rgba(6, 111, 209, 0.1) 0%, transparent 70%);
            border-radius: 50%;
            z-index: 0;
        }

        .hero-title {
            font-size: clamp(2rem, 5vw, 3.5rem);
            font-weight: 900;
            line-height: 1.2;
            margin-bottom: 1.5rem;
            color: var(--tblr-emphasis-color);
        }

        .hero-subtitle {
            font-size: 1.25rem;
            color: var(--tblr-secondary-color);
            margin-bottom: 2.5rem;
            max-width: 600px;
        }

        .hero-image {
            position: relative;
            z-index: 1;
            border-radius: 2rem;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            transition: transform 0.5s ease;
        }

        .hero-image:hover {
            transform: translateY(-10px);
        }

        /* Stats & Analytics Section */
        .analytics-section {
            padding: 8rem 0;
            background: #f8fafc;
        }

        .stat-card {
            background: white;
            border: 1px solid rgba(0, 0, 0, 0.05);
            border-radius: 1.5rem;
            padding: 2.5rem;
            text-align: center;
            height: 100%;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            background: rgba(var(--tblr-primary-rgb), 0.1);
            color: var(--hms-primary);
            border-radius: 1.25rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin: 0 auto 1.5rem;
        }

        .stat-card h3 {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            color: var(--tblr-emphasis-color);
        }

        .stat-card p {
            color: var(--tblr-secondary-color);
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 0;
        }

        .chart-container {
            background: white;
            border: 1px solid rgba(0, 0, 0, 0.05);
            border-radius: 2rem;
            padding: 3rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
            margin-top: 4rem;
        }

        [data-bs-theme=dark] .analytics-section {
            background: #0f172a;
        }

        [data-bs-theme=dark] .stat-card, 
        [data-bs-theme=dark] .chart-container,
        [data-bs-theme=dark] .service-card,
        [data-bs-theme=dark] .spec-card,
        [data-bs-theme=dark] .contact-card {
            background: #1e293b !important;
            border-color: rgba(255, 255, 255, 0.05) !important;
            color: #f8fafc;
        }

        [data-bs-theme=dark] .analytics-section,
        [data-bs-theme=dark] .bg-light-dynamic {
            background: #0f172a !important;
        }

        .bg-light-dynamic {
            background: #f8fafc;
        }

        .spec-card, .contact-card {
            background: white;
            border: 1px solid rgba(0, 0, 0, 0.05);
            border-radius: 1.5rem;
            padding: 2.5rem;
            height: 100%;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .spec-card:hover, .contact-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        [data-bs-theme=dark] .form-control.bg-light {
            background-color: #1e293b !important;
            color: #f8fafc !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
        }

        [data-bs-theme=dark] .form-control.bg-light::placeholder {
            color: #94a3b8 !important;
        }

        [data-bs-theme=dark] .text-secondary {
            color: #94a3b8 !important;
        }

        [data-bs-theme=dark] .form-floating > label {
            color: #94a3b8 !important;
        }

        /* Services Section */
        .services-section {
            padding: 8rem 0;
        }

        .section-tag {
            display: inline-block;
            padding: 0.5rem 1rem;
            background: rgba(var(--tblr-primary-rgb), 0.1);
            color: var(--hms-primary);
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.875rem;
            margin-bottom: 1rem;
        }

        .service-card {
            background: var(--tblr-card-bg);
            border: 1px solid var(--tblr-border-color);
            border-radius: 1.5rem;
            padding: 2.5rem;
            height: 100%;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .service-card:hover {
            transform: translateY(-10px);
            border-color: var(--hms-primary);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05);
        }

        .service-icon {
            width: 64px;
            height: 64px;
            background: rgba(var(--tblr-primary-rgb), 0.1);
            color: var(--hms-primary);
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            margin-bottom: 1.5rem;
        }

        /* About Section */
        .about-section {
            padding: 6rem 0;
            background: var(--tblr-secondary-bg);
            border-radius: 4rem;
            margin: 4rem 1.5rem;
        }

        /* Footer */
        .footer-landing {
            padding: 5rem 0 2rem;
            border-top: 1px solid var(--tblr-border-color);
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-fade-in {
            animation: fadeIn 0.8s forwards;
        }

        .delay-1 { animation-delay: 0.2s; }
        .delay-2 { animation-delay: 0.4s; }
        .delay-3 { animation-delay: 0.6s; }

        .btn-premium {
            padding: 0.75rem 2rem;
            border-radius: 0.75rem;
            font-weight: 700;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-premium-primary {
            background: var(--hms-primary);
            color: white;
            border: none;
        }

        .btn-premium-primary:hover {
            background: var(--hms-primary-shade);
            transform: scale(1.05);
            box-shadow: 0 10px 15px -3px rgba(6, 111, 209, 0.3);
        }

        /* How it Works */
        .step-card {
            background: var(--tblr-card-bg);
            border-radius: 2rem;
            border: 1px solid var(--tblr-border-color);
            transition: all 0.3s;
        }

        .step-card:hover {
            border-color: var(--hms-primary);
            transform: translateY(-5px);
        }

        .step-number {
            width: 48px;
            height: 48px;
            background: var(--hms-primary);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            font-weight: 800;
            margin: 0 auto;
        }

        /* Testimonials */
        .testimonial-card {
            transition: all 0.3s;
        }

        .testimonial-card:hover {
            transform: scale(1.02);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1) !important;
        }

        /* Utils */
        .py-8 { padding-top: 8rem; padding-bottom: 8rem; }
    </style>
</head>
<body>
    {{-- Navbar --}}
    <nav class="navbar-landing" id="mainHeader">
        <div class="container-xl d-flex justify-content-between align-items-center">
            <a href="{{ url('/') }}" class="logo-hms">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 14c1.66 0 3-1.34 3-3V5c0-1.66-1.34-3-3-3H5C3.34 2 2 3.34 2 5v6c0 1.66 1.34 3 3 3"/>
                    <path d="M18 22H6c-1.1 0-2-.9-2-2v-4c0-1.1.9-2 2-2h12c1.1 0 2 .9 2 2v4c0 1.1-.9 2-2 2z"/>
                    <path d="M12 2v10"/>
                </svg>
                <span>{{ config('app.name', 'HMS') }}</span>
            </a>

            <div class="d-flex align-items-center gap-3">
                <div class="d-none d-md-flex gap-2">
                    @if (function_exists('get_available_locales'))
                        @foreach (get_available_locales() as $localeCode => $properties)
                            <a href="{{ get_locale_url($localeCode) }}" class="btn btn-ghost-primary btn-sm px-2">
                                {{ $properties['native'] ?? strtoupper($localeCode) }}
                            </a>
                        @endforeach
                    @endif
                </div>

                <div class="h-divider d-none d-md-block" style="width: 1px; height: 24px; background: var(--tblr-border-color);"></div>

                <div class="d-flex gap-2">
                    @auth('admin')
                        <a href="{{ route('dashboard.home') }}" class="btn btn-primary btn-premium">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler-layout-dashboard" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 4h6v8h-6z" /><path d="M4 16h6v4h-6z" /><path d="M14 12h6v8h-6z" /><path d="M14 4h6v4h-6z" /></svg>
                            {{ __('translate.dashboard') }}
                        </a>
                    @else
                        <a href="{{ route('dashboard.login') }}" class="btn btn-ghost-primary fw-bold">{{ __('translate.login') }}</a>
                        @if (Route::has('dashboard.register'))
                            <a href="{{ route('dashboard.register') }}" class="btn btn-primary btn-premium">
                                {{ __('translate.register') }}
                            </a>
                        @endif
                    @endauth
                </div>

                {{-- Theme Switcher --}}
                <div class="nav-item d-flex">
                    <a href="{{ request()->fullUrlWithQuery(['theme' => 'dark']) }}" class="nav-link px-0 hide-theme-dark" title="Dark mode">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" /></svg>
                    </a>
                    <a href="{{ request()->fullUrlWithQuery(['theme' => 'light']) }}" class="nav-link px-0 hide-theme-light" title="Light mode">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" /></svg>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <main>
        {{-- Hero --}}
        <section class="hero-section">
            <div class="container-xl">
                <div class="row align-items-center g-5">
                    <div class="col-lg-6 animate-fade-in">
                        <span class="section-tag">{{ config('app.name', 'HMS') }} {{ __('translate.welcome_platform') }}</span>
                        <h1 class="hero-title">{{ __('translate.welcome_hero_title') }}</h1>
                        <p class="hero-subtitle">{{ __('translate.welcome_hero_subtitle') }}</p>
                        <div class="d-flex gap-3">
                            <a href="{{ route('patient.register') }}" class="btn btn-primary btn-premium py-3 px-4 shadow-sm">
                                <span>{{ __('translate.book_appointment') }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="{{ app()->getLocale() == 'ar' ? 'rotate-180' : '' }}"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                            </a>
                            <a href="#features" class="btn btn-outline-primary btn-premium py-3 px-4">
                                {{ __('translate.welcome_features_title') }}
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 animate-fade-in delay-1">
                        <div class="position-relative">
                            <img src="https://images.unsplash.com/photo-1516549655169-df83a0774514?q=80&w=2070&auto=format&fit=crop" alt="Medical Platform" class="img-fluid hero-image">
                            <div class="position-absolute bottom-0 start-0 m-4 p-3 bg-white rounded-4 shadow-lg d-none d-md-flex align-items-center gap-3 animate-fade-in delay-3" style="color: #333">
                                <div class="bg-success-lt p-2 rounded-circle">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon text-success" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                                </div>
                                <div>
                                    <div class="fw-bold">{{ __('translate.welcome_reliable') }}</div>
                                    <div class="small text-muted">{{ __('translate.welcome_cloud_hosted') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Analytics & Stats --}}
        <section class="analytics-section">
            <div class="container-xl">
                <div class="text-center mb-6">
                    <span class="section-tag">@lang('translate.analytics')</span>
                    <h2 class="display-6 fw-bold mt-2">@lang('translate.welcome_platform_insights')</h2>
                </div>
                
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user-doctor" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 21v-2a4 4 0 0 1 4 -4h1" /><path d="M15 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M15 21a2 2 0 0 0 2 -2.2" /><path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M17 12l2 2l4 -4" /></svg>
                            </div>
                            <h3>{{ $stats['doctors'] ?? 0 }}+</h3>
                            <p>@lang('translate.welcome_stats_doctors')</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-hospital-user" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 21v-2a4 4 0 0 1 4 -4h2" /><path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" /><path d="M12 21v-4" /><path d="M14 19l2 2l4 -4" /></svg>
                            </div>
                            <h3>{{ $stats['patients'] ?? 0 }}+</h3>
                            <p>@lang('translate.welcome_stats_patients')</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-microscope" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 21h14" /><path d="M6 18h2" /><path d="M7 18v3" /><path d="M9 11l3 3l6 -6l-3 -3z" /><path d="M10.5 12.5l-1.5 1.5" /><path d="M17 3l3 3" /><path d="M12 21a6 6 0 0 0 3.715 -10.712" /></svg>
                            </div>
                            <h3>{{ $stats['specializations'] ?? 0 }}+</h3>
                            <p>@lang('translate.specializations')</p>
                        </div>
                    </div>
                </div>

                <div class="chart-container">
                    <div class="d-flex align-items-center justify-content-between mb-5 flex-wrap gap-3">
                        <div>
                            <h4 class="fw-bold mb-0" style="font-size: 1.5rem;">@lang('translate.platform_growth')</h4>
                            <p class="text-muted small mb-0">@lang('translate.growth_last_6_months')</p>
                        </div>
                        <div class="badge bg-primary-lt p-2 px-3 rounded-pill">
                            <i class="fa-solid fa-clock-rotate-left me-2"></i> @lang('translate.real_time_data')
                        </div>
                    </div>
                    <div id="welcome-growth-chart" style="min-height: 400px;"></div>
                </div>
            </div>
        </section>

        {{-- Features --}}
        <section class="services-section" id="features">
            <div class="container-xl">
                <div class="text-center mb-6">
                    <span class="section-tag">{{ __('translate.welcome_features_title') }}</span>
                    <h2 class="display-5 fw-bold">{{ __('translate.welcome_services_title') }}</h2>
                </div>
                <div class="row g-4">
                    <div class="col-md-6 col-lg-3">
                        <div class="service-card animate-fade-in">
                            <div class="service-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler-calendar-stats"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M11.795 21h-6.795a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v4" /><path d="M18 14v4h4" /><path d="M18 18m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M15 3v4" /><path d="M7 3v4" /><path d="M3 11h16" /></svg>
                            </div>
                            <h3>{{ __('translate.welcome_feature_appointments') }}</h3>
                            <p>{{ __('translate.welcome_feature_appointments_desc') }}</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="service-card animate-fade-in delay-1">
                            <div class="service-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler-pill"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4.5 12.5l8 -8a4.94 4.94 0 0 1 7 7l-8 8a4.94 4.94 0 0 1 -7 -7" /><path d="M8.5 8.5l7 7" /></svg>
                            </div>
                            <h3>{{ __('translate.welcome_feature_prescriptions') }}</h3>
                            <p>{{ __('translate.welcome_feature_prescriptions_desc') }}</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="service-card animate-fade-in delay-2">
                            <div class="service-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler-hospital"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 21l18 0" /><path d="M5 21v-16a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v16" /><path d="M9 21v-4a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v4" /><path d="M10 9l4 0" /><path d="M12 7l0 4" /></svg>
                            </div>
                            <h3>{{ __('translate.welcome_feature_clinic') }}</h3>
                            <p>{{ __('translate.welcome_feature_clinic_desc') }}</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="service-card animate-fade-in delay-3">
                            <div class="service-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler-shield-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M11.46 20.77a12 12 0 0 1 -6.46 -11.77a12 12 0 0 0 7 -3a12 12 0 0 0 7 3a12 12 0 0 1 -3.34 8.232" /><path d="M9 12l2 2l4 -4" /></svg>
                            </div>
                            <h3>{{ __('translate.welcome_feature_secure') }}</h3>
                            <p>{{ __('translate.welcome_feature_secure_desc') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- About --}}
        <section class="about-section">
            <div class="container-xl">
                <div class="row align-items-center g-5">
                    <div class="col-lg-6">
                        <img src="https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?q=80&w=2053&auto=format&fit=crop" alt="Doctors" class="img-fluid rounded-5 shadow-lg">
                    </div>
                    <div class="col-lg-6">
                        <span class="section-tag">{{ __('translate.welcome_about_title') }}</span>
                        <h2 class="display-6 fw-bold mb-4">{{ __('translate.welcome_hero_title') }}</h2>
                        <p class="lead mb-4 text-secondary">
                            {{ __('translate.welcome_about_desc') }}
                        </p>
                        <ul class="list-unstyled mb-5">
                            <li class="mb-3 d-flex align-items-center gap-3">
                                <div class="bg-primary-lt p-1 rounded-circle">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon text-primary" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                                </div>
                                <span class="fw-bold">{{ __('translate.welcome_about_support') }}</span>
                            </li>
                            <li class="mb-3 d-flex align-items-center gap-3">
                                <div class="bg-primary-lt p-1 rounded-circle">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon text-primary" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                                </div>
                                <span class="fw-bold">{{ __('translate.welcome_about_updates') }}</span>
                            </li>
                            <li class="mb-3 d-flex align-items-center gap-3">
                                <div class="bg-primary-lt p-1 rounded-circle">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon text-primary" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                                </div>
                                <span class="fw-bold">{{ __('translate.welcome_about_encryption') }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        {{-- Available Specializations --}}
        @if(isset($specializations) && $specializations->count() > 0)
        <section class="py-8 bg-light-dynamic">
            <div class="container-xl text-center">
                <span class="section-tag">@lang('translate.specializations')</span>
                <h2 class="display-6 fw-bold mb-5">@lang('translate.welcome_platform') {{ config('app.name') }}</h2>
                <div class="row g-4">
                    @foreach($specializations as $spec)
                        <div class="col-md-3">
                            <div class="card spec-card p-4 shadow-sm h-100 border-0 rounded-4 transition-all hover-translate-y">
                                <div class="bg-primary-lt p-3 rounded-circle mx-auto mb-3" style="width: 60px; height: 60px; display: flex; align-items: center; justify-content: center;">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon text-primary" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3a12 12 0 0 0 8.5 3a12 12 0 0 1 -8.5 15a12 12 0 0 1 -8.5 -15a12 12 0 0 0 8.5 -3"/></svg>
                                </div>
                                <h4 class="fw-bold mb-2">{{ $spec->specialization_name }}</h4>
                                <p class="text-secondary small mb-0">{{ Str::limit($spec->description, 80) }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif

        {{-- Contact Us --}}
        <section class="py-8" id="contact">
            <div class="container-xl">
                <div class="row g-5">
                    <div class="col-lg-5">
                        <span class="section-tag">@lang('translate.welcome_contact_title')</span>
                        <h2 class="display-6 fw-bold mb-4">@lang('translate.welcome_hero_title')</h2>
                        <p class="text-secondary mb-5">@lang('translate.welcome_footer_desc')</p>
                        
                        <div class="d-flex align-items-center gap-4 mb-4">
                            <div class="bg-primary text-white p-3 rounded-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" /><path d="M3 7l9 6l9 -6" /></svg>
                            </div>
                            <div>
                                <h5 class="mb-1">@lang('translate.contact_via_email')</h5>
                                <p class="mb-0 text-secondary">support@hms.com</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="card contact-card p-5 shadow-lg border-0 rounded-5">
                            @if(session('success'))
                                <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4">
                                    {{ session('success') }}
                                </div>
                            @endif

                            <form action="{{ route('contact.store') }}" method="POST">
                                @csrf
                                <div class="row g-4">
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="text" name="name" class="form-control rounded-4 border-0 bg-light" id="contact_name" placeholder="@lang('translate.enter_name')" required>
                                            <label for="contact_name">@lang('translate.enter_name')</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="email" name="email" class="form-control rounded-4 border-0 bg-light" id="contact_email" placeholder="name@example.com" required>
                                            <label for="contact_email">@lang('translate.email')</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="text" name="subject" class="form-control rounded-4 border-0 bg-light" id="contact_subject" placeholder="@lang('translate.subject')">
                                            <label for="contact_subject">@lang('translate.subject')</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <textarea name="message" class="form-control rounded-4 border-0 bg-light" id="contact_message" placeholder="@lang('translate.message')" style="height: 150px" required></textarea>
                                            <label for="contact_message">@lang('translate.message')</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary btn-premium py-3 px-5 shadow-lg">
                                            <span>@lang('translate.submit')</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 14l11 -11" /><path d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5" /></svg>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer-landing bg-dark text-white">
        <div class="container-xl">
            <div class="row g-5 mb-5">
                <div class="col-lg-4">
                    <a href="{{ url('/') }}" class="logo-hms mb-4" style="color: white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 14c1.66 0 3-1.34 3-3V5c0-1.66-1.34-3-3-3H5C3.34 2 2 3.34 2 5v6c0 1.66 1.34 3 3 3"/>
                            <path d="M18 22H6c-1.1 0-2-.9-2-2v-4c0-1.1.9-2 2-2h12c1.1 0 2 .9 2 2v4c0 1.1-.9 2-2 2z"/>
                            <path d="M12 2v10"/>
                        </svg>
                        <span>{{ config('app.name', 'HMS') }}</span>
                    </a>
                    <p class="text-white-50">
                        {{ __('translate.welcome_footer_desc') }}
                    </p>
                </div>
                <div class="col-lg-2">
                    <h4 class="mb-4">{{ __('translate.welcome_features_title') }}</h4>
                    <ul class="list-unstyled text-white-50">
                        <li class="mb-2"><a href="#" class="text-reset text-decoration-none">{{ __('translate.appointments') }}</a></li>
                        <li class="mb-2"><a href="#" class="text-reset text-decoration-none">{{ __('translate.doctors') }}</a></li>
                        <li class="mb-2"><a href="#" class="text-reset text-decoration-none">{{ __('translate.patients') }}</a></li>
                    </ul>
                </div>
                <div class="col-lg-2">
                    <h4 class="mb-4">{{ __('translate.welcome_company') }}</h4>
                    <ul class="list-unstyled text-white-50">
                        <li class="mb-2"><a href="#" class="text-reset text-decoration-none">{{ __('translate.about_us') }}</a></li>
                        <li class="mb-2"><a href="#" class="text-reset text-decoration-none">{{ __('translate.welcome_privacy_policy') }}</a></li>
                        <li class="mb-2"><a href="#" class="text-reset text-decoration-none">{{ __('translate.welcome_terms_of_service') }}</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h4 class="mb-4">{{ __('translate.welcome_contact_title') }}</h4>
                    <p class="text-white-50">{{ __('translate.email') }}: support@hms.com</p>
                    <p class="text-white-50">{{ __('translate.phone') }}: +966 123 456 789</p>
                </div>
            </div>
            <hr class="border-white-10">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <p class="mb-0 text-white-50">&copy; {{ date('Y') }} {{ config('app.name', 'HMS') }}. {{ __('translate.welcome_all_rights_reserved') }}</p>
                <div class="d-flex gap-3">
                    <a href="#" class="text-white-50"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 4l11.733 16h4.267l-11.733 -16z" /><path d="M4 20l6.768 -6.768m2.46 -2.46l6.772 -6.772" /></svg></a>
                    <a href="#" class="text-white-50"><svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3" /></svg></a>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('assets/dist/js/tabler.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        // Header scroll effect
        window.addEventListener('scroll', function() {
            const header = document.getElementById('mainHeader');
            if (header) {
                if (window.scrollY > 50) {
                    header.classList.add('scrolled');
                } else {
                    header.classList.remove('scrolled');
                }
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            if (typeof ApexCharts !== 'undefined') {
                var isDark = document.documentElement.getAttribute('data-bs-theme') === 'dark';
                var options = {
                    series: [{
                        name: "{{ __('translate.doctors') }}",
                        data: @json($chartDoctors ?? [])
                    }, {
                        name: "{{ __('translate.patients') }}",
                        data: @json($chartPatients ?? [])
                    }],
                    chart: {
                        type: 'area',
                        height: 400,
                        toolbar: { show: false },
                        fontFamily: 'Cairo, sans-serif',
                        background: 'transparent',
                        zoom: { enabled: false }
                    },
                    colors: ['#066fd1', '#2fb344'],
                    dataLabels: { enabled: false },
                    stroke: { curve: 'smooth', width: 4, lineCap: 'round' },
                    fill: {
                        type: 'gradient',
                        gradient: {
                            shadeIntensity: 1,
                            opacityFrom: 0.5,
                            opacityTo: 0.05,
                            stops: [0, 90, 100]
                        }
                    },
                    grid: {
                        borderColor: isDark ? '#374151' : '#f1f1f1',
                        strokeDashArray: 4,
                        padding: { left: 20, right: 20 }
                    },
                    xaxis: {
                        categories: @json($chartMonths ?? []),
                        axisBorder: { show: false },
                        axisTicks: { show: false },
                        labels: {
                            style: { colors: isDark ? '#9ca3af' : '#6b7280', fontSize: '13px', fontWeight: 600 }
                        }
                    },
                    yaxis: {
                        labels: {
                            style: { colors: isDark ? '#9ca3af' : '#6b7280', fontSize: '13px', fontWeight: 600 }
                        }
                    },
                    markers: { 
                        size: 6, 
                        colors: ['#066fd1', '#2fb344'],
                        strokeColors: '#fff',
                        strokeWidth: 3,
                        hover: { size: 8 }
                    },
                    tooltip: {
                        theme: isDark ? 'dark' : 'light',
                        x: { show: true },
                        y: {
                            formatter: function (val) { return val + " " + "{{ __('translate.members') }}" }
                        }
                    },
                    legend: {
                        position: 'top',
                        horizontalAlign: 'right',
                        fontFamily: 'Cairo, sans-serif',
                        fontWeight: 700,
                        markers: { radius: 12, width: 12, height: 12 }
                    }
                };

                var chart = new ApexCharts(document.querySelector("#welcome-growth-chart"), options);
                chart.render();
            }
        });
    </script>
</body>
</html>
