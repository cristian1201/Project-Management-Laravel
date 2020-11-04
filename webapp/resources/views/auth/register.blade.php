@extends('layouts.app')

@section('content')
    <section style="border: solid rgb(143, 133, 135) 1px; border-radius: 10px; padding: 50px">
        <h3>Register</h3>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="row gtr-uniform gtr-50">
                <div class="col-6 col-12-small">
                    <div class="row">
                        <div class="col-6">
                            <input id="name" type="text" placeholder="First name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                        <div class="col-6">
                            <input id="lastname" type="text" placeholder="Last name" class="form-control @error('name') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" autofocus>
                            @error('lastname')
                            <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                            @enderror
                        </div>
                    </div>

                    <br>
                    <input id="email" type="email" placeholder="E-mail" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror <br>
                    <input id="username" type="text" placeholder="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autofocus>
                    @error('username')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <br>
                </div>
                <div class="col-6 col-12-small">
                    <input id="telephone" type="text" placeholder="Phone number" class="form-control @error('telephone') is-invalid @enderror" name="telephone" value="{{ old('telephone') }}" required autofocus>
                    @error('telephone')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <br>
                    <input id="password" type="password" placeholder="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <br/>
                    <input id="password-confirm" type="password" placeholder="confirm password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
                <div class="col-12">
                    <center><div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label> &nbsp;&nbsp;&nbsp;
                            <input type="submit" value="Register" class="primary"/>
                        </div>
                        </center>
                </div>
                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </div>
        </form>
    </section>
@endsection
