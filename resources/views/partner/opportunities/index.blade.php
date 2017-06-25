@extends('app')

@section('title', 'My Dashboard')

@extends('_partials.authenticated.account_bar')
@extends('_partials.partner_menu')

@section('content')
    <div id="dashboard">
        <div id="page-topper">
            <div id="page-topper-bg"></div>
            <h1 id="page-title">Opportunities</h1>
            <h5 id="page-subtitle">Your submitted opportunities</h5>
            <div id="page-topper-breadcrumbs">
                <ul>
                    <li>
                        <a href="{{route('partner.dashboard')}}">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        Opportunities
                    </li>
                </ul>
            </div>
        </div>
        <div id="opportunities">
            <div class="row">
                <div class="col-xs-12">
                    <a href="{{route('partner.opportunities.create')}}"><button class="button">Create opportunity</button></a>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <table id="opportunities-table" class="table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Vendor</th>
                            <th>End User</th>
                            <th>Value</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($opportunities as $opportunity)
                            <tr>
                                <td>{{ $opportunity->name }}</td>
                                <td>{{ $opportunity->organisation->name }}</td>
                                <td>{{ $opportunity->endUser->name }}</td>
                                <td>{{ number_format($opportunity->estimated_value/100,2) }}</td>
                                <td>{{ \Carbon\Carbon::parse($opportunity->created_at)->toFormattedDateString() }}</td>
                                <td>
                                    <ul>
                                        <a href="/partner/opportunities/{{$opportunity->id}}">
                                            <li><i class="fa fa-link" aria-hidden="true"></i></li>
                                        </a>
                                    </ul>
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
        $('#opportunities-table').DataTable();
    </script>
@endsection