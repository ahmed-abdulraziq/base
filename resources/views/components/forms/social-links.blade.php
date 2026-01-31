@props([
    'name' => 'social_links',
    'label' => __('translate.social_links'),
    'value' => old('social_links', []),
    'col' => 'col-md-12',
])

@php
    $socials = is_array($value) ? $value : json_decode($value ?? '[]', true);
    $types = ['facebook', 'instagram', 'whatsapp', 'instapay']; // تقدر تضيف أكتر
@endphp

<div class="{{ $col }} mb-3">
    <label class="form-label">{{ $label }}</label>
    <div id="social-links-wrapper">
        @foreach ($socials as $index => $social)
            <div class="row mb-2 social-link-item">
                <div class="col-md-4">
                    <select name="{{ $name }}[{{ $index }}][type]" class="form-select" required>
                        @foreach ($types as $type)
                            <option value="{{ $type }}" @selected($social['type'] == $type)>
                                {{ ucfirst($type) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <input type="text" name="{{ $name }}[{{ $index }}][link]" class="form-control" placeholder="https://..." value="{{ $social['link'] ?? '' }}" required>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger remove-social-link w-100">
                        {{ __('translate.remove') }}
                    </button>
                </div>
            </div>
        @endforeach
    </div>

    <button type="button" class="btn btn-outline-primary" id="add-social-link">
        + {{ __('translate.add_social_link') }}
    </button>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let wrapper = document.getElementById('social-links-wrapper');
        let addButton = document.getElementById('add-social-link');
        let types = @json($types);
        let fieldName = "{{ $name }}";

        addButton.addEventListener('click', function () {
            let index = wrapper.children.length;
            let row = document.createElement('div');
            row.className = 'row mb-2 social-link-item';
            row.innerHTML = `
                <div class="col-md-4">
                    <select name="${fieldName}[${index}][type]" class="form-select" required>
                        ${types.map(type => `<option value="${type}">${type.charAt(0).toUpperCase() + type.slice(1)}</option>`).join('')}
                    </select>
                </div>
                <div class="col-md-6">
                    <input type="text" name="${fieldName}[${index}][link]" class="form-control" placeholder="https://..." required>
                </div>
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger remove-social-link w-100">
                        @lang('translate.remove')
                    </button>
                </div>
            `;
            wrapper.appendChild(row);
        });

        wrapper.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-social-link')) {
                e.target.closest('.social-link-item').remove();
            }
        });
    });
</script>
@endpush