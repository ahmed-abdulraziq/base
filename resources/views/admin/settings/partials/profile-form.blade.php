@php
    $user = $user ?? auth('admin')->user();
@endphp
<form action="{{ route('dashboard.settings.profile.update') }}" method="POST">
    @method('PUT')
    @csrf

    <div class="card-header">
        <h3 class="card-title mb-0">
            @lang('translate.edit_profile')
        </h3>
    </div>
    <div class="card-body border-bottom py-3">
        <div class="row">
                {{-- Avatar (if exists) --}}
                @if($user->avatar ?? null)
                    <div class="col-12 mb-3">
                        <label class="form-label">@lang('translate.avatar')</label>
                        <div class="d-flex align-items-center gap-3">
                            <span class="avatar avatar-xl rounded-circle" style="background-image: url('{{ $user->avatar }}')"></span>
                        </div>
                    </div>
                @endif

                <div class="col-12 col-md-6">
                    <x-input
                        name="name"
                        :value="old('name', $user->name)"
                        :label="__('translate.name')"
                        :required="true"
                    />
                </div>
                <div class="col-12 col-md-6">
                    <x-input
                        name="email"
                        type="email"
                        :value="old('email', $user->email)"
                        :label="__('translate.email')"
                        :required="true"
                    />
                </div>

                <div class="col-12">
                    <p class="text-muted small mb-2">@lang('translate.leave_blank_to_keep')</p>
                </div>
                <div class="col-12 col-md-6">
                    <x-input-password name="password" :label="__('translate.password')" :required="false" />
                </div>
                <div class="col-12 col-md-6">
                    <x-input
                        name="password_confirmation"
                        type="password"
                        :value="old('password_confirmation')"
                        :label="__('translate.password_confirmation')"
                        :required="false"
                    />
                </div>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">
            @lang('translate.save')
        </button>
    </div>
</form>
