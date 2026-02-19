{{--
    Shared Patient History Partial
    Variables:
      $patient          – Patient model (eager-loaded)
      $uploadRoute      – string|null  e.g. 'doctor.examinations.upload'
      $pdfRoute         – string       e.g. 'doctor.prescriptions.pdf'
      $editRoute        – string|null  admin-only edit-patient route name
--}}
<style>
    :root {
        --primary-soft: #eef2ff;
        --primary-color: #435ebe;
    }
    .ph-card {
        border: none;
        border-radius: 1rem;
        box-shadow: 0 0.5rem 1rem rgba(0,0,0,.05);
    }
    .ph-card .card-header {
        background: transparent;
        border-bottom: 1px solid #f0f0f0;
        padding: 1.25rem 1.5rem;
    }
    .nav-tabs-custom .nav-link {
        color: #6c757d;
        border: none;
        border-bottom: 3px solid transparent;
        padding: 1rem 1.5rem;
        font-weight: 600;
        transition: all .3s;
    }
    .nav-tabs-custom .nav-link.active {
        color: var(--primary-color);
        border-bottom-color: var(--primary-color);
        background: transparent;
    }
    .nav-tabs-custom { border-bottom: 1px solid #e9ecef; }
    .info-label {
        color: #9ca3af;
        font-size: .75rem;
        text-transform: uppercase;
        letter-spacing: .05em;
        font-weight: 600;
        margin-bottom: .25rem;
    }
    .info-value { color: #1f2937; font-weight: 500; font-size: .95rem; }
    .ph-timeline-item {
        position: relative;
        padding-left: 2.5rem;
        padding-bottom: 2rem;
        border-left: 2px solid #e5e7eb;
    }
    .ph-timeline-item:last-child { border-left: 2px solid transparent; padding-bottom: 0; }
    .ph-timeline-icon {
        position: absolute;
        left: -1rem; top: 0;
        width: 2rem; height: 2rem;
        border-radius: 50%;
        background: var(--primary-soft);
        color: var(--primary-color);
        display: flex; align-items: center; justify-content: center;
        border: 2px solid #fff;
        box-shadow: 0 2px 4px rgba(0,0,0,.1);
    }
    /* RTL overrides */
    [dir="rtl"] .ph-timeline-item {
        padding-left: 0;
        padding-right: 2.5rem;
        border-left: none;
        border-right: 2px solid #e5e7eb;
    }
    [dir="rtl"] .ph-timeline-item:last-child {
        border-right: 2px solid transparent;
        padding-bottom: 0;
    }
    [dir="rtl"] .ph-timeline-icon {
        left: auto;
        right: -1rem;
    }
    .ph-timeline-card {
        background: #f9fafb;
        border-radius: .75rem;
        padding: 1.25rem;
    }
    .file-preview {
        display: flex; align-items: center;
        padding: .75rem;
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: .5rem;
        margin-bottom: .5rem;
        transition: border-color .2s;
        text-decoration: none;
    }
    .file-preview:hover { border-color: var(--primary-color); background-color: #f8fafc; }
</style>

<div class="row g-4">
    {{-- ───── LEFT: Profile + Alerts ───── --}}
    <div class="col-lg-3">
        <div class="ph-card card">
            <div class="card-body text-center pt-5">
                {{-- Avatar --}}
                <div class="mb-4 d-inline-block">
                    @if($patient->image ?? false)
                        <img src="{{ $patient->image_url }}" alt="{{ $patient->name }}"
                             class="rounded-circle shadow-sm"
                             style="width:140px;height:140px;object-fit:cover;border:4px solid white;">
                    @else
                        <div class="rounded-circle bg-primary bg-gradient d-flex align-items-center justify-content-center mx-auto text-white shadow-sm"
                             style="width:140px;height:140px;font-size:3rem;border:4px solid white;">
                            {{ strtoupper(substr($patient->name, 0, 1)) }}
                        </div>
                    @endif
                </div>

                <h4 class="fw-bold text-dark mb-1">{{ $patient->name }}</h4>
                <p class="text-muted mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-phone me-1 text-primary"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" /></svg>
                    <span dir="ltr">{{ $patient->phone }}</span>
                </p>

                <div class="d-flex justify-content-center gap-2 mb-3">
                    <span class="badge bg-light text-dark border">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-gender-bigender me-1"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M11 11m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M19 3l-4.5 4.5" /><path d="M19 3h-4" /><path d="M19 3v4" /><path d="M11 15v6" /><path d="M8 18h6" /></svg>
                        {{ $patient->gender instanceof \BackedEnum ? $patient->gender->value : $patient->gender }}
                    </span>
                    <span class="badge bg-light text-dark border">
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-cake me-1"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 20h18" /><path d="M3 17a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3" /><path d="M3 11h18" /><path d="M12 11v-4" /><path d="M12 3m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /></svg>
                        {{ $patient->date_of_birth ? $patient->date_of_birth->format('Y-m-d') : '-' }}
                    </span>
                </div>

                @if($editRoute ?? null)
                    <a href="{{ route($editRoute, $patient->id) }}" class="btn btn-sm btn-outline-primary w-100 d-inline-flex align-items-center justify-content-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                        @lang('translate.edit_patient')
                    </a>
                @endif

                <hr class="my-4 opacity-10">

                <div class="text-start px-1">
                    <div class="mb-3">
                        <div class="info-label">@lang('translate.email')</div>
                        <div class="info-value text-break">{{ $patient->email ?? '-' }}</div>
                    </div>
                    <div class="mb-3">
                        <div class="info-label">@lang('translate.address')</div>
                        <div class="info-value">{{ $patient->address ?? '-' }}</div>
                    </div>
                    <div class="row g-2">
                        <div class="col-6">
                            <div class="info-label">@lang('translate.blood_type')</div>
                            <div class="info-value text-danger fw-bold">{{ $patient->blood_type ?? '-' }}</div>
                        </div>
                        <div class="col-6">
                            <div class="info-label">@lang('translate.age')</div>
                            <div class="info-value">{{ $patient->date_of_birth ? $patient->date_of_birth->age . ' yrs' : '-' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Medical Alerts --}}
        @if($patient->allergies || $patient->medical_history)
        <div class="card border-0 border-start border-4 border-danger shadow-sm">
            <div class="card-header bg-danger bg-opacity-10 py-3">
                <h6 class="text-danger fw-bold mb-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-alert-circle me-2"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M12 8v4" /><path d="M12 16h.01" /></svg> @lang('translate.medical_alerts')
                </h6>
            </div>
            <div class="card-body bg-danger bg-opacity-10 py-2">
                @if($patient->allergies)
                    <div class="mb-2">
                        <strong class="text-danger d-block small text-uppercase">@lang('translate.allergies')</strong>
                        <p class="mb-0 text-dark small fw-medium">{{ $patient->allergies }}</p>
                    </div>
                @endif
                @if($patient->medical_history)
                    <div>
                        <strong class="text-secondary d-block small text-uppercase">@lang('translate.medical_history')</strong>
                        <p class="mb-0 text-dark small">{{ $patient->medical_history }}</p>
                    </div>
                @endif
            </div>
        </div>
        @endif
    </div>

    {{-- ───── RIGHT: Tabs ───── --}}
    <div class="col-lg-9">
        <div class="ph-card card h-100">
            <div class="card-header p-0">
                <ul class="nav nav-tabs nav-tabs-custom px-0 border-0" id="ph-mainTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#ph-history" role="tab">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-history me-2"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 8l0 4l2 2" /><path d="M3.05 11a9 9 0 1 1 .5 4m-.5 5v-5h5" /></svg> @lang('translate.medical_history')
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#ph-medications" role="tab">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-pill me-2"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4.5 12.5l8 -8a4.94 4.94 0 0 1 7 7l-8 8a4.94 4.94 0 0 1 -7 -7" /><path d="M8.5 8.5l7 7" /></svg> @lang('translate.prescriptions')
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#ph-visits" role="tab">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-calendar me-2"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" /><path d="M16 3v4" /><path d="M8 3v4" /><path d="M4 11h16" /><path d="M11 15h1" /><path d="M12 15v3" /></svg> @lang('translate.appointments')
                        </a>
                    </li>
                </ul>
            </div>

            <div class="card-body p-3" style="border-bottom-left-radius:1rem;border-bottom-right-radius:1rem;">
                <div class="tab-content">

                    {{-- ── Medical Examinations Timeline ── --}}
                    <div class="tab-pane fade show active" id="ph-history" role="tabpanel">
                        <h5 class="fw-bold mb-4">@lang('translate.consultations_and_tests')</h5>
                        <div class="ps-2">
                            @forelse($patient->medicalExaminations as $exam)
                                <div class="ph-timeline-item">
                                    <div class="ph-timeline-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-stethoscope"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6 4h-1a2 2 0 0 0 -2 2v3.5h0a5.5 5.5 0 0 0 11 0v-3.5a2 2 0 0 0 -2 -2h-1" /><path d="M8 15a6 6 0 1 0 12 0v-3" /><path d="M11 3v2" /><path d="M6 3v2" /><path d="M20 10m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /></svg>
                                    </div>

                                    <div class="d-flex justify-content-between mb-2">
                                        <div>
                                            <span class="text-primary fw-bold">{{ $exam->diagnosis ?? __('translate.no_diagnosis') }}</span>
                                            <div class="text-muted small">{{ $exam->doctor->name ?? 'Dr. Unknown' }}</div>
                                        </div>
                                        <div class="text-end">
                                            <div class="text-dark fw-bold small">{{ $exam->examination_date }}</div>
                                            <span class="badge bg-light text-secondary border">#{{ $exam->id }}</span>
                                        </div>
                                    </div>

                                    <div class="ph-timeline-card">
                                        @if($exam->symptoms)
                                            <p class="mb-2 small">
                                                <strong class="text-muted text-uppercase">@lang('translate.symptoms'):</strong>
                                                {{ $exam->symptoms }}
                                            </p>
                                        @endif
                                        @if($exam->notes)
                                            <p class="mb-0 small text-muted fst-italic">{{ $exam->notes }}</p>
                                        @endif

                                        {{-- Attachments --}}
                                        <div class="mt-3 pt-3 border-top">
                                            <div class="d-flex align-items-center justify-content-between mb-2">
                                                <small class="text-uppercase fw-bold text-muted">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-paperclip me-1"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 7l-6.5 6.5a1.5 1.5 0 0 0 3 3l6.5 -6.5a3 3 0 0 0 -6 -6l-6.5 6.5a4.5 4.5 0 0 0 9 9l6.5 -6.5" /></svg> @lang('translate.attachments')
                                                </small>
                                                @if($uploadRoute ?? null)
                                                    <form action="{{ route($uploadRoute, $exam->id) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <label for="upload-{{ $exam->id }}" class="btn btn-sm btn-link text-decoration-none p-0 d-inline-flex align-items-center gap-1">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-circle-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" /><path d="M9 12h6" /><path d="M12 9v6" /></svg> @lang('translate.add_file')
                                                        </label>
                                                        <input type="file" id="upload-{{ $exam->id }}" name="file" class="d-none"
                                                               onchange="if(confirm('{{ __('translate.confirm_upload') ?? 'Upload this file?' }}')) this.form.submit()">
                                                    </form>
                                                @endif
                                            </div>

                                            @if($exam->attachments->count() > 0)
                                                <div class="row g-2">
                                                    @foreach($exam->attachments as $file)
                                                        <div class="col-md-6 col-lg-4">
                                                            <div class="file-preview d-flex align-items-center justify-content-between">
                                                                <a href="{{ $file->url }}" target="_blank"
                                                                   class="d-flex align-items-center gap-2 flex-grow-1 text-decoration-none overflow-hidden">
                                                                    <div class="text-secondary flex-shrink-0">
                                                                        @php $ext = strtolower($file->extension ?? ''); @endphp
                                                                        @if(in_array($ext, ['jpg','jpeg','png','gif']))
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-photo"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 8h.01" /><path d="M3 6a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v12a3 3 0 0 1 -3 3h-12a3 3 0 0 1 -3 -3v-12z" /><path d="M3 16l5 -5c.928 -.893 2.072 -.893 3 0l4 4" /><path d="M14 14l1 -1c.928 -.893 2.072 -.893 3 0l3 3" /></svg>
                                                                        @elseif($ext === 'pdf')
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-file-type-pdf text-danger"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4" /><path d="M5 18h1.5a1.5 1.5 0 0 0 0 -3h-1.5v6" /><path d="M17 18h2" /><path d="M20 15h-3v6" /><path d="M11 15v6h1a2 2 0 0 0 2 -2v-2a2 2 0 0 0 -2 -2h-1z" /></svg>
                                                                        @else
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-file"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /></svg>
                                                                        @endif
                                                                    </div>
                                                                    <div class="overflow-hidden">
                                                                        <div class="text-dark small fw-bold text-truncate">{{ $file->title ?? $file->name }}</div>
                                                                        <div class="text-muted" style="font-size:.65rem">{{ strtoupper($file->extension) }}</div>
                                                                    </div>
                                                                </a>
                                                                @if($uploadRoute ?? null)
                                                                    <form action="{{ route('doctor.attachments.delete', $file->id) }}" method="POST"
                                                                          class="ms-2 flex-shrink-0"
                                                                          onsubmit="return confirm('{{ __('translate.confirm_delete_file') }}')">
                                                                        @csrf @method('DELETE')
                                                                        <button type="submit"
                                                                                class="btn btn-sm btn-ghost-danger p-1"
                                                                                title="{{ __('translate.delete_file') }}">
                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                                                        </button>
                                                                    </form>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <div class="text-muted small fst-italic">@lang('translate.no_files_uploaded')</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-5 text-muted">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-folder-open opacity-25 mb-3 d-block mx-auto"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 19l2.757 -7.351a1 1 0 0 1 .936 -.649h12.307a1 1 0 0 1 .972 1.243l-1.928 7a1 1 0 0 1 -.972 .757h-14.072" /><path d="M5 19v-11a2 2 0 0 1 2 -2h4l3 3h5a2 2 0 0 1 2 2v1" /></svg>
                                    <h6>@lang('translate.no_examinations_found')</h6>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    {{-- ── Prescriptions ── --}}
                    <div class="tab-pane fade" id="ph-medications" role="tabpanel">
                        @forelse($patient->prescriptions as $prescription)
                            <div class="card border mb-3">
                                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-calendar text-muted me-1"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" /><path d="M16 3v4" /><path d="M8 3v4" /><path d="M4 11h16" /></svg>
                                        <strong>{{ $prescription->created_at->format('Y-m-d') }}</strong>
                                        <span class="mx-2 text-muted">|</span>
                                        <small class="text-muted">{{ $prescription->doctor->name ?? '-' }}</small>
                                    </div>
                                    <a href="{{ route($pdfRoute, $prescription->id) }}" target="_blank"
                                       class="btn btn-sm btn-primary d-inline-flex align-items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-printer"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" /><path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" /><path d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" /></svg>
                                        <span class="d-none d-sm-inline">PDF</span>
                                    </a>
                                </div>
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead class="text-muted small text-uppercase bg-white">
                                            <tr>
                                                <th class="ps-4 border-bottom-0">@lang('translate.medication')</th>
                                                <th class="border-bottom-0">@lang('translate.dosage')</th>
                                                <th class="border-bottom-0">@lang('translate.duration')</th>
                                                <th class="border-bottom-0">@lang('translate.instructions')</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($prescription->details as $detail)
                                                <tr>
                                                    <td class="ps-4 fw-bold text-primary">{{ $detail->medication->name ?? $detail->medication_id }}</td>
                                                    <td><span class="badge bg-light text-dark border">{{ $detail->dosage }}</span></td>
                                                    <td>{{ $detail->duration }}</td>
                                                    <td class="text-muted small">{{ $detail->instructions }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                @if($prescription->notes)
                                    <div class="px-4 py-2 bg-light border-top">
                                        <small class="text-muted fw-bold">@lang('translate.notes'):</small>
                                        <span class="text-dark small">{{ $prescription->notes }}</span>
                                    </div>
                                @endif
                            </div>
                        @empty
                            <div class="text-center py-5 text-muted">
                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-pill opacity-25 mb-3 d-block mx-auto"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4.5 12.5l8 -8a4.94 4.94 0 0 1 7 7l-8 8a4.94 4.94 0 0 1 -7 -7" /><path d="M8.5 8.5l7 7" /></svg>
                                <h6>@lang('translate.no_prescriptions_found')</h6>
                            </div>
                        @endforelse
                    </div>

                    {{-- ── Appointments ── --}}
                    <div class="tab-pane fade" id="ph-visits" role="tabpanel">
                        <div class="table-responsive mx-n3 mt-n3 mb-n3">
                            <table class="table table-hover align-middle">
                                <thead class="bg-light text-muted small text-uppercase">
                                    <tr>
                                        <th class="ps-3 py-3">@lang('translate.date')</th>
                                        <th class="py-3">@lang('translate.doctor')</th>
                                        <th class="py-3 text-center">@lang('translate.status')</th>
                                        <th class="py-3 pe-3">@lang('translate.reason')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($patient->appointments as $app)
                                        @php
                                            $sv = $app->status instanceof \BackedEnum ? $app->status->value : $app->status;
                                            $sc = match($sv) {
                                                'completed'          => 'success',
                                                'cancelled'          => 'danger',
                                                'confirmed'          => 'primary',
                                                'booked', 'pending'  => 'warning',
                                                default              => 'secondary',
                                            };
                                        @endphp
                                        <tr>
                                            <td class="ps-3">
                                                @php
                                                    $apptDate = \Carbon\Carbon::parse($app->appointment_date);
                                                    if ($app->appointment_time) {
                                                        $t = \Carbon\Carbon::parse($app->appointment_time);
                                                        $apptDt = $apptDate->setTime($t->hour, $t->minute);
                                                    } else {
                                                        $apptDt = $apptDate;
                                                    }
                                                @endphp
                                                <div class="fw-bold text-dark">{{ $apptDt->format('d M Y') }}</div>
                                                <div class="d-flex align-items-center gap-2 mt-1">
                                                    <span class="badge bg-light text-secondary border" style="font-size:.7rem;font-weight:600;">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="9"/><polyline points="12 7 12 12 15 15"/></svg>
                                                        {{ $apptDt->format('h:i A') }}
                                                    </span>
                                                    <span class="text-muted" style="font-size:.7rem;">{{ $apptDt->diffForHumans() }}</span>
                                                </div>
                                            </td>
                                            <td>{{ $app->doctor->name ?? '-' }}</td>
                                            <td class="text-center">
                                                <span class="badge bg-{{ $sc }} bg-opacity-10 text-{{ $sc }} px-3 py-2 rounded-pill">
                                                    {{ ucfirst($sv) }}
                                                </span>
                                            </td>
                                            <td class="pe-3 text-muted">{{ \Illuminate\Support\Str::limit($app->reason, 45) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-5 text-muted">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icon-tabler-calendar-off opacity-25 mb-2 d-block mx-auto"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9.5 3h5" /><path d="M3 9h18" /><path d="M5 3h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2z" /><path d="M3 3l18 18" /></svg>
                                                @lang('translate.no_appointments_found')
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
