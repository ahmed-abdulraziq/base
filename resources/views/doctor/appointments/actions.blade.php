@php
    $item = $item ?? null;
@endphp
@if($item)
<div style="width: fit-content; display: flex; align-items: center;">
    <a href="{{ route('doctor.appointments.edit', $item) }}" class="text-primary p-1 mx-1 fs-6" title="{{ __('translate.edit') }}">
        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"/>
            <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3z"/>
            <path d="M16 5l3 3"/>
        </svg>
    </a>
    <form action="{{ route('doctor.appointments.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('{{ __('translate.are_you_sure') }}');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-link text-danger p-1 m-1 border-0" title="{{ __('translate.delete') }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M4 7h16"/>
                <path d="M10 11v6"/>
                <path d="M14 11v6"/>
                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"/>
                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"/>
            </svg>
        </button>
    </form>
</div>
@endif

