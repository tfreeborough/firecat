@extends('app')

@section('title', 'My Dashboard')

@extends('_partials.authenticated.account_bar')
@extends('_partials.vendor_menu')

@section('content')
    <div id="dashboard">
        <div id="page-topper">
            <div id="page-topper-bg"></div>
            <h1 id="page-title">Deals</h1>
            <h5 id="page-subtitle">Pending and completed deals for {{ $organisation->name }}.</h5>
            <div id="page-topper-breadcrumbs">
                <ul>
                    <li>
                        <a href="{{route('vendor.dashboard')}}">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        Deals
                    </li>
                </ul>
            </div>
        </div>
        <div id="vendor-deals">
            <div class="row">
                <div class="col-xs-12">
                    <table id="vendor-deals-table" class="table">
                        <thead>
                        <tr>
                            <th>Status</th>
                            <th>Deal Name</th>
                            <th>End Users Sector</th>
                            <th>Tags</th>
                            <th>Assigned</th>
                            <th>Converted On</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($deals as $deal)
                            <tr>
                                <td>
                                    @if($deal->opportunity->status->getStatusCode() === 4)
                                        Accepted
                                    @else
                                        Rejected
                                    @endif
                                </td>
                                <td>
                                    <a href="/vendor/deals/{{$deal->id}}">
                                        {{ $deal->opportunity->name }}
                                    </a>
                                    @if($deal->reference)
                                        <small>({{$deal->reference}})</small>
                                    @endif
                                </td>
                                <td>{{ $deal->opportunity->endUser->organisation_type }}</td>
                                <td>
                                    @foreach($deal->tags as $tag)
                                        <div class="tag">{{ $tag->organisation_tag->name }}</div>

                                    @endforeach
                                    <br />
                                    <small><span><a href="/vendor/deals/{{$deal->id}}/tag">Edit tags</a></span></small>
                                </td>
                                <td>
                                    <ul>
                                        @foreach($deal->opportunity->assignees as $assignee)
                                            <li>
                                                <img title="{{ $assignee->user->first_name }} {{ $assignee->user->last_name }}" src="{{ $assignee->user->extra->avatar_url }}" />
                                            </li>
                                        @endforeach
                                        @if(count($deal->opportunity->assignees) === 0)
                                            <li>
                                                Nobody has been assigned so far
                                            </li>
                                        @endif
                                    </ul>
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($deal->created_at)->format('d-m-y @ h:ma') }}
                                </td>
                                <td>
                                    <a href="/vendor/deals/{{$deal->id}}">
                                        <i class="fa fa-chain-broken" aria-hidden="true"></i>
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
        $('#vendor-deals-table').DataTable();
    </script>
@endsection