@props([
    'showFlags' => true,
    'showNames' => true,
    'showNativeNames' => false,
    'dropdown' => true,
    'class' => '',
    'itemClass' => '',
    'currentClass' => 'font-bold text-primary',
])

@php
    $locales = get_locale_switcher_data();
    $currentLocale = get_current_locale();
@endphp

@if(count($locales) > 1)
    <div class="locale-switcher {{ $class }}">
        @if($dropdown)
            <div class="relative inline-block text-left">
                <div>
                    <button type="button" 
                            class="inline-flex items-center justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            id="locale-menu-button" 
                            aria-expanded="false" 
                            aria-haspopup="true">
                        @if($showFlags)
                            <span class="mr-2">{{ get_locale_flag($currentLocale) }}</span>
                        @endif
                        @if($showNames)
                            <span>{{ get_locale_name($currentLocale) }}</span>
                        @elseif($showNativeNames)
                            <span>{{ get_locale_native_name($currentLocale) }}</span>
                        @else
                            <span class="uppercase">{{ $currentLocale }}</span>
                        @endif
                        <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>

                <div class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none hidden" 
                     role="menu" 
                     aria-orientation="vertical" 
                     aria-labelledby="locale-menu-button" 
                     tabindex="-1"
                     id="locale-menu">
                    <div class="py-1" role="none">
                        @foreach($locales as $locale)
                            <a href="{{ $locale['url'] }}" 
                               class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 {{ $locale['is_current'] ? $currentClass : '' }} {{ $itemClass }}"
                               role="menuitem" 
                               tabindex="-1">
                                @if($showFlags)
                                    <span class="mr-3">{{ $locale['flag'] }}</span>
                                @endif
                                <div class="flex flex-col">
                                    @if($showNames)
                                        <span>{{ $locale['name'] }}</span>
                                    @endif
                                    @if($showNativeNames && $locale['native'] !== $locale['name'])
                                        <span class="text-xs text-gray-500">{{ $locale['native'] }}</span>
                                    @endif
                                </div>
                                @if($locale['is_current'])
                                    <svg class="ml-auto h-4 w-4 text-primary" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                @endif
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        @else
            <div class="flex space-x-2">
                @foreach($locales as $locale)
                    <a href="{{ $locale['url'] }}" 
                       class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 {{ $locale['is_current'] ? $currentClass : '' }} {{ $itemClass }}">
                        @if($showFlags)
                            <span class="mr-2">{{ $locale['flag'] }}</span>
                        @endif
                        @if($showNames)
                            <span>{{ $locale['name'] }}</span>
                        @elseif($showNativeNames)
                            <span>{{ $locale['native'] }}</span>
                        @else
                            <span class="uppercase">{{ $locale['code'] }}</span>
                        @endif
                    </a>
                @endforeach
            </div>
        @endif
    </div>

    @if($dropdown)
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const button = document.getElementById('locale-menu-button');
                const menu = document.getElementById('locale-menu');
                
                if (button && menu) {
                    button.addEventListener('click', function() {
                        const isExpanded = button.getAttribute('aria-expanded') === 'true';
                        button.setAttribute('aria-expanded', !isExpanded);
                        menu.classList.toggle('hidden');
                    });
                    
                    // Close menu when clicking outside
                    document.addEventListener('click', function(event) {
                        if (!button.contains(event.target) && !menu.contains(event.target)) {
                            button.setAttribute('aria-expanded', 'false');
                            menu.classList.add('hidden');
                        }
                    });
                }
            });
        </script>
    @endif
@endif

