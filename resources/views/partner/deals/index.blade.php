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
                            <th>Status</th>
                            <th>Implementation Date</th>
                            <th>Deal Name</th>
                            <th>Vendor</th>
                            <th>End User</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($deals as $deal)
                            <tr
                                    class="@if($deal->status->pending)
                                            pending
                                        @else
                                    @if($deal->status->won)
                                            won
                                        @else
                                            lost
                                        @endif
                                    @endif"
                            >
                                <td>
                                    @if($deal->status->pending)
                                        Pending
                                    @else
                                        @if($deal->status->won)
                                            Won
                                        @else
                                            Lost
                                        @endif
                                    @endif
                                </td>
                                <td>
                                    {{ \Carbon\Carbon::parse($deal->opportunity->implementation_date)->format('d M Y') }}
                                </td>
                                <td>
                                    <a href="{{ route('partner.deal',$deal->id) }}">
                                        {{ $deal->opportunity->name }}
                                    </a>

                                    @if($deal->reference)
                                        <small>({{$deal->reference}})</small>
                                    @endif
                                </td>
                                <td>{{ $deal->opportunity->organisation->name }}</td>
                                <td>{{ $deal->opportunity->endUser->name }}</td>
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