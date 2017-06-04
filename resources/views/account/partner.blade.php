@extends('app')

@section('title', 'My Account')

@extends('_partials.authenticated.account_bar')
@extends('_partials.partner_menu')


@section('content')
    <div id="dashboard">
        <div id="page-topper">
            <div id="page-topper-bg"></div>
            <h1 id="page-title">Account</h1>
            <h5 id="page-subtitle">Edit your personal account settings.</h5>
            <div id="page-topper-breadcrumbs">
                <ul>
                    <li>
                        Account
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection