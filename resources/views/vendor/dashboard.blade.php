@extends('app')

@section('title', 'My Dashboard')


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
                <div class="col-xs-12">
                    @include('_partials.flash_message')
                </div>
            </div>
            <div id="vendor-overview">
                <div class="top-wrap block">
                    <h3 class="title">Organisation statistics (last 30 days)</h3>
                    <p>
                        @if($statistics !== null)
                            <strong>Last Updated:</strong> {{ \Carbon\Carbon::parse($statistics->calculated_at)->toDayDateTimeString() }}
                        @else
                            <strong>Last Updated:</strong> Not yet run
                        @endif
                    </p>
                </div>
                <div id="acceptance" class="dashboard-panel">
                    <div class="dashboard-panel-wrapper">
                        <div class="dashboard-panel-big">
                            @if($statistics !== null)
                                {{ $statistics->deal_conversion_rate }}%
                            @else
                                N/A
                            @endif
                        </div>
                        <div class="dashboard-panel-small">
                            Deal Conversion Rate
                        </div>
                    </div>
                </div>
                <div id="opportunities_created" class="dashboard-panel">
                    <div class="dashboard-panel-wrapper">
                        <div class="dashboard-panel-big">
                            @if($statistics !== null)
                                {{ $statistics->opportunities_received }}
                            @else
                                N/A
                            @endif
                        </div>
                        <div class="dashboard-panel-small">
                            Opportunities created
                        </div>
                    </div>
                </div>
                <div id="deal_value" class="dashboard-panel">
                    <div class="dashboard-panel-wrapper">
                        <div class="dashboard-panel-big">
                            @if($statistics !== null)
                                {{ number_format($statistics->average_deal_value/100 , 0) }}
                            @else
                                N/A
                            @endif
                        </div>
                        <div class="dashboard-panel-small">
                            Average Deal Value
                        </div>
                    </div>
                </div>
                <div id="response_time" class="dashboard-panel">
                    <div class="dashboard-panel-wrapper">
                        <div class="dashboard-panel-big">
                            @if($statistics !== null)
                                {{ number_format($statistics->average_assignment_wait/60/60/24, 2) }}
                            @else
                                N/A
                            @endif
                        </div>
                        <div class="dashboard-panel-small">
                            Average assignment time
                        </div>
                    </div>
                </div>
            </div>
            <div id="recent-deals">
                <div class="block">
                    <h3 class="title">My Assignments</h3>
                    <table id="recent-deals-table" class="table">
                        <thead>
                        <tr>
                            <th>&nbsp;</th>
                            <th>Name</th>
                            <th>Created</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($assignments as $assignment)
                            <tr @if($assignment->opportunity->isRejected())class="rejected"@endif>
                                <td @if($assignment->opportunity->deal) class="deal" @else class="opportunity" @endif>
                                    @if($assignment->opportunity->deal)
                                        <i class="fa fa-briefcase" aria-hidden="true" title="This opportunity was successfully converted into a Deal Registration"></i>
                                    @else
                                        <i class="fa fa-file-text" aria-hidden="true" title="This is an opportunity"></i>
                                    @endif
                                </td>
                                @if($assignment->opportunity->deal)
                                    <td><a href="/vendor/deals/{{$assignment->opportunity->deal->id}}">{{ $assignment->opportunity->name }}</a></td>
                                @else
                                    <td><a href="/vendor/opportunities/{{$assignment->opportunity->id}}">{{ $assignment->opportunity->name }}</a></td>
                                @endif
                                <td>{{ str_replace('before','ago',$assignment->opportunity->created_at->diffForHumans(Carbon\Carbon::now())) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div id="activity" class="block">
                    <h3 class="title">Recent Activity</h3>
                    <ul>
                        @foreach($recent_activity as $activity)
                            <li>
                                <p>
                                    {{ $activity->description }}
                                </p>
                                <p>
                                    <small>{{ \Carbon\Carbon::parse($activity->created_at)->toDayDateTimeString() }}</small>
                                    @if($activity->opportunity->deal === null)
                                        <a href="{{ route('vendor.opportunity', $activity->opportunity->id) }}"><i class="fa fa-link" aria-hidden="true"></i></a>
                                    @else
                                        <a href="{{ route('vendor.deal', $activity->opportunity->deal->id) }}"><i class="fa fa-link" aria-hidden="true"></i></a>
                                    @endif
                                </p>
                            </li>
                        @endforeach
                    </ul>
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