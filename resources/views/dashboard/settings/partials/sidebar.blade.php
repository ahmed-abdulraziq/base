<div class="col-12 col-md-3 border-end">
    <div class="card-body">
        <h4 class="subheader">
            @lang('translate.settings')
        </h4>
        <div class="list-group list-group-transparent">
            <a href="{{ route('dashboard.settings.profile') }}" class="list-group-item list-group-item-action d-flex align-items-center {{ request()->routeIs('dashboard.settings.index') || request()->routeIs('dashboard.settings.profile') ? 'active' : '' }}">
                <i class="fa-solid fa-user me-2"></i>
                @lang('translate.profile')
            </a>
            @can('view.roles')
            <a href="{{ route('dashboard.settings.roles.index') }}" class="list-group-item list-group-item-action d-flex align-items-center {{ request()->routeIs('dashboard.settings.roles.*') ? 'active' : '' }}">
                <i class="fa-solid fa-user-tag me-2"></i>
                @lang('translate.roles')
            </a>
            @endcan
            @can('view.permissions')
            <a href="{{ route('dashboard.settings.permissions.index') }}" class="list-group-item list-group-item-action d-flex align-items-center {{ request()->routeIs('dashboard.settings.permissions.*') ? 'active' : '' }}">
                <i class="fa-solid fa-key me-2"></i>
                @lang('translate.permissions')
            </a>
            @endcan
        </div>
    </div>
</div>
