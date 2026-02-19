@extends('dashboard.layouts.master')
@section('title', __('translate.prescription_options'))
@section('header', __('translate.prescription_options'))
@section('settings', 'active')
@section('breadcrumbs', Breadcrumbs::render('settings.prescription_options'))

@section('content')
<div class="card col-12">
    <div class="row g-0">
        @include('admin.settings.partials.sidebar')
        <div class="col-12 col-md-9">
            <div class="card-body">

                <div class="card-header mb-3">
                    <h3 class="card-title">{{ __('translate.prescription_options') }}</h3>
                    <p class="text-muted mb-0">{{ __('translate.prescription_options_hint') }}</p>
                </div>

                <div class="row">
                    @foreach(['dosage' => __('translate.dosage'), 'frequency' => __('translate.frequency'), 'duration' => __('translate.duration')] as $type => $label)
                    <div class="col-12 col-lg-4 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title mb-0">{{ $label }}</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('dashboard.settings.prescription-options.store') }}" method="POST" class="mb-3">
                                    @csrf
                                    <input type="hidden" name="type" value="{{ $type }}">
                                    <div class="input-group">
                                        <input type="text" name="value" class="form-control" placeholder="{{ __('translate.add_option') }}" required>
                                        <button type="submit" class="btn btn-primary">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-plus m-0"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 5l0 14"/><path d="M5 12l14 0"/></svg>
                                        </button>
                                    </div>
                                    @error("value_{$type}")
                                        <span class="text-danger small">{{ $message }}</span>
                                    @enderror
                                </form>
                                <ul class="list-group list-group-flush">
                                    @forelse($optionsByType[$type] ?? [] as $item)
                                    <li class="list-group-item d-flex justify-content-between align-items-center py-2 px-3">
                                        <span>{{ $item->value }}</span>
                                        <form action="{{ route('dashboard.settings.prescription-options.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('{{ __('translate.confirm_delete') }}');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn text-danger py-1 px-2" title="{{ __('translate.delete') }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash m-0"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0"/><path d="M10 11l0 6"/><path d="M14 11l0 6"/><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"/><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"/></svg>
                                            </button>
                                        </form>
                                    </li>
                                    @empty
                                    <li class="list-group-item text-muted small py-2">{{ __('translate.no_options') }}</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
