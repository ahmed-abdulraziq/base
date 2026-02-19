@extends('dashboard.layouts.master')

@section('title', __('translate.edit_appointment'))
@section('header', __('translate.edit_appointment'))
@section('clinic_appointments', 'active')
@section('breadcrumbs', Breadcrumbs::render('clinic.appointments.edit', $appointment))

@section('content')
    <div class="col-md-12">
        <x-forms.form route="dashboard.clinic.appointments.update" :model="$appointment" method="PUT" submitText="{{ __('translate.save') }}" formClass="form-horizontal" :title="__('translate.edit_appointment')">

            <x-forms.select name="patient_id" :label="__('translate.patient')" :options="$patients" :selected="$appointment->patient_id" required col="col-md-6" />
            <x-forms.select name="doctor_id" :label="__('translate.doctor')" :options="$doctors" :selected="$appointment->doctor_id" required col="col-md-6" />
            <x-forms.input type="date" name="appointment_date" :label="__('translate.appointment_date')" required :value="$appointment->appointment_date?->format('Y-m-d')" col="col-md-6" />
            <x-forms.input type="time" name="appointment_time" :label="__('translate.appointment_time')" required :value="$appointment->appointment_time" col="col-md-6" />
            <div class="col-md-6 mb-3">
                <label class="form-label">{{ __('translate.status') }} <span class="text-danger">*</span></label>
                <select name="status" class="form-select" required>
                    @foreach(\App\Enums\AppointmentStatus::cases() as $case)
                        <option value="{{ $case->value }}" {{ $appointment->status === $case ? 'selected' : '' }}>{{ $case->label() }}</option>
                    @endforeach
                </select>
            </div>
            <x-forms.select name="created_by" :label="__('translate.created_by')" :options="$employees" :selected="$appointment->created_by" col="col-md-6" />
            <x-forms.textarea name="reason" :label="__('translate.reason')" :value="$appointment->reason" col="col-12" />
            <x-forms.textarea name="notes" :label="__('translate.notes')" :value="$appointment->notes" col="col-12" />

        </x-forms.form>
    </div>
@endsection
