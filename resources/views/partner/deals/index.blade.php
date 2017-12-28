@extends('app')

@section('title', 'My Deals')

@section('content')
    <div id="dashboard">
        <div id="page-topper">
            <div id="page-topper-bg"></div>
            <h1 id="page-title">Deals</h1>
            <h5 id="page-subtitle">Opportunities that have been resolved.</h5>
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
                        @foreach($deals as $deal)
                            <tr>
                                <td>
                                    <a href={{ route('partner.deal',$deal->id) }}>
                                        {{ $deal->opportunity->name }}
                                    </a>
                                </td>
                                <td>{{ $deal->opportunity->organisation->name }}</td>
                                <td>{{ $deal->opportunity->endUser->name }}</td>
                                <td>{{ number_format($deal->opportunity->estimated_value/100,2) }}</td>
                                <td>{{ \Carbon\Carbon::parse($deal->opportunity->created_at)->toFormattedDateString() }}</td>
                                <td>
                                    <ul>
                                        <a href="{{ route('partner.deal',$deal->id) }}">
                                            <li><i class="fa fa-eye" aria-hidden="true"></i></li>
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