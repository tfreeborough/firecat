@extends('app')

@section('title', 'My Dashboard')

@extends('_partials.authenticated.account_bar')
@extends('_partials.vendor_menu')

@section('content')
    <div id="dashboard">
        <div id="page-topper">
            <div id="page-topper-bg"></div>
            <h1 id="page-title">Activity</h1>
            <h5 id="page-subtitle">Your personal activity feed</h5>
            <div id="page-topper-breadcrumbs">
                <ul>
                    <li>
                        <a href="{{route('vendor.dashboard')}}">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        Activity
                    </li>
                </ul>
            </div>
        </div>
        <div id="activity">
            <h2>Activity</h2>
        </div>
    </div>
@endsection