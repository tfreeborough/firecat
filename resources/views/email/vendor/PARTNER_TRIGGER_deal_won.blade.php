@extends('email.base')

@section('title', $deal->opportunity->name.' has been Won')

@section('styling')
    <style>
        #update_deal{
            margin-top:4rem;
            margin-bottom:4rem;
        }
    </style>
@endsection

@section('content')
    <div class="content">
        <h1 class="title"><span class="highlight">{{ $user->first_name }},</span> <br /><small> {{ $deal->opportunity->name }} has just been Won!</small></h1>
        <div>
            <p>
                {{ $deal->opportunity->partner->name() }} has just set the status of this Deal to WON, congratulations are in order. {{ $deal->opportunity->partner->first_name }} has
                also been sent a confirmation email. If you need to contact the partner to move forward with this Deal Registration you can still do so using the Deal.
            </p>
            <p>
                Click the link below to view your Won Deal.
            </p>
            <div class="center">
                <p id="update_deal">
                    <a class="button" href="{{ route('vendor.deal', $deal->id) }}">View Deal</a>
                </p>
            </div>
            <p class="small">
                Having trouble clicking the link? Please use the following url: <br />{{ route('vendor.deal', $deal->id) }}
            </p>
            <p class="small">
                If you did not sign up to Firecat or believe you were sent this in error, please contact <span class="link">support@firecat.io</span> to let us know.
            </p>
        </div>
    </div>
@endsection
