<!-- resources/views/components/forms/select.blade.php -->
@props([
    'name',
    'label',
    'col' => 'col-md-6',
    'options' => [],        // لو بعت خيارات جاهزة
    'selected' => null,     // القيمة المختارة حالياً
    'required' => false,
    'model' => null,        // اسم الموديل (بدون الـ namespace)
    'dependsField' => null, // اسم الـ select اللي بيعتمد عليه (id)
])

@php
    // لو مفيش خيارات مارة، يبنيها من الموديل
    if (!$options && $model) {
        $class = "App\\Models\\{$model}";
        $all = $class::all();

        if ($dependsField) {
            // نجمعهم حسب الـ dependsField عشان يبقى بالشكل: [parent_id => [id => name, ...], ...]
            $options = $all
                ->groupBy($dependsField)
                ->map(fn($group) => $group->pluck('name', 'id')->toArray())
                ->toArray();
        } else {
            // خيارات مستقلة (id => name)
            $options = $all->pluck('name', 'id')->toArray();
        }
    }
@endphp

<div class="{{ $col }} mb-3">
  <div class="form-group">
    <label for="{{ $name }}" class="form-label">
      {{ $label }}
      @if($required)<span class="text-danger">*</span>@endif
    </label>
    <select
      name="{{ $name }}"
      id="{{ $name }}"
      class="form-select @error($name) is-invalid @enderror"
      @if($required) required @endif
    >
      <option value="">{{ __('translate.select_option') }}</option>
      {{-- لو مفيش dependsField، نعرض الخيارات كلها --}}
      @if(!$dependsField)
        @foreach($options as $value => $text)
          <option value="{{ $value }}" {{ (string)$selected === (string)$value ? 'selected' : '' }}>
            {{ $text }}
          </option>
        @endforeach
      @endif
    </select>
    @error($name)
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
</div>

@push('scripts')
  @if($dependsField)
    <script>
      $(function() {
        // كل الخيارات المجموعة في مصفوفة: { parent_id: { id: name, ...}, ... }
        const allOpts = @json($options);
        const initial = "{{ $selected }}";

        function populate() {
          const parentVal = $('#{{ $dependsField }}').val();
          const target = $('#{{ $name }}');

          // تفريغ وتعبئة الخيار الافتراضي
          target.html('<option value="">{{ __('translate.select_option') }}</option>');

          if (allOpts[parentVal]) {
            $.each(allOpts[parentVal], function(val, text) {
              const opt = $('<option>').val(val).text(text);
              if (val == initial) opt.prop('selected', true);
              target.append(opt);
            });
          }
        }

        // أول تعبئة لو فيه قيمة افتراضية
        populate();

        // لما يتغير الـ parent
        $('#{{ $dependsField }}').on('change', function() {
          populate();
        });
      });
    </script>
  @endif
@endpush
