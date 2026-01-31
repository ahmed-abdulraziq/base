@props([
    'name' => 'working_days',
    'value' => old('working_days', []),
    'label' => __('translate.working_days'),
    'col' => 'col-md-12',
])

@php
    $days = [
        'saturday' => __('translate.saturday'),
        'sunday' => __('translate.sunday'),
        'monday' => __('translate.monday'),
        'tuesday' => __('translate.tuesday'),
        'wednesday' => __('translate.wednesday'),
        'thursday' => __('translate.thursday'),
        'friday' => __('translate.friday'),
    ];
    $workingDays = is_string($value) ? json_decode($value, true) : $value;
@endphp

<div class="{{ $col }} mb-4">
    <label class="form-label d-block mb-2">{{ $label }}</label>

    <div class="card">
        <div class="table-responsive">
            <table class="table card-table table-vcenter text-center">
                <thead class="bg-light">
                    <tr>
                        <th>{{ __('translate.day') }}</th>
                        <th>{{ __('translate.active') }}</th>
                        <th>{{ __('translate.from') }}</th>
                        <th>{{ __('translate.to') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($days as $dayKey => $dayName)
                        @php
                            $from = $workingDays[$dayKey][1]['from'] ?? '';
                            $to = $workingDays[$dayKey][1]['to'] ?? '';
                            $isActive = $from && $to;
                        @endphp
                        <tr>
                            <td class="fw-semibold">{{ $dayName }}</td>
                            <td>
                                <input type="checkbox"
                                       class="form-check-input toggle-day"
                                       data-day="{{ $dayKey }}"
                                       name="{{ $name }}[{{ $dayKey }}][1][active]"
                                       value="1"
                                       {{ $isActive ? 'checked' : '' }}>
                            </td>
                            <td>
                                <input type="time"
                                       class="form-control form-control time-from-{{ $dayKey }}"
                                       name="{{ $name }}[{{ $dayKey }}][1][from]"
                                       value="{{ $from }}"
                                       {{ !$isActive ? 'disabled' : '' }}>
                            </td>
                            <td>
                                <input type="time"
                                       class="form-control form-control time-to-{{ $dayKey }}"
                                       name="{{ $name }}[{{ $dayKey }}][1][to]"
                                       value="{{ $to }}"
                                       {{ !$isActive ? 'disabled' : '' }}>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.toggle-day').forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    const day = this.dataset.day;
                    const fromInput = document.querySelector(`.time-from-${day}`);
                    const toInput = document.querySelector(`.time-to-${day}`);

                    if (this.checked) {
                        fromInput.removeAttribute('disabled');
                        toInput.removeAttribute('disabled');
                    } else {
                        fromInput.setAttribute('disabled', true);
                        toInput.setAttribute('disabled', true);
                    }
                });
            });
        });
    </script>
@endpush
