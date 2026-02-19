@php
    $dashboardUser = auth()->user();
@endphp

<aside class="navbar navbar-vertical navbar-expand-lg sidebar-glass">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu"
            aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand navbar-brand-autodark">
            <a href="{{ route('dashboard.home') }}">
                <svg width="110" height="32" viewBox="0 0 141 35" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M10.3867 28.3711C10.6159 28.4427 10.8451 28.4928 11.0742 28.5215C11.3034 28.5358 11.5326 28.543 11.7617 28.543C12.3346 28.543 12.8861 28.4642 13.416 28.3066C13.946 28.1491 14.4401 27.9271 14.8984 27.6406C15.3711 27.3398 15.7865 26.9818 16.1445 26.5664C16.5169 26.1367 16.8177 25.6641 17.0469 25.1484L21.3438 29.4668C20.7995 30.2402 20.1693 30.9349 19.4531 31.5508C18.7513 32.1667 17.985 32.6895 17.1543 33.1191C16.3379 33.5488 15.4714 33.8711 14.5547 34.0859C13.6523 34.3151 12.7214 34.4297 11.7617 34.4297C10.1432 34.4297 8.61784 34.1289 7.18555 33.5273C5.76758 32.9258 4.52148 32.0879 3.44727 31.0137C2.38737 29.9395 1.54948 28.6647 0.933594 27.1895C0.317708 25.6999 0.00976562 24.0671 0.00976562 22.291C0.00976562 20.472 0.317708 18.8105 0.933594 17.3066C1.54948 15.8027 2.38737 14.5208 3.44727 13.4609C4.52148 12.401 5.76758 11.5775 7.18555 10.9902C8.61784 10.403 10.1432 10.1094 11.7617 10.1094C12.7214 10.1094 13.6595 10.224 14.5762 10.4531C15.4928 10.6823 16.3594 11.0117 17.1758 11.4414C18.0065 11.8711 18.7799 12.401 19.4961 13.0312C20.2122 13.6471 20.8424 14.3418 21.3867 15.1152L10.3867 28.3711ZM13.3945 16.2754C13.1224 16.1751 12.8503 16.1107 12.5781 16.082C12.3203 16.0534 12.0482 16.0391 11.7617 16.0391C10.9596 16.0391 10.2005 16.1895 9.48438 16.4902C8.78255 16.7767 8.16667 17.1921 7.63672 17.7363C7.12109 18.2806 6.71289 18.9395 6.41211 19.7129C6.11133 20.472 5.96094 21.3314 5.96094 22.291C5.96094 22.5059 5.9681 22.7493 5.98242 23.0215C6.01107 23.2936 6.04688 23.5729 6.08984 23.8594C6.14714 24.1315 6.21159 24.3965 6.2832 24.6543C6.35482 24.9121 6.44792 25.1413 6.5625 25.3418L13.3945 16.2754ZM32.5895 4.73828C32.5895 5.28255 32.4821 5.79102 32.2673 6.26367C32.0667 6.73633 31.7874 7.15169 31.4294 7.50977C31.0713 7.85352 30.6488 8.13281 30.1618 8.34766C29.6891 8.54818 29.1807 8.64844 28.6364 8.64844C28.0921 8.64844 27.5765 8.54818 27.0895 8.34766C26.6169 8.13281 26.2015 7.85352 25.8434 7.50977C25.4997 7.15169 25.2204 6.73633 25.0055 6.26367C24.805 5.79102 24.7048 5.28255 24.7048 4.73828C24.7048 4.20833 24.805 3.70703 25.0055 3.23438C25.2204 2.7474 25.4997 2.33203 25.8434 1.98828C26.2015 1.63021 26.6169 1.35091 27.0895 1.15039C27.5765 0.935547 28.0921 0.828125 28.6364 0.828125C29.1807 0.828125 29.6891 0.935547 30.1618 1.15039C30.6488 1.35091 31.0713 1.63021 31.4294 1.98828C31.7874 2.33203 32.0667 2.7474 32.2673 3.23438C32.4821 3.70703 32.5895 4.20833 32.5895 4.73828ZM31.5798 34H25.6716V10.9902H31.5798V34ZM43.2552 34H37.39V10.9902H38.808L40.7416 13.2246C41.6869 12.3652 42.7539 11.7064 43.9427 11.248C45.1459 10.7754 46.3991 10.5391 47.7025 10.5391C49.1061 10.5391 50.431 10.8112 51.6771 11.3555C52.9232 11.8854 54.0117 12.623 54.9427 13.5684C55.8737 14.4993 56.6042 15.5951 57.1341 16.8555C57.6784 18.1016 57.9505 19.4336 57.9505 20.8516V34H52.0853V20.8516C52.0853 20.25 51.9707 19.6842 51.7416 19.1543C51.5124 18.61 51.1973 18.1374 50.7962 17.7363C50.3952 17.3353 49.9297 17.0202 49.3998 16.791C48.8698 16.5618 48.3041 16.4473 47.7025 16.4473C47.0866 16.4473 46.5065 16.5618 45.9623 16.791C45.418 17.0202 44.9453 17.3353 44.5443 17.7363C44.1433 18.1374 43.8282 18.61 43.599 19.1543C43.3698 19.6842 43.2552 20.25 43.2552 20.8516V34ZM85.6963 34H84.2784L82.001 30.8418C81.4424 31.3431 80.848 31.8158 80.2178 32.2598C79.6019 32.6895 78.9502 33.069 78.2627 33.3984C77.5752 33.7135 76.8662 33.9642 76.1358 34.1504C75.4196 34.3366 74.6892 34.4297 73.9444 34.4297C72.3259 34.4297 70.8005 34.1289 69.3682 33.5273C67.9502 32.9115 66.7041 32.0664 65.6299 30.9922C64.57 29.9036 63.7321 28.6217 63.1162 27.1465C62.5004 25.6569 62.1924 24.0384 62.1924 22.291C62.1924 20.5579 62.5004 18.9466 63.1162 17.457C63.7321 15.9674 64.57 14.6784 65.6299 13.5898C66.7041 12.5013 67.9502 11.6491 69.3682 11.0332C70.8005 10.4173 72.3259 10.1094 73.9444 10.1094C74.46 10.1094 74.9899 10.1523 75.5342 10.2383C76.0928 10.3242 76.6299 10.4674 77.1455 10.668C77.6755 10.8542 78.1696 11.1048 78.628 11.4199C79.0863 11.735 79.473 12.1217 79.7881 12.5801V1.83789H85.6963V34ZM79.7881 22.291C79.7881 21.4889 79.6306 20.7155 79.3155 19.9707C79.0147 19.2116 78.5993 18.5456 78.0694 17.9727C77.5394 17.3854 76.9164 16.9199 76.2002 16.5762C75.4984 16.2181 74.7465 16.0391 73.9444 16.0391C73.1423 16.0391 72.3832 16.1823 71.667 16.4688C70.9652 16.7552 70.3493 17.1706 69.8194 17.7148C69.3037 18.2448 68.8955 18.8965 68.5948 19.6699C68.294 20.4434 68.1436 21.3171 68.1436 22.291C68.1436 23.1361 68.294 23.9382 68.5948 24.6973C68.8955 25.4564 69.3037 26.1224 69.8194 26.6953C70.3493 27.2682 70.9652 27.7194 71.667 28.0488C72.3832 28.3783 73.1423 28.543 73.9444 28.543C74.7465 28.543 75.4984 28.3711 76.2002 28.0273C76.9164 27.6693 77.5394 27.2038 78.0694 26.6309C78.5993 26.0436 79.0147 25.3776 79.3155 24.6328C79.6306 23.8737 79.7881 23.0931 79.7881 22.291ZM113.786 34H112.368L110.091 30.8418C109.532 31.3431 108.938 31.8158 108.307 32.2598C107.691 32.6895 107.04 33.069 106.352 33.3984C105.665 33.7135 104.956 33.9642 104.225 34.1504C103.509 34.3366 102.779 34.4297 102.034 34.4297C100.415 34.4297 98.89 34.1576 97.4577 33.6133C96.0398 33.069 94.7937 32.2812 93.7195 31.25C92.6596 30.2044 91.8217 28.9297 91.2058 27.4258C90.5899 25.9219 90.282 24.2103 90.282 22.291C90.282 20.5007 90.5899 18.8607 91.2058 17.3711C91.8217 15.8672 92.6596 14.5781 93.7195 13.5039C94.7937 12.4297 96.0398 11.599 97.4577 11.0117C98.89 10.4102 100.415 10.1094 102.034 10.1094C102.779 10.1094 103.516 10.2025 104.247 10.3887C104.977 10.5749 105.686 10.8327 106.374 11.1621C107.061 11.4915 107.713 11.8783 108.329 12.3223C108.959 12.7663 109.546 13.2461 110.091 13.7617L112.368 11.0332H113.786V34ZM107.878 22.291C107.878 21.4889 107.72 20.7155 107.405 19.9707C107.104 19.2116 106.689 18.5456 106.159 17.9727C105.629 17.3854 105.006 16.9199 104.29 16.5762C103.588 16.2181 102.836 16.0391 102.034 16.0391C101.232 16.0391 100.473 16.1751 99.7566 16.4473C99.0547 16.7194 98.4389 17.1204 97.9089 17.6504C97.3933 18.1803 96.9851 18.8392 96.6843 19.627C96.3835 20.4004 96.2331 21.2884 96.2331 22.291C96.2331 23.2936 96.3835 24.1888 96.6843 24.9766C96.9851 25.75 97.3933 26.4017 97.9089 26.9316C98.4389 27.4616 99.0547 27.8626 99.7566 28.1348C100.473 28.4069 101.232 28.543 102.034 28.543C102.836 28.543 103.588 28.3711 104.29 28.0273C105.006 27.6693 105.629 27.2038 106.159 26.6309C106.689 26.0436 107.104 25.3776 107.405 24.6328C107.72 23.8737 107.878 23.0931 107.878 22.291ZM125.504 34H119.596V1.83789H125.504V22.1191L134.248 11.0332H140.995L133.368 20.6152L140.995 34H134.248L129.586 25.6426L125.504 31.0566V34Z"
                        fill="#3654D0" />
                </svg>
            </a>
        </h1>
        <div class="navbar-nav flex-row d-lg-none">
            <div class="nav-item">
                <x-notifications-dropdown />
            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                    <span class="avatar avatar-sm rounded-circle" @if($dashboardUser->avatar ?? null) style="background-image: url('{{ $dashboardUser->avatar }}')" @endif></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a href="{{ route('dashboard.logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('translate.logout') }}</a>
                </div>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="sidebar-menu">
            <ul class="navbar-nav pt-lg-3">
                <li class="nav-item @yield('home')">
                    <a class="nav-link" href="{{ route('dashboard.home') }}">
                        <span class="nav-link-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-home">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                                <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                                <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                            </svg>
                        </span>
                        <span class="nav-link-title">@lang('translate.home')</span>
                    </a>
                </li>

                @can('view.admins')
                <li class="nav-item @yield('admins')">
                    <a class="nav-link" href="{{ route('dashboard.admins.index') }}">
                        <span class="nav-link-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user-cog">
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
                        <span class="nav-link-title">@lang('translate.admins')</span>
                    </a>
                </li>
                @endcan

                @can('view.users')
                <li class="nav-item @yield('users')">
                    <a class="nav-link" href="{{ route('dashboard.users.index') }}">
                        <span class="nav-link-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-users">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <circle cx="9" cy="7" r="4" />
                                <path d="M3 17v-2a4 4 0 0 1 4 -4h2" />
                                <path d="M21 17v-2a4 4 0 0 0 -3 -3.85" />
                                <path d="M16 5a2 2 0 0 1 2 2v1a2 2 0 0 1 -2 2" />
                            </svg>
                        </span>
                        <span class="nav-link-title">@lang('translate.users')</span>
                    </a>
                </li>
                @endcan

                <div class="hr-text">@lang('translate.clinic')</div>

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

                @can('view.admins')
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
        </div>
    </div>
</aside>
