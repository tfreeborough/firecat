@extends('app')

@section('title', 'My Dashboard')

@extends('_partials.authenticated.account_bar')
@extends('_partials.partner_menu')

@section('content')
    <div id="dashboard">
        <div id="page-topper">
            <div id="page-topper-bg"></div>
            <h1 id="page-title">Dashboard</h1>
            <h5 id="page-subtitle">Where the magic happens.</h5>
            <div id="page-topper-breadcrumbs">
                <ul>
                    <li>
                        Dashboard
                    </li>
                </ul>
            </div>
        </div>
        <div id="partner-dashboard">

        </div>
    </div>
@endsection