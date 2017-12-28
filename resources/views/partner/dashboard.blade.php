@extends('app')

@section('title', 'My Dashboard')

@section('content')
    <div id="dashboard">
        <div id="page-topper">
            <div id="page-topper-bg"></div>
            <h1 id="page-title">Dashboard</h1>
            <h5 id="page-subtitle">Where the magic happens.</h5>
            <div id="page-topper-breadcrumbs">
                <ul>
                    <li>
                        Dashboard
                    </li>
                </ul>
            </div>
        </div>
        <div id="partner-dashboard">
            <div class="row">
                <div class="col-xs-12">
                    @include('_partials.flash_message')
                </div>
            </div>
        </div>
    </div>
@endsection