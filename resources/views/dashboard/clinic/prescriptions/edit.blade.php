@extends('dashboard.layouts.master')

@section('title', __('translate.edit_prescription'))
@section('header', __('translate.edit_prescription'))
@section('clinic_prescriptions', 'active')
@section('breadcrumbs', Breadcrumbs::render('clinic.prescriptions.edit', $prescription))

@section('content')
    <div class="col-md-12">
        <form action="{{ route('dashboard.clinic.prescriptions.update', $prescription) }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @if ($errors->any())
                <div class="mb-3">
                    @foreach ($errors->all() as $error)
                        <span class="text-danger fw-bold">{{ $error }}</span><br>
                    @endforeach
                </div>
            @endif
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">{{ __('translate.edit_prescription') }}</h3>
                    <a href="{{ route('dashboard.clinic.prescriptions.pdf', $prescription) }}" class="btn btn-success" target="_blank" title="{{ __('translate.print_prescription') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-file-type-pdf me-1"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4"/><path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4"/><path d="M5 18h1.5a1.5 1.5 0 0 0 0 -3h-1.5v6"/><path d="M17 18h2"/><path d="M20 15h-3v6"/><path d="M11 15v6h1a2 2 0 0 0 2 -2v-2a2 2 0 0 0 -2 -2h-1z"/></svg>
                        {{ __('translate.print_prescription') }}
                    </a>
                </div>
                <div class="card-body border-bottom py-3">
                    <div class="row">
                        <div class="hr-text text-primary fs-4">{{ __('translate.prescription_data') }}</div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">{{ __('translate.examination') }}</label>
                            <input type="text" class="form-control" readonly value="كشف #{{ $prescription->examination_id }} - {{ $prescription->patient?->full_name }} - د.{{ $prescription->doctor?->full_name }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">{{ __('translate.prescription_date') }} <span class="text-danger">*</span></label>
                            <input type="datetime-local" name="prescription_date" class="form-control" value="{{ old('prescription_date', $prescription->prescription_date?->format('Y-m-d\TH:i')) }}" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">{{ __('translate.notes') }}</label>
                            <textarea name="notes" class="form-control" rows="2">{{ old('notes', $prescription->notes) }}</textarea>
                        </div>

                        <div class="hr-text text-primary fs-4 mt-3">{{ __('translate.prescription_medications') }}</div>
                        <div class="col-12">
                            <div id="prescription-details-container">
                                @foreach($prescription->details as $index => $detail)
                                <div class="detail-row row mb-3 border-bottom pb-3">
                                    <div class="col-md-4">
                                        <label class="form-label">{{ __('translate.medication') }}</label>
                                        <select name="details[{{ $index }}][medication_id]" class="form-select">
                                            <option value="">{{ __('translate.select_option') }}</option>
                                            @foreach($medications ?? [] as $value => $label)
                                                <option value="{{ $value }}" {{ ($detail->medication_id == $value || old("details.{$index}.medication_id") == $value) ? 'selected' : '' }}>{{ $label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">{{ __('translate.dosage') }}</label>
                                        <input type="text" name="details[{{ $index }}][dosage]" class="form-control" list="dosage-options" placeholder="اختر أو اكتب" value="{{ old("details.{$index}.dosage", $detail->dosage) }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">{{ __('translate.frequency') }}</label>
                                        <input type="text" name="details[{{ $index }}][frequency]" class="form-control" list="frequency-options" placeholder="اختر أو اكتب" value="{{ old("details.{$index}.frequency", $detail->frequency) }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">{{ __('translate.duration') }}</label>
                                        <input type="text" name="details[{{ $index }}][duration]" class="form-control" list="duration-options" placeholder="اختر أو اكتب" value="{{ old("details.{$index}.duration", $detail->duration) }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">&nbsp;</label>
                                        <button type="button" class="btn btn-outline-danger w-100 remove-detail-row">
                                            {{ __('translate.delete') }}
                                        </button>
                                    </div>
                                    <div class="col-12 mt-1">
                                        <input type="text" name="details[{{ $index }}][instructions]" class="form-control" placeholder="{{ __('translate.instructions') }}" value="{{ old("details.{$index}.instructions", $detail->instructions) }}">
                                    </div>
                                </div>
                                @endforeach
                                @if($prescription->details->isEmpty())
                                <div class="detail-row row mb-3 border-bottom pb-3">
                                    <div class="col-md-4">
                                        <label class="form-label">{{ __('translate.medication') }}</label>
                                        <select name="details[0][medication_id]" class="form-select">
                                            <option value="">{{ __('translate.select_option') }}</option>
                                            @foreach($medications ?? [] as $value => $label)
                                                <option value="{{ $value }}">{{ $label }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">{{ __('translate.dosage') }}</label>
                                        <input type="text" name="details[0][dosage]" class="form-control" list="dosage-options" placeholder="اختر أو اكتب">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">{{ __('translate.frequency') }}</label>
                                        <input type="text" name="details[0][frequency]" class="form-control" list="frequency-options" placeholder="اختر أو اكتب">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">{{ __('translate.duration') }}</label>
                                        <input type="text" name="details[0][duration]" class="form-control" list="duration-options" placeholder="اختر أو اكتب">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">&nbsp;</label>
                                        <button type="button" class="btn btn-outline-danger w-100 remove-detail-row">
                                            {{ __('translate.delete') }}
                                        </button>
                                    </div>
                                    <div class="col-12 mt-1">
                                        <input type="text" name="details[0][instructions]" class="form-control" placeholder="{{ __('translate.instructions') }}">
                                    </div>
                                </div>
                                @endif
                            </div>
                            <button type="button" id="add-detail-row" class="btn btn-outline-primary">
                                + {{ __('translate.add_medication') }}
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-footer d-flex align-items-center">
                    <button type="submit" class="btn btn-primary">{{ __('translate.save') }}</button>
                </div>
            </div>
        </form>

        <datalist id="dosage-options">
            @foreach($prescriptionOptions['dosage'] ?? [] as $opt)
                <option value="{{ $opt }}">
            @endforeach
        </datalist>
        <datalist id="frequency-options">
            @foreach($prescriptionOptions['frequency'] ?? [] as $opt)
                <option value="{{ $opt }}">
            @endforeach
        </datalist>
        <datalist id="duration-options">
            @foreach($prescriptionOptions['duration'] ?? [] as $opt)
                <option value="{{ $opt }}">
            @endforeach
        </datalist>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('prescription-details-container');
            const medications = @json($medications ?? []);
            let rowIndex = {{ $prescription->details->count() ?: 1 }};

            document.getElementById('add-detail-row').addEventListener('click', function() {
                const options = Object.entries(medications).map(([val, label]) =>
                    `<option value="${val}">${label}</option>`
                ).join('');
                const row = document.createElement('div');
                row.className = 'detail-row row mb-2 border-bottom pb-2';
                row.innerHTML = `
                    <div class="col-md-4">
                        <label class="form-label">{{ __('translate.medication') }}</label>
                        <select name="details[${rowIndex}][medication_id]" class="form-select">
                            <option value="">{{ __('translate.select_option') }}</option>
                            ${options}
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">{{ __('translate.dosage') }}</label>
                        <input type="text" name="details[${rowIndex}][dosage]" class="form-control" list="dosage-options" placeholder="اختر أو اكتب">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">{{ __('translate.frequency') }}</label>
                        <input type="text" name="details[${rowIndex}][frequency]" class="form-control" list="frequency-options" placeholder="اختر أو اكتب">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">{{ __('translate.duration') }}</label>
                        <input type="text" name="details[${rowIndex}][duration]" class="form-control" list="duration-options" placeholder="اختر أو اكتب">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">&nbsp;</label>
                        <button type="button" class="btn btn-outline-danger w-100 remove-detail-row">
                            {{ __('translate.delete') }}
                        </button>
                    </div>
                    <div class="col-12 mt-1">
                        <input type="text" name="details[${rowIndex}][instructions]" class="form-control" placeholder="{{ __('translate.instructions') }}">
                    </div>
                `;
                container.appendChild(row);
                rowIndex++;
            });

            container.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-detail-row')) {
                    const row = e.target.closest('.detail-row');
                    if (container.querySelectorAll('.detail-row').length > 1) {
                        row.remove();
                    }
                }
            });
        });
    </script>
    @endpush
@endsection
