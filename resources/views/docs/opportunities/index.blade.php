@extends('app')

@section('title', 'Documentation - Opportunities')

@section('content')
    <div id="docs">

        <div id="page-topper">
            <div id="page-topper-bg"></div>
            <h1 id="page-title">Documentation - Opportunities</h1>
            <h5 id="page-subtitle">Learn more about opportunities</h5>
            <div id="page-topper-breadcrumbs">
                <ul>
                    <li>
                        <a href="{{route('docs')}}">
                            Docs
                        </a>
                    </li>
                    <li>
                        Opportunities
                    </li>
                </ul>
            </div>
        </div>
        <div id="opportunities">
            <div class="alert alert-warning">
                <p>
                    Please note that this documentation is being progressively updated and so content may appear missing or changed
                    over time.
                </p>
            </div>
            <div class="row">
                @include('docs.opportunities._partials.statuses')
                @include('docs.opportunities._partials.considerations')
            </div>
        </div>
    </div>
@endsection