@extends('dashboard.layouts.master')
@section('title', __('translate.contact_messages'))
@section('header', __('translate.contact_messages'))
@section('contact_messages', 'active')

@section('content')
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">@lang('translate.contact_messages')</h3>
            </div>
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap datatable">
                    <thead>
                        <tr>
                            <th>@lang('translate.id')</th>
                            <th>@lang('translate.from')</th>
                            <th>@lang('translate.subject')</th>
                            <th>@lang('translate.status')</th>
                            <th>@lang('translate.sent_at')</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($messages as $message)
                            <tr>
                                <td>{{ $message->id }}</td>
                                <td>
                                    <div class="d-flex py-1 align-items-center">
                                        <div class="flex-fill">
                                            <div class="font-weight-medium">{{ $message->name }}</div>
                                            <div class="text-muted"><a href="mailto:{{ $message->email }}" class="text-reset">{{ $message->email }}</a></div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $message->subject }}</td>
                                <td>
                                    @if($message->read_at)
                                        <span class="badge bg-success">@lang('translate.read')</span>
                                    @else
                                        <span class="badge bg-warning">@lang('translate.unread')</span>
                                    @endif
                                </td>
                                <td>{{ $message->created_at->format('Y-m-d H:i') }}</td>
                                <td class="text-end">
                                    <span class="dropdown">
                                        <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport" data-bs-toggle="dropdown">@lang('translate.operations')</button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="{{ route('dashboard.contact_messages.show', $message->id) }}">
                                                <i class="fa-solid fa-eye me-2"></i> @lang('translate.view_message')
                                            </a>
                                            @if(!$message->read_at)
                                                <form action="{{ route('dashboard.contact_messages.markAsRead', $message->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="dropdown-item">
                                                        <i class="fa-solid fa-check me-2"></i> @lang('translate.mark_as_read')
                                                    </button>
                                                </form>
                                            @endif
                                            <form action="{{ route('dashboard.contact_messages.destroy', $message->id) }}" method="POST" onsubmit="return confirm('{{ __('translate.are_you_sure') }}')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item text-danger">
                                                    <i class="fa-solid fa-trash me-2"></i> @lang('translate.delete')
                                                </button>
                                            </form>
                                        </div>
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">@lang('translate.no_messages')</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($messages->hasPages())
                <div class="card-footer d-flex align-items-center">
                    {{ $messages->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
