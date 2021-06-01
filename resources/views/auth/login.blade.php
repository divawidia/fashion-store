@extends('layout-login_register.index')
@section('title', 'Login')
@section('content')

<div class="register-login-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="login-form">
                    <h2>Login</h2>
                    <form method="POST" action="/postlogin">
                        @csrf

                        <div class="group-input">
                            <label for="email">{{ __('E-Mail Address') }}</label>

                           
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="group-input">
                            <label for="password" >{{ __('Password') }}</label>

                          
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           
                        </div>

                        <div class="group-input gi-check">
                            <div class="gi-more">
                                <label for="save-pass">
                                    Save Password
                                    <input class="form-check-input" type="checkbox" name="remember" id="save-pass" {{ old('remember') ? 'checked' : '' }}>

                                    <span class="checkmark"></span>
                                </label>
                                @if (Route::has('password.request'))
                                    <a class="forget-pass" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                                <button type="submit" class="site-btn login-btn">
                                    {{ __('Login') }}
                                </button>
                    </form>
                    <div class="switch-login">
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="or-login">Or Create An Account</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
