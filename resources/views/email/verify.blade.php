@extends('email.base')

@extends('email.banner')

@section('content')
    <h2>Verify Your Email Address</h2>

    <div>
        <p>Thanks for signing up, please click the link below to confirm your email address.</p>
        <p>
            <a href="{{ URL::to('/verify/' . $user->email_verification_code) }}">Click here to verify</a>
        </p>

    </div>
@endsection
