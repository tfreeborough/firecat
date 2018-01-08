@extends('email.base')

@section('title', 'You have been given a proposed update.')

@section('styling')
    <style>
        #view_deal{
            margin-top:4rem;
            margin-bottom:4rem;
        }

        #view_deal a{
            margin:5px;
        }
    </style>
@endsection

@section('content')
    <div class="content">
        <h1 class="title"><span class="highlight">{{ $user->first_name }},</span> <br /><small> a update request has been made.</small></h1>
        <div>
            <p>
                Hi {{ $user->first_name }}, {{ $deal->opportunity->partner->name() }} on the deal <strong>{{ $deal->opportunity->name }}</strong> has requested that
                the {{ $deal_update->type_formatted }} be changed from <strong>{{ \Carbon\Carbon::parse($deal->opportunity[$deal_update->type])->format('d/m/Y') }}</strong> to <strong>{{ $deal_update->proposal }}</strong>.
            </p>
            <p>
                You can either Accept or Reject this proposal by using either of the two buttons below.
            </p>
            <div class="center">
                <p id="view_deal">
                    <a class="button" href="{{ route('vendor.deal.update.accept', [$deal->id,$deal_update->id]) }}">Accept Proposal</a>
                    <a class="button" href="{{ route('vendor.deal.update.reject', [$deal->id,$deal_update->id]) }}">Reject Proposal</a>
                </p>
            </div>
            <p class="small">
                Having trouble clicking the links? Please use the following url: <br />{{ route('partner.deal', $deal->id) }}
            </p>
            <p class="small">
                If you did not sign up to Firecat or believe you were sent this in error, please contact <span class="link">support@firecat.io</span> to let us know.
            </p>
        </div>
    </div>
@endsection
