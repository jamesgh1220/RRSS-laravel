@extends('layouts.app')

@section('content')
<div class="container mr-0">
    <div class="row justify-content-center">
        <div class="col-7 mt-5 d-flex">
            <div class="col-md-10">
                <div class="card row justify-content-center mr-5">
                    <div class="card-header">{{ __('Login') }}</div>

                    <div class="card-body mt-3 ">
                        <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                            @csrf

                            <div class="form-group row">
                                <div class="col-md-7">
                                    <input id="email" type="email" placeholder={{ __('E-Mail Address') }} class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-7">
                                    <input id="password" type="password" placeholder={{ __('Password')}} class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-8 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row">
                                <a class="btn btn-link mx-6" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                                <div class="col-md-8 offset-md-5">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                                <a class="btn btn-link mx-6 mt-2" href="{{ route('register') }}">
                                    {{ __('Register') }}
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>  
        <div class="col-5 mr-0 d-flex">
            <div class="bg-green">
                <h1>dsadadsa</h1>
            </div>
        </div>
    </div>
</div>


@endsection
