<!-- resources/views/components/forms/tags-input.blade.php -->
@props([
    'name',
    'label',
    'value' => '',
    'required' => false,
    'col' => 'col-md-6',
    'placeholder' => '',
    'translatable' => false,
    'locale' => app()->getLocale(),
    'translations' => [],
    'darkMode' => false,
    'ariaDescribedBy' => null,
])

@php
    $inputClasses = 'form-control tags-input ' . 
                    ($darkMode ? 'bg-dark text-light ' : '') .
                    ($errors->has($name) ? 'is-invalid ' : '');
@endphp

<div class="{{ $col }} mb-3">
    <div class="form-group" x-data="{ currentLang: '{{ $locale }}' }">
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
                            class="{{ $inputClasses }}"
                            placeholder="{{ $placeholder }} {{ strtoupper($lang) }}"
                            aria-label="{{ $label }} ({{ strtoupper($lang) }})"
                            @if($ariaDescribedBy) aria-describedby="{{ $ariaDescribedBy }}_{{ $lang }}" @endif
                            @if($required && $lang == app()->getLocale()) required @endif
                        >{{ old("$name.$lang", $translations[$lang][$name] ?? '') }}</textarea>
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
                          class="{{ $inputClasses }}"
                          placeholder="{{ $placeholder }}"
                          @if($ariaDescribedBy) aria-describedby="{{ $ariaDescribedBy }}" @endif
                          @if($required) required @endif
                >{{ old($name, $value) }}</textarea>
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
        body {
            overflow-x: hidden;
        }
    /* Translation field transitions */
    .translation-field {
        transition: all 0.3s ease;
    }
    
    /* Lang switch enhancement */
    .btn-group .lang-switch.active {
        position: relative;
        font-weight: bold;
    }
    
    /* Tags Input Styling */
    .selectize-control.multi .selectize-input > div {
        background: #0d6efd;
        color: white;
        border-radius: 12px;
        padding: 5px 10px;
        margin: 2px 5px 2px 0;
        font-size: 0.85rem;
    }
    
    .selectize-control.multi .selectize-input {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
    }
    
    .selectize-control.multi .selectize-input > div.item {
        display: flex;
        align-items: center;
    }
    
    .selectize-control.multi .selectize-input > div .remove {
        margin-left: 5px;
        color: rgba(255, 255, 255, 0.8);
    }
    
    .selectize-control.multi .selectize-input > div .remove:hover {
        color: white;
    }
    
    .selectize-control.multi .selectize-input input {
        padding: 0 !important;
        margin: 0 !important;
        border: none !important;
        outline: none !important;
        min-width: 80px;
        height: 24px;
    }
    
    /* Dark Mode Support */
    .bg-dark .selectize-dropdown,
    .bg-dark .selectize-input,
    .bg-dark .selectize-input input {
        background-color: #343a40;
        color: #f8f9fa;
        border-color: #495057;
    }
    
    .bg-dark .selectize-dropdown .option,
    .bg-dark .selectize-dropdown .optgroup-header {
        color: #f8f9fa;
    }
    
    .bg-dark .selectize-dropdown-content .option.active {
        background-color: #495057;
    }
    
    .bg-dark .selectize-input.focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
    
    /* Mobile responsiveness */
    @media (max-width: 576px) {
        .selectize-control.multi .selectize-input {
            font-size: 16px; /* Prevents zoom on mobile */
        }
    }
    </style>
    @endpush
@endonce

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Check if jQuery and Selectize exist
        if (typeof $ !== 'undefined' && $.fn.selectize) {
            initializeTagsInputs();
        } else {
            console.error('Selectize or jQuery is not available. Make sure to include the required libraries.');
            
            // Dynamically load dependencies if not already present
            loadSelectizeDependencies();
        }
    });
    
    function loadSelectizeDependencies() {
        // Load jQuery if not present
        if (typeof $ === 'undefined') {
            let jqueryScript = document.createElement('script');
            jqueryScript.src = 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js';
            jqueryScript.onload = function() {
                // Load Selectize after jQuery loads
                loadSelectize();
            };
            document.head.appendChild(jqueryScript);
        } else {
            // Load just Selectize
            loadSelectize();
        }
    }
    
    function loadSelectize() {
        // Load Selectize CSS
        let selectizeCSS = document.createElement('link');
        selectizeCSS.rel = 'stylesheet';
        selectizeCSS.href = 'https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.6/css/selectize.min.css';
        document.head.appendChild(selectizeCSS);
        
        // Load Selectize JavaScript
        let selectizeScript = document.createElement('script');
        selectizeScript.src = 'https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.13.6/js/standalone/selectize.min.js';
        selectizeScript.onload = function() {
            // Initialize inputs after library loads
            initializeTagsInputs();
        };
        document.head.appendChild(selectizeScript);
    }
    
    function initializeTagsInputs() {
        $('.tags-input').each(function() {
            let $input = $(this);
            
            // Check if element has already been initialized
            if (!$input.hasClass('selectized')) {
                $input.selectize({
                    delimiter: ',',
                    persist: false,
                    plugins: ['remove_button'],
                    placeholder: $input.attr('placeholder'),
                    createOnBlur: true,
                    create: function(input) {
                        return {
                            value: input,
                            text: input
                        }
                    },
                    onInitialize: function() {
                        // Add dark mode class if needed
                        if ($input.hasClass('bg-dark')) {
                            this.$wrapper.addClass('bg-dark');
                            this.$dropdown.addClass('bg-dark');
                        }
                    }
                });
            }
        });
    }
</script>
@endpush