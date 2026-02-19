@php
    $prefix = 'dashboard';
    $user = null;

    if (request()->is('doctor*')) {
        $user = auth('doctor')->user();
        $prefix = 'doctor';
    } elseif (auth('admin')->check()) {
        $user = auth('admin')->user();
        $prefix = 'dashboard';
    } elseif (auth('doctor')->check()) {
        $user = auth('doctor')->user();
        $prefix = 'doctor';
    } elseif (auth('web')->check()) {
        $user = auth('web')->user();
        $prefix = 'web';
    } else {
        $user = auth()->user();
    }

    $unreadCount = $user ? $user->unreadNotifications->count() : 0;
    $notifications = $user ? $user->notifications()->take(5)->get() : collect();
@endphp

<div class="nav-item dropdown d-none d-md-flex">
    <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1" aria-label="Show notifications">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6" />
            <path d="M9 17v1a3 3 0 0 0 6 0v-1" />
        </svg>
        @if ($unreadCount > 0)
            <span class="badge bg-red"></span>
        @endif
    </a>
    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang('translate.notifications')</h3>
                <div class="card-actions">
                    <a href="{{ route($prefix . '.notifications.markAllRead') }}" class="btn-action mark-all-read" title="@lang('translate.mark_all_as_read')">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M18 6l-12 12" />
                            <path d="M6 6l12 12" />
                        </svg>
                    </a>
                </div>
            </div>
            <div class="list-group list-group-flush list-group-hoverable" id="notifications-list-container">
                @include('components.notifications-list', ['notifications' => $notifications, 'prefix' => $prefix])
            </div>
            <div class="card-footer text-center">
                <a href="{{ route($prefix . '.notifications.index') }}" class="btn btn-2 w-100">@lang('translate.view_all_notifications')</a>
            </div>
        </div>
    </div>
    
    {{-- Sound for notifications --}}
    <audio id="notification-sound" src="https://assets.mixkit.co/active_storage/sfx/2869/2869-preview.mp3" preload="auto"></audio>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        let lastUnreadCount = {{ $unreadCount }};
        const checkUrl = "{{ route($prefix . '.notifications.check') }}";
        const sound = document.getElementById('notification-sound');
        const container = document.getElementById('notifications-list-container');

        // Function to bind events to dynamic elements
        function bindEvents() {
            document.querySelectorAll('.mark-as-read').forEach(item => {
                if(item.dataset.bound) return;
                item.dataset.bound = true;
                
                item.addEventListener('click', function (e) {
                    e.preventDefault();
                    let url = this.getAttribute('href');
                    let parent = this.closest('.list-group-item');
                    let badge = document.querySelector('.nav-link .badge'); // Re-select badge

                    fetch(url, {
                        method: 'GET',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            parent.classList.remove('bg-red-lt');
                            let dot = parent.querySelector('.status-dot');
                            if(dot) {
                                dot.classList.remove('status-dot-animated', 'bg-red');
                                dot.classList.add('bg-secondary');
                            }
                            
                            if(badge) {
                                if(data.count > 0) badge.innerText = data.count;
                                else badge.remove();
                            }
                            lastUnreadCount = data.count; 
                        }
                    });
                });
            });
        }

        bindEvents();

        setInterval(() => {
            fetch(checkUrl + '?t=' + new Date().getTime(), { // Prevent caching
                method: 'GET',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    // Update badge logic - Re-select badge every time
                    let badge = document.querySelector('.nav-link .badge');
                    let anchor = document.querySelector('a[aria-label="Show notifications"]');

                    if (data.unread_count > 0) {
                        if (!badge && anchor) {
                             let newBadge = document.createElement('span');
                             newBadge.className = 'badge bg-red badge-blink';
                             anchor.appendChild(newBadge);
                        } else if (badge) {
                            badge.innerText = data.unread_count;
                        }
                    } else if (badge) {
                        badge.remove();
                    }

                    // Play sound if count INCREASED
                    if (data.unread_count > lastUnreadCount) {
                        sound.play().catch(e => console.warn('Audio play failed (Autoplay blocked? Click page to enable):', e));
                    }
                    
                    lastUnreadCount = data.unread_count;

                    if (container) {
                        container.innerHTML = data.html;
                        bindEvents();
                    }
                }
            })
            .catch(err => console.error('Notification check error:', err));
        }, 5000);

        // Mark all as read
        let markAllBtn = document.querySelector('.mark-all-read');
        if(markAllBtn) {
            markAllBtn.addEventListener('click', function(e) {
                e.preventDefault();
                let url = this.getAttribute('href');
                let badge = document.querySelector('.nav-link .badge'); // Re-select
                
                fetch(url, {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.querySelectorAll('.list-group-item').forEach(item => {
                            item.classList.remove('bg-red-lt');
                            let dot = item.querySelector('.status-dot');
                            if(dot) {
                                dot.classList.remove('status-dot-animated', 'bg-red');
                                dot.classList.add('bg-secondary');
                            }
                        });
                        if(badge) badge.remove();
                        lastUnreadCount = 0;
                    }
                });
            });
        }
    });
</script>
