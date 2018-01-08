@extends('email.base')

@section('title', 'A team member rejected an opportunity')

@section('content')
    <style>
        #view_opportunity{
            margin-top:4rem;
            margin-bottom:4rem;
        }

        #reasoning{
            margin-top:2rem;
            margin-bottom:2rem;
        }

        #reasoning p{
            font-style: italic;
            margin-bottom:0;
        }
    </style>
    <div class="content">
        <h1 class="title"><span class="highlight">{{ $user->first_name }},</span> <br /><small> {{ $rejector->name() }} rejected an opportunity you are assigned to.</small></h1>
        <div>
            <p>
                Hi {{ $user->first_name }}, the opportunity was rejected by <strong>{{ $rejector->name() }}.</strong> The reason they gave for
                this rejection is as follows:
            </p>
            <div id="reasoning">
                <p>
                    <i>{{ $opportunity->rejectionReasoning() }}</i>
                </p>
            </div>
            <p>
                You may not longer make changes to this opportunity but will still be able to view its information on your account.
            </p>
            <div id="view_opportunity" class="center">
                <p>
                    <a class="button" href="{{ route('vendor.opportunity', $opportunity->id) }}">View {{ $opportunity->name }}</a>
                </p>
            </div>
            <p class="small">
                Having trouble clicking the link? Please use the following url: <br />{{ route('vendor.opportunity', $opportunity->id) }}
            </p>
            <p class="small">
                If you did not sign up to Firecat or believe you were sent this in error, please contact <span class="link">support@firecat.io</span> to let us know.
            </p>
        </div>
    </div>
@endsection
