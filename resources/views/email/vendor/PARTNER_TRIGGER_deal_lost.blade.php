@extends('email.base')

@section('title', $deal->opportunity->name.' has been Lost')

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
                Unfortunately, {{ $deal->opportunity->name }} has been marked as lost, this was marked as lost by {{ $deal->opportunity->partner->name() }} so more than likely
                means they did not secure business from the end user. If you require any further clarifications with {{ $deal->opportunity->partner->first_name }} you can
                still contact them via the deal.
            </p>
            <p>
                Please click the link below to view the Deal registration
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
