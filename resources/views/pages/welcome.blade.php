@extends('app_frontend')

@section('title', 'Welcome')

@extends('_partials.menu')

@section('content')
    <div id="welcome">
        <div id="welcome-wrapper">
            <div id="welcome-wrapper-grid">
                <div id="welcome-wrapper-introduction">
                    <div>
                        <div id="logo-wrapper">
                            <div id="menu-logo">
                                <span class="fire">FIRE</span><span class="cat">CAT</span>
                                <h5 class="text-center">Deal Registration Portal</h5>
                            </div>
                        </div>
                        <div id="menu-links">
                            <ul>
                                @if(Auth::user())
                                    <a href="{{route('dashboard')}}"><li>Dashboard</li></a>
                                    <a href="{{route('logout')}}"><li>Logout</li></a>
                                @else
                                    <a href="{{route('register')}}"><li>Sign Up As A Partner</li></a>
                                    <a href="{{route('login')}}"><li>Login</li></a>
                                    <a href="{{route('docs')}}"><li>Documentation</li></a>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
                <div id="welcome-wrapper-sign-up">
                    <div id="welcome-wrapper-sign-up-form-wrapper">
                        <h2 class="title text-left">Get started today</h2>
                        <div id="welcome-wrapper-tabulator">
                            <ul>
                                <li class="active" onclick="activateTab(event, 'partner')">Partners</li>
                                <li onclick="activateTab(event, 'vendor')">Vendors</li>
                            </ul>
                        </div>
                        <div id="welcome-wrapper-tabbed-content" class="text-left">
                            @include('_partials.flash_message')
                            <div id="partner" class="active">
                                <p>
                                    Sign up for <span class="highlight"><strong>free</strong></span> and create deal registrations
                                    with a wide range of Vendors across the UK within seconds.
                                </p>
                                {!! Form::open(['url' => '/register']) !!}
                                <div class="row">
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('first_name', null, ['class' => 'control-label']) }}
                                            {{ Form::text('first_name', null, array_merge(['class' => 'form-control', 'placeholder' => 'First Name', 'autocomplete' => 'off'])) }}
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('last_name', null, ['class' => 'control-label']) }}
                                            {{ Form::text('last_name', null, array_merge(['class' => 'form-control', 'placeholder' => 'Last Name', 'autocomplete' => 'off'])) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="form-group">
                                            {{ Form::label('email', null, ['class' => 'control-label']) }}
                                            {{ Form::text('email', null, array_merge(['class' => 'form-control', 'placeholder' => 'Your Email', 'autocomplete' => 'off'])) }}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('password', null, ['class' => 'control-label']) }}
                                            {{ Form::password('password', array_merge(['class' => 'form-control', 'placeholder' => 'Password', 'autocomplete' => 'off'])) }}
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-6">
                                        <div class="form-group">
                                            {{ Form::label('password_confirmation', null, ['class' => 'control-label']) }}
                                            {{ Form::password('password_confirmation', array_merge(['class' => 'form-control', 'placeholder' => 'Password Confirmation', 'autocomplete' => 'off'])) }}
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div id="g-recaptcha1" data-sitekey="6Le_sjgUAAAAACTbuusWiVJooy5L_TPKC210wGZF"></div>
                                </div>
                                <div class="form-group">
                                    {{ Form::submit('Create an account', array_merge(['class' => 'button action'])) }}
                                </div>
                                {!! Form::close() !!}
                            </div>
                            <div id="vendor">
                                <div id="vendor-promo-wrapper">
                                    <p>
                                        Only members of our <span class="highlight"><strong>Beta Program</strong></span> may currently use Firecat. If you would like to see what
                                        Firecat can do for your business, <span class="highlight"><strong>register your interest below.</strong></span>
                                    </p>
                                    {!! Form::open(['url' => route('beta.interest')]) !!}
                                    <div class="row">
                                        <div class="col-xs-12 col-md-6">
                                            <div class="form-group">
                                                {{ Form::label('company_name', null, ['class' => 'control-label']) }}
                                                {{ Form::text('company_name', null, array_merge(['class' => 'form-control', 'placeholder' => 'Company Name', 'autocomplete' => 'off'])) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-md-6">
                                            <div class="form-group">
                                                {{ Form::label('contact_name', null, ['class' => 'control-label']) }}
                                                {{ Form::text('contact_name', null, array_merge(['class' => 'form-control', 'placeholder' => 'Contact Name', 'autocomplete' => 'off'])) }}
                                            </div>
                                        </div>
                                        <div class="col-xs-12 col-md-6">
                                            <div class="form-group">
                                                {{ Form::label('contact_email', null, ['class' => 'control-label']) }}
                                                {{ Form::text('contact_email', null, array_merge(['class' => 'form-control', 'placeholder' => 'Contact Email', 'autocomplete' => 'off'])) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12">
                                            <div class="form-group">
                                                {{ Form::label('account_managers', 'Number of Account Managers (Approx.)', ['class' => 'control-label', 'autocomplete' => 'off']) }}
                                                {{ Form::number('account_managers', 10, array_merge(['class' => 'form-control'])) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div id="g-recaptcha2" data-sitekey="6Le_sjgUAAAAACTbuusWiVJooy5L_TPKC210wGZF"></div>
                                    </div>
                                    <div class="form-group">
                                        {{ Form::submit('Register my Interest', array_merge(['class' => 'button action'])) }}
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                        <div id="extra-links" class="row">
                            <div class="col-xs-12">
                                <a href="{{ route('login') }}">Login</a> | <a href="{{ route('password.reset.view') }}">Forgotten your password?</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function activateTab(event, t){
            var tab = $(event.target);
            $('#welcome-wrapper-tabulator li').removeClass('active');
            $(tab).addClass('active');
            $('#partner').removeClass('active');
            $('#vendor').removeClass('active');
            $('#'+t).addClass('active');
        }
    </script>

    <script type="text/javascript">
        var CaptchaCallback = function() {
            grecaptcha.render('g-recaptcha1', {'sitekey' : '6Le_sjgUAAAAACTbuusWiVJooy5L_TPKC210wGZF'});
            grecaptcha.render('g-recaptcha2', {'sitekey' : '6Le_sjgUAAAAACTbuusWiVJooy5L_TPKC210wGZF'});
        };
    </script>
@endsection