@extends('dashboard.layouts.master')
@section('title', __('translate.view_message'))
@section('header', __('translate.view_message'))
@section('contact_messages', 'active')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h3 class="card-title">@lang('translate.view_message') #{{ $contactMessage->id }}</h3>
                <a href="{{ route('dashboard.contact_messages.index') }}" class="btn btn-primary">
                    <i class="fa-solid fa-arrow-left me-2"></i> @lang('translate.back_to_home')
                </a>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label font-weight-bold">@lang('translate.from')</label>
                        <div class="form-control-plaintext border rounded p-2">
                            <strong>{{ $contactMessage->name }}</strong> ({{ $contactMessage->email }})
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label font-weight-bold">@lang('translate.sent_at')</label>
                        <div class="form-control-plaintext border rounded p-2">
                            {{ $contactMessage->created_at->format('Y-m-d H:i:s') }}
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="form-label font-weight-bold">@lang('translate.subject')</label>
                        <div class="form-control-plaintext border rounded p-2">
                            {{ $contactMessage->subject }}
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="form-label font-weight-bold">@lang('translate.message')</label>
                        <div class="form-control-plaintext border rounded p-2" style="white-space: pre-wrap; min-height: 150px;">
                            {{ $contactMessage->message }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-end">
                <form action="{{ route('dashboard.contact_messages.destroy', $contactMessage->id) }}" method="POST" class="d-inline" onsubmit="return confirm('{{ __('translate.are_you_sure') }}')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fa-solid fa-trash me-2"></i> @lang('translate.delete')
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
