@extends('app')

@section('title', 'My Dashboard')

@extends('_partials.authenticated.account_bar')
@extends('_partials.partner_menu')

@section('content')
    <div id="dashboard">
        <h1>Partner Dashboard</h1>
    </div>
@endsection