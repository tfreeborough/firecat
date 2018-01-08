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
        <h1 class="title"><span class="highlight">{{ $user->first_name }},</span> <br /><small> {{ $deal->opportunity->name }} has been marked as Lost.</small></h1>
        <div>
            <p>
                Unfortunately, {{ $deal->opportunity->name }} has been marked as lost, this may have been done by an assigned member of the deal OR automatically by the system.
                The system will automatically mark deals as lost if they exceed their implementation date. The current implementation date on this deal
                is <strong>{{ \Carbon\Carbon::parse($deal->opportunity->implementation_date)->toFormattedDateString() }}.</strong>
            </p>
            <p>
                Please click the link below to view the Deal registration
            </p>
            <div class="center">
                <p id="update_deal">
                    <a class="button" href="{{ route('vendor.deal', $deal->id) }}">View {{ $deal->opportunity->name }}</a>
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
