@extends('app')

@section('title', 'Partner Management')

@extends('_partials.authenticated.account_bar')
@extends('_partials.admin_menu')

@section('content')
    <div id="dashboard">
        <div id="page-topper">
            <div id="page-topper-bg"></div>
            <h1 id="page-title">Partner Management</h1>
            <h5 id="page-subtitle">Manage, Edit and Add new Partners to Firecat.</h5>
            <div id="page-topper-breadcrumbs">
                <ul>
                    <li>
                        <a href="{{route('admin.dashboard')}}">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        Partner Management
                    </li>
                </ul>
            </div>
        </div>
        <div id="partners">
            <div class="row">
                <div class="col-xs-12">
                    @include('_partials.flash_message')
                </div>
            </div>
            <a href="{{route('admin.partners.create')}}">
                <button class="button action">Create New Partner <i class="fa fa-users" aria-hidden="true"></i></button>
            </a>
            <table id="partners-table" class="table">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Opportunities</th>
                    <th>Deals</th>
                    <th>Last Login</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($partners as $partner)
                    <tr>
                        <td>{{ $partner->first_name }} {{ $partner->last_name }}</td>
                        <td>{{ $partner->email }}</td>
                        <td>{{ count($partner->opportunities) }}</td>
                        <td>{{ count($partner->deals) }}</td>
                        <td>{{ ( is_null($partner->last_login) ? 'Never' : \Carbon\Carbon::parse($partner->last_login)->setTimezone('Europe/London')->diffForHumans()) }}</td>
                        <td>
                            <a href="/admin/partners/{{$partner->id}}">
                                <button class="button" title="View this Partner"><i class="fa fa-eye" aria-hidden="true"></i></button>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        $('#partners-table').DataTable();
    </script>
@endsection