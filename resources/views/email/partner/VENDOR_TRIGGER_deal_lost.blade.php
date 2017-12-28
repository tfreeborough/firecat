@extends('email.base')

@section('title', 'Your deal has been Lost')

@section('content')
    <style>
        #update_deal{
            margin-top:4rem;
            margin-bottom:4rem;
        }
    </style>
    <div class="content">
        <h1 class="title"><span class="highlight">{{ $user->first_name }},</span> <br /><small> {{ $deal->opportunity->name }} has just been Lost.</small></h1>
        <div>
            <p>
                A member of {{ $deal->opportunity->organisation->name }} has just update this Deal to reflect that it has been lost, this may
                have been done by a member of {{ $deal->opportunity->organisation->name }} or automatically due to the implementation date. The
                current implementation date on this deal is <strong>{{ \Carbon\Carbon::parse($deal->opportunity->implementation_date)->toFormattedDateString() }}.</strong>
            </p>
            <p>
                If you need to contact {{ $deal->opportunity->organisation->name }} or make any further changes to your deal reg you can can do so using the link below.
            </p>
            <div class="center">
                <p id="update_deal">
                    <a class="button" href="{{ route('partner.deal', $deal->id) }}">View {{ $deal->opportunity->name }}</a>
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
