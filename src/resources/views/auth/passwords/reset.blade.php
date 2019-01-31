@extends('skeletor::layouts.login')
@section('content')
<div class="row justify-content-center">
    <div class="col-5">
        <div class="login wrapper">
            <div class="logo">
                <img src="{{ asset(config('skeletor.logo')) }}" width="400" height="80" alt="logo" />
            </div>
            <div class="content">
                <div class="top">
                    <div class="layer">
                        <div class="title pt-4">{{ __('validation.attributes.reset-password') }}</div>
                    </div>
                </div>
                <form class="px-3 py-4" method="POST" action="{{ route('skeletor.auth.password.reset') }}" aria-label="{{ __('validation.attributes.reset-password') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="input-group mb-3">
                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="{{ __('Email') }}">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="fas fa-envelope"></i>
                            </span>
                        </div>
                        @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="input-group mb-3">
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="{{ __('validation.attributes.reset-password') }}">
                        <div class="input-group-append">
                          <span class="input-group-text">
                                <i class="fas fa-lock"></i>
                          </span>
                        </div>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="input-group mb-3">
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="{{ __('validation.attributes.confirm-password') }}">
                        <div class="input-group-append">
                          <span class="input-group-text">
                                <i class="fas fa-lock"></i>
                          </span>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary btn-block">
                            {{ __('validation.attributes.reset-password') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
