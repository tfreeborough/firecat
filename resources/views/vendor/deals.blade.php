@extends('app')

@section('title', 'My Dashboard')

@extends('_partials.authenticated.account_bar')
@extends('_partials.vendor_menu')

@section('content')
    <div id="dashboard">
        <div id="page-topper">
            <div id="page-topper-bg"></div>
            <h1 id="page-title">My Deals</h1>
            <h5 id="page-subtitle">Your pending and completed deals.</h5>
            <div id="page-topper-breadcrumbs">
                <ul>
                    <li>
                        <a href="{{route('vendor.dashboard')}}">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        Deals
                    </li>
                </ul>
            </div>
        </div>
        <div id="deals">
            <h2>Deals</h2>
        </div>
    </div>
@endsection