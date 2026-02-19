@extends($layout)

@section('title', __('translate.notifications'))

@section('content')
<div class="w-100">
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        @lang('translate.notifications')
                    </h2>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route($prefix . '.notifications.markAllRead') }}" class="btn btn-primary d-none d-sm-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10" /></svg>
                            @lang('translate.mark_all_as_read')
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="list-group list-group-flush list-group-hoverable">
                            @forelse ($notifications as $notification)
                            <div class="list-group-item {{ $notification->read_at ? '' : 'bg-azure-lt' }}">
                                <div class="row align-items-center">
                                    <div class="col-auto"><span class="status-dot {{ $notification->read_at ? 'bg-secondary' : 'status-dot-animated bg-red' }} d-block"></span></div>
                                    <div class="col-auto">
                                        <span class="avatar {{ $notification->read_at ? '' : 'bg-red-lt' }}">
                                            <!-- @if(isset($notification->data['icon']))
                                                <i class="{{ $notification->data['icon'] }}"></i>
                                            @else
                                            @endif -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6"/><path d="M9 17v1a3 3 0 0 0 6 0v-1"/></svg>
                                        </span>
                                    </div>
                                    <div class="col text-truncate">
                                        <a href="{{ route($prefix . '.notifications.read', $notification->id) }}" class="text-body d-block">{{ __($notification->data['title'] ?? 'Notification') }}</a>
                                        <div class="d-block text-secondary text-truncate mt-n1">{{ __($notification->data['message'] ?? '', $notification->data['params'] ?? []) }}</div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="text-secondary" title="{{ $notification->created_at }}">{{ $notification->created_at->diffForHumans() }}</div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="list-group-item">
                                <div class="text-center text-muted py-3">
                                    @lang('translate.no_notifications')
                                </div>
                            </div>
                            @endforelse
                        </div>
                    </div>
                    <div class="d-flex justify-content-center mt-3">
                        {{ $notifications->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
