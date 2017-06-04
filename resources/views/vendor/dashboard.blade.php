@extends('app')

@section('title', 'My Dashboard')

@extends('_partials.authenticated.account_bar')
@extends('_partials.vendor_menu')

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
        <div id="vendor-dashboard">
            <div class="row">
                <h3 class="title"></h3>
            </div>
            <div class="row">
                <div id="vendor-overview" class="col-xs-12 col-md-7">
                    <h3 class="title">My Overview (Last 7 days)</h3>
                    <div class="col-xs-12 col-md-6 dashboard-panel">
                        <div class="dashboard-panel-wrapper">
                            <div class="dashboard-panel-big">
                                {{ $acceptanceRate }}
                            </div>
                            <div class="dashboard-panel-small">
                                Deal Acceptance rate
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6 dashboard-panel">
                        <div class="dashboard-panel-wrapper">
                            <div class="dashboard-panel-big">
                                {{ $opportunitiesCreated }}
                            </div>
                            <div class="dashboard-panel-small">
                                Opportunities created
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6 dashboard-panel">
                        <div class="dashboard-panel-wrapper">
                            <div class="dashboard-panel-big">
                                &pound;{{ number_format($averageDealValue/100 , 2) }}
                            </div>
                            <div class="dashboard-panel-small">
                                Average deal value
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6 dashboard-panel">
                        <div class="dashboard-panel-wrapper">
                            <div class="dashboard-panel-big">
                                {{ \Carbon\Carbon::create($averageResponseTime)->hour }} hours
                            </div>
                            <div class="dashboard-panel-small">
                                Average response time
                            </div>
                        </div>
                    </div>
                </div>
                <div id="recent-deals" class="col-xs-12 col-md-5">
                    <h3 class="title">Recent Deals</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Created</th>
                                <th>Assigned</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($deals as $deal)
                                <tr>
                                    <td>{{ $deal->name }}</td>
                                    <td>{{ \Carbon\Carbon::now()->diffForHumans($deal->created_at) }}</td>
                                    <td>
                                        @foreach($deal->assigned as $assigned)
                                            <div class="avatar-small">
                                                @if($assigned->user->avatar !== null)
                                                    <img src="{{$assigned->user->avatar}}" />
                                                @else
                                                    <img src="/images/avatar.png" />
                                                @endif
                                            </div>
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection