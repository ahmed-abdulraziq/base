@extends('doctor.layouts.master')
@section('title', __('translate.create_prescription'))
@section('header', __('translate.create_prescription'))
@section('doctor_prescriptions', 'active')
@section('breadcrumbs', Breadcrumbs::render('doctor.prescriptions.create'))

@section('content')
    <div class="col-md-12">
        <form action="{{ route('doctor.prescriptions.store') }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
            @csrf
            @if ($errors->any())
                <div class="mb-3">
                    @foreach ($errors->all() as $error)
                        <span class="text-danger fw-bold">{{ $error }}</span><br>
                    @endforeach
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('translate.create_prescription') }}</h3>
                </div>
                <div class="card-body border-bottom py-3">
                    <div class="row">
                        <div class="hr-text text-primary fs-4">{{ __('translate.prescription_data') }}</div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">{{ __('translate.examination') }} <span class="text-danger">*</span></label>
                            <select name="examination_id" class="form-select" required>
                                <option value="">{{ __('translate.select_option') }}</option>
                                @foreach($examinations ?? [] as $value => $label)
                                    <option value="{{ $value }}" {{ old('examination_id') == $value ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">{{ __('translate.prescription_date') }} <span class="text-danger">*</span></label>
                            <input type="datetime-local" name="prescription_date" class="form-control" value="{{ old('prescription_date', now()->format('Y-m-d\TH:i')) }}" required>
                        </div>
                        <div class="col-12 mb-3">
                            <label class="form-label">{{ __('translate.notes') }}</label>
                            <textarea name="notes" class="form-control" rows="2">{{ old('notes') }}</textarea>
                        </div>

                        <div class="hr-text text-primary fs-4 mt-3">{{ __('translate.prescription_medications') }}</div>
                        <div class="col-12">
                            <div id="prescription-details-container">
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
                                        <button type="button" class="btn btn-outline-danger w-100 remove-detail-row" title="{{ __('translate.delete') }}">
                                            {{ __('translate.delete') }}
                                        </button>
                                    </div>
                                    <div class="col-12 mt-1">
                                        <input type="text" name="details[0][instructions]" class="form-control" placeholder="{{ __('translate.instructions') }}">
                                    </div>
                                </div>
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
            let rowIndex = 1;

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
