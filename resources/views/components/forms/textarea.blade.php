<!-- resources/views/components/forms/textarea.blade.php -->
@props([
    'name',
    'label',
    'value' => '',
    'rows' => 3,
    'required' => false,
    'col' => 'col-md-6',
    'placeholder' => '',
    'translatable' => false,
    'locale' => app()->getLocale(),
    'translations' => [],
    'maxlength' => null,
    'autofocus' => false,
    'darkMode' => false,
    'ariaDescribedBy' => null,
])

@php
    $inputClasses = 'form-control ' . 
                    ($darkMode ? 'bg-dark text-light ' : '') .
                    ($errors->has($name) ? 'is-invalid ' : '');
@endphp

<div class="{{ $col }} mb-3">
    <div class="form-group"
         x-data="{ 
            currentLang: '{{ $locale }}',
            charCount: 0,
            maxChars: {{ $maxlength ? $maxlength : 'null' }},
            getCharCount(text) {
                return text ? text.length : 0;
            }
         }">
        @if($translatable)
            <div class="d-flex justify-content-between align-items-center mb-2">
                <label class="form-label mb-0">
                    {{ $label }}
                    @if($required)<span class="text-danger">*</span>@endif
                </label>
                <div class="btn-group btn-group-sm" role="group" aria-label="Language switcher">
                    @foreach(config('translatable.locales') as $lang)
                        <button type="button" 
                                class="btn btn-outline-primary lang-switch {{ $locale == $lang ? 'active' : '' }}"
                                x-on:click="currentLang = '{{ $lang }}'"
                                :class="{'active': currentLang === '{{ $lang }}'}"
                                aria-pressed="{{ $locale == $lang ? 'true' : 'false' }}"
                                data-lang="{{ $lang }}">
                            <span class="d-none d-sm-inline">{{ strtoupper($lang) }}</span>
                            <span class="d-inline d-sm-none">{{ substr(strtoupper($lang), 0, 2) }}</span>
                        </button>
                    @endforeach
                </div>
            </div>
            
            @foreach(config('translatable.locales') as $lang)
                <div class="translation-field" 
                     x-show="currentLang === '{{ $lang }}'"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform scale-95"
                     x-transition:enter-end="opacity-100 transform scale-100"
                     data-lang="{{ $lang }}">
                    <div class="position-relative">
                        <textarea name="{{ $name }}[{{ $lang }}]" 
                            id="{{ $name }}_{{ $lang }}" 
                            rows="{{ $rows }}" 
                            class="{{ $inputClasses }}"
                            placeholder="{{ $placeholder }} {{ strtoupper($lang) }}"
                            x-on:input="charCount = getCharCount($event.target.value)"
                            aria-label="{{ $label }} ({{ strtoupper($lang) }})"
                            @if($ariaDescribedBy) aria-describedby="{{ $ariaDescribedBy }}_{{ $lang }}" @endif
                            @if($required && $lang == app()->getLocale()) required @endif
                            @if($autofocus && $lang == app()->getLocale()) autofocus @endif
                            @if($maxlength) maxlength="{{ $maxlength }}" @endif
                        >{{ old("$name.$lang", $translations[$lang][$name] ?? '') }}</textarea>
                        
                        @if($maxlength)
                        <div class="form-text text-end mt-1" x-show="maxChars" id="charCount_{{ $name }}_{{ $lang }}">
                            <span x-text="charCount"></span>/<span x-text="maxChars"></span> {{ __('characters') }}
                        </div>
                        @endif
                    </div>
                    
                    @error("$name.$lang")
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            @endforeach
        @else
            <label for="{{ $name }}" class="form-label">
                {{ $label }}
                @if($required)<span class="text-danger">*</span>@endif
            </label>
            <div class="position-relative">
                <textarea name="{{ $name }}" 
                          id="{{ $name }}" 
                          rows="{{ $rows }}" 
                          class="{{ $inputClasses }}"
                          placeholder="{{ $placeholder }}"
                          x-on:input="charCount = getCharCount($event.target.value)"
                          @if($ariaDescribedBy) aria-describedby="{{ $ariaDescribedBy }}" @endif
                          @if($required) required @endif
                          @if($autofocus) autofocus @endif
                          @if($maxlength) maxlength="{{ $maxlength }}" @endif>{{ old($name, $value) }}</textarea>
                
                @if($maxlength)
                <div class="form-text text-end mt-1" x-show="maxChars" id="charCount_{{ $name }}">
                    <span x-text="charCount"></span>/<span x-text="maxChars"></span> {{ __('characters') }}
                </div>
                @endif
            </div>
            
            @error($name)
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        @endif
    </div>
</div>

@once
    @push('styles')
    <style>
    /* Textarea Enhancements */
    .form-control:focus {
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
    
    .translation-field {
        transition: all 0.3s ease;
    }
    
    /* Lang switch enhancement */
    .btn-group .lang-switch.active {
        position: relative;
        font-weight: bold;
    }
    
    /* Dark Mode Support */
    .form-control.bg-dark::placeholder {
        color: #adb5bd;
    }
    
    /* Make text areas more responsive */
    @media (max-width: 576px) {
        textarea.form-control {
            font-size: 16px; /* Prevents zoom on mobile */
        }
    }
    </style>
    @endpush
@endonce

@push('scripts')
<script>
    document.addEventListener('alpine:init', () => {
        // Any global Alpine.js initialization can go here
    });
</script>
@endpush