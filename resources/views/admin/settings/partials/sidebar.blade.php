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
            <a href="{{ route('dashboard.settings.prescription-options.index') }}" class="list-group-item list-group-item-action d-flex align-items-center {{ request()->routeIs('dashboard.settings.prescription-options.*') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-pills me-2"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 8a5 5 0 1 0 10 0a5 5 0 1 0 -10 0"/><path d="M13 17a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"/><path d="M4.5 4.5l7 7"/><path d="M19.5 14.5l-5 5"/></svg>
                @lang('translate.prescription_options')
            </a>
        </div>
    </div>
</div>
