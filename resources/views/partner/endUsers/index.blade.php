@extends('app')

@section('title', 'End Users')

@extends('_partials.authenticated.account_bar')
@extends('_partials.partner_menu')

@section('content')
    <div id="dashboard">
        <div id="page-topper">
            <div id="page-topper-bg"></div>
            <h1 id="page-title">End Users</h1>
            <h5 id="page-subtitle">Your currently added end users</h5>
            <div id="page-topper-breadcrumbs">
                <ul>
                    <li>
                        <a href="{{route('partner.dashboard')}}">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        End Users
                    </li>
                </ul>
            </div>
        </div>
        <div id="end-users">
            <div class="row">
                <div class="col-xs-12">
                    <a href="{{route('partner.endUsers.create')}}">
                        <button id="create-end-user" class="button large action">New End User</button>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <table id="end-users-table" class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Contact</th>
                                <th>Parent Organisation</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($endUsers as $endUser)
                                <tr>
                                    <td>
                                        {{ $endUser->name }}
                                    </td>
                                    <td>
                                        {{ $endUser->address_line_1 }} <br/>
                                        @if(isset($endUser->address_line_2))
                                            {{ $endUser->address_line_2 }} <br />
                                        @endif
                                        {{ $endUser->city }} <br />
                                        {{ $endUser->county }} <br />
                                        {{ $endUser->postcode }} <br />
                                        {{ $endUser->country }}
                                    </td>
                                    <td>
                                        {{ $endUser->contact_name }} <br />
                                        {{ $endUser->contact_number }} <br />
                                        {{ $endUser->contact_email }} <br />
                                        @if(isset($endUser->contact_job_title))
                                            {{ $endUser->contact_job_title }} <br />
                                        @endif
                                    </td>
                                    <td>
                                        @if(isset($endUser->parent_organisation))
                                            {{ $endUser->parent_organisation }}
                                        @else
                                            N/A
                                        @endif
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
        $('#end-users-table').DataTable();
    </script>
@endsection