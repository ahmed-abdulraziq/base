@props([
    'name' => 'slug',
    'label' => __('translate.slug'),
    'value' => '',
    'required' => false,
    'col' => 'col-md-6',
    'placeholder' => '',
    'source' => 'name_en', // ← هنا ID الحقل اللي بناخد منه القيمة
])

<div class="{{ $col }} mb-3">
    <div class="form-group">
        <label for="{{ $name }}" class="form-label">
            {{ $label }}
            @if ($required)
                <span class="text-danger">*</span>
            @endif
        </label>
        <div class="input-group input-group-flat">
            <span class="input-group-text">{{ route('index') }}/</span>
            <input type="text" name="{{ $name }}" id="{{ $name }}"
                class="form-control ps-1 @error($name) is-invalid @enderror" value="{{ old($name, $value) }}"
                placeholder="{{ $placeholder }}" @if ($required) required @endif>
        </div>
        @error($name)
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

@push('scripts')
<script>
    $(document).on('input', '#{{ $name }}', function () {
    let value = $(this).val();

    // فلترة: فقط حروف وأرقام و - و _
    value = value.toLowerCase().replace(/[^a-z0-9\-_]/g, '');

    $(this).val(value);
});
    function slugify(text) {
        return text.toString().toLowerCase()
            .replace(/\s+/g, '-')
            .replace(/[^\w\-]+/g, '')
            .replace(/\-\-+/g, '-')
            .replace(/^-+/, '')
            .replace(/-+$/, '');
    }

    function checkSlug(slugValue, slugInput) {
        if (slugValue.length > 0) {
            $.ajax({
                url: "{{ route('restaurants.check_slug') }}",
                method: 'GET',
                data: { slug: slugValue },
                success: function (response) {
                    if (response.exists) {
                        slugInput.addClass('is-invalid');
                        if (!slugInput.next('.invalid-feedback').length) {
                            slugInput.after('<div class="invalid-feedback">{{ __("translate.this_slug_already_exists") }}</div>');
                        }
                    } else {
                        slugInput.removeClass('is-invalid');
                        slugInput.next('.invalid-feedback').remove();
                    }
                }
            });
        }
    }

    $(document).ready(function () {
        const sourceInput = $('#{{ $source }}');

        // عند الكتابة في name → توليد slug + check
        sourceInput.on('input', function () {
            const nameValue = $(this).val();
            const slugValue = slugify(nameValue);
            const slugInput = $('#{{ $name }}');
            slugInput.val(slugValue);
            checkSlug(slugValue, slugInput);
        });

        // عند التعديل اليدوي على slug → check فقط
        $(document).on('input', '#{{ $name }}', function () {
            const slugValue = $(this).val();
            checkSlug(slugValue, $(this));
        });
    });
</script>
@endpush

