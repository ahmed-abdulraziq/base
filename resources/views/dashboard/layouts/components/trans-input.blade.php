@php
    $user = auth()->user();
    // dd($menuSelect);
    if ($user->hasRole('staff')) {
        $langs = $user->staff->menu->user->package->lang;
    } else {
        $langs =
            $langs ??
            ($user->package->lang ??
                ($menu->user->package->lang ?? App\Models\Menu::find(session('menu'))->user->package->lang));
    }
    $value = $value ?? [];
    $attribute = $attribute ?? 'name';
    $required = $required ?? true;
    $type = $type ?? 'text';
@endphp

@switch($type)
    @case('text')
        @foreach ($langs as $locale)
            <div class="col-{{ $col ?? 6 }}">
                <div class="mb-3 ">
                    <label for="{{ $locale . "[$attribute]" }}"
                        class="form-label @if ($required) required @endif">@lang('translate.' . $locale . '.' . $attribute)</label>
                    <input name="{{ $attribute . "[$locale]" }}" type="text" class="form-control"
                        value="{{ old($attribute . '.' . $locale) ?? ($value[$locale] ?? '') }}" id="{{ $locale . "[$attribute]" }}"
                        @if ($required) required @endif />
                    @error($attribute . '.' . $locale)
                        {{-- @dd($errors) --}}
                        <span class="text-danger fw-bold">{{ $errors->first($locale . '.' . $attribute) }}</span>
                    @enderror
                </div>
            </div>
        @endforeach
    @break
    @case('textarea')
        @foreach ($langs as $locale)
            <div class="col-{{ $col ?? 6 }}">
                <div class="mb-3">
                    <label for="{{ $locale . "[$attribute]" }}"
                        class="form-label @if ($required) required @endif">@lang('translate.' . $locale . '.' . $attribute)</label>
                    <textarea name="{{ $attribute . "[$locale]" }}" class="form-control"
                        id="{{ $locale . "[$attribute]" }}" @if ($required) required @endif>{{ old($attribute . '.' . $locale) ?? ($value[$locale] ?? '') }}</textarea>
                    @error($attribute . '.' . $locale)
                        <span class="text-danger fw-bold">{{ $errors->first($locale . '.' . $attribute) }}</span>
                    @enderror
                </div>
            </div>
        @endforeach
    @break
    @case('trix-editor')
        @foreach ($langs as $locale)
            <div class="col-{{ $col ?? 6 }}">
                <div class="mb-3">
                    <label for="{{ $locale . "[$attribute]" }}"
                        class="form-label @if ($required) required @endif">@lang('translate.' . $locale . '.' . $attribute)</label>
                    <input id="{{ $locale . "[$attribute]" }}" type="hidden" name="{{ $attribute . "[$locale]" }}"
                        value="{{ old($attribute . '.' . $locale) ?? ($value[$locale] ?? '') }}">
                    <trix-editor input="{{ $locale . "[$attribute]" }}"></trix-editor>
                    @error($attribute . '.' . $locale)
                        <span class="text-danger fw-bold">{{ $errors->first($locale . '.' . $attribute) }}</span>
                    @enderror
                </div>
            </div>
        @endforeach
    @break
    @case('select')
        <div class="col-{{ $col ?? 6 }}">
            <div class="mb-3">
                <label for="{{ $attribute }}" class="form-label @if ($required) required @endif">@lang('translate.' . $attribute)</label>
                <select name="{{ $attribute }}" class="form-select" id="{{ $attribute }}" @if ($required) required @endif>
                    <option value="" disabled selected>@lang('translate.' . $attribute)</option>
                    @foreach ($options as $option)
                        <option value="{{ $option->id }}" {{ old($attribute) == $option->id ? 'selected' : '' }}>
                            {{ $option->translate('name') }}</option>
                    @endforeach
                </select>
                @error($attribute)
                    <span class="text-danger fw-bold">{{ $message }}</span>
                @enderror
            </div>
        </div>
    @break
    @case('file')
        <div class="col-{{ $col ?? 6 }}">
            <div class="mb-3">
                <label for="{{ $attribute }}" class="form-label @if ($required) required @endif">@lang('translate.' . $attribute)</label>
                <input type="file" name="{{ $attribute }}" class="form-control" id="{{ $attribute }}" @if ($required) required @endif />
                @error($attribute)
                    <span class="text-danger fw-bold">{{ $message }}</span>
                @enderror
            </div>
        </div>
    @break
@endswitch
