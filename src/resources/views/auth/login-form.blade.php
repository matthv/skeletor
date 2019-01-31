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
                        <div class="title pt-4">Connexion</div>
                    </div>
                </div>
                <form class="px-3 py-4" method="POST" action="{{ route('skeletor.auth.login') }}" aria-label="{{ __('Login') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" required autofocus placeholder="email">
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
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="mot de passe">
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
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="form-check-label" for="remember">Se souvenir de moi</label>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary btn-block">
                            {{ __('ME CONNECTER') }}
                        </button>
                    </div>
                </form>
            </div>
            <div class="mt-3">
                <a class="btn btn-link p-0 color-white" href="{{ route('skeletor.auth.password.reset') }}">Mot de passe oublié ?</a>
            </div>
        </div>
    </div>
</div>
@endsection
