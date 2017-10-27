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
                <div id="vendor-overview" class="col-xs-12">
                    <h3 class="title">Organisation statistics (last 30 days)</h3>
                    <div id="acceptance" class="dashboard-panel">
                        <div class="dashboard-panel-wrapper">
                            <div class="dashboard-panel-big">
                                {{ $acceptanceRate }}
                            </div>
                            <div class="dashboard-panel-small">
                                Deal Acceptance rate
                            </div>
                        </div>
                    </div>
                    <div id="opportunities_created" class="dashboard-panel">
                        <div class="dashboard-panel-wrapper">
                            <div class="dashboard-panel-big">
                                {{ $opportunitiesCreated }}
                            </div>
                            <div class="dashboard-panel-small">
                                Opportunities created
                            </div>
                        </div>
                    </div>
                    <div id="deal_value" class="dashboard-panel">
                        <div class="dashboard-panel-wrapper">
                            <div class="dashboard-panel-big">
                                &pound;{{ number_format($averageDealValue/100 , 2) }}
                            </div>
                            <div class="dashboard-panel-small">
                                Average deal value
                            </div>
                        </div>
                    </div>
                    <div id="response_time" class="dashboard-panel">
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
                <div id="recent-deals" class="col-xs-12">
                    <div class="row">
                        <div class="col-xs-12 col-lg-6">
                            <h3 class="title">My Deals/Opportunities</h3>
                            <table id="recent-deals-table" class="table">
                                <thead>
                                <tr>
                                    <th>&nbsp;</th>
                                    <th>Name</th>
                                    <th>Created</th>
                                    <th>Assigned</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($assignments as $assignment)
                                    <tr>
                                        <td @if($assignment->opportunity->deal) class="deal" @else class="opportunity" @endif>
                                            @if($assignment->opportunity->deal)
                                                <i class="fa fa-briefcase" aria-hidden="true" title="This opportunity was successfully converted into a Deal Registration"></i>
                                            @else
                                                <i class="fa fa-file-text" aria-hidden="true" title="This is an opportunity"></i>
                                            @endif
                                        </td>
                                        @if($assignment->opportunity->deal)
                                            <td><a href="/vendor/opportunities/{{$assignment->opportunity->id}}">{{ $assignment->opportunity->name }}</a></td>
                                        @else
                                            <td><a href="/vendor/deals/{{$assignment->opportunity->deal->id}}">{{ $assignment->opportunity->name }}</a></td>
                                        @endif
                                        <td>{{ str_replace('before','ago',$assignment->opportunity->created_at->diffForHumans(Carbon\Carbon::now())) }}</td>
                                        <td>
                                            <ul>
                                                @foreach($assignment->opportunity->assignees as $assignee)
                                                    <li>
                                                        <img title="{{ $assignee->user->first_name }} {{ $assignee->user->last_name }}" src="{{ $assignee->user->extra->avatar_url }}" />
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-xs-12 col-lg-6">
                            <h3 class="title">My Notifications</h3>
                            <p>Nothing here yet...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('#recent-deals-table').DataTable();
    </script>
@endsection