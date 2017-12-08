@extends('app_frontend')

@section('title', 'Forgotten password')

@extends('_partials.menu')

@section('content')
    <div id="login">
        <div id="login-wrapper">
            <div id="logo-banner" class="row">
                <div id="menu-logo" class="text-center">
                    <a href="{{route('home')}}">
                        <span class="fire">FIRE</span><span class="cat">CAT</span>
                    </a>
                </div>
                <h5 class="text-center">Deal Registration Portal</h5>
            </div>
            <div class="row">
                <h2 class="title">Password Reset</h2>
                <p>
                    If you require a password reset, please enter your email address below and we'll send out a password
                    reset link right away.
                </p>
                @include('_partials.flash_message')
                <form method="POST" action="{{ route('password.email') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="control-label">E-Mail Address</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="button action">
                            Send Password Reset Link
                        </button>
                    </div>
                </form>
            </div>
            <div class="row">
                <a href="{{ route('login') }}">Login</a> | <a href="{{ route('register') }}">Register</a>
            </div>
        </div>
    </div>
@endsection
