@extends('app')

@section('title', 'My Dashboard')

@extends('_partials.authenticated.account_bar')
@extends('_partials.vendor_menu')

@section('content')
    <div id="dashboard">
        <div id="page-topper">
            <div id="page-topper-bg"></div>
            <h1 id="page-title">Opportunities</h1>
            <h5 id="page-subtitle">Opportunities logged with {{ $organisation->name }}</h5>
            <div id="page-topper-breadcrumbs">
                <ul>
                    <li>
                        <a href="{{route('vendor.dashboard')}}">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        Opportunities
                    </li>
                </ul>
            </div>
        </div>
        <div id="deals">
            <h2>Deals</h2>
        </div>
    </div>
@endsection