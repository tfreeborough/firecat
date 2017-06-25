@extends('app_frontend')

@section('title', 'Create an Account')

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
                @if (count($errors) > 0)
                    <div id="login-errors" class="text-left">
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{!! $error !!}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif
                    <h1>Log in</h1>
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
                        {{ Form::submit('Login', array_merge(['class' => 'form-control button action'])) }}
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection