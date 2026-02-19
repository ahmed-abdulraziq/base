@extends('doctor.layouts.master')

@section('title', __('translate.add_examination'))
@section('header', __('translate.add_examination'))
@section('doctor_examinations', 'active')
@section('breadcrumbs', Breadcrumbs::render('doctor.examinations.create'))

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">@lang('translate.add_examination')</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('doctor.examinations.store') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="appointment_id" class="form-label">@lang('translate.appointment') <span class="text-danger">*</span></label>
                            <select class="form-select @error('appointment_id') is-invalid @enderror" id="appointment_id" name="appointment_id" required>
                                <option value="">@lang('translate.select_appointment')</option>
                                @foreach($appointments as $id => $label)
                                    <option value="{{ $id }}" {{ old('appointment_id') == $id ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('appointment_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label for="examination_date" class="form-label">@lang('translate.examination_date') <span class="text-danger">*</span></label>
                            <input type="datetime-local" class="form-control @error('examination_date') is-invalid @enderror" id="examination_date" name="examination_date" value="{{ old('examination_date', now()->format('Y-m-d\TH:i')) }}" required>
                            @error('examination_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="symptoms" class="form-label">@lang('translate.symptoms')</label>
                            <textarea class="form-control @error('symptoms') is-invalid @enderror" id="symptoms" name="symptoms" rows="3">{{ old('symptoms') }}</textarea>
                            @error('symptoms')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="diagnosis" class="form-label">@lang('translate.diagnosis')</label>
                            <textarea class="form-control @error('diagnosis') is-invalid @enderror" id="diagnosis" name="diagnosis" rows="3">{{ old('diagnosis') }}</textarea>
                            @error('diagnosis')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="notes" class="form-label">@lang('translate.notes')</label>
                            <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="2">{{ old('notes') }}</textarea>
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
