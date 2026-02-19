@forelse ($notifications as $notification)
    <div class="list-group-item {{ $notification->read_at ? '' : 'bg-red-lt' }}">
        <div class="row align-items-center">
            <div class="col-auto">
                <span class="status-dot {{ $notification->read_at ? 'bg-secondary' : 'status-dot status-dot-animated bg-red d-block' }} d-block"></span>
            </div>
            <div class="col text-truncate">
                <a href="{{ route($prefix . '.notifications.read', $notification->id) }}" class="text-body d-block">{{ __($notification->data['title'] ?? '') }}</a>
                <div class="d-block text-secondary text-truncate mt-n1">
                    {{ __($notification->data['message'] ?? '', $notification->data['params'] ?? []) }}
                </div>
            </div>
            <div class="col-auto">
                <a href="{{ route($prefix . '.notifications.read', $notification->id) }}" class="list-group-item-actions mark-as-read">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon text-muted">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M10 10l4 4m0 -4l-4 4" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
@empty
    <div class="list-group-item">
        <div class="text-center text-muted">
            @lang('translate.no_notifications')
        </div>
    </div>
@endforelse
