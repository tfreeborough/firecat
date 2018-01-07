@extends('app')

@section('title', 'My Dashboard')

@section('content')
    <div id="dashboard">
        <div id="page-topper">
            <div id="page-topper-bg"></div>
            <h1 id="page-title">Dashboard</h1>
            <h5 id="page-subtitle">Your deals at a glance.</h5>
            <div id="page-topper-breadcrumbs">
                <ul>
                    <li>
                        Dashboard
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                @include('_partials.flash_message')
            </div>
        </div>
        <div id="partner-dashboard">
            <div class="top-wrap block">
                <h3 class="title">Welcome, {{ Auth::user()->first_name }}</h3>
                <div class="alert alert-info">
                    <h4>Notice</h4>
                    Firecat is still in it's early stages of development. We hope that whilst using the service you do not encounter
                    any issues but if you do, you can reach us directly at <strong>support@firecat.io.</strong> We take feedback
                    very seriously and endeavour to give you the best way to manage deal registrations.
                </div>
            </div>
            <div id="overview">
                <div class="dashboard-panel">
                    <div class="dashboard-panel-wrapper">
                        <div class="dashboard-panel-big">
                            {{ count($opportunities) }}/{{ count($deals) }}
                        </div>
                        <div class="dashboard-panel-small">
                            Opportunities/Deals
                        </div>
                    </div>
                </div>
                <div class="dashboard-panel">
                    <div class="dashboard-panel-wrapper">
                        <div class="dashboard-panel-big">
                            {{ number_format((100/(count($opportunities) > 0 ? count($opportunities) : 1))*count($deals),2) }}%
                        </div>
                        <div class="dashboard-panel-small">
                            Deal Conversion Rate
                        </div>
                    </div>
                </div>
                <div class="dashboard-panel">
                    <div class="dashboard-panel-wrapper">
                        <div class="dashboard-panel-big">
                            <span class="green">{{ $deals_won }}</span>/<span class="red">{{ $deals_lost }}</span>
                        </div>
                        <div class="dashboard-panel-small">
                            Deals Won/Lost
                        </div>
                    </div>
                </div>
                <div class="dashboard-panel">
                    <div class="dashboard-panel-wrapper">
                        <div class="dashboard-panel-big">
                            {{ $win_rate }}%
                        </div>
                        <div class="dashboard-panel-small">
                            Win Rate
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection