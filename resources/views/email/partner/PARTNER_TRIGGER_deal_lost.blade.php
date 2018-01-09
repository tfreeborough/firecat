@extends('email.base')

@section('title', 'Your deal has been Lost')

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
        <h1 class="title"><span class="highlight">{{ $user->first_name }},</span> <br /><small> We're sorry to hear you lost the Deal.</small></h1>
        <div>
            <p>
                You recently let us know that a deal registration you had with {{ $deal->opportunity->organisation->name }} has been lost. All members
                of {{ $deal->opportunity->organisation->name }} assigned to this deal have been automatically notified. There is nothing more for you to do.
            </p>
            <p>
                If you need to contact {{ $deal->opportunity->organisation->name }} or make any further changes to your deal reg you can can do so using the link below.
            </p>
            <div class="center">
                <p id="update_deal">
                    <a class="button" href="{{ route('partner.deal', $deal->id) }}">View Deal</a>
                </p>
            </div>
            <p class="small">
                Having trouble clicking the link? Please use the following url: <br />{{ route('partner.deal', $deal->id) }}
            </p>
            <p class="small">
                If you did not sign up to Firecat or believe you were sent this in error, please contact <span class="link">support@firecat.io</span> to let us know.
            </p>
        </div>
    </div>
@endsection
