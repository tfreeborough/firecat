@extends('email.base')

@section('title', 'Your proposed change was rejected.')

@section('styling')
    <style>
        #view_deal{
            margin-top:4rem;
            margin-bottom:4rem;
        }
    </style>
@endsection

@section('content')

    <div class="content">
        <h1 class="title"><span class="highlight">{{ $user->first_name }},</span> <br /><small> your proposed change has been rejected.</small></h1>
        <div>
            <p>
                Unfortunately {{ $user->first_name }}, your proposal to modify the {{ $dealUpdate->type_formatted }} on the deal <strong>{{ $deal->opportunity->name }}</strong> has been
                rejected by {{ $deal->opportunity->organisation->name }}.
            </p>
            <p>
                If you have any further enquiries or would like to view the progress of this deal, please click on the link below.
            </p>
            <div class="center">
                <p id="view_deal">
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
