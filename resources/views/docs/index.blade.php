@extends('app')

@section('title', 'Documentation')

@extends('_partials.authenticated.account_bar')
@extends('_partials.docs_menu')

@section('content')
    <div id="docs">
        <div id="page-topper">
            <div id="page-topper-bg"></div>
            <h1 id="page-title">Documentation</h1>
            <h5 id="page-subtitle">Learn more about how to use Firecat</h5>
            <div id="page-topper-breadcrumbs">
                <ul>
                    <li>
                            Docs
                    </li>
                </ul>
            </div>
        </div>
        <div id="documentation">
            <p>Documentation to follow...</p>
        </div>
    </div>
@endsection