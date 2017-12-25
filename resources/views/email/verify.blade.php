@extends('email.base')

@section('title', 'Welcome to Firecat, please verify your account.')

@section('content')
    <style>
        #accept_invite{
            margin-top:4rem;
            margin-bottom:4rem;
        }
    </style>
    <div class="content">
        <h1 class="title">Hey <span class="highlight">{{ $user->first_name }},</span> <br /><small>thanks for joining Firecat!</small></h1>
        <div>
            <p>
                Hi {{ $user->first_name }}, Thanks for signing up to Firecat, we know you're going to love of the features that make managing deal registration a breeze.
                We're almost ready send you off exploring, but we just want to verify that this email address is owned by you.
            </p>
            <p>
                Please click the link below to verify your account
            </p>
            <div class="center">
                <p id="accept_invite">
                    <a class="button" href="{{ url('/verify/'.$user->email_verification_code) }}">Verify my account</a>
                </p>
            </div>
            <p class="small">
                Having trouble clicking the link? Please use the following url: <br />{{ url('/verify/'.$user->email_verification_code) }}
            </p>
            <p class="small">
                If you did not sign up to Firecat or believe you were sent this in error, please contact <span class="link">support@firecat.io</span> to let us know.
            </p>
        </div>
    </div>
@endsection
