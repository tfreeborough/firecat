@extends('app')

@section('title', 'My Dashboard')

@section('content')
    <div id="dashboard">
        <div id="page-topper">
            <div id="page-topper-bg"></div>
            <h1 id="page-title">My Deals</h1>
            <h5 id="page-subtitle">Your pending and completed deals.</h5>
            <div id="page-topper-breadcrumbs">
                <ul>
                    <li>
                        <a href="{{route('partner.dashboard')}}">
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
            <h2 class="title">Deals</h2>
        </div>
    </div>
@endsection