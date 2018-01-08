@extends('email.base')

@section('title', 'An updated has been requested from you.')

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
        <h1 class="title">Hey <span class="highlight">{{ $user->first_name }},</span> <br /><small>and update has been requested from you.</small></h1>
        <div>
            <p>
                Hi {{ $user->first_name }}, We have received a request on behalf of {{ $vendor_account->name() }} ({{ $vendor_account->organisation->name }}) for
                an update on the status of a deal registration you have currently have with them ({{ $deal->opportunity->name }}). If you get a spare moment, click the
                link below and let the vendor know if this Deal has been Won, Lost, is Still pending or requires an extension on the date of implementation.
            </p>
            <p>
                Please click the link below to view the Deal registration
            </p>
            <div class="center">
                <p id="update_deal">
                    <a class="button" href="{{ route('partner.deal', $deal->id) }}">Update my deal</a>
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
