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
                <h2 class="title">Create an account</h2>
                @include('_partials.flash_message')
                {!! Form::open(['url' => '/register']) !!}
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('first_name', null, ['class' => 'control-label']) }}
                            {{ Form::text('first_name', null, array_merge(['class' => 'form-control', 'placeholder' => 'First Name'])) }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('last_name', null, ['class' => 'control-label']) }}
                            {{ Form::text('last_name', null, array_merge(['class' => 'form-control', 'placeholder' => 'Last Name'])) }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            {{ Form::label('email', null, ['class' => 'control-label']) }}
                            {{ Form::text('email', null, array_merge(['class' => 'form-control', 'placeholder' => 'Your Email'])) }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('password', null, ['class' => 'control-label']) }}
                            {{ Form::password('password', array_merge(['class' => 'form-control', 'placeholder' => 'Password'])) }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <div class="form-group">
                            {{ Form::label('password_confirmation', null, ['class' => 'control-label']) }}
                            {{ Form::password('password_confirmation', array_merge(['class' => 'form-control'])) }}
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <div class="g-recaptcha" data-sitekey="6Le_sjgUAAAAACTbuusWiVJooy5L_TPKC210wGZF"></div>
                </div>
                <div class="form-group">
                    {{ Form::submit('Create an account', array_merge(['class' => 'button action'])) }}
                </div>
                {!! Form::close() !!}
            </div>
            <div class="row">
                <a href="{{ route('login') }}">Login</a> | <a href="{{ route('password.reset.view') }}">Forgotten your password?</a>
            </div>
        </div>
    </div>
@endsection