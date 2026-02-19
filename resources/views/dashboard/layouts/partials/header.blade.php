<!-- BEGIN NAVBAR  -->
<header class="navbar navbar-expand-md d-none d-lg-flex d-print-none">
    <div class="container-xl">
        <!-- BEGIN NAVBAR TOGGLER -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
            aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- END NAVBAR TOGGLER -->
        <div class="navbar-nav flex-row ms-auto">
            <div class="d-none d-md-flex">
                <div class="nav-item">
                    <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Enable dark mode"
                        data-bs-toggle="tooltip" data-bs-placement="bottom">
                        <!-- Download SVG icon from http://tabler.io/icons/icon/moon -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon icon-1">
                            <path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" />
                        </svg>
                    </a>
                    <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Enable light mode"
                        data-bs-toggle="tooltip" data-bs-placement="bottom">
                        <!-- Download SVG icon from http://tabler.io/icons/icon/sun -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon icon-1">
                            <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                            <path
                                d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" />
                        </svg>
                    </a>
                </div>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" title="@lang('translate.language')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-world">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M3.6 9h16.8" /><path d="M3.6 15h16.8" /><path d="M11.5 3a17 17 0 0 0 0 18" /><path d="M12.5 3a17 17 0 0 1 0 18" />
                        </svg>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        @foreach (get_available_locales() as $localeCode => $properties)
                            <a class="dropdown-item @if($localeCode == get_current_locale()) active @endif" rel="alternate" hreflang="{{ $localeCode }}" href="{{ get_locale_url($localeCode) }}">
                                {{ $properties['native'] ?? $localeCode }}
                            </a>
                        @endforeach
                    </div>
                </div>
                <x-notifications-dropdown />
            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0 px-2" data-bs-toggle="dropdown"
                    aria-label="Open user menu">
                    <span class="avatar avatar-sm rounded-circle" @if($dashboardUser->avatar ?? null) style="background-image: url('{{ $dashboardUser->avatar }}')" @endif>
                        @unless($dashboardUser->avatar ?? null)
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                            <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                        </svg>
                        @endunless
                    </span>
                    <div class="d-none d-xl-block ps-2">
                        <div>{{ $dashboardUser->name ?? $dashboardUser->full_name ?? '' }}</div>
                        <div class="mt-1 small text-secondary">@lang('translate.' . ($dashboardUser->role ?? 'doctor'))</div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    {{-- <a href="#" class="dropdown-item">Status</a>
                    <a href="./profile.html" class="dropdown-item">Profile</a>
                    <a href="#" class="dropdown-item">Feedback</a> --}}

                    <div class="dropdown-divider"></div>
                    @can('view.settings')
                    <a href="{{ route('dashboard.settings.index') }}" class="dropdown-item">
                        <span class="nav-link-icon me-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M19.875 6.27a2.225 2.225 0 0 1 1.125 1.948v7.284c0 .809 -.443 1.555 -1.158 1.948l-6.75 4.27a2.269 2.269 0 0 1 -2.184 0l-6.75 -4.27a2.225 2.225 0 0 1 -1.158 -1.948v-7.285c0 -.809 .443 -1.554 1.158 -1.947l6.75 -3.98a2.33 2.33 0 0 1 2.25 0l6.75 3.98h-.033z" />
                                <path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
                            </svg>
                        </span>
                        @lang('translate.settings')
                    </a>
                    @endcan
                    <a href="{{ route('dashboard.logout') }}"
                        onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();"
                        class="dropdown-item">
                        <span class="nav-link-icon me-2">
                            <svg xmlns="http://www.w3.org/2000/svg"
                            width="24"
                            height="24"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            style="color: red;"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-logout">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M14 8v-1a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-1" />
                            <path d="M7 12h14l-3 -3m0 6l3 -3" />
                        </svg>
                        </span>
                        {{ __('translate.logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('dashboard.logout') }}" method="POST"
                        style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>

{{-- <header class="navbar-expand-md">
    <div class="collapse navbar-collapse" id="navbar-menu">
        <div class="navbar">
            <div class="container-xl">
                <div class="row flex-fill align-items-center">
                    <div class="col">
                        <!-- BEGIN NAVBAR MENU -->
                        <ul class="navbar-nav">
                            <li class="nav-item @yield('home')">
                                <a class="nav-link" href="{{ route('dashboard.home') }}">
                                    <span class="nav-link-icon">
                                        <!-- Download SVG icon from http://tabler.io/icons/icon/home -->
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-home">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                            <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                            <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                                        </svg>
                                    </span>
                                    <span class="nav-link-title">
                                        @lang('translate.home')
                                    </span>
                                </a>
                            </li>
                            <!-- admins  --------------------------------------------- -->
                            @can('view.admins')
                                <li class="nav-item @yield('admins')">
                                    <a class="nav-link" href="{{ route('dashboard.admins.index') }}">
                                        <span class="nav-link-icon">
                                            <!-- Download SVG icon from http://tabler.io/icons/icon/users -->
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-user-cog">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                                <path d="M6 21v-2a4 4 0 0 1 4 -4h2.5" />
                                                <path d="M17.001 19a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                <path d="M19.001 15.5v1.5" />
                                                <path d="M19.001 21v1.5" />
                                                <path d="M22.032 17.25l-1.299 .75" />
                                                <path d="M17.27 20l-1.3 .75" />
                                                <path d="M15.97 17.25l1.3 .75" />
                                                <path d="M20.733 20l1.3 .75" />
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            @lang('translate.admins')
                                        </span>
                                    </a>
                                </li>
                            @endcan

                            <!-- users  --------------------------------------------- -->
                            @can('view.users')
                                <li class="nav-item @yield('users')">
                                    <a class="nav-link" href="{{ route('dashboard.users.index') }}">
                                        <span class="nav-link-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                class="icon icon-tabler icons-tabler-outline icon-tabler-users">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <circle cx="9" cy="7" r="4" />
                                                <path d="M3 17v-2a4 4 0 0 1 4 -4h2" />
                                                <path d="M21 17v-2a4 4 0 0 0 -3 -3.85" />
                                                <path d="M16 5a2 2 0 0 1 2 2v1a2 2 0 0 1 -2 2" />
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">
                                            @lang('translate.users')
                                        </span>
                                    </a>
                                </li>
                            @endcan

                            <!-- clinic - التخصصات --------------------------------------------- -->
                            @can('view.specializations')
                                <li class="nav-item @yield('clinic_specializations')">
                                    <a class="nav-link" href="{{ route('dashboard.clinic.specializations.index') }}">
                                        <span class="nav-link-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-stethoscope">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M6 4h-1a2 2 0 0 0 -2 2v3.5h0a1.5 1.5 0 0 0 1.5 1.5h1a1.5 1.5 0 0 0 1.5 -1.5h0v-3a2 2 0 0 0 -2 -2h-1" />
                                                <path d="M4.5 17a2 2 0 0 0 2 2h1a2 2 0 0 0 2 -2v-3.5h-5v3.5" />
                                                <path d="M12 8v5" />
                                                <path d="M12 17v.01" />
                                                <path d="M16 17v.01" />
                                                <path d="M15 8a2 2 0 0 1 2 2v3" />
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">@lang('translate.specializations')</span>
                                    </a>
                                </li>
                            @endcan

                            <!-- clinic - الأطباء --------------------------------------------- -->
                            @can('view.doctors')
                                <li class="nav-item @yield('clinic_doctors')">
                                    <a class="nav-link" href="{{ route('dashboard.clinic.doctors.index') }}">
                                        <span class="nav-link-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">@lang('translate.doctors')</span>
                                    </a>
                                </li>
                            @endcan

                            <!-- clinic - الموظفين --------------------------------------------- -->
                            @can('view.employees')
                                <li class="nav-item @yield('clinic_employees')">
                                    <a class="nav-link" href="{{ route('dashboard.clinic.employees.index') }}">
                                        <span class="nav-link-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-users">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <circle cx="9" cy="7" r="4" />
                                                <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                                <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                                <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">@lang('translate.employees')</span>
                                    </a>
                                </li>
                            @endcan

                            <!-- clinic - المرضى --------------------------------------------- -->
                            @can('view.patients')
                                <li class="nav-item @yield('clinic_patients')">
                                    <a class="nav-link" href="{{ route('dashboard.clinic.patients.index') }}">
                                        <span class="nav-link-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-wheelchair"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 16a5 5 0 1 0 10 0a5 5 0 1 0 -10 0" /><path d="M17 19a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M19 17a3 3 0 0 0 -3 -3h-3.4" /><path d="M3 3h1a2 2 0 0 1 2 2v6" /><path d="M6 8h11" /><path d="M15 8v6" /></svg>
                                        </span>
                                        <span class="nav-link-title">@lang('translate.patients')</span>
                                    </a>
                                </li>
                            @endcan

                            <!-- clinic - الأدوية --------------------------------------------- -->
                            @can('view.medications')
                                <li class="nav-item @yield('clinic_medications')">
                                    <a class="nav-link" href="{{ route('dashboard.clinic.medications.index') }}">
                                        <span class="nav-link-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-pill"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4.5 12.5l8 -8a4.94 4.94 0 0 1 7 7l-8 8a4.94 4.94 0 0 1 -7 -7" /><path d="M8.5 8.5l7 7" /></svg>                                        </span>
                                        <span class="nav-link-title">@lang('translate.medications')</span>
                                    </a>
                                </li>
                            @endcan

                            <!-- clinic - المواعيد --------------------------------------------- -->
                            @can('view.appointments')
                                <li class="nav-item @yield('clinic_appointments')">
                                    <a class="nav-link" href="{{ route('dashboard.clinic.appointments.index') }}">
                                        <span class="nav-link-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-check">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M11.5 21h-5.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v6" />
                                                <path d="M16 3v4" />
                                                <path d="M8 3v4" />
                                                <path d="M4 11h16" />
                                                <path d="M15 19l2 2l4 -4" />
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">@lang('translate.appointments')</span>
                                    </a>
                                </li>
                            @endcan

                            <!-- clinic - الروشتات --------------------------------------------- -->
                            @can('view.prescriptions')
                                <li class="nav-item @yield('clinic_prescriptions')">
                                    <a class="nav-link" href="{{ route('dashboard.clinic.prescriptions.index') }}">
                                        <span class="nav-link-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-file-text">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                                <path d="M9 17h6" />
                                                <path d="M9 13h6" />
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">@lang('translate.prescriptions')</span>
                                    </a>
                                </li>
                            @endcan

                            <!-- clinic - الفحوصات الطبية --------------------------------------------- -->
                            @can('view.examinations')
                                <li class="nav-item @yield('clinic_examinations')">
                                    <a class="nav-link" href="{{ route('dashboard.clinic.examinations.index') }}">
                                        <span class="nav-link-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-clipboard-text">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
                                                <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                                <path d="M9 12h6" />
                                                <path d="M9 16h6" />
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">@lang('translate.medical_examinations')</span>
                                    </a>
                                </li>
                            @endcan

                            <!-- contact messages --------------------------------------------- -->
                            @can('view.admins') <!-- Only admins can see contact messages -->
                                <li class="nav-item @yield('contact_messages')">
                                    <a class="nav-link" href="{{ route('dashboard.contact_messages.index') }}">
                                        <span class="nav-link-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-mail">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                <path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" />
                                                <path d="M3 7l9 6l9 -6" />
                                            </svg>
                                        </span>
                                        <span class="nav-link-title">@lang('translate.contact_messages')</span>
                                    </a>
                                </li>
                            @endcan

                        </ul>
                        <!-- END NAVBAR MENU -->
                    </div>

                </div>
            </div>
        </div>
    </div>
</header>--}}
<!-- END NAVBAR  -->
