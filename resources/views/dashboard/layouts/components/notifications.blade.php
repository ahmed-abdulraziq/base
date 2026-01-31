<div id="alert-container" class="position-fixed top-0 end-0 p-3" style="z-index: 1050;"></div>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var audio = new Audio("{{ asset('dashboard_assets/audio/notification.wav') }}");
        @php
            if (auth()->user()?->hasRole('super')) {
                $menus = ['super'];
            } elseif (auth()->user()?->hasRole('staff')) {
                $menus = [auth()->user()?->staff->menu->id];
            } else {
                $menus = auth()->user()->menuArrayIds();
            }
        @endphp

        Pusher.logToConsole = true;

        var pusher = new Pusher('46f1c17d3fa5f4e43dd5', {
            cluster: 'mt1'
        });

        var channel = pusher.subscribe('order-notification');

        channel.bind('pusher:subscription_succeeded', function() {
            console.log('Successfully subscribed to channel: menu-notification');
        });

        @roleStaff('read_orders')
        @foreach ($menus as $menu)
            channel.bind('menu-{{ $menu }}', function(data) {
                // Use Laravel's translation here, inserting dynamic data including requester's name
                var alertMessage = `@lang('translate.notification_menu', [
                    'name' => '${data.requester_name}',
                    'menu' => '${data.menu_name}',
                ])`;

                var alertHtml = `
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <div onclick="window.location.href='${data.order_url}'" style="cursor: pointer;">
                                ${alertMessage}
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>`;

                document.getElementById('alert-container').insertAdjacentHTML('beforeend', alertHtml);
                audio.play();
                // let dismissTimeoutStarted = false;

                // function handlePageFocus() {
                //     if (!dismissTimeoutStarted && document.hasFocus()) {
                //         dismissTimeoutStarted = true;
                //         setTimeout(function() {
                //             var alertElement = document.querySelector('#alert-container .alert');
                //             if (alertElement) {
                //                 alertElement.classList.remove('show');
                //                 setTimeout(() => alertElement.remove(), 150);
                //             }
                //             window.removeEventListener('focus', handlePageFocus);
                //         }, 10000);
                //     }
                // }

                // window.addEventListener('focus', handlePageFocus);
                // handlePageFocus();
            });
        @endforeach
    @endroleStaff
    });
</script>
