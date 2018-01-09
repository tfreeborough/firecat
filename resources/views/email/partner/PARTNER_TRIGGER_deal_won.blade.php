@extends('email.base')

@section('title', 'Your deal has been Won')

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
        <h1 class="title"><span class="highlight">{{ $user->first_name }},</span> <br /><small> Congratulations are in order.</small></h1>
        <div>
            <p>
                You recently notified us that you won a deal, all assigned members of {{ $deal->opportunity->organisation->name }} have been notified that
                you marked this deal has won, and your dashboard has been updated to reflect this. Once more congratulations on winning your
                business with {{ $deal->opportunity->endUser->name }}.
            </p>
            <p>
                Thanks for using Firecat!
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
