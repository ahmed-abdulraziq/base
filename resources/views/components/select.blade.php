@props([
    'name',
    'label' => '',
    'options' => [],
    'model' => null,
    'required' => false,
    'value' => '',
])

@php
    if (empty($options) && $model) {
        $options = $model::pluck('name', 'id')->toArray();
    }
@endphp

<div class="mb-3">
    @if($label)
        <label for="{{ $name }}" class="form-label {{ $required ? 'required' : '' }}">
            {{ $label }}
        </label>
    @endif

    <select name="{{ $name }}" id="{{ $name }}" class="form-control" {{ $required ? 'required' : '' }}>
        <option value="">{{ __('translate.choose') }}</option>
        @foreach($options as $key => $text)
            <option value="{{ $key }}" {{ $value == $key ? 'selected' : '' }}>{{ $text }}</option>
        @endforeach
    </select>

    @error($name)
        <span class="text-danger fw-bold">{{ $message }}</span>
    @enderror
</div>
