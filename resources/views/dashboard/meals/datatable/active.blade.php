@if ($item->active)
    <span class="badge bg-green-lt">
        <i class="fa-solid fa-check"></i>
        {{ __('translate.active') }}
    </span>
@else
    <span class="badge bg-red-lt">
        <i class="fa-solid fa-clock"></i>
        {{ __('translate.inactive') }}
    </span>
@endif
