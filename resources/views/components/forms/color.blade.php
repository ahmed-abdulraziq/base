<div class="{{ $col }} mb-3">
    <label for="{{ $name }}" class="form-label">
        {{ $label }}
    </label>
    <div class="d-flex align-items-center gap-2">
        <input type="color" class="form-control form-control-color" name="{{ $name }}" value="{{ old($name, $value) }}" title="{{ $label }}" colorpick-eyedropper-active="true">
        {{-- @lang('translate.color_picker') --}}
        <small class="form-text text-muted">{{ __('translate.choose_color') }}</small>
    </div>
</div>
@push('styles')
    <style>
        .form-control-color {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            border: none;
            padding: 0;
            cursor: pointer;
        }
        .form-control-color:focus {
            outline: none;
            box-shadow: 0 0 0 2px rgba(0, 123, 255, 0.25);
        }
    </style>
@endpush