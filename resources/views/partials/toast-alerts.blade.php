@php
    $toasts = [
        'success' => ['bg' => 'bg-success', 'icon' => '<path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l5 5l10 -10"/>'],
        'error'   => ['bg' => 'bg-danger',  'icon' => '<path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"/><path d="M12 8v4"/><path d="M12 16h.01"/>'],
        'warning' => ['bg' => 'bg-warning', 'icon' => '<path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9v4"/><path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.871l-8.106 -13.534a1.914 1.914 0 0 0 -3.274 0z"/><path d="M12 16h.01"/>'],
        'info'    => ['bg' => 'bg-info',    'icon' => '<path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"/><path d="M12 8h.01"/><path d="M11 12h1v4h1"/>'],
    ];
@endphp

{{-- Toast Container --}}
<div id="toast-container"
     style="position:fixed;bottom:1.5rem;{{ app()->isLocale('ar') ? 'left' : 'right' }}:1.5rem;z-index:9999;display:flex;flex-direction:column-reverse;gap:.6rem;min-width:320px;max-width:420px;">
    @foreach($toasts as $type => $cfg)
        @if(session($type))
            <div class="toast-item {{ $cfg['bg'] }} text-white rounded-3 shadow-lg overflow-hidden"
                 style="opacity:0;transform:translateY(12px);transition:opacity .3s ease,transform .3s ease;">
                <div class="d-flex align-items-center px-3 py-2 gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                         fill="none" stroke="currentColor" stroke-width="2"
                         stroke-linecap="round" stroke-linejoin="round" class="flex-shrink-0">
                        {!! $cfg['icon'] !!}
                    </svg>
                    <span class="flex-grow-1 small fw-medium">{{ session($type) }}</span>
                    <button type="button"
                            onclick="this.closest('.toast-item').remove()"
                            style="background:none;border:none;color:inherit;opacity:.75;cursor:pointer;padding:0 0 0 .5rem;line-height:1;">&#x2715;</button>
                </div>
                {{-- Progress bar --}}
                <div class="toast-progress" style="height:3px;background:rgba(255,255,255,.35);">
                    <div style="height:100%;width:100%;background:rgba(255,255,255,.75);
                                transition:width 5s linear;"></div>
                </div>
            </div>
        @endif
    @endforeach
</div>

<script>
(function () {
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('#toast-container .toast-item').forEach(function (el) {
            // Animate in
            requestAnimationFrame(function () {
                requestAnimationFrame(function () {
                    el.style.opacity = '1';
                    el.style.transform = 'translateY(0)';

                    // Start progress bar shrink
                    var bar = el.querySelector('.toast-progress div');
                    if (bar) {
                        requestAnimationFrame(function () { bar.style.width = '0%'; });
                    }
                });
            });

            // Auto-dismiss after 5 s
            setTimeout(function () {
                el.style.opacity = '0';
                el.style.transform = 'translateY(12px)';
                setTimeout(function () { el.remove(); }, 350);
            }, 5000);
        });
    });
})();
</script>
