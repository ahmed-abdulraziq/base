<!-- resources/views/components/forms/input.blade.php -->
@props([
    'name',
    'label',
    'value' => '',
    'type' => 'text',
    'required' => false,
    'maxlength' => null,
    'col' => 'col-md-6',
    'placeholder' => null,
    'translatable' => false,
    'locale' => app()->getLocale(),
    'translations' => [],
    'tagsInput' => false,
    'accept' => null,
    'multiple' => false,
    'any' => true,
])

<div class="{{ $col }} mb-3">
    <div class="form-group">

        @if ($translatable)
            <div class="d-flex justify-content-between align-items-center mb-2">
                <label class="form-label mb-0">
                    {{ $label ?? '' }}
                    @if ($required)
                        <span class="text-danger">*</span>
                    @endif
                    @if ($type == 'file' && $accept == 'image/*')
                        <span class="text-muted">({{ __('translate.image_only') }})</span>
                    @endif
                    @if ($type == 'file' && $accept == 'image/*' && $value)
                        @foreach (config('translatable.locales') as $lang)
                            @if ($value[$lang][$name] ?? false)
                                <span data-lang="{{ $lang }}" class="current-image {{ $locale == $lang ? '' : 'd-none' }}">
                                    <a href="{{ get_upload_file($value[$lang][$name], true) }}" data-fancybox="gallery"
                                        data-caption="{{ __('translate.current_image') }}[{{ $lang }}]">
                                        {{ __('translate.current_image') }} [{{ $lang }}]
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                                            <path
                                                d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
                                        </svg>
                                    </a>
                                </span>
                            @endif
                        @endforeach
                    @endif
                </label>
                <div class="btn-group btn-group-sm">
                    @foreach (config('translatable.locales') as $lang)
                        <button type="button"
                            class="btn btn-outline-primary lang-switch {{ $locale == $lang ? 'active' : '' }}"
                            data-lang="{{ $lang }}">
                            {{ strtoupper($lang) }}
                        </button>
                    @endforeach

                </div>
            </div>
            @foreach (config('translatable.locales') as $lang)
                <div class="translation-field {{ $locale == $lang ? '' : 'd-none' }}" data-lang="{{ $lang }}">
                    <input type="{{ $type }}" name="{{ $name }}[{{ $lang }}]"
                        @if ($type == 'number' && $any) step="any" min="0" @endif
                        @if ($type == 'file' && $multiple) multiple @endif
                        @if ($type == 'file' && $accept) accept="{{ $accept }}" @endif
                        id="{{ $name }}_{{ $lang }}"
                        class="form-control {{ $tagsInput ? 'tags-input' : '' }} @error("$name.$lang") is-invalid @enderror"
                        value="{{ old("$name.$lang", $translations[$lang][$name] ?? '') }}"
                        placeholder="{{ $placeholder }} {{ strtoupper($lang) }}"
                        @if ($maxlength) maxlength="{{ $maxlength }}" @endif
                        @if ($required && $lang == app()->getLocale()) required @endif>

                    @error("$name.$lang")
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            @endforeach
        @else
            <label for="{{ $name }}" class="form-label">
                {{ $label ?? '' }}
                @if ($required)
                    <span class="text-danger">*</span>
                @endif
                @if ($type == 'file' && $accept == 'image/*')
                    <span class="text-muted">({{ __('translate.image_only') }})</span>
                @endif
                @if ($type == 'file' && $accept == 'image/*' && $value)
                    <a href="{{ get_upload_file($value, true) }}" data-fancybox data-caption="Single image">
                        {{ __('translate.current_image') }}
                    </a>
                @endif
            </label>

            <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
                @if ($type == 'number' && $any) step="any" min="0" @endif
                @if ($type == 'file' && $multiple) multiple @endif
                @if ($type == 'file' && $accept) accept="{{ $accept }}" @endif
                class="form-control {{ $tagsInput ? 'tags-input' : '' }} @error($name) is-invalid @enderror"
                value="{{ old($name, $value) }}" placeholder="{{ $placeholder ?? $label }}"
                @if ($maxlength) maxlength="{{ $maxlength }}" @endif
                @if ($required) required @endif>


            @error($name)
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        @endif
    </div>
</div>

@if ($translatable)
    @push('scripts')
        <script>
            $(document).ready(function() {
                $('.lang-switch').click(function() {
                    let lang = $(this).data('lang');
                    $(this).addClass('active').siblings().removeClass('active');
                    $(this).closest('.form-group').find('.translation-field').addClass('d-none');
                    $(this).closest('.form-group').find(`.translation-field[data-lang="${lang}"]`).removeClass('d-none');
                    @if ($type == 'file' && $accept == 'image/*') 
                        $(this).closest('.form-group').find('.current-image').addClass('d-none');
                        $(this).closest('.form-group').find(`.current-image[data-lang="${lang}"]`).removeClass('d-none');  
                    @endif
                });

            });
        </script>
    @endpush
    @push('styles')
        <style>
            .lang-switch {
                min-width: 40px;
                text-align: center;
            }

            .translation-field {
                transition: all 0.3s ease;
            }
        </style>
    @endpush
@endif

@if ($tagsInput)
    @push('styles')
        <style>
            .selectize-control.multi .selectize-input>div {
                background: #0d6efd;
                color: white;
                border-radius: 12px;
                padding: 5px 10px;
                margin: 2px 5px 2px 0;
                font-size: 0.85rem;
            }

            .selectize-control.multi .selectize-input {
                display: flex;
            }

            .selectize-control.multi .selectize-input input {
                padding: 0 !important;
                margin: 0 !important;
                border: none !important;
                outline: none !important;
            }
        </style>
    @endpush
    @push('scripts')
        <script>
            $(document).ready(function() {
                $('.tags-input').selectize({
                    delimiter: ',',
                    persist: false,
                    create: function(input) {
                        return {
                            value: input,
                            text: input
                        }
                    }
                });
            });
        </script>
    @endpush
@endif
