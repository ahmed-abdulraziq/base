@extends('doctor.layouts.master')

@section('title', $patient->name)
@section('header')
    <div class="d-flex align-items-center justify-content-between flex-wrap gap-2">
        <div class="d-flex align-items-center gap-3">
            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center shadow"
                 style="width:64px;height:64px;font-size:1.75rem;">
                {{ strtoupper(substr($patient->name, 0, 1)) }}
            </div>
            <div>
                <h4 class="mb-1 text-dark fw-bold">{{ $patient->name }}</h4>
                <div class="d-flex gap-3 text-muted small">
                    <span><i class="fas fa-venus-mars me-1"></i>{{ $patient->gender instanceof \BackedEnum ? $patient->gender->value : $patient->gender }}</span>
                    <span><i class="fas fa-calendar me-1"></i>{{ $patient->date_of_birth ? $patient->date_of_birth->format('Y-m-d') : '-' }}</span>
                    <span><i class="fas fa-phone me-1"></i><span dir="ltr">{{ $patient->phone }}</span></span>
                </div>
            </div>
        </div>
        <a href="{{ route('doctor.patients.index') }}" class="btn btn-light">
            <i class="fas fa-arrow-left me-1"></i> @lang('translate.back')
        </a>
    </div>
@endsection

@section('doctor_patients', 'active')
@section('breadcrumbs', Breadcrumbs::render('doctor.patients.show', $patient))

@section('content')
    @include('partials.patient-history', [
        'uploadRoute' => 'doctor.examinations.upload',
        'pdfRoute'    => 'doctor.prescriptions.pdf',
        'editRoute'   => null,
    ])
@endsection
