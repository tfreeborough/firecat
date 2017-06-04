@extends('app')

@section('title', 'End Users')

@extends('_partials.authenticated.account_bar')
@extends('_partials.partner_menu')

@section('content')
    <div id="dashboard">
        <div id="not-found">
            <h2>We couldn't find the page you were looking for...</h2>
            <h2>Sorry :(</h2>
        </div>
    </div>
@endsection