@extends('app_frontend')

@section('title', 'Finish Creating your account')

@section('content')
    <div id="invite">
        <div id="invite-wrapper">
            <div id="logo-banner" class="row">
                <div id="menu-logo" class="text-center">
                    <a href="{{route('home')}}">
                        <span class="fire">FIRE</span><span class="cat">CAT</span>
                    </a>
                </div>
                <h5 class="text-center">Deal Registration Portal</h5>
            </div>
            <div class="row">
                @if($invite->organisation)
                <p>
                    Please confirm the details of the vendor that invited you below.
                </p>
                <div id="vendor-box">
                    <div id="vendor-box-information">
                        <h4><span class="highlight">Name:</span> {{ $invite->organisation->name }}</h4>
                        <h4><span class="highlight">Number of Members:</span> {{ $invite->organisation->memberCount() }}</h4>
                        <h4>
                            <span class="highlight">Account Type:</span>
                            @if( $invite->organisation_admin)
                                Administrator Account
                            @else
                                Standard Account
                            @endif
                        </h4>
                    </div>
                </div>
                <p class="small">
                    If you do not recognise the Vendor, please contact
                    <span class="highlight">support@firecat.io</span> immediately.
                </p>
                @endif
                <br />
                <h1 class="title">Set your password</h1>
                @include('_partials.flash_message')
                {!! Form::open(['url' => route('invite',$invite->token)]) !!}
                <div class="form-group">
                    {{ Form::label('password', null, ['class' => 'control-label']) }}
                    {{ Form::password('password', array_merge(['class' => 'form-control'])) }}
                </div>
                <div class="form-group">
                    {{ Form::label('password_confirmation', null, ['class' => 'control-label']) }}
                    {{ Form::password('password_confirmation', array_merge(['class' => 'form-control'])) }}
                </div>
                <div class="form-group">
                    @include('_partials.recaptcha')
                </div>
                <div class="form-group">
                    {{ Form::submit('Create Account', array_merge(['class' => 'button action'])) }}
                </div>
                @include('_partials.recaptcha')
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        grecaptcha.ready(function() {
            grecaptcha.execute('{{ env('RECAPTCHA_SITE_KEY') }}', {action: 'signup'}).then(function(token) {
                $('.recaptcha').val(token);
            });
        });
    </script>
@endsection