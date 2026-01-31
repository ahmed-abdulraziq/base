@props([
    'type' => 'text',
    'name',
    'label' => null,
    'required' => false,
    'value' => '',
])

<div class="mb-3">

    <label for="{{ $name }}" class="form-label {{ $required ? 'required' : '' }}">
        {{ $label ?: __('translate.' . $name) }}
    </label>

    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" class="form-control"
        value="{{ $value }}" {{ $required ? 'required' : '' }} />
    @error($name)
        <span class="text-danger fw-bold">{{ $message }}</span>
    @enderror
</div>
