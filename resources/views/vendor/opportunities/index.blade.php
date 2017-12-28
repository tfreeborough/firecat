@extends('app')

@section('title', 'Opportunities')

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
        <div id="vendor-opportunities">
            <div class="row">
                <div class="col-xs-12">
                    <table id="vendor-opportunities-table" class="table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>End Users Sector</th>
                            <th>Submitted By</th>
                            <th>Assigned</th>
                            <th>Created On</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($organisation->opportunities as $opportunity)
                            <tr>
                                <td>
                                    <a href="/vendor/opportunities/{{$opportunity->id}}">
                                        {{ $opportunity->name }}
                                    </a>
                                </td>
                                <td>{{ $opportunity->endUser->organisation_type }}</td>
                                <td>{{ $opportunity->partner->first_name }} {{ $opportunity->partner->last_name }}</td>
                                <td>
                                    <ul>
                                        @foreach($opportunity->assignees as $assignee)
                                            <li>
                                                <img title="{{ $assignee->user->first_name }} {{ $assignee->user->last_name }}" src="{{ $assignee->user->extra->avatar_url }}" />
                                            </li>
                                        @endforeach
                                        @if(count($opportunity->assignees) === 0)
                                            <li>
                                                Nobody has been assigned so far
                                            </li>
                                        @endif
                                    </ul>
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($opportunity->created_at)->toDayDateTimeString() }}
                                </td>
                                <td>
                                    <a href="/vendor/opportunities/{{$opportunity->id}}">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </a>
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
@section('scripts')
    <script>
        $('#vendor-opportunities-table').DataTable();
    </script>
@endsection