@extends('app')

@section('title', 'Opportunities -> Statuses')

@extends('_partials.authenticated.account_bar')
@extends('_partials.docs_menu')

@section('content')
    <div id="dashboard">

        <div id="page-topper">
            <div id="page-topper-bg"></div>
            <h1 id="page-title">Statuses</h1>
            <h5 id="page-subtitle">Learn more about opportunity statuses</h5>
            <div id="page-topper-breadcrumbs">
                <ul>
                    <li>
                        <a href="{{route('docs')}}">
                            Docs
                        </a>
                    </li>
                    <li>
                        <a href="{{route('docs.opportunities')}}">
                            Opportunities
                        </a>
                    </li>
                    <li>
                        Statuses
                    </li>
                </ul>
            </div>
        </div>
        <div id="opportunities">
            <div class="row">
                <div class="col-xs-12">
                    <h3>Learn more</h3>
                </div>
            </div>
        </div>
    </div>
@endsection