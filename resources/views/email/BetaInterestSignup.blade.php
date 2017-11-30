@extends('email.base')

@section('title', 'A new beta interest has been submitted')

@section('content')
    <style>
        #beta_details{
            margin-top:4rem;
            margin-bottom:4rem;
        }
    </style>
    <div class="content">
        <h1 class="title"><span class="highlight">Hey there,</span> <br /><small>Some good news for you...</small></h1>
        <div>
            <p>
                We have received a new submission to our beta interest programme. We should aim to contact them within the next 7 days.
            </p>
            <p>
                You can view the details of this below...
            </p>
            <div class="center">
                <div id="beta_details">
                    <ul>
                        <li>
                            <span class="highlight">Company: </span> {{ $betaInterest->company_name }}
                        </li>
                        <li>
                            <span class="highlight">Contact Name: </span> {{ $betaInterest->contact_name }}
                        </li>
                        <li>
                            <span class="highlight">Contact Email: </span> {{ $betaInterest->contact_email }}
                        </li>
                        <li>
                            <span class="highlight">Account Managers: </span> {{ $betaInterest->account_managers }}
                        </li>
                    </ul>
                </p>
            </div>
        </div>
    </div>
@endsection
