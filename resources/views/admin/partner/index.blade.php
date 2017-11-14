@extends('app')

@section('title', $partner->first_name.' '.$partner->last_name)

@extends('_partials.authenticated.account_bar')
@extends('_partials.admin_menu')

@section('content')
    <div id="dashboard">
        <div id="page-topper">
            <div id="page-topper-bg"></div>
            <h1 id="page-title">Partner - {{ $partner->first_name }} {{ $partner->last_name }}</h1>
            <h5 id="page-subtitle">View information about {{ $partner->first_name }}.</h5>
            <div id="page-topper-breadcrumbs">
                <ul>
                    <li>
                        <a href="{{route('admin.dashboard')}}">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{route('admin.partners')}}">
                            Partner Management
                        </a>
                    </li>
                    <li>
                        Partner - {{ $partner->first_name }} {{ $partner->last_name }}
                    </li>
                </ul>
            </div>
        </div>
        <div id="create_partner">
            <div class="row">
                <div class="col-xs-12">
                    @include('_partials.flash_message')
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <button class="button action" onclick="confirmDelete()">Delete partner</button>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <p>Deals: {{ count($partner->deals) }}</p>
                    <table id="partner-deals" class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($partner->deals as $deal)
                                <tr>
                                    <td>{{ $deal->opportunity->name }}</td>
                                    <td>
                                        @if($deal->opportunity->status->getStatusCode() === 1)
                                            Awaiting Association
                                        @elseif($deal->opportunity->status->getStatusCode() === 2)
                                            Associated
                                        @elseif($deal->opportunity->status->getStatusCode() === 3)
                                            In Review
                                        @elseif($deal->opportunity->status->getStatusCode() === 4)
                                            Deal Accepted
                                        @elseif($deal->opportunity->status->getStatusCode() === 5)
                                            Deal Rejected
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                    <td>{{ $deal->created_at }}</td>
                                    <td>&nbsp;</td>
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
        $('#partner-deals').DataTable();

        function confirmDelete()
        {
            vex.dialog.confirm({
                message: 'Are you sure you want to delete this user?',
                callback: function (value) {
                    if(value === true){
                        window.location.href = '{{route('admin.partners.index.delete', $partner->id)}}';
                    }

                }
            })
        }
    </script>
@endsection