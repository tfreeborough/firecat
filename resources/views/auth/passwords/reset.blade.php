@extends('app_frontend')

@section('title', 'Reset your password')

@section('content')
    <div id="reset-password">
        <div id="reset-password-wrapper">
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
                    Please make sure you enter the email entered is the same as the one you used to send your password
                    reset link to. Passwords must be at least 8 characters long.
                </p>
                @include('_partials.flash_message')
                <form method="POST" action="{{ route('password.request') }}">
                    {{ csrf_field() }}

                    <input type="hidden" name="token" value="{{ $token }}">

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="control-label">Email</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="control-label">New Password</label>
                        <input id="password" type="password" class="form-control" name="password" required>
                    </div>

                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <label for="password-confirm" class="control-label">Confirm New Password</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="button action">
                            Reset Password
                        </button>
                    </div>
                </form>
            </div>
            <div class="row">
                <a href="{{ route('password.reset.view') }}">Forgotten your password?</a>
            </div>
        </div>
    </div>
@endsection