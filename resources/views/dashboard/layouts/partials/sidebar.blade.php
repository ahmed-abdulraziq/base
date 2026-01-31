<div class="logo mb-30">
    <img src="{{ asset('dashboard_assets/imgs/logo.png') }}" alt="main logo" />
</div>

{{-- قسم الأدمن / Admin section --}}
<div class="sidebar-section mb-3">
    <div class="sidebar-section-title text-muted small text-uppercase mb-2 px-3">
        @lang('translate.admin')
    </div>
    <ul>
        <li class="@yield('home')">
            <a href="{{ route('dashboard.home') }}">
                <i class="fa-solid fa-house"></i>
                @lang('translate.home')
            </a>
        </li>
        <li class="@yield('users')">
            <a href="{{ route('dashboard.users.index') }}">
                <i class="fa-solid fa-users"></i>
                @lang('translate.users')
            </a>
        </li>
        <li class="@yield('admins')">
            <a href="{{ route('dashboard.admins.index') }}">
                <i class="fa-solid fa-user-shield"></i>
                @lang('translate.admins')
            </a>
        </li>
        @can('view.settings')
            <li class="@yield('settings')">
                <a href="{{ route('dashboard.settings.index') }}">
                    <i class="fa-solid fa-cog"></i>
                    @lang('translate.settings')
                </a>
            </li>
        @endcan
    </ul>
</div>

{{-- قسم المستخدم / User section --}}
<div class="sidebar-section">
    <div class="sidebar-section-title text-muted small text-uppercase mb-2 px-3">
        @lang('translate.user')
    </div>
    <ul>
        <li class="@yield('profile')">
            <a href="{{ route('dashboard.settings.profile') }}">
                <i class="fa-solid fa-user"></i>
                @lang('translate.profile')
            </a>
        </li>
    </ul>
</div>
