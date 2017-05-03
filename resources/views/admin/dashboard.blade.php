@extends('app')

@section('title', 'My Dashboard')

@extends('_partials.authenticated.account_bar')
@extends('_partials.admin_menu')

@section('content')
    <div id="dashboard">
        <h1>Admin Dashboard</h1>
    </div>
@endsection