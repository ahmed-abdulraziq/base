@extends('dashboard.layouts.master')
@section('title', __('translate.create_role'))
@section('header', __('translate.create_role'))
@section('roles', 'show')
@section('breadcrumbs', Breadcrumbs::render('roles.create'))
@section('content')
    <div class="col-12">
        <form action="{{ route('roles.store') }}" method="POST">
            @csrf
            <div class="box-shadow mb-30 pd-15">
                <div class="row">
                    <div class="col-12">
                        <div class="mb-3 ">
                            <label for="name" class="form-label">@lang('translate.name')</label>
                            <input name="name" type="text" class="form-control" value="{{ old('name') }} "
                                id="name" required />
                            @error('name')
                                <span class="text-danger fw-bold">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Permission:</strong>
                            {{-- <div class="row py-3">
                                @foreach ($permission as $value)
                                    <label><input type="checkbox" name="permission[{{ $value->id }}]"
                                            value="{{ $value->id }}" class="name">
                                        {{ $value->name }}</label>
                                    <br />
                                    @error('permission')
                                        <span class="text-danger fw-bold">{{ $message }}</span>
                                    @enderror
                                @endforeach
                            </div> --}}
                            <div class="row py-3">
                                @foreach ($permission as $value)
                                    <div class="col-xs-12 col-sm-12 col-md-3">
                                        <label><input type="checkbox" name="permission[{{ $value->id }}]"
                                                value="{{ $value->id }}" class="name">
                                            {{ $value->name }}</label>
                                    </div>
                                @endforeach
                                @error('permission')
                                    <span class="text-danger fw-bold">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">
                    @lang('translate.save')
                </button>
            </div>
        </form>
    </div>
@endsection
