<!-- resources/views/components/forms/select2.blade.php -->
@props([
    'name',
    'label',
    'options' => [],
    'selected' => null,
    'multiple' => false,
    'required' => false,
    'col' => 'col-md-6',
    'placeholder' => ''
])

<div class="{{ $col }} mb-3">
    <div class="form-group">
        <label for="{{ $name }}" class="form-label">
            {{ $label }}
            @if($required)<span class="text-danger">*</span>@endif
        </label>
        <select name="{{ $name }}{{ $multiple ? '[]' : '' }}" 
                id="{{ $name }}" 
                class="form-control select2 @error($name) is-invalid @enderror"
                {{ $multiple ? 'multiple' : '' }}
                @if($required) required @endif>
            @if(!$multiple)
                <option value="">{{ $placeholder ?: __('translate.select_option') }}</option>
            @endif
            @foreach($options as $value => $text)
                <option value="{{ $value }}" 
                    @if($multiple)
                        {{ in_array($value, (array)$selected) ? 'selected' : '' }}
                    @else
                        {{ $selected == $value ? 'selected' : '' }}
                    @endif>
                    {{ $text }}
                </option>
            @endforeach
        </select>
        @error($name)<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#{{ $name }}').select2({
            placeholder: "{{ $placeholder ?: __('translate.select_option') }}",
            allowClear: {{ $multiple ? 'false' : 'true' }},
            width: '100%'
        });
    });
</script>
@endpush