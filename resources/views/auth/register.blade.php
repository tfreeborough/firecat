@extends('app_frontend')

@section('title', 'Create an Account')

@extends('_partials.menu')

@section('content')
    <div id="register">
        <div id="banner">
            <div id="banner-image"></div>
            <div id="banner-text">
                <h2>It only takes a minute.<br/>You'll be making deals in no time!</h2>
                <div id="banner-extra" class="pull-right">
                    <div class="alert alert-info">
                        <strong>Note:</strong> If you are a vendor and wish to manage deal registrations on Firecat for your business, please get in touch with us.
                        <a href="{{route('register')}}">
                            <button class="button action small inline">here</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <h1>Lets get you set up.</h1>
                    {!! Form::open(['url' => '/register']) !!}
                    <div class="form-group">
                        {{ Form::label('first_name', null, ['class' => 'control-label']) }}
                        {{ Form::text('first_name', null, array_merge(['class' => 'form-control'])) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('last_name', null, ['class' => 'control-label']) }}
                        {{ Form::text('last_name', null, array_merge(['class' => 'form-control'])) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('email', null, ['class' => 'control-label']) }}
                        {{ Form::text('email', null, array_merge(['class' => 'form-control'])) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('password', null, ['class' => 'control-label']) }}
                        {{ Form::password('password', array_merge(['class' => 'form-control'])) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('password_confirmation', null, ['class' => 'control-label']) }}
                        {{ Form::password('password_confirmation', array_merge(['class' => 'form-control'])) }}
                    </div>
                    <div class="form-group">
                        {{ Form::submit('Register', array_merge(['class' => 'form-control button action'])) }}
                    </div>
                    {!! Form::close() !!}
                </div>
                <div id="registration-supplement" class="col-md-8 col-sm-6 col-xs-12">
                    <div class="col-md-6 col-xs-12">
                        <div class="supplement">
                            <div class="supplement-content">
                                <i class="fa fa-history" aria-hidden="true"></i>
                                <h4>Track deals from creation to completion</h4>
                                <p>With firecat, we keep a comprehensive history of what happens to your deal registrations for better insight.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="supplement">
                            <div class="supplement-content">
                                <i class="fa fa-tablet" aria-hidden="true"></i>
                                <h4>Availability on devices wherever you are.</h4>
                                <p>Now you don't need to be rushing back to the office! Create and manage deal registrations across all modern devices.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="supplement">
                            <div class="supplement-content">
                                <i class="fa fa-code-fork" aria-hidden="true"></i>
                                <h4>Better workflow, better results</h4>
                                <p>A robust set of tools helps to keep your productive and stress free when managing large volumes of deal registrations.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-xs-12">
                        <div class="supplement">
                            <div class="supplement-content">
                                <i class="fa fa-database" aria-hidden="true"></i>
                                <h4>Keep all your deal registrations in one place.</h4>
                                <p>As more and more vendors join Firecat, managing a wide portfolio gets even easier, stored safely in one big system.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection