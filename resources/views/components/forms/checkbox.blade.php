@props([
    'name',
    'label' => '',
    'checked' => false, // default value if not old() or model
    'required' => false,
    'col' => 'col-md-6',
])

@php
    $isChecked = old($name) !== null
        ? old($name)
        : $checked;
@endphp

<div class="{{ $col }} mb-3">
    <div class="form-label">{{ $label }}</div>
    <label class="form-check form-switch form-switch-2">
        <input
            type="checkbox"
            class="form-check-input @error($name) is-invalid @enderror"
            name="{{ $name }}"
            id="{{ $name }}"
            value="1"
            {{ $isChecked ? 'checked' : '' }}
            @if($required) required @endif
        >
        <span class="form-check-label" for="{{ $name }}">{{ $slot }}</span>
    </label>

    @error($name)
        <div class="invalid-feedback d-block">{{ $message }}</div>
    @enderror
</div>
