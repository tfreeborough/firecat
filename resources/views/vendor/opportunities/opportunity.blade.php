@extends('app')

@section('title', $opportunity->name)

@extends('_partials.authenticated.account_bar')
@extends('_partials.vendor_menu')

@section('content')
    <div id="dashboard">
        <div id="page-topper">
            <div id="page-topper-bg"></div>
            <h1 id="page-title">{{ $opportunity->name }}</h1>
            <h5 id="page-subtitle">Submitted by {{ $opportunity->partner->first_name }} {{ $opportunity->partner->last_name }}</h5>
            <div id="page-topper-breadcrumbs">
                <ul>
                    <li>
                        <a href="{{route('vendor.dashboard')}}">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{route('vendor.opportunities')}}">
                        Opportunities
                        </a>
                    </li>
                    <li>
                        {{ $opportunity->name }}
                    </li>
                </ul>
            </div>
        </div>
        <div id="vendor-opportunity">
            <div class="row">
                <div class="col-xs-12">
                    @include('_partials.opportunities.status_code_display')
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-4">
                    <h3 class="title">Assignments</h3>
                    <div class="row">
                        <div class="col-xs-12">
                            <p>Any members of {{ $user->organisation->name }} that are assigned to this opportunity will show here when they are made.</p>
                        </div>
                        @foreach($opportunity->assignees as $assignee)
                            <div class="assignment-block col-xs-12 col-sm-6 col-md-4">
                                <img src={{ $assignee->user->extra->avatar_url }} />
                                <p>{{ $assignee->user->first_name }} {{ $assignee->user->last_name }}</p>
                            </div>
                        @endforeach
                        @if(count($opportunity->assignees) === 0)
                            <div class="col-xs-12">
                                <p><strong>Nobody is currently assigned to this opportunity</strong></p>
                            </div>
                        @endif
                    </div>
                    @if(!$user->isAssigned($opportunity->id))
                        <button onClick="assignmentConfirm()" class="button action">Assign me to this opportunity</button>
                    @endif
                </div>
                <div class="col-xs-12 col-sm-4">
                    <h3 class="title">Latest Messages</h3>
                    @if(Auth::user()->isAssigned($opportunity->id))
                        <div>
                            <p>Authorized</p>
                        </div>
                    @else
                        <div class="disabled">
                            <div class="disabled-block">
                                <p>
                                    Non assigned members cannot view internal messaging, assign yourself to this opportunity if you wish to contribute.
                                </p>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="col-xs-12 col-sm-4">
                    <h3 class="title">Activity</h3>
                    @if(Auth::user()->isAssigned($opportunity->id))
                        <div>
                            <p>Authorized</p>
                        </div>
                    @else
                        <div class="disabled">
                            <div class="disabled-block">
                                <p>
                                    Non assigned members cannot view activity on this opportunity, assign yourself to view activity.
                                </p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <h3 class="title">Partner Information</h3>
                    <p>More to come soon</p>
                </div>
                <div class="col-xs-12 col-sm-6">
                    <h3 class="title">Opportunity Information</h3>
                    <p>More to come soon</p>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function assignmentConfirm()
        {
            vex.dialog.confirm({
                message: 'Are you sure you want to assign youself to this opportunity, you will not be able to undo this action?',
                callback: function (value) {
                    if (value) {
                        window.location.href = '/vendor/opportunities/{{$opportunity->id}}/assign';
                    }
                }
            })
        }
    </script>
@endsection