@extends('app')

@section('title', 'Organisation Administration')

@extends('_partials.authenticated.account_bar')
@extends('_partials.vendor_menu')

@section('content')
    <div id="dashboard">
        <div id="page-topper">
            <div id="page-topper-bg"></div>
            <h1 id="page-title">Administration</h1>
            <h5 id="page-subtitle">Administration for {{ $vendor->name }}</h5>
            <div id="page-topper-breadcrumbs">
                <ul>
                    <li>
                        <a href="{{route('vendor.dashboard')}}">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        Administration
                    </li>
                </ul>
            </div>
        </div>
        <div id="vendor-opportunities">
            <h1>hello</h1>
        </div>
    </div>
@endsection
@section('scripts')

@endsection