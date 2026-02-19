@extends('doctor.layouts.master')

@section('title', __('translate.edit_examination'))
@section('header', __('translate.edit_examination'))
@section('doctor_examinations', 'active')
@section('breadcrumbs', Breadcrumbs::render('doctor.examinations.edit', $examination))

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">@lang('translate.edit_examination')</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('doctor.examinations.update', $examination) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="appointment_id" class="form-label">@lang('translate.appointment') <span class="text-danger">*</span></label>
                            <select class="form-select @error('appointment_id') is-invalid @enderror" id="appointment_id" name="appointment_id" required disabled>
                                <option value="">@lang('translate.select_appointment')</option>
                                @foreach($appointments as $id => $label)
                                    <option value="{{ $id }}" {{ old('appointment_id', $examination->appointment_id) == $id ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            <input type="hidden" name="appointment_id" value="{{ $examination->appointment_id }}">
                            <input type="hidden" name="patient_id" value="{{ $examination->patient_id }}">
                            <input type="hidden" name="doctor_id" value="{{ $examination->doctor_id }}">
                            @error('appointment_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="examination_date" class="form-label">@lang('translate.examination_date') <span class="text-danger">*</span></label>
                            <input type="datetime-local" class="form-control @error('examination_date') is-invalid @enderror" id="examination_date" name="examination_date" value="{{ old('examination_date', $examination->examination_date?->format('Y-m-d\TH:i')) }}" required>
                            @error('examination_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="symptoms" class="form-label">@lang('translate.symptoms')</label>
                            <textarea class="form-control @error('symptoms') is-invalid @enderror" id="symptoms" name="symptoms" rows="3">{{ old('symptoms', $examination->symptoms) }}</textarea>
                            @error('symptoms')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="diagnosis" class="form-label">@lang('translate.diagnosis')</label>
                            <textarea class="form-control @error('diagnosis') is-invalid @enderror" id="diagnosis" name="diagnosis" rows="3">{{ old('diagnosis', $examination->diagnosis) }}</textarea>
                            @error('diagnosis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="notes" class="form-label">@lang('translate.notes')</label>
                            <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="2">{{ old('notes', $examination->notes) }}</textarea>
                            @error('notes')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">@lang('translate.save')</button>
                            <a href="{{ route('doctor.examinations.index') }}" class="btn btn-secondary">@lang('translate.cancel')</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
