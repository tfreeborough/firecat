@extends('email.base')

@section('title', 'You\'ve been invited to Firecat.')

@section('styling')
    <style>
        #accept_invite{
            margin-top:4rem;
            margin-bottom:4rem;
        }
    </style>
@endsection

@section('content')
    <div class="content">
        <h1 class="title">Hey <span class="highlight">{{ $invite->first_name }},</span> <br /><small>you've been invited to Firecat.</small></h1>
        <div>
            <p>
                Hi {{ $invite->first_name }}, we're sending you this email because an account has been created for you on <a target="_blank" href="https://firecat.io">Firecat</a>.
                Your account is almost set up all we need now is for you to verify your account and create a password.
            </p>
            <p>
                Please click the link below to accept your invite.
            </p>
            <div class="center">
                <p id="accept_invite">
                    <a class="button" href="{{ url('/invite/'.$invite->token) }}">Accept Invite</a>
                </p>
            </div>
            <p>
                Invites are <span class="highlight">valid for 7 days,</span> after that it will expire and you will need to contact whoever invited you for another invite.
            </p>
            <p class="small">
                Having trouble clicking the link? Please use the following url: <br />{{ url('/invite/'.$invite->token) }}
            </p>
            <p class="small">
                If you did not sign up to Firecat or believe you were sent this in error, please contact <span class="link">support@firecat.io</span> to let us know.
            </p>
        </div>
    </div>
@endsection
