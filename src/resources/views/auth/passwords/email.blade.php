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
                <form class="px-3 py-4" method="POST" action="{{ route('skeletor.auth.password.email') }}" aria-label="{{ __('validation.attributes.reset-password') }}">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="email" value="{{ old('email') }}" required>
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
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary btn-block">
                            {{ __('validation.attributes.send-password-link') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
