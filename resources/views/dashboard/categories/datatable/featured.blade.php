@if ($item->featured)
    <span class="badge bg-green-lt">
        <i class="fa-solid fa-check"></i>
        {{ __('translate.featured') }}
    </span>
@else
    <span class="badge bg-red-lt">
        <i class="fa-solid fa-clock"></i>
        {{ __('translate.not_featured') }}
    </span>
@endif
