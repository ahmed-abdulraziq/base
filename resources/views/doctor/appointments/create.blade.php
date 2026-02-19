@extends('doctor.layouts.master')
@section('title', __('translate.create_appointment'))
@section('header', __('translate.create_appointment'))
@section('doctor_appointments', 'active')
@section('breadcrumbs', Breadcrumbs::render('doctor.appointments.create'))

@section('content')
    <div class="col-md-12">
        <x-forms.form route="doctor.appointments.store" method="POST" submitText="{{ __('translate.save') }}" formClass="form-horizontal" :title="__('translate.create_appointment')">
            <input type="hidden" name="doctor_id" value="{{ auth('doctor')->user()->id }}">
            <x-forms.select name="patient_id" :label="__('translate.patient')" :options="$patients" required col="col-md-6" />
            <x-forms.input type="date" name="appointment_date" :label="__('translate.appointment_date')" required col="col-md-6" />
            <x-forms.input type="time" name="appointment_time" :label="__('translate.appointment_time')" required col="col-md-6" />
            <div class="col-md-6 mb-3">
                <label class="form-label">{{ __('translate.status') }} <span class="text-danger">*</span></label>
                <select name="status" class="form-select" required>
                    @foreach(\App\Enums\AppointmentStatus::cases() as $case)
                    <option value="{{ $case->value }}" {{ $case->value === \App\Enums\AppointmentStatus::default() ? 'selected' : '' }}>{{ $case->label() }}</option>
                @endforeach
                </select>
            </div>
            <x-forms.select name="created_by" :label="__('translate.created_by')" :options="$employees ?? []" col="col-md-6" />
            <x-forms.textarea name="reason" :label="__('translate.reason')" col="col-12" />
            <x-forms.textarea name="notes" :label="__('translate.notes')" col="col-12" />
        </x-forms.form>
    </div>
@endsection
