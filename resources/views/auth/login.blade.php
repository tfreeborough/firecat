@extends('app_frontend')

@section('title', 'Create an Account')

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
                <h2 class="title">Log in</h2>
                @include('_partials.flash_message')
                {!! Form::open(['url' => '/login']) !!}
                <div class="form-group">
                    {{ Form::label('email', null, ['class' => 'control-label']) }}
                    {{ Form::text('email', null, array_merge(['class' => 'form-control'])) }}
                </div>
                <div class="form-group">
                    {{ Form::label('password', null, ['class' => 'control-label']) }}
                    {{ Form::password('password', array_merge(['class' => 'form-control'])) }}
                </div>
                <div class="form-group">
                    {{ Form::submit('Login', array_merge(['class' => 'button action'])) }}
                </div>
                {!! Form::close() !!}
            </div>
            <div class="row">
                <a href="{{ route('password.reset.view') }}">Forgotten your password?</a> | <a href="{{ route('register') }}">Register</a>
            </div>
        </div>
    </div>
@endsection