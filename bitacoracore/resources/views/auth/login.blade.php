@extends('layouts.main', ['class' => 'bg-dark'])

@section('page-title', 'Login')
@section('ngApp', 'login')
@section('ngController', 'login')

@section('styles')
    <link type="text/css" href="{{ asset('assets') }}/css/login.css" rel="stylesheet">
@endsection

@section('content')

    <img class="imagen_fondo" id="fondo" alt="Fondo login">
    {{-- <div class="container mt--9 bg-info"> --}}
    <div class="vw-100 vh-100 d-flex align-items-center justify-content-center border">
        <div class="login-container col-10 col-sm-8 col-md-6 col-lg-5 col-xl-4">
            <div class="card bg-white border-0">
                {{-- <div class="card-header bg-transparent pb-5">
                        <div class="text-muted text-center mt-2 mb-3"><small>{{ __('Sign in with') }}</small></div>
                        <div class="btn-wrapper text-center">
                            <a href="#" class="btn btn-neutral btn-icon">
                                <span class="btn-inner--icon"><img src="{{ asset('argon') }}/img/icons/common/github.svg"></span>
                                <span class="btn-inner--text">{{ __('Github') }}</span>
                            </a>
                            <a href="#" class="btn btn-neutral btn-icon">
                                <span class="btn-inner--icon"><img src="{{ asset('argon') }}/img/icons/common/google.svg"></span>
                                <span class="btn-inner--text">{{ __('Google') }}</span>
                            </a>
                        </div>
                    </div> --}}
                <div class="card-body px-lg-5 py-lg-4">
                    {{-- <div class="text-center text-muted mb-4">
                            <small>
                                    Create new account OR Sign in with these credentials:
                                    <br>
                                    Username <strong>admin@argon.com</strong> Password: <strong>secret</strong>
                            </small>
                        </div> --}}
                    <form role="form" method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }} mb-4">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email') }}</label>
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                </div>
                                <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                    placeholder="{{ __('Email') }}" id="email" type="email" name="email"
                                    value="{{ old('email') }}" value="admin@argon.com" required autofocus>
                            </div>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                            <div class="input-group input-group-alternative">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                </div>
                                <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                    name="password" placeholder="{{ __('Password') }}" id="password" type="password"
                                    required>
                            </div>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" style="display: block;" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        {{-- <div class="custom-control custom-control-alternative custom-checkbox">
                                <input class="custom-control-input" name="remember" id="customCheckLogin" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="customCheckLogin">
                                    <span class="text-muted">{{ __('Remember me') }}</span>
                                </label>
                            </div> --}}
                        <div class="py-3 d-grid gap-2 text-center">
                            <button type="submit" class="btn btn-primary btn-block">{{ __('Acceder') }}</button>
                        </div>
                    </form>
                    {{-- <div class="row mt-3">
                            <div class="col-6">
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-dark">
                                        <small>{{ __('Forgot password?') }}</small>
                                    </a>
                                @endif
                            </div>
                            <div class="col-6 text-right">
                                <a href="{{ route('register') }}" class="text-dark">
                                    <small>{{ __('Create new account') }}</small>
                                </a>
                            </div>
                        </div> --}}
                </div>
            </div>

        </div>
    </div>
    {{-- </div> --}}
@endsection

@push('js')
    <script src="{{ asset('assets') }}/js/login.js"></script>
@endpush
