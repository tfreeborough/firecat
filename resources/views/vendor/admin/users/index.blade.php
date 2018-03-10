@extends('app')

@section('title', 'Organisation Users')

@section('content')
    <div id="page-topper">
        <div id="page-topper-bg"></div>
        <h1 id="page-title">Users</h1>
        <h5 id="page-subtitle">Users for {{ $vendor->name }}</h5>
        <div id="page-topper-breadcrumbs">
            <ul>
                <li>
                    <a href="{{route('vendor.dashboard')}}">
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{route('vendor.admin')}}">
                        Administration
                    </a>
                </li>
                <li>
                    Users
                </li>
            </ul>
        </div>
    </div>
    @include('_partials.flash_message')
    <div id="vendor-admin-users" class="block">
        <table id="vendor-admin-users-table" class="table">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Joined</th>
                <th>Last Login</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name() }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ \Carbon\Carbon::parse($user->created_at)->toDayDateTimeString() }}</td>
                    <td>{{ \Carbon\Carbon::parse($user->last_login)->toDayDateTimeString() }}</td>
                    <td>&nbsp;</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
@section('scripts')
    <script>
        $('#vendor-admin-users-table').DataTable();
    </script>
@endsection